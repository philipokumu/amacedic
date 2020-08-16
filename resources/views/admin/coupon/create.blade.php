@auth('admin')

@extends('admin.layouts.app', ['activePage' => 'Create-coupon', 'titlePage' => __('Create coupon')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('admin.coupon.store') }}" autocomplete="off" class="form-horizontal">
            @csrf

            <div class="card ">
              <div class="card-header card-header-primary row">
                <span class="col-6">
                  <h4 class="card-title ">{{ __('Create coupon') }}</h4>
                  <p class="card-category">{{ __('Fill in the coupon information') }}</p>
                </span>
                <span class="col-6">
                  <a href="{{route('admin.coupon.index')}}" class='btn btn-info pull-right'>Back to list</a>
                </span>
              </div>
              <div class="card-body ">
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Coupon name') }}</label>
                  <div class="col-sm-7">
                    <div class="input-group">
                      <div class="input-group-prepend pr-2">
                        <select class="form-control{{ $errors->has('couponName') ? ' is-invalid' : '' }}" name="couponName" id="input-couponName" type="text" value="{{ old('couponName,""') }}" required="true" aria-required="true">
                          <option value="" selected disabled>-Select coupon name-</option>
                          <option value="New customer">New customer</option>
                          <option value="Order-based">Order based</option>
                          <option value="Holiday discount">Holiday discount</option>
                        </select>
                      </div>
                        <select class="form-control{{ $errors->has('orderNumber') ? ' is-invalid' : '' }}" name="orderNumber" id="orderNumber" type="number" required >
                          <option selected disabled>-Select no of orders (for order-based only)-</option>
                          @foreach ($orderBasedCouponSelect as $select)
                        <option value="{{$select}}">{{$select}}</option>
                          @endforeach
                        </select>
                    </div>
                      @if ($errors->has('couponName'))
                        <span id="couponName-error" class="error text-danger" for="input-couponName">{{ $errors->first('couponName') }}</span>
                      @endif
                      @if ($errors->has('orderNumber'))
                        <span id="orderNumber-error" class="error text-danger" for="input-orderNumber">{{ $errors->first('orderNumber') }}</span>
                      @endif
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Description') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                    <textarea class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" id="input-description" rows="3" type="description" placeholder="{{ __('Description') }}" value="{{ old('description'/*, auth()->user()->description*/) }}" required /></textarea>
                      @if ($errors->has('description'))
                        <span id="description-error" class="error text-danger" for="input-description">{{ $errors->first('description') }}</span>
                      @endif
                    </div>
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Coupon code') }}</label>
                  <div class="col-sm-7">
                    <div class="input-group">
                      <div class="input-group-prepend pr-2">
                        <input class="form-control{{ $errors->has('codePrefix') ? ' is-invalid' : '' }}" name="codePrefix" id="input-codePrefix" type="text" placeholder="{{ __('e.g EASTER') }}" value="{{ old('codePrefix')}}" required="true" aria-required="true"/>
                      </div>
                      <input class="form-control{{ $errors->has('codeSuffix') ? ' is-invalid' : '' }}" name="codeSuffix" id="input-codeSuffix" type="number" value="{{ $codeSuffix}}" required="true" aria-required="true" readonly/>
                      @if ($errors->has('codeSuffix'))
                      <span id="codeSuffix-error" class="error text-danger" for="input-codeSuffix">{{ $errors->first('codeSuffix') }}</span>
                      @endif
                    </div>
                    @if ($errors->has('codePrefix'))
                      <span id="codePrefix-error" class="error text-danger" for="input-codePrefix">{{ $errors->first('codePrefix') }}</span>
                    @endif
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Type of discount') }}</label>
                  <div class="col-sm-7">
                    <div class="input-group">
                      <div class="input-group-prepend pr-2">
                        <select class="form-control{{ $errors->has('Type of discount') ? ' is-invalid' : '' }}" title="-Select-" data-style="btn btn-link" name="type" id="type" type="type" value="{{ old('type') }}" required >
                          <option selected disabled>-Select discount type-</option>
                          <option value="percent">Percent off</option>
                          <option value="page">Page off</option>
                        </select>
                      </div>
                      <select class="form-control{{ $errors->has('discountValue') ? ' is-invalid' : '' }}" title="-Select-" data-style="btn btn-link" name="discountValue" id="discountValue" type="number" value="{{ old('discountValue') }}" required >
                        <option selected disabled>-Select discount value-</option>
                        <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                          <option value="6">6</option>
                          <option value="7">7</option>
                          <option value="8">8</option>
                          <option value="9">9</option>
                          <option value="10">10</option>
                          <option value="11">11</option>
                          <option value="12">12</option>
                          <option value="13">13</option>
                          <option value="14">14</option>
                          <option value="15">15</option>
                        </select>
                      </div>
                      @if ($errors->has('discountValue'))
                        <span id="type-error" class="error text-danger" for="input-type">{{ $errors->first('type') }}</span>
                      @endif
                      @if ($errors->has('discountValue'))
                      <span id="discountValue-error" class="error text-danger" for="input-discountValue">{{ $errors->first('discountValue') }}</span>
                      @endif
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Deadline *optional') }}</label>
                  <div class="col-sm-7">
                    <div class="input-group">
                      <div class="input-group-prepend pr-2">
                        <input type="text" id="startDate" name="startDate" class="form-control{{ $errors->has('startDate') ? ' is-invalid' : '' }} datetimepicker mt-1" value="" placeholder="{{ __('Valid from') }}"/>
                      </div>
                      <input type="text" id="endDate" name="endDate" class="form-control{{ $errors->has('endDate') ? ' is-invalid' : '' }} datetimepicker mt-1" value="" placeholder="{{ __('Valid until') }}"/>
                    </div>
                    @if ($errors->has('startDate'))
                      <span id="startDate-error" class="error text-danger" for="input-startDate">{{ $errors->first('startDate') }}</span>
                    @endif
                    @if ($errors->has('endDate'))
                      <span id="endDate-error" class="error text-danger" for="input-endDate">{{ $errors->first('endDate') }}</span>
                    @endif
                  </div>
                </div>

              </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@endauth