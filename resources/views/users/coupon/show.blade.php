@auth('web')

@extends('layouts.app', ['activePage' => 'My-coupons', 'titlePage' => __('Coupon list')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary row">
            <span class="col-6">
              <h4 class="card-title ">Coupon information for: {{$coupon->couponCode }}</h4>
              <p class="card-category">{{ __('Details') }}</p>
            </span>
            <span class="col-6">
              <a href="{{route('user.coupon.index')}}" class='btn btn-info pull-right'>Back to list</a>
            </span>
          </div>
          <div class="card-body">
            <div class="table-responsive">

              <table class="table table-hover">
                <thead class=" text-primary">
                  <tr>
                    <th colspan="7">
                      <span class="pull-right">
                        <a href="{{route('order.create')}}" class='btn btn-success pull-right'>Create new order</a>
                      </span>
                    </th>
                  </tr>
                  <th>
                    Label
                  </th>
                  <th>
                    Value
                  </th>
                  <th>
                    Label
                  </th>
                  <th>
                    Value
                  </th>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      Coupon name:
                    </td>
                    <td>
                      {{$coupon->couponName}}
                    </td>
                    <td>
                      Coupon code:
                    </td>
                    <td>
                      {{$coupon->couponCode}}
                    </td>
                    <tr>
                      <td>
                        Value:
                      </td>
                      <td>
                        {{$coupon->value()}} {{$coupon->type}} off
                      </td>
                      <td>
                      </td>
                      <td>
                      </td>
                    </tr>
                    <tr>
                      @if ($coupon->starts_at!=NULL)
                      <td>
                        Duration start:
                      </td>
                      <td>
                        {{$coupon->starts_at}}
                        No expiry limit
                      </td>
                      <td>
                        Duration end:
                      </td>
                      <td>
                        {{$coupon->ends_at}}
                      </td>
                      @endif
                    </tr>
                    <tr>
                      <td colspan="5">
                        <h4><strong>Description:</strong></h4>
                      {{$coupon->description}}
                    </td>
                      </td>
                    </tr>
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