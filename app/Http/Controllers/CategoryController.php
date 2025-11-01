<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use DataTables;

class CategoryController extends Controller
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
            $categories = Category::latest();

            return DataTables::of($categories)
                ->addIndexColumn()

                ->addColumn('status', function ($row) {
                    $checked = $row->status === 'Active' ? 'checked' : '';
                    $class   = $row->status === 'Active' ? 'active-category' : 'decline-category';

                    return '
                        <label class="switch">
                            <input
                                type="checkbox"
                                class="' . $class . '"
                                id="status-category-update"
                                data-id="' . $row->id . '"
                                ' . $checked . '
                            >
                            <span class="slider round"></span>
                        </label>
                    ';
                })

                ->addColumn('action', function ($row) {
                    $editUrl = route('categories.show', $row->id);

                    return '
                        <a href="' . $editUrl . '"
                           class="btn btn-primary btn-sm action-button edit-category"
                           data-id="' . $row->id . '">
                            <i class="fa fa-edit"></i>
                        </a>
                        &nbsp;
                        <button type="button"
                           class="btn btn-danger btn-sm delete-category action-button"
                           data-id="' . $row->id . '">
                            <i class="fa fa-trash"></i>
                        </button>
                    ';
                })

                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        return view('categories.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        try
        {
            if($request->file('image')){
                $file = $request->file('image');
                $name = time() . auth()->user()->id . $file->getClientOriginalName();
                $file->move(public_path() . '/uploads/categories/', $name);
                $path = 'uploads/categories/' . $name;
            }
            Category::create([
                'user_id' => user()->id,
                'category_name' => $request->category_name,
                'is_top' => $request->has('is_top')?$request->is_top:0,
                'is_featured' => $request->has('is_featured')?$request->is_featured:0,
                'is_homepage' => $request->has('is_homepage')?$request->is_homepage:0,
                'status' => $request->status,
                'image' => $path,
            ]);

            $notification=array(
                'messege'=>"Successfully a category has been added",
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
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        try
        {
            if($request->file('image')){
                $file = $request->file('image');
                $name = time() . auth()->user()->id . $file->getClientOriginalName();
                $file->move(public_path() . '/uploads/categories/', $name);
                if($category->image != null){
                    unlink(public_path($category->image));
                }
                $path = 'uploads/categories/' . $name;
            }else{
                $path = $category->image;
            }

            $category->category_name = $request->category_name;
            $category->status = $request->status;
            $category->is_top = $request->has('is_top')?$request->is_top:$category->is_top;
            $category->is_featured = $request->has('is_featured')?$request->is_featured:$category->is_featured;
            $category->is_homepage = $request->has('is_homepage')?$request->is_homepage:$category->is_homepage;
            $category->image = $path;
            $category->update();

            $notification=array(
                'messege'=>"Successfully the category has been updated",
                'alert-type'=>"success",
            );

            return redirect('/categories')->with($notification);

        }catch(Exception $e){
            return response()->json(['status'=>false, 'code'=>$e->getCode(), 'message'=>$e->getMessage()],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        try
        {
            if($category->image != null){
                unlink(public_path($category->image));
            }

            $category->sliders()->delete();
            $category->subcategories()->delete();
            $category->products()->delete();
            $category->delete();
            return response()->json(['status'=>true, 'message'=>'Successfully the category has been deleted']);
        }catch(Exception $e){
            return response()->json(['status'=>false, 'code'=>$e->getCode(), 'message'=>$e->getMessage()],500);
        }
    }
}
