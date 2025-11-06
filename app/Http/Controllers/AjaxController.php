<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Brand;
use App\Models\Unit;
use App\Models\Variant;
use App\Models\Product;
use App\Models\Productvariant;
use App\Models\Cart;
use App\Models\Whishlist;
use Exception;
use Illuminate\Support\Facades\Log;
use Session;
session_start();
use Auth;

class AjaxController extends Controller
{
    public function categoryStatusUpdate(Request $request)
    {
    	try
    	{
    		$category = Category::findorfail($request->category_id);
    		$category->status = $request->status;
    		$category->update();
    		return response()->json(['status'=>true, 'message'=>"Successfully the category's status has been updated"]);
    	}catch(Exception $e){
    		return response()->json(['status'=>false, 'code'=>$e->getCode(), 'message'=>$e->getMessage()],500);
    	}
    }

    public function subCategoryStatusUpdate(Request $request)
    {
        try
        {
            $subcategory = Subcategory::findorfail($request->subcategory_id);
            $subcategory->status = $request->status;
            $subcategory->update();
            return response()->json(['status'=>true, 'message'=>"Successfully the subcategory's status has been updated"]);
        }catch(Exception $e){
            return response()->json(['status'=>false, 'code'=>$e->getCode(), 'message'=>$e->getMessage()],500);
        }
    }

    public function brandStatusUpdate(Request $request)
    {
        try
        {
            $brand = Brand::findorfail($request->brand_id);
            $brand->status = $request->status;
            $brand->update();
            return response()->json(['status'=>true, 'message'=>"Successfully the brand's status has been updated"]);
        }catch(Exception $e){
            return response()->json(['status'=>false, 'code'=>$e->getCode(), 'message'=>$e->getMessage()],500);
        }
    }

    public function unitStatusUpdate(Request $request)
    {
        try
        {
            $unit = Unit::findorfail($request->unit_id);
            $unit->status = $request->status;
            $unit->update();
            return response()->json(['status'=>true, 'message'=>"Successfully the unit's status has been updated"]);
        }catch(Exception $e){
            return response()->json(['status'=>false, 'code'=>$e->getCode(), 'message'=>$e->getMessage()],500);
        }
    }

    public function variantStatusUpdate(Request $request)
    {
        try
        {
            $variant = Variant::findorfail($request->variant_id);
            $variant->status = $request->status;
            $variant->update();
             return response()->json(['status'=>true, 'message'=>"Successfully the variant's status has been updated"]);
        }catch(Exception $e){
            return response()->json(['status'=>false, 'code'=>$e->getCode(), 'message'=>$e->getMessage()],500);
        }
    }

    public function productStatusUpdate(Request $request)
    {
        try
        {
            $product = Product::findorfail($request->product_id);
            $product->status = $request->status;
            $product->update();
             return response()->json(['status'=>true, 'message'=>"Successfully the product's status has been updated"]);
        }catch(Exception $e){
            return response()->json(['status'=>false, 'code'=>$e->getCode(), 'message'=>$e->getMessage()],500);
        }
    }

    public function getSubcategories($id)
    {
        try
        {
            $category = Category::findorfail($id);
            $subcategories = $category->subcategories;
            return response()->json(['status'=>count($subcategories) > 0, 'data'=>$subcategories]);
        }catch(Exception $e){
            return response()->json(['status'=>false, 'code'=>$e->getCode(), 'message'=>$e->getMessage()],500);
        }
    }

    public function addProductVariant($id)
    {
        $product = Product::findorfail($id);
        $variants = Variant::with(['productvariants' => function ($query) use ($id) {
            $query->where('product_id', $id);
        }])->get();
        //return $variants;
        return view('products.add_variant', compact('product','variants'));
    }


