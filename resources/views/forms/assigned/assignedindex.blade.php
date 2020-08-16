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
        Amount
      </th>
      <th>
        Writer ID
      </th>
    </thead>
    <tbody>
      @foreach ($assignedOrders as $assignedOrder)
      <tr>
        <td>
          {{$loop->iteration}}
        </td>
        <td>
          @auth('admin')<a href="{{ route('admin.assigned.show', $assignedOrder)}}">{{$assignedOrder->id}}</a>@endauth
          @auth('web')<a href="{{ route('user.assigned.show', $assignedOrder)}}">{{$assignedOrder->id}}</a>@endauth
          @auth('writer')<a href="{{ route('writer.assigned.show', $assignedOrder)}}">{{$assignedOrder->id}}</a>@endauth
          @if (auth('web')->check()==FALSE && count(App\Order::where('user_id', $assignedOrder->user_id)->get())==1)
            <span class="badge badge-warning">New</span>
          @endif
          @if ($assignedOrder->isUrgent=='yes')
            <span class="badge badge-danger">CO</span>
          @endif
        </td>
        <td>
          @auth('admin')<a href="{{ route('admin.assigned.show', $assignedOrder)}}">{{$assignedOrder->title}}</a><br>@endauth
          @auth('web')<a href="{{ route('user.assigned.show', $assignedOrder)}}">{{$assignedOrder->title}}</a><br>@endauth
          @auth('writer')<a href="{{ route('writer.assigned.show', $assignedOrder)}}">{{$assignedOrder->title}}</a><br>@endauth
          @if((Carbon\Carbon::now()->diffAsCarbonInterval(Carbon\Carbon::parse($assignedOrder->writerEndDate),false))->invert ? 'minus ' : 'plus ' =='minus')
          <small>Due in: -{{Carbon\Carbon::now()->diffAsCarbonInterval(Carbon\Carbon::parse($assignedOrder->writerEndDate),false)}} </small>
          @else 
          <small>Due in: {{Carbon\Carbon::now()->diffAsCarbonInterval(Carbon\Carbon::parse($assignedOrder->writerEndDate),false)}} </small>
          @endif
        </td>
        <td>
          {{$assignedOrder->noOfPages}}
        </td>
        <td>
          @auth('admin')<h6><a href="{{ route('admin.assigned.show', $assignedOrder)}}">{{substr($assignedOrder['currency'],5)}} {{$assignedOrder['totalPrice']}}</a></h6>@endauth
          @auth('web')<h6><a href="{{ route('user.assigned.show', $assignedOrder)}}">{{substr($assignedOrder['currency'],5)}} {{$assignedOrder['totalPrice']}}</a></h6>@endauth
          @auth('writer')<h6><a href="{{ route('writer.assigned.show', $assignedOrder)}}">Ksh. {{$assignedOrder['writerAmount']}}</a></h6>@endauth
        </td>
        <td class="text-primary">
          <i>W{{$assignedOrder->writer_id}}</i>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <div class="row">
    <div class="col-12 text-center d-flex justify-content-center pt-5">
      {{$assignedOrders->links()}}
    </div>
  </div>
</div>