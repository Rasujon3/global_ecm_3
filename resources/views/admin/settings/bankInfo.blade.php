@extends('admin_master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Bank Info</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{URL::to('/bank-info')}}">Bank Info
                                </a></li>
                        <li class="breadcrumb-item active">Bank Info</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Bank Info</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route('dc-bank-info.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="bank_name">Bank Name <span class="required">*</span></label>
                                <input
                                    type="text"
                                    name="bank_name"
                                    class="form-control"
                                    id="bank_name"
                                    required
                                    placeholder="Bank Name"
                                    value="{{old('bank_name', ($setting && $setting->bank_name) ? $setting->bank_name : "")}}"
                                >
                                @error('bank_name')
                                <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="acc_no">Account No. <span class="required">*</span></label>
                                <input type="text" name="acc_no" class="form-control" id="acc_no"
                                       placeholder="Account No." required value="{{old('acc_no', $setting ? $setting->acc_no : "")}}">
                                @error('acc_no')
                                <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="branch_name">Branch Name <span class="required">*</span></label>
                                <input
                                    type="text"
                                    name="branch_name"
                                    class="form-control"
                                    id="branch_name"
                                    required
                                    placeholder="Branch Name"
                                    value="{{old('branch_name', ($setting && $setting->branch_name) ? $setting->branch_name : "")}}"
                                >
                                @error('branch_name')
                                <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="routing_number">Routing Number <span class="required">*</span></label>
                                <input
                                    type="text"
                                    name="routing_number"
                                    class="form-control"
                                    id="routing_number"
                                    placeholder="Routing Number"
                                    required
                                    value="{{old('routing_number', $setting ? $setting->routing_number : "")}}"
                                >
                                @error('routing_number')
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
