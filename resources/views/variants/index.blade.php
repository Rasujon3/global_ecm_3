@extends('admin_master')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">All Variant</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">All Variant</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">All Variant</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <a href="{{route('variants.create')}}" class="btn btn-primary add-new mb-2">Add New Variant</a>
                <div class="fetch-data table-responsive">
                    <table id="variant-table" class="table table-bordered table-striped data-table">
                        <thead>
                            <tr>
                                <th>Variant Name</th>
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
      let variant_id;
  		var variantTable = $('#variant-table').DataTable({
		        searching: true,
		        processing: true,
		        serverSide: true,
		        ordering: false,
		        responsive: true,
		        stateSave: true,
		        ajax: {
		          url: "{{url('/variants')}}",
		        },

		        columns: [
		            {data: 'variant_name', name: 'variant_name'},
		            {data: 'status', name: 'status'},
		            {data: 'action', name: 'action', orderable: false, searchable: false},
		        ]
        });



       $(document).on('click', '#status-variant-update', function(){

	         variant_id = $(this).data('id');
	         var isUnitchecked = $(this).prop('checked');
	         var status_val = isUnitchecked ? 'Active' : 'Inactive'; 
	         $.ajax({

                url: "{{url('/variant-status-update')}}",

                     type:"POST",
                     data:{'variant_id':variant_id, 'status':status_val},
                     dataType:"json",
                     success:function(data) {

                        toastr.success(data.message);

                        $('.data-table').DataTable().ajax.reload(null, false);

                },
	                            
	        });
       }); 


       $(document).on('click', '.delete-variant', function(e){

           e.preventDefault();

           variant_id = $(this).data('id');

           if(confirm('Do you want to delete this?'))
           {
               $.ajax({

                    url: "{{url('/variants')}}/"+variant_id,

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