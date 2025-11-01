<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSliderRequest;
use App\Http\Requests\UpdateSliderRequest;
use DataTables;
use Illuminate\Support\Facades\Log;

class SliderController extends Controller
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
            $sliders = Slider::with('category', 'brand')->latest();

            return DataTables::of($sliders)
                ->addIndexColumn()

                ->addColumn('category', function ($row) {
                    return $row->category?->category_name ?? 'N/A';
                })

                ->addColumn('brand', function ($row) {
                    return $row->brand?->brand_name ?? 'N/A';
                })

                ->addColumn('action', function ($row) {
                    $editUrl = route('sliders.show', $row->id);

                    return '
                        <a href="' . $editUrl . '"
                           class="btn btn-primary btn-sm action-button edit-slider"
                           data-id="' . $row->id . '">
                            <i class="fa fa-edit"></i>
                        </a>
                        &nbsp;
                        <button type="button"
                           class="btn btn-danger btn-sm delete-slider action-button"
                           data-id="' . $row->id . '">
                            <i class="fa fa-trash"></i>
                        </button>
                    ';
                })

                ->rawColumns(['category','brand', 'action'])
                ->make(true);
        }

        return view('sliders.index');
    }
    public function create()
    {
        return view('sliders.create');
    }
    public function store(StoreSliderRequest $request)
    {
        try
        {
            if($request->file('image')){
                $file = $request->file('image');
                $name = time() . auth()->user()->id . $file->getClientOriginalName();
                $file->move(public_path() . '/uploads/sliders/', $name);
                $path = 'uploads/sliders/' . $name;
            }

            Slider::create([
                'user_id' => user()->id,
//                'category_id' => $request->category_id,
                'brand_id' => $request->brand_id,
                'title' => $request->title,
                'sub_title' => $request->sub_title,
                'image' => $path,
            ]);

            $notification=array(
                'messege'=>"Successfully a slider has been added",
                'alert-type'=>"success",
            );

            return redirect()->route('sliders.index')->with($notification);

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

            return redirect()->route('sliders.index')->with($notification);
        }
    }
    public function show(Slider $slider)
    {
        return view('sliders.edit', compact('slider'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        //
    }
    public function update(UpdateSliderRequest $request, Slider $slider)
    {
        try
        {
            if($request->file('image')){
                $file = $request->file('image');
                $name = time() . auth()->user()->id . $file->getClientOriginalName();
                $file->move(public_path() . '/uploads/sliders/', $name);
                unlink(public_path($slider->image));
                $path = 'uploads/sliders/' . $name;
            }else{
                $path = $slider->image;
            }
//            $slider->category_id = $request->category_id;
            $slider->brand_id = $request->brand_id;
            $slider->title = $request->title;
            $slider->sub_title = $request->sub_title;
            $slider->image = $path;
            $slider->update();

            $notification=array(
                'messege'=>"Successfully the slider has been updated",
                'alert-type'=>"success",
            );

            return redirect('/sliders')->with($notification);

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

            return redirect()->route('sliders.index')->with($notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        try
        {
            unlink(public_path($slider->image));
            $slider->delete();
            return response()->json(['status'=>true, 'message'=>'Successfully the slider has been deleted']);
        }catch(Exception $e){
            return response()->json(['status'=>false, 'code'=>$e->getCode(), 'message'=>$e->getMessage()],500);
        }
    }
}
