@auth('admin')

@extends('admin.layouts.app', ['activePage' => 'Refunded', 'titlePage' => __('All refunded orders')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">All refunded orders</h4>
          </div>
          <div class="card-body">
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
                  Amount
                </th>
                <th>
                  User email
                </th>
              </thead>
              <tbody>
                @foreach ($refundedOrders as $refundedOrder)
                <tr>
                  <td>
                    {{$loop->iteration}}
                  </td>
                  <td>
                    <a href="{{ route('admin.cancelled.show', $refundedOrder)}}">{{$refundedOrder->id}}</a>
                  </td>
                  <td>
                    <a href="{{ route('admin.cancelled.show', $refundedOrder)}}">{{$refundedOrder->title}}</a>
                  </td>
                  <td>
                    <h6> <a href="{{ route('admin.cancelled.show', $refundedOrder)}}">{{substr($refundedOrder['currency'],5)}} {{$refundedOrder['totalPrice']}}</a></h6>
                  </td>
                  <td class="text-primary">
                    <a href="{{ route('admin.cancelled.show', $refundedOrder)}}">{{$refundedOrder->user->email}}</a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <div class="row">
              <div class="col-12 text-center d-flex justify-content-center pt-5">
                {{$refundedOrders->links()}}
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