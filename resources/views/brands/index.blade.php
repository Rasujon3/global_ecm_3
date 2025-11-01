@extends('admin_master')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">All Brand</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">All Brand</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">All Brand</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <a href="{{route('brands.create')}}" class="btn btn-primary add-new mb-2">Add New Brand</a>
                <div class="fetch-data table-responsive">
                    <table id="brand-table" class="table table-bordered table-striped data-table">
                        <thead>
                            <tr>
                                <th>Brand Name</th>
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
      let brand_id;
  		var brandTable = $('#brand-table').DataTable({
		        searching: true,
		        processing: true,
		        serverSide: true,
		        ordering: false,
		        responsive: true,
		        stateSave: true,
		        ajax: {
		          url: "{{url('/brands')}}",
		        },

		        columns: [
		            {data: 'brand_name', name: 'brand_name'},
		            {data: 'status', name: 'status'},
		            {data: 'action', name: 'action', orderable: false, searchable: false},
		        ]
        });



       $(document).on('click', '#status-brand-update', function(){

	         brand_id = $(this).data('id');
	         var isBrandchecked = $(this).prop('checked');
	         var status_val = isBrandchecked ? 'Active' : 'Inactive'; 
	         $.ajax({

                url: "{{url('/brand-status-update')}}",

                     type:"POST",
                     data:{'brand_id':brand_id, 'status':status_val},
                     dataType:"json",
                     success:function(data) {

                        toastr.success(data.message);

                        $('.data-table').DataTable().ajax.reload(null, false);

                },
	                            
	        });
       }); 


       $(document).on('click', '.delete-brand', function(e){

           e.preventDefault();

           brand_id = $(this).data('id');

           if(confirm('Do you want to delete this?'))
           {
               $.ajax({

                    url: "{{url('/brands')}}/"+brand_id,

                         type:"DELETE",
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