    public function saveProductVariant(Request $request)
    {
        try {
            $product_id = $request->product_id;
            $variant_values = $request->variant_values ?? [];
            $variant_prices = $request->variant_prices ?? [];
            $stock_qtys = $request->stock_qtys ?? [];
            $images = $request->file('images') ?? [];
            $productvariant_ids = $request->productvariant_ids ?? [];

            foreach ($variant_values as $variant_id => $values) {
                foreach ($values as $index => $value) {

                    if (empty($value)) continue;

                    $pv_id = $productvariant_ids[$variant_id][$index] ?? null;

                    $data = [
                        'product_id'    => $product_id,
                        'variant_id'    => $variant_id,
                        'variant_value' => $value,
                        'variant_price' => $variant_prices[$variant_id][$index] ?? null,
                        'stock_qty'     => $stock_qtys[$variant_id][$index] ?? 0,
                    ];

                    if (isset($images[$variant_id][$index]) && $images[$variant_id][$index]->isValid()) {
                        $file = $images[$variant_id][$index];
                        $imageName = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                        $file->move(public_path('uploads/variants'), $imageName);
                        $data['image'] = 'uploads/variants/' . $imageName;
                    }

                    if ($pv_id && $existing = ProductVariant::find($pv_id)) {
                        $existing->update($data);
                    } else {
                        ProductVariant::create($data);
                    }
                }
            }

            $notification=array(
                'messege'=>"Successfully variant added/updated",
                'alert-type'=>"success",
            );

            return redirect()->back()->with($notification);

        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteVariant($id)
    {
        try
        {
            $variant = Productvariant::findorfail($id);
            if($variant->image != NULL){
                unlink(public_path($variant->image));
            }
            $variant->delete();
            return response()->json(['status'=>true, 'message'=>'Successfully the variant has been deleted']);
        }catch (Exception $e) {
            return response()->json([
                'status' => false,
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function addToCart(Request $request)
    {
        try {
            $product = Product::find($request->element_id);
            $variant = Productvariant::find($request->element_id);
            $cart_session_id = Session::get('cart_session_id');
            $count = Cart::count() + 1;

            // 🧠 Stock check
            if (!stockCheck($request)) {
                return response()->json(['status' => false, 'message' => 'The product is sold out']);
            }

            // ✅ NEW: Stock check for variants or base product
            if ($variant) {
                if ($variant->stock_qty == 0 || ($variant->stock_qty && $request->qty > $variant->stock_qty)) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Only ' . $variant->variant_stock_qty . ' items available in this variant'
                    ]);
                }
            } else {
                if ($product && $product->stock_qty && $request->qty > $product->stock_qty) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Only ' . $product->stock_qty . ' items available in stock'
                    ]);
                }
            }

            // 🧠 Create session ID if missing
            if (empty($cart_session_id)) {
                $new_session_id = rand(1000, 9000) . $count;
                Session::put('cart_session_id', $new_session_id);
                $cart_session_id = $new_session_id;
            }

            // 🧮 Determine price
            if ($product) {
                $price = discount($product);
            } else {
                $price = $variant->variant_price ?? $product->product_price;
            }

            // 🧩 Handle variants - Sort and normalize
            $variantIds = null;
            $sortedVariantArray = null;

            if ($request->has('productvariant_ids') && !empty($request->productvariant_ids)) {
                // Convert to array if it's a string
                $variantArray = is_array($request->productvariant_ids)
                    ? $request->productvariant_ids
                    : json_decode($request->productvariant_ids, true);

                // Sort the array to ensure consistent comparison
                sort($variantArray);
                $sortedVariantArray = $variantArray;
                $variantIds = json_encode($sortedVariantArray);
            }

            // 🧠 Find existing cart with same product and variants
            $cart = null;

            if ($variantIds) {
                // For products with variants - check all carts with this product
                $existingCarts = Cart::where('product_id', $product->id)
                    ->where('cart_session_id', $cart_session_id)
                    ->whereNotNull('productvariant_ids')
                    ->get();

                // Compare decoded JSON arrays
                foreach ($existingCarts as $existingCart) {
                    $existingVariants = json_decode($existingCart->productvariant_ids, true);

                    if ($existingVariants) {
                        sort($existingVariants); // Sort for comparison

                        // Compare sorted arrays
                        if ($existingVariants == $sortedVariantArray) {
                            $cart = $existingCart;
                            break;
                        }
                    }
                }
            } else {
                // For products without variants - simple query
                $cart = Cart::where('product_id', $product->id)
                    ->where('cart_session_id', $cart_session_id)
                    ->whereNull('productvariant_ids')
                    ->first();
            }

            // 🛒 If exists — update qty
            if ($cart) {
                $newQty = $request->has('qty')
                    ? $cart->cart_qty + $request->qty
                    : $cart->cart_qty + 1;

                // Check if new quantity exceeds stock
                if ($product && $product->stock_qty && $newQty > $product->stock_qty) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Cannot add more. Only ' . $product->stock_qty . ' items available in stock'
                    ]);
                }

