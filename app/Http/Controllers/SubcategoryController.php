<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSubCategoryRequest;
use App\Http\Requests\UpdateSubCategoryRequest;
use DataTables;

class SubcategoryController extends Controller
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
            $subcategories = Subcategory::latest();

            return DataTables::of($subcategories)
                ->addIndexColumn()


                ->addColumn('category', function ($row) {

                    return $row->category->category_name;
                })

                ->addColumn('status', function ($row) {
                    $checked = $row->status === 'Active' ? 'checked' : '';
                    $class   = $row->status === 'Active' ? 'active-subcategory' : 'decline-subcategory';

                    return '
                        <label class="switch">
                            <input
                                type="checkbox"
                                class="' . $class . '"
                                id="status-subcategory-update"
                                data-id="' . $row->id . '"
                                ' . $checked . '
                            >
                            <span class="slider round"></span>
                        </label>
                    ';
                })

                ->addColumn('action', function ($row) {
                    $editUrl = route('subcategories.show', $row->id);

                    return '
                        <a href="' . $editUrl . '"
                           class="btn btn-primary btn-sm action-button edit-subcategory"
                           data-id="' . $row->id . '">
                            <i class="fa fa-edit"></i>
                        </a>
                        &nbsp;
                        <button type="button"
                           class="btn btn-danger btn-sm delete-subcategory action-button"
                           data-id="' . $row->id . '">
                            <i class="fa fa-trash"></i>
                        </button>
                    ';
                })

                ->rawColumns(['status', 'action','category'])
                ->make(true);
        }

        return view('subcategories.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('subcategories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubCategoryRequest $request)
    {
        try
        {
            Subcategory::create([
                'user_id' => user()->id,
                'category_id' => $request->category_id,
                'subcategory_name' => $request->subcategory_name,
                'is_mega_menu' => $request->is_mega_menu,
                'status' => $request->status,
            ]);

            $notification=array(
                'messege'=>"Successfully a subcategory has been added",
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
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function show(Subcategory $subcategory)
    {
        return view('subcategories.edit', compact('subcategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Subcategory $subcategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubCategoryRequest $request, Subcategory $subcategory)
    {
        try
        {
            $subcategory->update($request->validated());
            $notification=array(
                'messege'=>"Successfully the subcategory has been updated",
                'alert-type'=>"success",
            );

            return redirect('/subcategories')->with($notification);
        }catch(Exception $e){
            return response()->json(['status'=>false, 'code'=>$e->getCode(), 'message'=>$e->getMessage()],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subcategory $subcategory)
    {
        try
        {
            $subcategory->products()->delete();
            $subcategory->delete();
            return response()->json(['status'=>true, 'message'=>'Successfully the subcategory has been deleted']);
        }catch(Exception $e){
            return response()->json(['status'=>false, 'code'=>$e->getCode(), 'message'=>$e->getMessage()],500);
        }
    }
}
