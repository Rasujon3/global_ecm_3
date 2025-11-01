<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBannerRequest;
use App\Http\Requests\StoreIntroRequest;
use App\Http\Requests\UpdateBannerRequest;
use App\Http\Requests\UpdateIntroRequest;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Intro;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class IntroController extends Controller
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
            $brands = Intro::latest();

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

                ->addColumn('action', function ($row) {
                    $editUrl = route('intros.show', $row->id);

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
                    'status',
                    'action'
                ])
                ->make(true);
        }

        $count = Intro::count();
        return view('intros.index', compact('count'));
    }
    public function create()
    {
        return view('intros.create');
    }
    public function store(StoreIntroRequest $request)
    {
        try
        {
            $intro = new Intro();
            $intro->icon = $request->icon;
            $intro->title = $request->title;
            $intro->description = $request->description;
            $intro->save();

            $notification=array(
                'messege'=>"Successfully a intro has been added",
                'alert-type'=>"success",
            );

            return redirect()->route('intros.index')->with($notification);

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

            return redirect()->route('intros.index')->with($notification);
        }
    }
    public function show(Intro $intro)
    {
        return view('intros.edit', compact('intro'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Intro  $intro
     * @return \Illuminate\Http\Response
     */
    public function edit(Intro $intro)
    {
        //
    }
    public function update(UpdateIntroRequest $request, Intro $intro)
    {
        try
        {
            $intro->icon = $request->icon;
            $intro->title = $request->title;
            $intro->description = $request->description;
            $intro->update();

            $notification=array(
                'messege' => "Successfully the intro has been updated",
                'alert-type' => "success",
            );

            return redirect()->route('intros.index')->with($notification);

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

            return redirect()->route('intros.index')->with($notification);
        }
    }

    public function destroy(Intro $intro)
    {
        try {
            $intro->delete();
            return response()->json(['status'=>true, 'message'=>"Successfully the intro has been deleted"]);
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
