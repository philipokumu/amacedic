@auth('web')

@extends('layouts.app', ['activePage' => 'My-coupons', 'titlePage' => __('My coupons')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title">{{ __('Your unused coupons for order discounts') }}</h4>
            <p class="card-category">{{ __('All coupons are for one time usage. Copy the coupon code and use in your new order') }}</p>
          </div>
          <div class="card-body">
            <div class="table-responsive">

              <table class="table table-hover">
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
                    <th colspan="7">
                      <span class="pull-right">
                        <a href="{{route('order.create')}}" class='btn btn-success pull-right'>Create new order</a>
                      </span>
                    </th>
                  </tr>
                  <th>
                    #
                  </th>
                  <th>
                    Coupon name
                  </th>
                  <th>
                    Coupon code
                  </th>
                  <th>
                    Coupon value
                  </th>
                  <th>
                    Action
                  </th>
                </thead>
                <tbody>
                  @foreach ($coupons as $coupon)
                  <tr>
                    <td>
                      {{$loop->iteration}}
                    </td>
                    <td>
                      <a href="{{ route('user.coupon.show', $coupon)}}">{{$coupon->couponName}}</a>
                    </td>
                    <td>
                      <a href="{{ route('user.coupon.show', $coupon)}}">{{$coupon->couponCode}}</a>
                    </td>
                    <td>
                      <a href="{{ route('user.coupon.show', $coupon)}}">{{$coupon->value()}} {{$coupon->type}} off</a>
                    </td>
                    <td>
                      <a href="{{ route('user.coupon.show', $coupon)}}"><i>Click to view details</i></a>
                    </td>
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
</div>
@endsection

@endauth