@auth('admin')

@extends('admin.layouts.app', ['activePage' => 'Urgent-orders', 'titlePage' => __('Urgent orders')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Urgent orders</h4>
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
                @foreach ($urgentOrders as $urgentOrder)
                <tr>
                  <td>
                    {{$loop->iteration}}
                  </td>
                  <td>
                    @auth('admin')<a href="{{ route('admin'.'.'.$urgentOrder->status.'.'.'show', $urgentOrder)}}">{{$urgentOrder->id}}</a>@endauth
                    @auth('editor')<a href="{{ route('editor'.'.'.$urgentOrder->status.'.'.'show', $urgentOrder)}}">{{$urgentOrder->id}}</a>@endauth
                    @if(auth('web')->check()==FALSE && count(App\Order::where('user_id', $urgentOrder->user_id)->get())==1)
                      <span class="badge badge-warning">New</span>
                    @endif
                  </td>
                  <td>
                    @auth('admin')<a href="{{ route('admin'.'.'.$urgentOrder->status.'.'.'show', $urgentOrder)}}">{{$urgentOrder->title}}</a><br>@endauth
                    @auth('editor')<a href="{{ route('editor'.'.'.$urgentOrder->status.'.'.'show', $urgentOrder)}}">{{$urgentOrder->title}}</a><br>@endauth
                      @if((Carbon\Carbon::now()->diffAsCarbonInterval(Carbon\Carbon::parse($urgentOrder->writerEndDate),false))->invert ? 'minus ' : 'plus ' =='minus')
                        <small>Due in: -{{Carbon\Carbon::now()->diffAsCarbonInterval(Carbon\Carbon::parse($urgentOrder->writerEndDate),false)}}</small>
                      @else 
                      <small>Due in: {{Carbon\Carbon::now()->diffAsCarbonInterval(Carbon\Carbon::parse($urgentOrder->writerEndDate),false)}}</small>
                      @endif
                  </td>
                  <td>
                    {{$urgentOrder->noOfPages}}
                  </td>
                  <td>
                    {{$urgentOrder->status}}
                  </td>
                  <td>
                    @auth('admin')<h6> <a href="{{ route('admin'.'.'.$urgentOrder->status.'.'.'show', $urgentOrder)}}">{{substr($urgentOrder['currency'],5)}} {{$urgentOrder['totalPrice']}}</a></h6>@endauth
                    @auth('editor')<h6> <a href="{{ route('editor'.'.'.$urgentOrder->status.'.'.'show', $urgentOrder)}}">Ksh. {{$urgentOrder['editorAmount']}}</a></h6>@endauth
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
@endsection

@endauth