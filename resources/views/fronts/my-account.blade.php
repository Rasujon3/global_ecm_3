@extends('front_master')
@section('front_content')
<main class="main">
        <!-- Start of Page Header -->
        <div class="page-header">
          <div class="container">
            <h1 class="page-title mb-0">My Account</h1>
          </div>
        </div>
        <!-- End of Page Header -->

        <!-- Start of Breadcrumb -->
        <nav class="breadcrumb-nav">
          <div class="container">
            <ul class="breadcrumb">
              <li><a href="{{ route('home') }}">Home</a></li>
              <li>My account</li>
            </ul>
          </div>
        </nav>
        <!-- End of Breadcrumb -->

        <!-- Start of PageContent -->
        <div class="page-content pt-2">
          <div class="container">
            <div class="tab tab-vertical row gutter-lg">
              <ul class="nav nav-tabs mb-6" role="tablist">
                <li class="nav-item">
                  <a href="#account-dashboard" class="nav-link active"
                    >Dashboard</a
                  >
                </li>
                <li class="nav-item">
                  <a href="#account-orders" class="nav-link">Orders</a>
                </li>
                <li class="nav-item">
                  <a href="#account-details" class="nav-link"
                    >Account details</a
                  >
                </li>
              </ul>

              <div class="tab-content mb-6">
                <div class="tab-pane active in" id="account-dashboard">

                  <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">
                      <a href="#account-orders" class="link-to-tab">
                        <div class="icon-box text-center">
                          <span class="icon-box-icon icon-orders">
                            <i class="w-icon-orders"></i>
                          </span>
                          <div class="icon-box-content">
                            <p class="text-uppercase mb-0">Total Orders</p>
                            <p class="text-uppercase mb-0">{{ $totalOrders ?? 0 }}</p>
                          </div>
                        </div>
                      </a>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">
                      <a href="#account-orders" class="link-to-tab">
                        <div class="icon-box text-center">
                          <span class="icon-box-icon icon-download">
                            <i class="w-icon-download"></i>
                          </span>
                          <div class="icon-box-content">
                            <p class="text-uppercase mb-0">Today Orders</p>
                              <p class="text-uppercase mb-0">{{ $todayOrders ?? 0 }}</p>
                          </div>
                        </div>
                      </a>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">
                      <a href="#account-orders" class="link-to-tab">
                        <div class="icon-box text-center">
                          <span class="icon-box-icon icon-address">
                            <i class="w-icon-map-marker"></i>
                          </span>
                          <div class="icon-box-content">
                            <p class="text-uppercase mb-0">This month Orders</p>
                              <p class="text-uppercase mb-0">{{ $monthlyOrders ?? 0 }}</p>
                          </div>
                        </div>
                      </a>
                    </div>
                  </div>
                </div>

                <div class="tab-pane mb-4" id="account-orders">
                  <div class="icon-box icon-box-side icon-box-light">
                    <span class="icon-box-icon icon-orders">
                      <i class="w-icon-orders"></i>
                    </span>
                    <div class="icon-box-content">
                      <h4 class="icon-box-title text-capitalize ls-normal mb-0">
                        Orders
                      </h4>
                    </div>
                  </div>

                  <table class="shop-table account-orders-table mb-6">
                    <thead>
                      <tr>
                        <th class="order-id">Order</th>
                        <th class="order-date">Date</th>
                        <th class="order-status">Status</th>
                        <th class="order-total">Total</th>
                        <th class="order-total">Invoice</th>
                      </tr>
                    </thead>
                    <tbody>
                    @if($orders->count() > 0)
                    @foreach($orders as $order)
                      <tr>
                        <td class="order-id" style="text-align: center !important;">{{ $order->id ?? '' }}</td>
                        <td class="order-date" style="text-align: center !important;">{{ $order->created_at ?? '' }}</td>
                        <td class="order-status" style="text-align: center !important;">{{ $order->status ?? '' }}</td>
                        <td class="order-total" style="text-align: center !important;">{{ $order->total ?? 0 }}</td>
                        <td class="order-total" style="text-align: center !important;">
                            <a href="{{ route('front.invoice', $order->id) }}" target="_blank" class="btn btn-link btn-underline btn-icon-right text-primary">
                                <i class="w-icon-download"></i>
                            </a>
                        </td>
                      </tr>
                    @endforeach
                    @else
                      <tr>
                        <td colspan="4" class="text-center">No orders found.</td>
                      </tr>
                    @endif
                    </tbody>
                  </table>


                </div>

                <div class="tab-pane" id="account-downloads">
                  <div class="icon-box icon-box-side icon-box-light">
                    <span class="icon-box-icon icon-downloads mr-2">
                      <i class="w-icon-download"></i>
                    </span>
                    <div class="icon-box-content">
                      <h4 class="icon-box-title ls-normal">Downloads</h4>
                    </div>
                  </div>
                  <p class="mb-4">No downloads available yet.</p>
                  <a
                    href="shop-banner-sidebar.html"
                    class="btn btn-dark btn-rounded btn-icon-right"
                    >Go Shop<i class="w-icon-long-arrow-right"></i
                  ></a>
                </div>

                <div class="tab-pane" id="account-addresses">
                  <div class="icon-box icon-box-side icon-box-light">
                    <span class="icon-box-icon icon-map-marker">
                      <i class="w-icon-map-marker"></i>
                    </span>
                    <div class="icon-box-content">
                      <h4 class="icon-box-title mb-0 ls-normal">Addresses</h4>
                    </div>
                  </div>
                  <p>
                    The following addresses will be used on the checkout page by
                    default.
                  </p>
                  <div class="row">
                    <div class="col-sm-6 mb-6">
                      <div class="ecommerce-address billing-address pr-lg-8">
                        <h4
                          class="title title-underline ls-25 font-weight-bold"
                        >
                          Billing Address
                        </h4>
                        <address class="mb-4">
                          <table class="address-table">
                            <tbody>
                              <tr>
                                <th>Name:</th>
                                <td>John Doe</td>
                              </tr>
                              <tr>
                                <th>Company:</th>
                                <td>Conia</td>
                              </tr>
                              <tr>
                                <th>Address:</th>
                                <td>Wall Street</td>
                              </tr>
                              <tr>
                                <th>City:</th>
                                <td>California</td>
                              </tr>
                              <tr>
                                <th>Country:</th>
                                <td>United States (US)</td>
                              </tr>
                              <tr>
                                <th>Postcode:</th>
                                <td>92020</td>
                              </tr>
                              <tr>
                                <th>Phone:</th>
                                <td>1112223334</td>
                              </tr>
                            </tbody>
                          </table>
                        </address>
                        <a
                          href="#"
                          class="btn btn-link btn-underline btn-icon-right text-primary"
                          >Edit your billing address<i
                            class="w-icon-long-arrow-right"
                          ></i
                        ></a>
                      </div>
                    </div>
                    <div class="col-sm-6 mb-6">
                      <div class="ecommerce-address shipping-address pr-lg-8">
                        <h4
                          class="title title-underline ls-25 font-weight-bold"
                        >
                          Shipping Address
                        </h4>
                        <address class="mb-4">
                          <table class="address-table">
                            <tbody>
                              <tr>
                                <th>Name:</th>
                                <td>John Doe</td>
                              </tr>
                              <tr>
                                <th>Company:</th>
                                <td>Conia</td>
                              </tr>
                              <tr>
                                <th>Address:</th>
                                <td>Wall Street</td>
                              </tr>
                              <tr>
                                <th>City:</th>
                                <td>California</td>
                              </tr>
                              <tr>
                                <th>Country:</th>
                                <td>United States (US)</td>
                              </tr>
                              <tr>
                                <th>Postcode:</th>
                                <td>92020</td>
                              </tr>
                            </tbody>
                          </table>
                        </address>
                        <a
                          href="#"
                          class="btn btn-link btn-underline btn-icon-right text-primary"
                          >Edit your shipping address<i
                            class="w-icon-long-arrow-right"
                          ></i
                        ></a>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="tab-pane" id="account-details">
                  <div class="icon-box icon-box-side icon-box-light">
                    <span class="icon-box-icon icon-account mr-2">
                      <i class="w-icon-user"></i>
                    </span>
                    <div class="icon-box-content">
                      <h4 class="icon-box-title mb-0 ls-normal">
                        Account Details
                      </h4>
                    </div>
                  </div>
                    <form
                        class="form account-details-form"
                        action="{{ route('user-change-password') }}"
                        method="POST"
                    >
                        @csrf
                        <h4 class="title title-password ls-25 font-weight-bold">
                            Password change
                        </h4>

                        <div class="form-group">
                            <label class="text-dark" for="cur-password">Current Password</label>
                            <input
                                type="password"
                                class="form-control form-control-md"
                                id="cur-password"
                                name="current_password"
                                required
                            />
                        </div>

                        <div class="form-group">
                            <label class="text-dark" for="new-password">New Password</label>
                            <input
                                type="password"
                                class="form-control form-control-md"
                                id="new-password"
                                name="new_password"
                                required
                            />
                        </div>

                        <div class="form-group mb-10">
                            <label class="text-dark" for="conf-password">Confirm Password</label>
                            <input
                                type="password"
                                class="form-control form-control-md"
                                id="conf-password"
                                name="confirm_password"
                                required
                            />
                        </div>

                        <button type="submit" class="btn btn-dark btn-rounded btn-sm mb-4">
                            Save Changes
                        </button>
                    </form>

                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- End of PageContent -->
      </main>
@endsection
