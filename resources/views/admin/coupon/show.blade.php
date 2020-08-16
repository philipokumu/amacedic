@auth('admin')

@extends('admin.layouts.app', ['activePage' => 'Coupon-list', 'titlePage' => __('Coupon list')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary row">
            <span class="col-6">
              <h4 class="card-title ">Coupon information for coupon: {{$coupon->couponName }}</h4>
              <p class="card-category">{{ __('All details') }}</p>
            </span>
            <span class="col-6">
              <a href="{{route('admin.coupon.index')}}" class='btn btn-info pull-right'>Back to list</a>
            </span>
          </div>
          <div class="card-body">
            <div class="table-responsive">

              <table class="table table-hover">
                <thead class=" text-primary">
                  <tr>
                    <th colspan="7">
                      <span class="pull-right">
                        <button type="button" class="btn btn-danger" data-original-title="" title="" onclick="confirm('{{ __("Are you sure you want to delete this coupon?") }}') ? this.parentElement.submit() : ''">
                          Delete this coupon
                          <div class="ripple-container"></div>
                      </button>
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
                        {{$coupon->value()}} {{$coupon->type}}
                      </td>
                      <td>
                        User:
                      </td>
                      <td>
                        C{{$coupon->user_id}}
                      </td>
                    </tr>
                    <tr>
                      <td>
                        Created on:
                      </td>
                      <td>
                        {{$coupon->created_at}}
                      </td>
                      <td>
                        Number of times used
                      </td>
                      <td>
                        {{$coupon->orders->count()}}
                      </td>
                    </tr>
                    @if ($coupon->starts_at!=NULL)
                      <tr>
                        <td>
                          Duration start:
                        </td>
                        <td>
                          {{$coupon->starts_at}}
                        </td>
                        <td>
                          Duration end:
                        </td>
                        <td>
                          {{$coupon->ends_at}}
                        </td>
                      </tr>
                    @endif
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