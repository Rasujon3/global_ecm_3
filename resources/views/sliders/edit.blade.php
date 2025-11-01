@extends('admin_master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Slider</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{URL::to('/sliders')}}">All Slider
                                </a></li>
                        <li class="breadcrumb-item active">Edit Slider</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Edit Slider</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{route('sliders.update',$slider->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="title">Title <span class="required">*</span></label>
                                <input type="text" name="title" class="form-control" id="title"
                                    placeholder="Title" required="" value="{{old('title',$slider->title)}}">
                                @error('title')
                                <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="sub_title">Sub Title <span class="required">*</span></label>
                                <input type="text" name="sub_title" class="form-control" id="sub_title"
                                    placeholder="Sub Title" required="" value="{{old('sub_title',$slider->sub_title)}}">
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
{{--                                      <option value="{{$category->id}}" <?php if($slider->category_id == $category->id){echo "selected";} ?>>{{$category->category_name}}</option>--}}
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
                                        <option value="{{$brand->id}}" <?php if($slider->brand_id == $brand->id){echo "selected";} ?>>{{ $brand->brand_name }}</option>
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
                            <input name="image" type="file" id="image" accept="image/*" class="dropify" data-height="200" data-default-file="{{ URL::to($slider->image) }}"/>
                            @error('image')
                            <span class="alert alert-danger">{{ $message }}</span>
                            @enderror
                          </div>
                        </div>


                        <div class="form-group w-100 px-2">
                            <button type="submit" class="btn btn-success">Save Changes</button>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </form>
        </div>
    </section>
</div>
@endsection
