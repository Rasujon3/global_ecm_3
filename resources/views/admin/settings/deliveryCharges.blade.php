@extends('admin_master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Delivery Charges</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ URL::to('/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ URL::to('/delivery-charges') }}">Delivery Charges</a></li>
                        <li class="breadcrumb-item active">Delivery Charges</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Delivery Charges</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route('delivery-charges.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="inside_dhaka_dc">Inside Dhaka (delivery Charges) <span class="required">*</span></label>
                                <input
                                    type="text"
                                    name="inside_dhaka_dc"
                                    class="form-control"
                                    id="inside_dhaka_dc"
                                    required
                                    placeholder="Inside Dhaka (delivery Charges)"
                                    value="{{old('inside_dhaka_dc', ($setting && $setting->inside_dhaka_dc !== null) ? $setting->inside_dhaka_dc : "")}}"
                                >
                                @error('inside_dhaka_dc')
                                <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="outside_dhaka_dc">Outside Dhaka (delivery Charges) <span class="required">*</span></label>
                                <input type="text" name="outside_dhaka_dc" class="form-control" id="outside_dhaka_dc"
                                       placeholder="Outside Dhaka (delivery Charges)" required value="{{old('outside_dhaka_dc', ($setting && $setting->outside_dhaka_dc !== null) ? $setting->outside_dhaka_dc : "")}}">
                                @error('outside_dhaka_dc')
                                <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="sub_urban_areas_dc">Sub Urban Areas (delivery Charges) <span class="required">*</span></label>
                                <input type="text" name="sub_urban_areas_dc" class="form-control" id="sub_urban_areas_dc"
                                       placeholder="Sub Urban Areas (delivery Charges)"  value="{{old('sub_urban_areas_dc', ($setting && $setting->sub_urban_areas_dc !== null) ? $setting->sub_urban_areas_dc : "")}}">
                                @error('sub_urban_areas_dc')
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
