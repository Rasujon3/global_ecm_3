@extends('admin_master')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Category</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">All Categories</a></li>
                        <li class="breadcrumb-item active">Edit Category</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Edit Category</h3>
            </div>

            <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="card-body">
                    <div class="row">


                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="category_name">Category Name <span class="required">*</span></label>
                                <input type="text" 
                                       name="category_name" 
                                       class="form-control" 
                                       id="category_name"
                                       placeholder="Category Name"
                                       value="{{ old('category_name', $category->category_name) }}"
                                       required>
                                @error('category_name')
                                    <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

   
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="is_top">Is Top</label>
                                <select class="form-control select2bs4" name="is_top" id="is_top" required>
                                    <option disabled>Choose Option</option>
                                    <option value="1" {{ $category->is_top == 1 ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ $category->is_top == 0 ? 'selected' : '' }}>No</option>
                                </select>
                            </div>
                        </div>

 
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="is_featured">Is Featured</label>
                                <select class="form-control select2bs4" name="is_featured" id="is_featured" required>
                                    <option disabled>Choose Option</option>
                                    <option value="1" {{ $category->is_featured == 1 ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ $category->is_featured == 0 ? 'selected' : '' }}>No</option>
                                </select>
                            </div>
                        </div>

       
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="is_homepage">Is HomePage</label>
                                <select class="form-control select2bs4" name="is_homepage" id="is_homepage" required>
                                    <option disabled>Choose Option</option>
                                    <option value="1" {{ $category->is_homepage == 1 ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ $category->is_homepage == 0 ? 'selected' : '' }}>No</option>
                                </select>
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control select2bs4" name="status" id="status" required>
                                    <option disabled>Select Status</option>
                                    <option value="Active" {{ $category->status == 'Active' ? 'selected' : '' }}>Active</option>
                                    <option value="Inactive" {{ $category->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                        </div>

    
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input name="image" 
                                       type="file" 
                                       id="image" 
                                       accept="image/*" 
                                       class="dropify" 
                                       data-height="200"
                                       data-default-file="{{ URL::to($category->image) }}" />
                                @error('image')
                                    <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success">Save Changes</button>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection
