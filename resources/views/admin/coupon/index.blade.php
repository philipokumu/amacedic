@auth('admin')

@extends('admin.layouts.app', ['activePage' => 'Coupon-list', 'titlePage' => __('Coupon list')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title">{{ __('Coupon list') }}</h4>
            <p class="card-category">{{ __('Click to view coupon information') }}</p>
          </div>
          <div class="card-body">
            <div class="table-responsive">

              <table class="table table-hover">
                <thead class=" text-primary">
                  <tr>
                    <th colspan="7">
                      <span class="pull-right">
                        <a href="{{route('admin.coupon.create')}}" class='btn btn-success pull-right'>Create new coupon</a>
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
                    Type
                  </th>
                  <th>
                    Value
                  </th>
                  <th>
                    Actions
                  </th>
                </thead>
                <tbody>
                  @foreach ($coupons as $coupon)
                  <tr>
                    <td>
                      {{$loop->iteration}}
                    </td>
                    <td>
                      <a href="{{ route('admin.coupon.show', $coupon)}}">{{$coupon->couponName}}</a>
                    </td>
                    <td>
                      <a href="{{ route('admin.coupon.show', $coupon)}}">{{$coupon->couponCode}}</a>
                    </td>
                    <td>
                      <a href="{{ route('admin.coupon.show', $coupon)}}">{{$coupon->type}}</a>
                    </td>
                    <td class="text-primary">
                      <a href="{{ route('admin.coupon.show', $coupon)}}">{{$coupon->value()}}</a>
                    </td>
                    <td>
                      <form action="{{ route('admin.coupon.destroy', $coupon) }}" method="post">
                        @csrf
                        @method('delete')

                        <button type="button" class="btn btn-danger btn-link" data-original-title="" title="" onclick="confirm('{{ __("Are you sure you want to delete this coupon?") }}') ? this.parentElement.submit() : ''">
                            <i class="material-icons">close</i>
                            <div class="ripple-container"></div>
                        </button>
                    </form>
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