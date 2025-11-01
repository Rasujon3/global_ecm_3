@extends('admin_master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Add Intro</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{URL::to('/intros')}}">All Intro</a></li>
                            <li class="breadcrumb-item active">Edit Intro</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <section class="content">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Edit Intro</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{route('intros.update',$intro->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="icon">Icon <span class="required">*</span></label>
                                    <input
                                        type="text"
                                        name="icon"
                                        class="form-control"
                                        id="icon"
                                        placeholder="Icon"
                                        required=""
                                        value="{{old('icon',$intro->icon)}}"
                                    >
                                    @error('icon')
                                    <span class="alert alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="title">Title <span class="required">*</span></label>
                                    <input
                                        type="text"
                                        name="title"
                                        class="form-control"
                                        id="title"
                                        placeholder="Title"
                                        required=""
                                        value="{{old('title',$intro->title)}}"
                                    >
                                    @error('title')
                                    <span class="alert alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="description">Description <span class="required">*</span></label>
                                    <input
                                        type="text"
                                        name="description"
                                        class="form-control"
                                        id="description"
                                        placeholder="Description"
                                        required=""
                                        value="{{old('description',$intro->description)}}"
                                    >
                                    @error('description')
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
