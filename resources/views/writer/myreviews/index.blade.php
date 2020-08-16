@auth('writer')

@extends('writer.layouts.app', ['activePage' => 'Customer-reviews', 'titlePage' => __('Customer reviews')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary row">
            <span class="col-sm-12">
              <h4 class="card-title ">Customer reviews</h4> 
              <p class="card-category">Click to see the reviews</p>
            </span>
          </div>
          
          <div class="modal-body">
            <h5>Overall rating: <input id="input-1" required="true" name="rating" class="rating rating-loading" data-min="0" data-max="5" data-step="0.5" data-size="x"
              value="{{$avgRating}}" readonly></h5>
            <div id="accordion" role="tablist">
              <div class="card card-collapse">
                @foreach ($myRatedOrders as $order)
                    
              <div class="card-header pb-1" role="tab" id="heading.{{$loop->iteration}}">
                    <h5 class="mb-0">
                      <a data-toggle="collapse" href="#collapse.{{$loop->iteration}}" aria-expanded="true" aria-controls="collapse.{{$loop->iteration}}">
                        <span class="pull-left">
                          
                          <h6 class="">Order ID: #{{$order->id}}</h6>
                          <p>Order rating: <input id="input-1" required="true" name="rating" class="rating rating-loading" data-min="0" data-max="5" data-step="0.5" data-size="x"
                              value="{{$order->rating}}" readonly></p>
                        </span>
                        <span class="pull-right">
                          <h6 class="">Date: {{$order->approved_at}}</h6>
                          <i class="material-icons">keyboard_arrow_down</i>
                        </span>
                      </a>
                    </h5>
                  </div>
                  <hr>
              
                  <div id="collapse.{{$loop->iteration}}" class="collapse" role="tabpanel" aria-labelledby="heading.{{$loop->iteration}}" data-parent="#accordion">
                    <div class="card-body">
                      <span class="pull-left">
                        {!!nl2br(e($order->ratingComment))!!}
                      </span>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@endauth