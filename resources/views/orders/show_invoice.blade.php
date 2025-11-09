
@extends('admin_master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Show Invoice</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{URL::to('/order-lists')}}">All Order
                                </a></li>
                        <li class="breadcrumb-item active">Add Order</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Show Invoice</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->

                <div class="card-body">
                    <div class="row">

                      <div class="col-md-12">
                      	<div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-globe"></i> {{ setting()->shop_name ?? 'Glamours World' }}
                    <b class="float-right">Order: INV-00-{{$data->id ?? '001'}}</b><br/>
                    <small class="float-right">Date: {{$data->date ?? 'N/A' }}</small><br/>
                    <small class="float-right">Status: {{$data->status ?? 'N/A'}}</small><br/>
                    <small class="float-right">Payment Method: {{ $data->paymentmethod->name ?? 'N/A' }}</small>
                      @if($data->screen_shot)
                            <br/>
                            <a href="{{asset($data->screen_shot)}}" target="_blank" class="float-right btn btn-sm btn-info">View Screenshot</a>
                          <br/>
                      @endif
                      <br/>
                      <button onclick="window.print()" class="btn btn-primary float-right" style="margin-right: 5px;">
                        <i class="fas fa-print"></i> Print Invoice
                      </button>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  {{-- From --}}
                  <address>
                    <strong>{{$data->name ?? 'N/A'}}</strong><br>
                   {{$data->full_address ?? 'N/A'}}<br/>
                    Email: {{$data->email ?? 'N/A'}}<br/>
                    Phone: {{$data->phone ?? 'N/A'}}
                  </address>
                </div>

                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>Serial #</th>
                      <th>Product</th>
                      <th>Qty</th>
                      <th>Per Unit Price</th>
                      <th>Unit Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data->orders as $key=>$order)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>
                            {{ $order?->product?->product_name ?? 'N/A' }}
                            {{-- ✅ Show variants if available --}}
                            @if(!empty($order->variant_details))
                                <br>
                                @foreach($order->variant_details as $variant)
                                    <small class="text-muted">
                                        {{ $variant->variant_name }}: {{ $variant->variant_value }}
                                        @if(!$loop->last) | @endif
                                    </small>
                                @endforeach
                            @endif
                        </td>
                        <td>{{ $order->qty ?? 'N/A' }}</td>
                        <td>{{ $order->product ?  discount($order->product) : 'N/A' }} BDT</td>
                        <td>{{ $order->product ? discount($order->product) * $order->qty : 'N/A' }} BDT</td>
                    </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">

                <div class="col-12">

                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th style="width:50%">Subtotal:</th>
                        <td>{{$data->sub_total ?? 'N/A' }} BDT</td>
                      </tr>
                      <tr>
                          <th style="width:50%">Delivery Charge:</th>
                          <td>{{$data->delivery_charge ?? 'N/A' }} BDT</td>
                      </tr>
                      <tr class="d-none">
                        <th>Tax (9.3%)</th>
                        <td>$10.34</td>
                      </tr>
                      <tr class="d-none">
                        <th>Shipping:</th>
                        <td>$5.80</td>
                      </tr>
                      <tr>
                        <th>Total:</th>
                        <td>{{$data->total ?? 'N/A' }} BDT</td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print d-none">
                <div class="col-12">
                  <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                  <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                    Payment
                  </button>
                  <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                    <i class="fas fa-download"></i> Generate PDF
                  </button>
                </div>
              </div>
            </div>
                      </div>

                    </div>
                    <!-- /.card-body -->
                </div>
            </form>
        </div>
    </section>
</div>
@endsection