                $cart->cart_qty = $newQty;
                $cart->unit_total = round($price * $newQty, 2);
                $cart->save();
            }
            // 🆕 Else — create new cart entry
            else {
                $qty = $request->has('qty') ? $request->qty : 1;

                $cart = new Cart();
                $cart->product_id = $product->id;
                $cart->cart_session_id = $cart_session_id;
                $cart->productvariant_id = $request->use_for == 'variant' ? $variant->id : null;
                $cart->productvariant_ids = $variantIds; // This is now properly formatted JSON
                $cart->cart_qty = $qty;
                $cart->unit_total = round($price * $qty, 2);
                $cart->save();
            }

            // 🧾 Count and HTML
            $countCart = Cart::where('cart_session_id', $cart_session_id)->count();
            $cartData = $this->getCartHtml2();

            return response()->json([
                'status' => true,
                'cart_count' => $countCart,
                'message' => $cart->wasRecentlyCreated
                    ? 'Product added to cart successfully'
                    : 'Cart quantity updated successfully',
                'cart_html' => $cartData['html'],
                'cart_sum' => $cartData['sum'],
            ]);

        } catch (Exception $e) {
            Log::error('Add to cart error: ' . $e->getMessage(), [
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ]);

            return response()->json([
                'status' => false,
                'code' => $e->getCode(),
                'message' => 'Failed to add product to cart: ' . $e->getMessage()
            ], 500);
        }
    }

    public function cartEmpty()
    {
        try
        {
            Cart::truncate();
            // Get rendered cart HTML + sum + count
//            $cartData = $this->getCartHtml();
            $cartData = $this->getCartHtml2();

            return response()->json([
                'status' => true,
                'cart_count' => 0,
                'message' => 'Successfully the product has been added to cart',
                'cart_html' => $cartData['html'],
                'cart_sum' => $cartData['sum'],
            ]);

            # return response()->json(['status'=>true, 'message'=>"Cart empty done"]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function cartDelete($id)
    {
        try
        {
            $cart = Cart::findorfail($id);
            $cart->delete();
            $count = Cart::where('cart_session_id',Session::get('cart_session_id'))->count();

            // Get rendered cart HTML + sum + count
//            $cartData = $this->getCartHtml();
            $cartData = $this->getCartHtml2();

            return response()->json([
                'status' => true,
                'cart_count' => $count,
                'message' => 'Successfully the product has been added to cart',
                'cart_html' => $cartData['html'],
                'cart_sum' => $cartData['sum'],
            ]);

            # return response()->json(['status'=>true, 'cart_count'=>$count, 'message'=>'Successfully the cart has been deleted']);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function productVariantDetails($id)
    {
        try
        {
            $variant = Productvariant::findorfail($id);
            return response()->json(['status'=>$variant->image == NUll?false:true, 'variant'=>$variant]);
        }catch(Exception $e) {
            return response()->json([
                'status' => false,
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function addWishlist($id)
    {
        try
        {
            $product = Product::findorfail($id);
            if(Auth::check()){
                $count = Whishlist::where('user_id',user()->id)->where('product_id',$product->id)->count();
                if($count > 0){
                    return response()->json(['status'=>false, 'message'=>'The product already in wishlist']);
                }
                $list = new Whishlist();
                $list->user_id = user()->id;
                $list->product_id = $product->id;
                $list->save();
                return response()->json(['status'=>true, 'message'=>'Successfully whishlisted']);
            }

            return response()->json(['status'=>false, 'message'=>'Please Logged In First']);

        }catch(Exception $e) {
            return response()->json([
                'status' => false,
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function removeWishlist($id)
    {
        try
        {
            $wishlist = Whishlist::findorfail($id);
            $wishlist->delete();
            return response()->json(['status'=>true, 'message'=>'Successfully the wishlist has been deleted']);
        }catch(Exception $e) {
            return response()->json([
                'status' => false,
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ], 500);
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

}
