@extends('admin_master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Add Banner One</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{URL::to('/banners')}}">All Banner One</a></li>
                            <li class="breadcrumb-item active">Edit Banner One</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <section class="content">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Edit Banner One</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{route('banners.update',$banner->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">Title <span class="required">*</span></label>
                                    <textarea
                                        class="form-control description"
                                        required=""
                                        name="title"
                                    >
                                    {!!old('title', $banner->title)!!}
                                </textarea>
                                    @error('title')
                                    <span class="alert alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="description">Description <span class="required">*</span></label>
                                    <textarea
                                        class="form-control description"
                                        required=""
                                        name="description"
                                    >
                                    {!!old('description', $banner->description)!!}
                                </textarea>
                                    @error('description')
                                    <span class="alert alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="price">Price <span class="required">*</span></label>
                                    <textarea
                                        class="form-control description"
                                        required=""
                                        name="price"
                                    >
                                    {!!old('price', $banner->price)!!}
                                </textarea>
                                    @error('price')
                                    <span class="alert alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="brand_id">Select Brand <span class="required">*</span></label>
                                    <select class="form-control select2bs4" name="brand_id" id="brand_id" required="">
                                        <option value="" selected="" disabled="">Select Brand</option>
                                        @foreach(brands() as $brand)
                                            <option value="{{ $brand->id }}" <?php if($banner->brand_id == $brand->id){echo "selected";} ?>>{{ $brand->brand_name }}</option>
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
                                    <input name="image" type="file" id="image" accept="image/*" class="dropify"
                                           data-height="200"
                                           data-default-file="{{ URL::to($banner->image ?: '') }}"
                                    />
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
