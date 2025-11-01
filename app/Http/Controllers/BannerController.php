<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBannerRequest;
use App\Http\Requests\UpdateBannerRequest;
use App\Models\Banner;
use App\Models\Brand;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class BannerController extends Controller
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
            $brands = Banner::with('brand')->latest();

            return DataTables::of($brands)
                ->addIndexColumn()

                ->addColumn('title', function($row){
                    return strip_tags($row->title);
                })

                ->addColumn('description', function($row){
                    return strip_tags($row->description);
                })

                ->addColumn('price', function($row){
                    return strip_tags($row->price);
                })

                ->addColumn('brand', function($row){
                    return $row->brand?->brand_name ?? 'N/A';
                })

                ->addColumn('action', function ($row) {
                    $editUrl = route('banners.show', $row->id);

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

                ->rawColumns([
                    'title',
                    'description',
                    'price',
                    'brand',
                    'action'
                ])
                ->make(true);
        }

        $count = Banner::count();
        return view('banners.index', compact('count'));
    }
    public function create()
    {
        return view('banners.create');
    }
    public function store(StoreBannerRequest $request)
    {
        try
        {
            if($request->file('image')){
                $file = $request->file('image');
                $name = time() . auth()->user()->id . $file->getClientOriginalName();
                $file->move(public_path() . '/uploads/banner/', $name);
                $path = 'uploads/banner/' . $name;
            }
            Banner::create([
                'brand_id' => $request->brand_id,
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->price,
                'image' => $path,
            ]);

            $notification=array(
                'messege'=>"Successfully a banner has been added",
                'alert-type'=>"success",
            );

            return redirect()->route('banners.index')->with($notification);

        } catch(Exception $e) {
            // Log the error
            Log::error('Error in store: ', [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            $notification=array(
                'messege' => 'Something went wrong!!!',
                'alert-type' => 'error'
            );

            return redirect()->route('banners.index')->with($notification);
        }
    }
    public function show(Banner $banner)
    {
        return view('banners.edit', compact('banner'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        //
    }
    public function update(UpdateBannerRequest $request, Banner $banner)
    {
        try
        {
            if($request->file('image')){
                $file = $request->file('image');
                $name = time() . auth()->user()->id . $file->getClientOriginalName();
                unlink(public_path($banner->image));
                $file->move(public_path() . '/uploads/banners/', $name);
                $path = 'uploads/banners/' . $name;
            }else{
                $path = $banner->image;
            }

            $banner->brand_id = $request->brand_id;
            $banner->title = $request->title;
            $banner->description = $request->description;
            $banner->price = $request->price;
            $banner->image = $path;
            $banner->update();

            $notification=array(
                'messege' => "Successfully the banner has been updated",
                'alert-type' => "success",
            );

            return redirect()->route('banners.index')->with($notification);

        } catch(Exception $e) {
            // Log the error
            Log::error('Error in update: ', [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            $notification=array(
                'messege' => 'Something went wrong!!!',
                'alert-type' => 'error'
            );

            return redirect()->route('banners.index')->with($notification);
        }
    }

    public function destroy(Banner $banner)
    {
        try {
            $banner->delete();
            return response()->json(['status'=>true, 'message'=>"Successfully the brand has been deleted"]);
        } catch(Exception $e) {
            // Log the error
            Log::error('Error in delete: ', [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['status'=>false, 'message'=>"Something went wrong"],500);
        }
    }
}
