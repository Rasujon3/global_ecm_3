@extends('admin_master')
@section('content')
    <style>
        #image-previews {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .preview-image {
            max-width: 100px;
            max-height: 100px;
        }

        .drop-container {
            border: 2px solid #3498db;
            background-color: #f5f5f5;
            padding: 20px;
            text-align: center;
            border-radius: 10px;
        }
        .upload-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: green;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .delete-button{
            cursor: pointer;
            background: red;
            padding: 8px;
            color: white;
            border-radius: 5%;
        }

        .dislike{
            color: red;
        }

        .like{
            color: green;
        }
        .preview-image {
            display: inline-block;
            margin: 10px;
            border: 1px solid #ccc;
            padding: 5px;
            border-radius: 5px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .preview-image img {
            max-width: 100%;
            height: auto;
        }

        #file-input {
            display: none; /* Hide the default file input */
        }
        .delete-button{
            cursor: pointer;
            background: red;
            padding: 8px;
            color: white;
            border-radius: 5%;
        }
    </style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Product</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{URL::to('/products')}}">All Product
                                </a></li>
                        <li class="breadcrumb-item active">Edit Product</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Edit Product</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{route('products.update',$product->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method("PATCH")
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="product_name">Product Name <span class="required">*</span></label>
                                <input type="text" name="product_name" class="form-control" id="product_name"
                                    placeholder="Product Name" required="" value="{{old('product_name',$product->product_name)}}">
                                @error('product_name')
                                <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="product_price">Product Price (BDT) <span class="required">*</span></label>
                                <input type="text" name="product_price" class="form-control" id="product_price"
                                    placeholder="Product Price" required="" value="{{old('product_price',$product->product_price)}}">
                                @error('product_price')
                                <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="discount">Discount (%)</label>
                                <input type="text" name="discount" class="form-control" id="discount"
                                    placeholder="Discount (%)" value="{{old('discount',$product->discount)}}">
                                @error('discount')
                                <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="category_id">Select Category <span class="required">*</span></label>
                                <select class="form-control select2bs4" name="category_id" id="category_id" required="">
                                    <option value="" selected="" disabled="">Select Category</option>
                                    @foreach(categories() as $category)
                                      <option value="{{$category->id}}" <?php if($product->category_id == $category->id){echo "selected";} ?>>{{$category->category_name}}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="subcategory_id">Select Subcategory</label>
                                <select class="form-control select2bs4" name="subcategory_id" id="subcategory_id">
                                	<option value="" selected="" disabled="">Select SubCategory</option>
                                	@if(count($subcategories) > 0)
	                                    @foreach($subcategories as $subcategory)
	                                     <option value="{{$subcategory->id}}" <?php if($product->subcategory_id == $subcategory->id){echo "selected";} ?>>{{$subcategory->subcategory_name}}</option>
	                                    @endforeach
	                                @endif
                                </select>
                                @error('subcategory_id')
                                <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="brand_id">Select Brand</label>
                                <select class="form-control select2bs4" name="brand_id" id="brand_id">
                                    <option value="" selected="" disabled="">Select Brand</option>
                                    @foreach(brands() as $brand)
                                      <option value="{{$brand->id}}" <?php if($product->brand_id == $brand->id){echo "selected";} ?>>{{$brand->brand_name}}</option>
                                    @endforeach
                                </select>
                                @error('brand_id')
                                <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="unit_id">Select Unit <span class="required">*</span></label>
                                <select class="form-control select2bs4" name="unit_id" id="unit_id" required="">
                                    <option value="" selected="" disabled="">Select Unit</option>
                                    @foreach(units() as $unit)
                                      <option value="{{$unit->id}}" <?php if($product->unit_id == $unit->id){echo "selected";} ?>>{{$unit->unit_name}}</option>
                                    @endforeach
                                </select>
                                @error('unit_id')
                                <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="stock_qty">Stock Quantity <span class="required">*</span></label>
                                <input type="text" name="stock_qty" class="form-control" id="stock_qty"
                                    placeholder="Stock Quantity" required="" value="{{old('stock_qty',$product->stock_qty)}}">
                                @error('stock_qty')
                                <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="status">Select Status <span class="required">*</span></label>
                                <select class="form-control select2bs4" name="status" id="status" required="">
                                    <option value="" selected="" disabled="">Select Status</option>
                                    <option value="Active" <?php if($product->status == 'Active'){echo "selected";} ?>>Active</option>
                                    <option value="Inactive" <?php if($product->status == 'Inactive'){echo "selected";} ?>>Inactive</option>
                                </select>
                                @error('status')
                                <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tag">Tag <span class="required">*</span></label>
                                <input
                                    type="text"
                                    name="tag"
                                    class="form-control"
                                    id="tag"
                                    placeholder="Tag"
                                    required=""
                                    value="{{ old('tag', $product->tag) }}"
                                >
                                @error('tag')
                                <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="is_arrival_product">Is Arrival Product <span class="required">*</span></label>
                                <select
                                    class="form-control select2bs4"
                                    name="is_arrival_product"
                                    id="is_arrival_product"
                                    required=""
                                >
                                    <option value="" selected="" disabled="">Choose Option</option>
                                    <option value="1" @if($product->is_arrival_product == "1") selected @endif>Yes</option>
                                    <option value="0" @if($product->is_arrival_product == "0") selected @endif>No</option>
                                </select>
                                @error('is_arrival_product')
                                <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="is_best_seller">Is Best Seller <span class="required">*</span></label>
                                <select
                                    class="form-control select2bs4"
                                    name="is_best_seller"
                                    id="is_best_seller"
                                    required=""
                                >
                                    <option value="" selected="" disabled="">Choose Option</option>
                                    <option value="1" @if($product->is_best_seller == "1") selected @endif>Yes</option>
                                    <option value="0" @if($product->is_best_seller == "0") selected @endif>No</option>
                                </select>
                                @error('is_best_seller')
                                <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{--
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="image">Image <span class="required">*</span></label>
                            <input name="image" type="file" id="image" accept="image/*" class="dropify" data-height="200" data-default-file="{{ URL::to($product->image) }}"/>
                            @error('image')
                            <span class="alert alert-danger">{{ $message }}</span>
                            @enderror
                          </div>
                        </div>
                        --}}

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Product Images</label>
                                <div class="drop-container">
                                    <label for="file-input" class="upload-button">Upload Product Images</label>
                                    <div class="preview-images" id="preview-container">
                                        @if(count($product->images) > 0)
                                            @foreach($product->images as $image)
                                                <div class="preview-image" id="row_{{$image->id}}">
                                                    <img src="{{URL::to($image->image)}}" alt="Product Image">
                                                    <span
                                                        class="btn btn-danger btn-sm delete-button delete-gallery-image my-2"
                                                        data-id="{{$image->id}}"
                                                    >
                                                    Delete
                                                </span>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                    <input type="file" name="images[]" id="file-input" multiple>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="description">Description <span class="required">*</span></label>
                            <textarea class="description" name="description">{!!old('description',$product->description)!!}</textarea>
                            @error('description')
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
@push('scripts')
    <script src="{{asset('custom/multiple_files.js')}}"></script>
 <script>
 	$(document).ready(function(){
 		$(document).on('change', '#category_id', function(){
 			let category_id = $(this).val();
 			$.ajax({

               url: "{{url('/get-subcategories')}}/"+category_id,

                type:"GET",
                dataType:"json",
                success:function(res) {
                	$('#subcategory_id').html('<option value="" selected="" disabled="">Select SubCategory</option>');

                	if(res.status == true){
                		$(res.data).each(function(idx,val){
                			let html = `<option value="${val.id}">${val.subcategory_name}</option>`;
                			$('#subcategory_id').append(html);
                		});
                	}
                },

            });
 		});
 	});
 </script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.delete-gallery-image', function(e) {
                e.preventDefault();
                let button = $(this);
                let imageId = button.data('id');

                if(!confirm('Are you sure you want to delete this image?')) return;

                $.ajax({
                    url: '{{ route("product.image.delete", ":id") }}'.replace(':id', imageId),
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.status) {
                            $('#row_' + imageId).fadeOut(300, function() {
                                $(this).remove();
                            });
                        } else {
                            alert('Error: ' + response.message);
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                        alert('Something went wrong while deleting.');
                    }
                });
            });
        });
    </script>
@endpush
