@extends('admin_master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">BKash Info</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{URL::to('/dc-bkash-info')}}">BKash Info</a></li>
                        <li class="breadcrumb-item active">BKash Info</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">BKash Info</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route('dc-bkash-info.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="bkash_no">BKash Number <span class="required">*</span></label>
                                <input
                                    type="text"
                                    name="bkash_no"
                                    class="form-control"
                                    id="bkash_no"
                                    required
                                    placeholder="BKash Number"
                                    value="{{old('bkash_no', ($setting && $setting->bkash_no !== null) ? $setting->bkash_no : "")}}"
                                >
                                @error('bkash_no')
                                <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="account_type">Account Type (Ex. Personal or Agent) <span class="required">*</span></label>
                                <input
                                    type="text"
                                    name="account_type"
                                    class="form-control"
                                    id="account_type"
                                    placeholder="Account Type (Ex. Personal or Agent)"
                                    required
                                    value="{{old('account_type', ($setting && $setting->account_type !== null) ? $setting->account_type : "")}}"
                                >
                                @error('account_type')
                                <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group w-100">
                        <button type="submit" class="btn btn-success">Save Changes</button>
                    </div>
                </div>
                    <!-- /.card-body -->
            </form>
        </div>
    </section>
</div>
@endsection
