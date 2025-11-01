<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Log;
use Session;

class CartController extends Controller
{
    public function carts()
    {
        $carts = Cart::with('product','productvariant', 'product.images')->where('cart_session_id',Session::get('cart_session_id'))->latest()->get();
        $sum = Cart::where('cart_session_id',Session::get('cart_session_id'))->sum('unit_total');
        return view('fronts.carts', compact('carts','sum'));
    }


    public function cartUpdate(Request $request)
    {
        try {

            $sessionId = $request->session_id ?? Session::get('cart_session_id');

            $cartItems = Cart::where('cart_session_id', $sessionId)->get();

            foreach ($cartItems as $cart) {
                $qtyInput = $request->input('cart_qty_' . $cart->id);

                $product = Product::where('id', $cart->product_id)->first();
                if ($product && $product->stock_qty && $qtyInput > $product->stock_qty) {
                    return redirect()->back()->with([
                        'messege' => 'Requested quantity for "' . $product->product_name . '" exceeds available stock.',
                        'alert-type' => "error"
                    ]);
                }

                if ($qtyInput && $qtyInput > 0) {
                    if ($cart->productvariant_id) {
                        $price = $cart->productvariant->pricevariant_price;
                    } else {
                        $price = discount($cart->product);
                    }

                    $unitTotal = $price * $qtyInput;

                    $cart->cart_qty = $qtyInput;
                    $cart->unit_total = number_format($unitTotal, 2, '.', '');
                    $cart->save();
                }
            }

            $count = Cart::where('cart_session_id',Session::get('cart_session_id'))->count();
            // Get rendered cart HTML + sum + count
            $cartData = $this->getCartHtml2();

//            return response()->json([
//                'status' => true,
//                'cart_count' => $count,
//                'message' => 'Cart updated successfully.',
//                'cart_html' => $cartData['html'],
//                'cart_sum' => $cartData['sum'],
//            ]);

            return redirect()->back()->with([
                'messege' => "Cart updated successfully!",
                'alert-type' => "success"
            ]);

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
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
    public function getCartHtml2()
    {
        try {
            $carts = Cart::with('product', 'productvariant', 'product.images')
                ->where('cart_session_id', Session::get('cart_session_id'))
                ->latest()
                ->get();

            $sum = Cart::where('cart_session_id', Session::get('cart_session_id'))
                ->sum('unit_total');

            // Render the partial (make sure this view path is correct)
            #$view = view('fronts.components.cart-dropdown-2', compact('carts', 'sum'))->render();
            $view = view('fronts.components.cart-dropdown-inner', compact('carts', 'sum'))->render();

            return [
                'success' => true,
                'html' => $view,
                'sum' => $sum,
                'count' => $carts->count(),
            ];
        } catch (Exception $e) {
            Log::error('Error in getCartHtml2 : '.$e->getMessage(), [
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
    public function cartUpdateAjax(Request $request)
    {
        try {
            $cart_id = $request->cart_id;
            $qty = $request->qty;

            $cart = Cart::find($cart_id);

            if (!$cart) {
                return response()->json([
                    'status' => false,
                    'message' => 'Cart item not found'
                ]);
            }

            // Check stock
            $product = Product::find($cart->product_id);
            if ($product && $product->stock_qty && $qty > $product->stock_qty) {
                return response()->json([
                    'status' => false,
                    'message' => 'Requested quantity exceeds available stock (' . $product->stock_qty . ' available)'
                ]);
            }

            // Calculate price
            if ($cart->productvariant_id) {
                $price = $cart->productvariant->variant_price;
            } else {
                $price = discount($cart->product);
            }

            // Update cart
            $cart->cart_qty = $qty;
            $cart->unit_total = round($price * $qty, 2);
            $cart->save();

            // Get updated cart data
            $countCart = Cart::where('cart_session_id', Session::get('cart_session_id'))->count();
            $cartData = $this->getCartHtml();

            return response()->json([
                'status' => true,
                'cart_count' => $countCart,
                'message' => 'Cart updated successfully',
                'cart_html' => $cartData['html'],
                'cart_sum' => $cartData['sum'],
            ]);

        } catch (\Exception $e) {
            Log::error('Error updating cart: ' . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to update cart: ' . $e->getMessage()
            ], 500);
        }
    }
    public function cartDelete($id)
    {
        try {
            $cart = Cart::find($id);

            if (!$cart) {
                return response()->json([
                    'status' => false,
                    'message' => 'Cart item not found'
                ]);
            }

            $cart->delete();

            // Get updated cart data
            $countCart = Cart::where('cart_session_id', Session::get('cart_session_id'))->count();
            $cartData = $this->getCartHtml();

            return response()->json([
                'status' => true,
                'cart_count' => $countCart,
                'message' => 'Item removed from cart',
                'cart_html' => $cartData['html'],
                'cart_sum' => $cartData['sum'],
            ]);

        } catch (\Exception $e) {
            Log::error('Error deleting cart: ' . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to remove item'
            ], 500);
        }
    }
}
