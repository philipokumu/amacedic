@auth('admin')

@extends('admin.layouts.app', ['activePage' => 'Unrefunded', 'titlePage' => __('All cancelled orders')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">All cancelled orders</h4>
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
                <th>
                  Action
                </th>
              </thead>
              <tbody>
                @foreach ($unrefundedOrders as $unrefundedOrder)
                <tr>
                  <td>
                    {{$loop->iteration}}
                  </td>
                  <td>
                    <a href="{{ route('admin.cancelled.show', $unrefundedOrder)}}">{{$unrefundedOrder->id}}</a>
                  </td>
                  <td>
                    <a href="{{ route('admin.cancelled.show', $unrefundedOrder)}}">{{$unrefundedOrder->title}}</a>
                  </td>
                  <td>
                    <h6> <a href="{{ route('admin.cancelled.show', $unrefundedOrder)}}">{{substr($unrefundedOrder['currency'],5)}} {{$unrefundedOrder['totalPrice']}}</a></h6>
                  </td>
                  <td class="text-primary">
                    <a href="{{ route('admin.cancelled.show', $unrefundedOrder)}}">{{$unrefundedOrder->user->email}}</a>
                  </td>
                  <td>
                    <form method="POST" id="submit-invoice" class="form-horizontal" action="{{route('admin.unrefunded.update', $unrefundedOrder)}}">
                      @csrf
                      @method('PATCH')
                      <button type="button" class="btn btn-sm btn-success" data-original-title="" title="" onclick="confirm('{{ __("Is money refunded?") }}') ? this.parentElement.submit() : ''">
                        Refund
                      </button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <div class="row">
              <div class="col-12 text-center d-flex justify-content-center pt-5">
                {{$unrefundedOrders->links()}}
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