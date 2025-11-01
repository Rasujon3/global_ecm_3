<?php

namespace App\Http\Controllers;

use App\Models\Variant;
use Illuminate\Http\Request;
use App\Http\Requests\StoreVariantRequest;
use App\Http\Requests\UpdateVariantRequest;
use DataTables;
class VariantController extends Controller
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
            $variants = Variant::latest();

            return DataTables::of($variants)
                ->addIndexColumn()

                ->addColumn('status', function ($row) {
                    $checked = $row->status === 'Active' ? 'checked' : '';
                    $class   = $row->status === 'Active' ? 'active-variant' : 'decline-variant';

                    return '
                        <label class="switch">
                            <input
                                type="checkbox"
                                class="' . $class . '"
                                id="status-variant-update"
                                data-id="' . $row->id . '"
                                ' . $checked . '
                            >
                            <span class="slider round"></span>
                        </label>
                    ';
                })

                ->addColumn('action', function ($row) {
                    $editUrl = route('variants.show', $row->id);

                    return '
                        <a href="' . $editUrl . '"
                           class="btn btn-primary btn-sm action-button edit-variant"
                           data-id="' . $row->id . '">
                            <i class="fa fa-edit"></i>
                        </a>
                        &nbsp;
                        <button type="button"
                           class="btn btn-danger btn-sm delete-variant action-button"
                           data-id="' . $row->id . '">
                            <i class="fa fa-trash"></i>
                        </button>
                    ';
                })

                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        return view('variants.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('variants.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVariantRequest $request)
    {
        try
        {
            Variant::create([
                'user_id' => user()->id,
                'variant_name' => $request->variant_name,
                'status' => $request->status,
            ]);

            $notification=array(
                'messege'=>"Successfully a variant has been added",
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
     * @param  \App\Models\Variant  $variant
     * @return \Illuminate\Http\Response
     */
    public function show(Variant $variant)
    {
        return view('variants.edit', compact('variant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Variant  $variant
     * @return \Illuminate\Http\Response
     */
    public function edit(Variant $variant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Variant  $variant
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVariantRequest $request, Variant $variant)
    {
        try
        {
            $variant->update($request->validated());

            $notification=array(
                'messege'=>"Successfully the variant has been updated",
                'alert-type'=>"success",
            );

            return redirect('/variants')->with($notification);

        }catch(Exception $e){
            return response()->json(['status'=>false, 'code'=>$e->getCode(), 'message'=>$e->getMessage()],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Variant  $variant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Variant $variant)
    {
        try
        {
            $variant->productvariants()->delete();
            $variant->delete();
            return response()->json(['status'=>true, 'message'=>'Successfully the variant has been deleted']);
        }catch(Exception $e){
            return response()->json(['status'=>false, 'code'=>$e->getCode(), 'message'=>$e->getMessage()],500);
        }
    }
}
