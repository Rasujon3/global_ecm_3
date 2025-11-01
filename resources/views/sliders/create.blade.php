@extends('admin_master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Add Slider</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{URL::to('/sliders')}}">All Slider
                                </a></li>
                        <li class="breadcrumb-item active">Add Slider</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Add Slider</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{route('sliders.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="title">Title <span class="required">*</span></label>
                                <input type="text" name="title" class="form-control" id="title"
                                    placeholder="Title" required="" value="{{old('title')}}">
                                @error('title')
                                <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="sub_title">Sub Title <span class="required">*</span></label>
                                <input type="text" name="sub_title" class="form-control" id="sub_title"
                                    placeholder="Sub Title" required="" value="{{old('sub_title')}}">
                                @error('sub_title')
                                <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


{{--                        <div class="col-md-12">--}}
{{--                            <div class="form-group">--}}
{{--                                <label for="category_id">Select Category <span class="required">*</span></label>--}}
{{--                                <select class="form-control select2bs4" name="category_id" id="category_id" required="">--}}
{{--                                    <option value="" selected="" disabled="">Select Category</option>--}}
{{--                                    @foreach(categories() as $category)--}}
{{--                                      <option value="{{$category->id}}">{{$category->category_name}}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                                @error('category_id')--}}
{{--                                <span class="alert alert-danger">{{ $message }}</span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div> --}}


                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="brand_id">Select Brand <span class="required">*</span></label>
                                <select class="form-control select2bs4" name="brand_id" id="brand_id" required="">
                                    <option value="" selected="" disabled="">Select Brand</option>
                                    @foreach(brands() as $brand)
                                      <option value="{{$brand->id}}">{{ $brand->brand_name }}</option>
                                    @endforeach
                                </select>
                                @error('brand_id')
                                <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="image">Image <span class="required">*</span></label>
                            <input name="image" type="file" id="image" accept="image/*" class="dropify" data-height="200" required=""/>
                            @error('image')
                            <span class="alert alert-danger">{{ $message }}</span>
                            @enderror
                          </div>
                        </div>


                        <div class="form-group w-100 px-2">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </form>
        </div>
    </section>
</div>
@endsection
