@auth('writer')

@extends('writer.layouts.app', ['activePage' => 'Bids', 'titlePage' => __('All my bids')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Orders I have bid for</h4>
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
                @foreach ($myBiddedOrders as $myBiddedOrder)
                <tr>
                  <td>
                    {{$loop->iteration}}
                  </td>
                  <td>
                    <a href="{{ route('writer'.'.'.$myBiddedOrder->status.'.'.'show', $myBiddedOrder)}}">{{$myBiddedOrder->id}}</a>
                    @if (auth('web')->check()==FALSE && count(App\Order::where('user_id', $myBiddedOrder->user_id)->get())==1)
                      <span class="badge badge-danger">New</span>
                    @endif
                  </td>
                  <td>
                    <a href="{{ route('writer'.'.'.$myBiddedOrder->status.'.'.'show', $myBiddedOrder)}}">{{$myBiddedOrder->title}}</a><br>
                      <small>Due in: {{Carbon\CarbonInterval::make(Carbon\Carbon::parse($myBiddedOrder->writerEndDate)->diff(Carbon\Carbon::now()))->cascade()->forHumans()}}</small>
                  </td>
                  <td>
                    {{$myBiddedOrder->noOfPages}}
                  </td>
                  <td>
                    {{$myBiddedOrder->status}}
                  </td>
                  <td>
                    <h6> <a href="{{ route('writer'.'.'.$myBiddedOrder->status.'.'.'show', $myBiddedOrder)}}">Ksh. {{$myBiddedOrder['writerAmount']}}</a></h6>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <div class="row">
              <div class="col-12 text-center d-flex justify-content-center pt-5">
                {{$myBiddedOrders->links()}}
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