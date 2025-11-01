<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use DataTables;

class BrandController extends Controller
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
            $brands = Brand::latest();

            return DataTables::of($brands)
                ->addIndexColumn()

                ->addColumn('status', function ($row) {
                    $checked = $row->status === 'Active' ? 'checked' : '';
                    $class   = $row->status === 'Active' ? 'active-brand' : 'decline-brand';

                    return '
                        <label class="switch">
                            <input
                                type="checkbox"
                                class="' . $class . '"
                                id="status-brand-update"
                                data-id="' . $row->id . '"
                                ' . $checked . '
                            >
                            <span class="slider round"></span>
                        </label>
                    ';
                })

                ->addColumn('action', function ($row) {
                    $editUrl = route('brands.show', $row->id);

                    return '
                        <a href="' . $editUrl . '"
                           class="btn btn-primary btn-sm action-button edit-brand"
                           data-id="' . $row->id . '">
                            <i class="fa fa-edit"></i>
                        </a>
                        &nbsp;
                        <button type="button"
                           class="btn btn-danger btn-sm delete-brand action-button"
                           data-id="' . $row->id . '">
                            <i class="fa fa-trash"></i>
                        </button>
                    ';
                })

                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        return view('brands.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('brands.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBrandRequest $request)
    {
        try
        {
            if($request->file('image')){
                $file = $request->file('image');
                $name = time() . auth()->user()->id . $file->getClientOriginalName();
                $file->move(public_path() . '/uploads/brands/', $name);
                $path = 'uploads/brands/' . $name;
            }
            Brand::create([
                'user_id' => user()->id,
                'brand_name' => $request->brand_name,
                'is_mega_menu' => $request->has('is_mega_menu')?$request->is_mega_menu:0,
                'status' => $request->status,
                'image' => $path,
            ]);

            $notification=array(
                'messege'=>"Successfully a brand has been added",
                'alert-type'=>"success",
            );

            return redirect()->back()->with($notification);

        }catch(Exception $e){
            return response()->json(['status'=>false, 'code'=>$e->getCode(), 'message'=>$e->getMessage()],500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        return view('brands.edit', compact('brand'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        try
        {
            if($request->file('image')){
                $file = $request->file('image');
                $name = time() . auth()->user()->id . $file->getClientOriginalName();
                unlink(public_path($brand->image));
                $file->move(public_path() . '/uploads/brands/', $name);
                $path = 'uploads/brands/' . $name;
            }else{
                $path = $brand->image;
            }

            $brand->brand_name = $request->brand_name;
            $brand->is_mega_menu = $request->has('is_mega_menu')?$request->is_mega_menu:$brand->is_mega_menu;
            $brand->status = $request->status;
            $brand->image = $path;
            $brand->update();

            $notification=array(
                'messege'=>"Successfully the brand has been updated",
                'alert-type'=>"success",
            );

            return redirect('/brands')->with($notification);

        }catch(Exception $e){
            return response()->json(['status'=>false, 'code'=>$e->getCode(), 'message'=>$e->getMessage()],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        try
        {
            $brand->products()->delete();
            $brand->delete();
            return response()->json(['status'=>true, 'messsage'=>"Successfully the brand has been deleted"]);
        }catch(Exception $e){
            return response()->json(['status'=>false, 'code'=>$e->getCode(), 'message'=>$e->getMessage()],500);
        }
    }
}
