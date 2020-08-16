@auth('admin')

@extends('admin.layouts.app', ['activePage' => 'Search', 'titlePage' => __('Search orders')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Search order</h4>
          </div>

          <div class="card-body">

            <form method="get" action="{{ route('admin.search.index') }}" class="form-horizontal">
              {{-- @csrf --}}

              <table class="table table-hover">
                <tbody>
                  <td>
                    <input class="form-control{{ $errors->has('order_id') ? ' is-invalid' : '' }}" name="order_id" id="input-order_id" type="text" placeholder="{{ __('Search by order ID') }}" autocomplete="off" value=""/>
                  </td>
                  <td>
                    <input class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" id="input-title" type="text" placeholder="{{ __('Search by order title') }}" value="" autocomplete="off"/>
                  </td>
                  <td>
                    <input class="form-control{{ $errors->has('client_id') ? ' is-invalid' : '' }}" name="client_id" id="input-client_id" type="text" placeholder="{{ __('Search by client ID') }}" value="" autocomplete="off"/>
                  </td>
                  <td>
                    <input class="form-control{{ $errors->has('writer_id') ? ' is-invalid' : '' }}" name="writer_id" id="input-writer_id" type="text" placeholder="{{ __('Search by writer ID') }}" value="" autocomplete="off"/>
                  </td>
                  <td>
                    <button type="submit" class="btn btn-sm btn-success">{{ __('Search') }}</button>
                  </td>
                </tbody>
              </table>
            </form>

            <table class="table table-hover">
              <thead class=" text-primary">
                <th>
                  #
                </th>
                <th>
                  Order ID
                </th>
                <th>
                  Title
                </th>
                <th>
                  Pages
                </th>
                <th>
                  Status
                </th>
                <th>
                  Amount
                </th>
              </thead>
              <tbody>
                @foreach ($allOrders as $order)
                <tr>
                  <td>
                    {{$loop->iteration}}
                  </td>
                  <td>
                    <a href="{{ route('admin'.'.'.$order->status.'.'.'show', $order)}}">{{$order->id}}</a>
                    @if (count(App\Order::where('user_id', $order->user_id)->get())==1)
                      <span class="badge badge-warning">New</span>
                    @endif
                    @if ($order->isUrgent=='yes')
                      <span class="badge badge-danger">CO</span>
                    @endif
                  </td>
                  <td>
                    <a href="{{ route('admin'.'.'.$order->status.'.'.'show', $order)}}">{{$order->title}}</a><br>
                    @if((Carbon\Carbon::now()->diffAsCarbonInterval(Carbon\Carbon::parse($order->writerEndDate),false))->invert ? 'minus ' : 'plus ' =='minus')
                    <small>Due in: -{{Carbon\Carbon::now()->diffAsCarbonInterval(Carbon\Carbon::parse($order->writerEndDate),false)}}</small>
                    @else 
                    <small>Due in: {{Carbon\Carbon::now()->diffAsCarbonInterval(Carbon\Carbon::parse($order->writerEndDate),false)}}</small>
                    @endif
                  </td>
                  <td>
                    {{$order->noOfPages}}
                  </td>
                  <td>
                    {{$order->status}}
                  </td>
                  <td>
                    <h6><a href="{{ route('admin'.'.'.$order->status.'.'.'show', $order)}}">{{substr($order['currency'],5)}} {{$order['totalPrice']}}</a></h6>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <div class="row">
              <div class="col-12 text-center d-flex justify-content-center pt-5">
                {{$allOrders->links()}}
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