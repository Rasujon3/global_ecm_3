@extends('front_master')
@section('front_content')
<!-- Start of Main -->
        <main class="main wishlist-page">
            <!-- Start of Page Header -->
            <div class="page-header">
                <div class="container">
                    <h1 class="page-title mb-0">Wishlist</h1>
                </div>
            </div>
            <!-- End of Page Header -->

            <!-- Start of Breadcrumb -->
            <nav class="breadcrumb-nav mb-10">
                <div class="container">
                    <ul class="breadcrumb">
                        <li><a href="{{url('/')}}">Home</a></li>
                        <li>Wishlist</li>
                    </ul>
                </div>
            </nav>
            <!-- End of Breadcrumb -->

            <!-- Start of PageContent -->
            <div class="page-content">
                <div class="container">
                    <h3 class="wishlist-title">My wishlist</h3>
                    <table class="shop-table wishlist-table">
                        <thead>
                            <tr>
                                <th class="product-name"><span>Product</span></th>
                                <th></th>
                                <th class="product-price"><span>Price</span></th>
                                <th class="product-stock-status"><span>Stock Status</span></th>
                                <th class="wishlist-action">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($data->isEmpty())
                                <tr>
                                    <td colspan="5" class="text-center">No wishlist found!</td>
                                </tr>
                                @else
                                @foreach($data as $row)
                                    <tr id="wishlist_{{$row->id}}">
                                        <td class="product-thumbnail">
                                            <div class="p-relative">
                                                <a href="{{ $row->id ? url('/product-details/'.$row->id) : '#' }}">
                                                    <figure>
                                                        <img
                                                            src="{{URL::to($row->product?->images?->first()?->image ?? '')}}"
                                                            alt="product"
                                                            width="300"
                                                            height="338"
                                                        >
                                                    </figure>
                                                </a>
                                                <button type="button" class="btn btn-close remove-wishlist" data-id="{{$row->id}}"><i
                                                        class="fas fa-times"></i></button>
                                            </div>
                                        </td>
                                        <td class="product-name">
                                            <a href="{{ url('/product-details/'.$row->id) }}">
                                                {{ $row?->product?->product_name ?? 'N/A' }}
                                            </a>
                                        </td>
                                        <td class="product-price">
                                            @if($row?->product?->discount > 0)
                                                <ins class="new-price">{{ $row->product ? discount($row->product) : 'N/A' }} BDT</ins><del
                                                    class="old-price">{{ $row?->product?->product_price ?? 'N/A' }} BDT</del>
                                            @else
                                                <ins class="new-price">{{ $row?->product?->product_price ?? 'N/A' }} BDT</ins>
                                            @endif
                                        </td>
                                        <td class="product-stock-status">
                                            @if($row?->product?->stock_qty > 0)
                                                <span class="wishlist-in-stock">In Stock</span>
                                            @else
                                                <span class="wishlist-in-stock">Sold Out</span>
                                            @endif
                                        </td>
                                        <td class="wishlist-action">
                                            <div class="d-lg-flex">
                                                <a href="{{ $row?->product?->id ? url('/product-details/'.$row?->product?->id) : '#' }}"
                                                   class="btn  btn-outline btn-default btn-rounded btn-sm mb-2 mb-lg-0">View Product</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <div style="margin-top: 5px; margin-bottom: 5px;">
                     {{$data->links()}}
                    </div>

                    <div class="social-links d-none">
                        <label>Share On:</label>
                        <div class="social-icons social-no-color border-thin">
                            <a href="#" class="social-icon social-facebook w-icon-facebook"></a>
                            <a href="#" class="social-icon social-twitter w-icon-twitter"></a>
                            <a href="#" class="social-icon social-pinterest w-icon-pinterest"></a>
                            <a href="#" class="social-icon social-email far fa-envelope"></a>
                            <a href="#" class="social-icon social-whatsapp fab fa-whatsapp"></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of PageContent -->
        </main>
        <!-- End of Main -->
@endsection

@push('scripts')
 <script>
 	$(document).on('click', '.remove-wishlist', function(e){
        e.preventDefault();
        wishlist_id = $(this).data('id');
        if(confirm('Do you want to delete this?'))
        {
            $.ajax({

                url: "{{url('/remove-wishlist')}}/"+wishlist_id,

                        type:"GET",
                        dataType:"json",
                        success:function(data) {

                        $('#wishlist_'+wishlist_id).remove();
                        // $('.cart-count').text(data.cart_count);
                        // cartCal();
                        toastr.success(data.message);

                },

            });
        }
      });
 </script>
@endpush
