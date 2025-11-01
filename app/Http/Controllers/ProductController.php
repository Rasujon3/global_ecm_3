<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Subcategory;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth_check');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $products = Product::latest();

            return DataTables::of($products)
                ->addIndexColumn()


                ->addColumn('category', function ($row) {

                    return $row->category->category_name;
                })

                ->addColumn('unit', function ($row) {

                    return $row->unit->unit_name;
                })

                ->addColumn('status', function ($row) {
                    $checked = $row->status === 'Active' ? 'checked' : '';
                    $class   = $row->status === 'Active' ? 'active-product' : 'decline-product';

                    return '
                        <label class="switch">
                            <input
                                type="checkbox"
                                class="' . $class . '"
                                id="status-product-update"
                                data-id="' . $row->id . '"
                                ' . $checked . '
                            >
                            <span class="slider round"></span>
                        </label>
                    ';
                })

                ->addColumn('action', function ($row) {
                    $editUrl = route('products.show', $row->id);
                    $variantUrl = url('/add-product-variant/'.$row->id);
                    return '

                        <a href="' . $variantUrl . '"
                           class="btn btn-success btn-sm action-button add-product-variant" >
                            Add/Edit Variant
                        </a>

                        &nbsp;

                        <a href="' . $editUrl . '"
                           class="btn btn-primary btn-sm action-button edit-product"
                           data-id="' . $row->id . '">
                            Edit
                        </a>
                        &nbsp;

                        <button type="button"
                           class="btn btn-danger btn-sm delete-product action-button"
                           data-id="' . $row->id . '">
                            Delete
                        </button>
                    ';
                })

                ->rawColumns(['status', 'action','category','unit'])
                ->make(true);
        }

        return view('products.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    public function store(StoreProductRequest $request)
    {
        DB::beginTransaction();
        try
        {
//            if($request->file('image')){
//                $file = $request->file('image');
//                $name = time() . auth()->user()->id . $file->getClientOriginalName();
//                $file->move(public_path() . '/uploads/products/', $name);
//                $path = 'uploads/products/' . $name;
//            }
            $product = Product::create([
                'user_id' => user()->id,
                'unit_id' => $request->unit_id,
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'brand_id' => $request->brand_id,
                'product_name' => $request->product_name,
                'product_price' => $request->product_price,
                'discount' => $request->discount,
                'status' => $request->status,
                # 'image' => $path,
                'description' => $request->description,
                'stock_qty' => $request->stock_qty,
                'is_arrival_product' => $request->is_arrival_product,
                'is_best_seller' => $request->is_best_seller,
                'tag' => $request->tag,
            ]);

            if($request->hasFile('images') && count($request->file('images')) > 0) {
                foreach ($request->file('images') as $image) {
                    $file = $image;
                    $name = time() . auth()->user()->id . $file->getClientOriginalName();
                    $file->move(public_path() . '/uploads/products/', $name);
                    $path = 'uploads/products/' . $name;

                    $productImage = new ProductImage();
                    $productImage->product_id = $product->id;
                    $productImage->user_id = user()->id;
                    $productImage->image = $path;
                    $productImage->save();
                }
            }

            DB::commit();

            $notification=array(
                'messege' => "Successfully a product has been added",
                'alert-type' => "success",
            );

            return redirect()->route('products.index')->with($notification);

        } catch(Exception $e) {
            DB::rollBack();
            Log::error('Error in store:', [
                'message' => $e->getMessage(),
                'code'    => $e->getCode(),
                'line'    => $e->getLine(),
                'trace'   => $e->getTraceAsString(),
            ]);

            $notification=array(
                'messege'=>"Something went wrong!",
                'alert-type'=>"error",
            );

            return redirect()->route('products.index')->with($notification);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $subcategories = Subcategory::where('category_id',$product->category_id)->latest()->get();
        return view('products.edit', compact('product','subcategories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }


    public function update(UpdateProductRequest $request, Product $product)
    {
        DB::beginTransaction();
        try
        {
//            if($request->file('image')){
//                $file = $request->file('image');
//                $name = time() . auth()->user()->id . $file->getClientOriginalName();
//                $file->move(public_path() . '/uploads/products/', $name);
//                unlink(public_path($product->image));
//                $path = 'uploads/products/' . $name;
//            }else{
//                $path = $product->image;
//            }

            $product->unit_id = $request->unit_id;
            $product->category_id = $request->category_id;
            $product->subcategory_id = $request->subcategory_id;
            $product->brand_id = $request->brand_id;
            $product->product_name = $request->product_name;
            $product->discount = $request->discount;
            $product->status = $request->status;
            # $product->image = $path;
            $product->description = $request->description;
            $product->stock_qty = $request->stock_qty;
            $product->is_arrival_product = $request->is_arrival_product;
            $product->is_best_seller = $request->is_best_seller;
            $product->tag = $request->tag;
            $product->update();

            if($request->hasFile('images') && count($request->file('images')) > 0) {
                $product->images()->delete();
                foreach ($request->file('images') as $image) {
                    $file = $image;
                    $name = time() . auth()->user()->id . $file->getClientOriginalName();
                    $file->move(public_path() . '/uploads/products/', $name);
                    $path = 'uploads/products/' . $name;

                    $productImage = new ProductImage();
                    $productImage->product_id = $product->id;
                    $productImage->user_id = user()->id;
                    $productImage->image = $path;
                    $productImage->save();
                }
            }

            DB::commit();

            $notification=array(
                'messege'=>"Successfully the product has been updated",
                'alert-type'=>"success",
            );

            return redirect('/products')->with($notification);

        } catch(Exception $e) {
            DB::rollBack();
            Log::error('Error in update:', [
                'message' => $e->getMessage(),
                'code'    => $e->getCode(),
                'line'    => $e->getLine(),
                'trace'   => $e->getTraceAsString(),
            ]);

            $notification=array(
                'messege'=>"Something went wrong!",
                'alert-type'=>"error",
            );

            return redirect()->route('products.index')->with($notification);
        }
    }
    public function destroy(Product $product)
    {
        DB::beginTransaction();
        try
        {
//            unlink(public_path($product->image));

            $product->carts()->delete();
            $product->whishlist()->delete();
            # $product->orders()->delete();
            $product->images()->delete();
            $product->delete();

            DB::commit();

            return response()->json(['status'=>true, 'message'=>"Successfully the product has been deleted"]);
        } catch(Exception $e) {
            DB::rollBack();
            return response()->json(['status'=>false, 'code'=>$e->getCode(), 'message'=>$e->getMessage()],500);
        }
    }
    public function deleteImage($id)
    {
        try {
            $image = ProductImage::findOrFail($id);

            // Delete the image file from storage
            if (file_exists(public_path($image->image))) {
                unlink(public_path($image->image));
            }

            // Delete DB record
            $image->delete();

            return response()->json(['status' => true, 'message' => 'Image deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
    }

}
