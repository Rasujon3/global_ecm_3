@extends('admin_master')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Order Lists</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Order Lists</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Order Lists</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="card w-100">
                    <div class="card-header">
                        <h5>Filter Order</h5>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="from_date">From Date</label>
                                    <input type="date" class="form-control" id="from_date" required=""/>
                                </div>

                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="to_date">To Date</label>
                                    <input type="date" class="form-control" id="to_date" required=""/>
                                </div>

                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Select Status</label>
                                    <select class="form-control select2bs4" id="selected_status">
                                        <option value="" selected="" disabled="">Select Status</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Order_Received">Order Received</option>
                                        <option value="Processing">Processing</option>
                                        <option value="Shipped">Shipped</option>
                                        <option value="In_Transit">In Transit</option>
                                        <option value="Out_for_Delivery">Out for Delivery</option>
                                        <option value="Delivered">Delivered</option>
                                    </select>
                                </div>

                            </div>

                            <div class="col-md-12">
                                <button type="button" class="btn btn-primary btn-block filter-order"><i class="fa fa-search"></i> SEARCH</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="fetch-data table-responsive">
                    <table id="order-table-detail" class="table table-bordered table-striped data-table">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Payment Method</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="conts">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')

  <script>
  	$(document).ready(function(){
  		let order_id;
  		var orderTable = $('#order-table-detail').DataTable({
		        searching: true,
		        processing: true,
		        serverSide: true,
		        ordering: false,
		        responsive: true,
		        stateSave: true,
		        ajax: {
		          url: "{{url('/order-lists')}}",
                    data: function (d) {
                        d.from_date = $('#from_date').val()
                            d.to_date = $('#to_date').val()
                            d.status = $('#selected_status').val()
                        d.search = $('.dataTables_filter input').val()
                    }
		        },

		        columns: [
		            {data: 'serial', name: 'serial'},
	                {data: 'name', name: 'name'},
	                {data: 'email', name: 'email'},
	                {data: 'phone', name: 'phone'},
	                {data: 'payment_method', name:'payment_method'},
	                {data: 'date', name: 'date'},
	                {data: 'time', name: 'time'},
		            {data: 'status', name: 'status'},
		            {data: 'action', name: 'action', orderable: false, searchable: false},
		        ]
        });

        $('.filter-order').click(function(e){
            e.preventDefault();
            orderTable.draw();
        });

       $(document).on('click', '#status-order-update', function(){

	         order_id = $(this).data('id');

       });


       $(document).on('click', '.delete-order', function(e){

           e.preventDefault();

           order_id = $(this).data('id');

           if(confirm('Do you want to delete this?'))
           {
               $.ajax({

                    url: "{{url('/delete-order')}}/"+order_id,

                         type:"GET",
                         dataType:"json",
                         success:function(data) {

                            toastr.success(data.message);

                            $('.data-table').DataTable().ajax.reload(null, false);

                    },

              });
           }

       });

        $(document).on('change', '.change-status', function(){

            order_id = $(this).data('id');
            var status_val = $(this).val();

            if(confirm('Do you want to change the status?'))
            {
                $.ajax({

                    url: "{{url('/order-status-update')}}",

                    type:"POST",
                    data:{'order_id':order_id, 'status':status_val},
                    dataType:"json",
                    success:function(data) {
                        toastr.success(data.message);

                        $('.data-table').DataTable().ajax.reload(null, false);

                    },

                });
            }
        });

  	});
  </script>

@endpush
