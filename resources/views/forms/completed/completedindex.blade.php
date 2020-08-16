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
    </thead>
    <tbody>
      @foreach ($completedOrders as $completedOrder)
      <tr>
        <td>
          {{$loop->iteration}}
        </td>
        <td>
          @auth('admin')<a href="{{ route('admin.completed.show', $completedOrder)}}">{{$completedOrder->id}}</a>@endauth
          @auth('web')<a href="{{ route('user.completed.show', $completedOrder)}}">{{$completedOrder->id}}</a>@endauth
          @auth('writer')<a href="{{ route('writer.completed.show', $completedOrder)}}">{{$completedOrder->id}}</a>@endauth
          @auth('editor')<a href="{{ route('editor.completed.show', $completedOrder)}}">{{$completedOrder->id}}</a>@endauth
          @if (auth('web')->check()==FALSE && count(App\Order::where('user_id', $completedOrder->user_id)->get())==1)
            <span class="badge badge-warning">New</span>
          @endif
          @if ($completedOrder->isUrgent=='yes')
            <span class="badge badge-danger">CO</span>
          @endif
        </td>
        <td>
          @auth('admin')<a href="{{ route('admin.completed.show', $completedOrder)}}">{{$completedOrder->title}}</a><br>@endauth
          @auth('web')<a href="{{ route('user.completed.show', $completedOrder)}}">{{$completedOrder->title}}</a><br>@endauth
          @auth('writer')<a href="{{ route('writer.completed.show', $completedOrder)}}">{{$completedOrder->title}}</a><br>@endauth
          @auth('editor')<a href="{{ route('editor.completed.show', $completedOrder)}}">{{$completedOrder->title}}</a><br>@endauth
          @if((Carbon\Carbon::now()->diffAsCarbonInterval(Carbon\Carbon::parse($completedOrder->writerEndDate),false))->invert ? 'minus ' : 'plus ' =='minus')
          <small>Due in: -{{Carbon\Carbon::now()->diffAsCarbonInterval(Carbon\Carbon::parse($completedOrder->writerEndDate),false)}}</small>
          @else 
          <small>Due in: {{Carbon\Carbon::now()->diffAsCarbonInterval(Carbon\Carbon::parse($completedOrder->writerEndDate),false)}}</small>
          @endif
        </td>
        <td>
          {{$completedOrder->noOfPages}}
        </td>
        <td>
          @auth('admin')<h6> <a href="{{ route('admin.completed.show', $completedOrder)}}">{{substr($completedOrder['currency'],5)}} {{$completedOrder['totalPrice']}}</a></h6>@endauth
          @auth('web')<h6> <a href="{{ route('user.completed.show', $completedOrder)}}">{{substr($completedOrder['currency'],5)}} {{$completedOrder['totalPrice']}}</a></h6>@endauth
          @auth('writer')<h6> <a href="{{ route('writer.completed.show', $completedOrder)}}">Ksh. {{$completedOrder['writerAmount']}}</a></h6>@endauth
          @auth('editor')<h6> <a href="{{ route('editor.completed.show', $completedOrder)}}">Ksh. {{$completedOrder['editorAmount']}}</a></h6>@endauth
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <div class="row">
    <div class="col-12 text-center d-flex justify-content-center pt-5">
      {{$completedOrders->links()}}
    </div>
  </div>
</div>