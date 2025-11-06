<?php

namespace App\Http\Controllers;

use App\Models\Productvariant;
use App\Models\Setting;
use Exception;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;
use App\Models\Orderdetail;
use App\Http\Requests\CheckoutRequest;
use Illuminate\Support\Facades\Log;
use Session;
use DB;

class CheckoutController extends Controller
{
    public function checkout()
    {
        $cart = Cart::where('cart_session_id',Session::get('cart_session_id'))->exists();
        if (!$cart) {
            $notification=array(
                'messege' => "Add product on cart.",
                'alert-type' => "error",
            );
            return redirect()->route('home')->with($notification);
        }
    	if(auth()->check()){
    		$carts = Cart::with('product')->where('cart_session_id',Session::get('cart_session_id'))->get();
	    	$sum = Cart::where('cart_session_id',Session::get('cart_session_id'))->sum('unit_total');
            $settings = Setting::first();

	    	return view('fronts.checkout',compact('carts','sum', 'settings'));
    	} else {
            $notification=array(
                'messege' => "Please login first.",
                'alert-type' => "error",
            );
            return redirect()->route('home')->with($notification);
    	}

    }

    public function saveOrder(CheckoutRequest $request)
    {
    	DB::beginTransaction();
    	try
    	{
    		date_default_timezone_set("Asia/Dhaka");
    		//return response()->json($request->all());
    		$carts = Cart::with('product')->where('cart_session_id',Session::get('cart_session_id'))->get();
    		$sum = Cart::where('cart_session_id',Session::get('cart_session_id'))->sum('unit_total');
    		//$orders = [];

    		if($request->file('image')){
                $file = $request->file('image');
                $name = time() . auth()->user()->id . $file->getClientOriginalName();
                $file->move(public_path() . '/uploads/order/', $name);
                $path = 'uploads/order/' . $name;
            }else{
            	$path = NULL;
            }

    		$detail = new Orderdetail();
    		$detail->user_id = user()->id;
    		$detail->paymentmethod_id = $request->paymentmethod_id;
    		$detail->name = $request->name;
    		$detail->email = $request->email;
    		$detail->phone = $request->phone;
    		$detail->zip_code = $request->zip_code;
    		$detail->full_address = $request->full_address;
    		$detail->sub_total = $sum;
    		$detail->delivery_charge = $request->delivery_charge;
    		$detail->total = $sum + $request->delivery_charge;
    		$detail->date = date('Y-m-d');
    		$detail->time = date('h:i: a');
    		$detail->timestamp = time();
    		$detail->status = 'Pending';
    		$detail->screen_shot = $path;
    		$detail->save();

    		foreach($carts as $cart){
                // product stock decrease
                $product = Product::find($cart->product_id);
                if($product) {
                    $product->stock_qty = $product->stock_qty - $cart->cart_qty;
                    $product->update();
                }

                // ✅ যদি variant থাকে তাহলে প্রতিটি variant-এর stock_qty কমাও
                if(!empty($cart?->productvariant_ids)) {
                    // JSON হলে decode করো
                    $variantIds = is_array($cart->productvariant_ids) ? $cart->productvariant_ids : json_decode($cart->productvariant_ids, true);

                    foreach($variantIds as $variantId) {
                        $productVariant = Productvariant::find($variantId);
                        if($productVariant) {
                            // stock কমাও
                            $productVariant->stock_qty = max(0, $productVariant->stock_qty - $cart->cart_qty);
                            $productVariant->save();
                        }
                    }
                }

    			$order = new Order();
    			$order->orderdetail_id = $detail->id;
                $order->variants = $cart->productvariant_ids;
    			$order->product_id = $cart->product_id;
    			$order->price = discount($cart->product);
    			$order->qty = $cart->cart_qty;
    			$order->unit_total = $cart->unit_total;
    			$order->save();
    		}

    		Session::forget('cart_session_id');

            // Get rendered cart HTML + sum + count
            $cartData = $this->getCartHtml();

    		$notification=array(
                'messege'=>"Successfully your order has been taken. We Will Contact you soon",
                'alert-type'=>"success",
            );

    		DB::commit();

            return redirect('/')->with($notification);

    	}catch(Exception $e){
    		DB::rollback();
            # return response()->json(['status'=>false, 'code'=>$e->getCode(), 'message'=>$e->getMessage()],500);

            $notification=array(
                'messege' => "Something went wrong!!!",
                'alert-type' => "error",
            );
            return redirect('/')->with($notification);
        }
    }
    public function getCartHtml()
    {
        try {
            $carts = Cart::with('product', 'productvariant', 'product.images')
                ->where('cart_session_id', Session::get('cart_session_id'))
                ->latest()
                ->get();

            $sum = Cart::where('cart_session_id', Session::get('cart_session_id'))
                ->sum('unit_total');

            // Render the partial (make sure this view path is correct)
            $view = view('fronts.components.cart-dropdown', compact('carts', 'sum'))->render();

            return [
                'success' => true,
                'html' => $view,
                'sum' => $sum,
                'count' => $carts->count(),
            ];
        } catch (Exception $e) {
            Log::error('Error in getCartHtml : '.$e->getMessage(), [
                'code' => $e->getCode(),
                'line' => $e->getLine()
            ]);

            return [
                'success' => false,
                'html' => '',
                'sum' => 0,
                'count' => 0,
            ];
        }
    }
    public function showBankInfo()
    {
        $settings = Setting::first([
            'bank_name',
            'branch_name',
            'routing_number',
            'acc_no'
        ]);

        return view('fronts.bank_info', compact('settings'));
    }
    public function showBkashInfo()
    {
        $settings = Setting::first([
            'bkash_no',
            'account_type'
        ]);

        return view('fronts.bkash_info', compact('settings'));
    }

}
