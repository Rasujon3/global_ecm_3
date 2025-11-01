<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBannerRequest;
use App\Http\Requests\StoreCosmeticRequest;
use App\Http\Requests\UpdateBannerRequest;
use App\Http\Requests\UpdateCosmeticRequest;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Cosmetic;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CosmeticController extends Controller
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
            $brands = Cosmetic::with('brand')->latest();

            return DataTables::of($brands)
                ->addIndexColumn()

                ->addColumn('title', function($row){
                    return strip_tags($row->title);
                })

                ->addColumn('description', function($row){
                    return strip_tags($row->description);
                })

                ->addColumn('brand', function($row){
                    return $row->brand?->brand_name ?? 'N/A';
                })

                ->addColumn('action', function ($row) {
                    $editUrl = route('cosmetics.show', $row->id);

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
                    'brand',
                    'action'
                ])
                ->make(true);
        }

        $count = Cosmetic::count();
        return view('cosmetics.index', compact('count'));
    }
    public function create()
    {
        return view('cosmetics.create');
    }
    public function store(StoreCosmeticRequest $request)
    {
        try
        {
            if($request->file('image')){
                $file = $request->file('image');
                $name = time() . auth()->user()->id . $file->getClientOriginalName();
                $file->move(public_path() . '/uploads/cosmetics/', $name);
                $path = 'uploads/cosmetics/' . $name;
            }

            Cosmetic::create([
                'brand_id' => $request->brand_id,
                'title' => $request->title,
                'description' => $request->description,
                'image' => $path,
            ]);

            $notification=array(
                'messege'=>"Successfully a cosmetics has been added",
                'alert-type'=>"success",
            );

            return redirect()->route('cosmetics.index')->with($notification);

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

            return redirect()->route('cosmetics.index')->with($notification);
        }
    }
    public function show(Cosmetic $cosmetic)
    {
        return view('cosmetics.edit', compact('cosmetic'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cosmetic  $cosmetic
     * @return \Illuminate\Http\Response
     */
    public function edit(Cosmetic $cosmetic)
    {
        //
    }
    public function update(UpdateCosmeticRequest $request, Cosmetic $cosmetic)
    {
        try
        {
            if($request->file('image')){
                $file = $request->file('image');
                $name = time() . auth()->user()->id . $file->getClientOriginalName();
                unlink(public_path($cosmetic->image));
                $file->move(public_path() . '/uploads/banners/', $name);
                $path = 'uploads/banners/' . $name;
            }else{
                $path = $cosmetic->image;
            }

            $cosmetic->brand_id = $request->brand_id;
            $cosmetic->title = $request->title;
            $cosmetic->description = $request->description;
            $cosmetic->image = $path;
            $cosmetic->update();

            $notification=array(
                'messege' => "Successfully the banner has been updated",
                'alert-type' => "success",
            );

            return redirect()->route('cosmetics.index')->with($notification);

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

            return redirect()->route('cosmetics.index')->with($notification);
        }
    }

    public function destroy(Cosmetic $cosmetic)
    {
        try {
            $cosmetic->delete();
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
