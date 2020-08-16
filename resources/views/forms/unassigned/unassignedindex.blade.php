<div class="card-body">
  <table class="table table-hover">
    <thead class=" text-primary">
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
        Amount
      </th>
    </thead>
    <tbody>
      @foreach ($orders as $order)
      <tr>
        <td>
          @auth('admin')<a href="{{ route('admin.unassigned.show',$order)}}">{{$order->id}}</a><br>@endauth
          @auth('web')<a href="{{ route('user.unassigned.show',$order)}}">{{$order->id}}</a><br>@endauth
          @auth('writer')<a href="{{ route('writer.unassigned.show',$order)}}">{{$order->id}}</a><br>@endauth
          @if (auth('web')->check()==FALSE && count(App\Order::where('user_id', $order->user_id)->get())==1)
            <span class="badge badge-warning">New</span>
          @endif
          @if ($order->isUrgent=='yes')
            <span class="badge badge-danger">CO</span>
          @endif
        </td>
        <td>
          @auth('admin')<a href="{{ route('admin.unassigned.show',$order)}}">{{$order->title}}</a><br>@endauth
          @auth('web')<a href="{{ route('user.unassigned.show',$order)}}">{{$order->title}}</a><br>@endauth
          @auth('writer')<a href="{{ route('writer.unassigned.show',$order)}}">{{$order->title}}</a><br>@endauth
          @if((Carbon\Carbon::now()->diffAsCarbonInterval(Carbon\Carbon::parse($order->writerEndDate),false))->invert ? 'minus ' : 'plus ' =='minus')
          <small>Due in: -{{Carbon\Carbon::now()->diffAsCarbonInterval(Carbon\Carbon::parse($order->writerEndDate),false)}} </small>
          @else 
          <small>Due in: {{Carbon\Carbon::now()->diffAsCarbonInterval(Carbon\Carbon::parse($order->writerEndDate),false)}} </small>
          @endif
        </td>
        <td>
          {{$order->noOfPages}}
        </td>
        <td class="text-primary">
          @auth('admin')<h6> {{substr($order['currency'],5)}} {{$order['totalPrice']}}</h6>@endauth
          @auth('web')<h6> {{substr($order['currency'],5)}} {{$order['totalPrice']}}</h6>@endauth
          @auth('writer')<h6> Ksh. {{$order['writerAmount']}}</h6>@endauth
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <div class="row">
    @if ($orders->isNotEmpty())
    <div class="col-12 text-center d-flex justify-content-center pt-5">
      {{$orders->links()}}
    </div>
    @endif
  </div>
</div>