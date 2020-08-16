@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
              <div class="card-icon">
                <i class="material-icons">star</i>
              </div>
              <p class="card-category">Total orders</p>
              <h3 class="card-title">{{$totalOrders}}
              </h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons text-danger">fiber_new</i>
                <a href="{{route('order.create')}}">Make new order</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
              <div class="card-icon">
                <i class="material-icons">store</i>
              </div>
              <p class="card-category">Ongoing orders</p>
              <h3 class="card-title">{{$ongoingOrders}}</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">access_time</i>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
              <div class="card-icon">
                <i class="material-icons">verified</i>
              </div>
              <p class="card-category">Approved orders</p>
            <h3 class="card-title">{{$approvedOrders}}</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">access_time</i>
                <a href="{{route('user.approved.index')}}">View order(s)</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
              <div class="card-icon">
                <i class="material-icons">access_time</i>
              </div>
              <p class="card-category">Cancelled orders</p>
              <h3 class="card-title">{{$cancelledOrders}}</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">update</i>
                <a href="{{route('user.cancelled.index')}}">View order(s)</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
              <div class="card-icon">
                <i class="material-icons">done</i>
              </div>
              <p class="card-category">Completed orders</p>
              <p class="card-category">(Awaiting your approval)</p>
              <h3 class="card-title">{{$completedOrders}}</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">access_time</i>
                <a href="{{route('user.completed.index')}}">View order(s)</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
              <div class="card-icon">
                <i class="material-icons">message</i>
              </div>
              <p class="card-category">Unread messages</p>
              <h3 class="card-title">{{$messagesCount}}</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">access_time</i>
                <a href="{{route('user.message.index')}}">View message(s)</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
              <div class="card-icon">
                <i class="material-icons">card_giftcard</i>
              </div>
              <p class="card-category">Unused coupons</p>
              <h3 class="card-title">{{$couponCount}}</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">access_time</i>
                <a href="{{route('user.coupon.index')}}">View coupon(s)</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12 col-md-12">
          <div class="card">
            <div class="card-header card-header-success">
              <h4 class="card-title">My coupons</h4>
              <p class="card-category">Copy coupon code and use in your new order</p>
            </div>
            <div class="card-body table-responsive">
              <table class="table table-hover">
                <thead class="text-warning">
                  <thead class=" text-primary">
                    <tr>
                      <th colspan="7">
                        <span>
                          <h4 class="card-title text-primary">Point your friends to us using your unique affiliate link below and earn more discounts!</h4>
                          <h4 class="card-title "><a target="_blank" href="{{route('order.create')}}/ref=c{{auth()->id()}}-{{auth()->user()->referralId}}">
                            {{route('order.create')}}/ref=c{{auth()->id()}}-{{auth()->user()->referralId}}
                          </a></h4>
                        </span>
                      </th>
                    </tr>
                    <tr>
                      <th>#</th>
                      <th>Coupon code</th>
                      <th>Value</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach ($coupons as $coupon)
                    <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$coupon->couponCode}}</td>
                    <td>{{$coupon->value()}} {{$coupon->type}} off</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection