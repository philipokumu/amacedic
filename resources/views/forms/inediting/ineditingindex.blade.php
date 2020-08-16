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
      @foreach ($ineditingOrders as $ineditingOrder)
      <tr>
        <td>
          {{$loop->iteration}}
        </td>
        <td>
          @auth('admin')<a href="{{ route('admin.inediting.show', $ineditingOrder)}}">{{$ineditingOrder->id}}</a>@endauth
          @auth('web')<a href="{{ route('user'.'.'.$ineditingOrder->status.'.'.'show', $ineditingOrder)}}">{{$ineditingOrder->id}}</a>@endauth
          @auth('writer')<a href="{{ route('writer'.'.'.$ineditingOrder->status.'.'.'show', $ineditingOrder)}}">{{$ineditingOrder->id}}</a>@endauth
          @auth('editor')<a href="{{ route('editor.inediting.show', $ineditingOrder)}}">{{$ineditingOrder->id}}</a>@endauth
          @if (auth('web')->check()==FALSE && count(App\Order::where('user_id', $ineditingOrder->user_id)->get())==1)
            <span class="badge badge-warning">New</span>
          @endif
          @if ($ineditingOrder->isUrgent=='yes')
            <span class="badge badge-danger">CO</span>
          @endif
        </td>
        <td>
          @auth('admin')<a href="{{ route('admin.inediting.show', $ineditingOrder)}}">{{$ineditingOrder->title}}</a><br>@endauth
          @auth('web')<a href="{{ route('user'.'.'.$ineditingOrder->status.'.'.'show', $ineditingOrder)}}">{{$ineditingOrder->title}}</a><br>@endauth
          @auth('writer')<a href="{{ route('writer'.'.'.$ineditingOrder->status.'.'.'show', $ineditingOrder)}}">{{$ineditingOrder->title}}</a><br>@endauth
          @auth('editor')<a href="{{ route('editor.inediting.show', $ineditingOrder)}}">{{$ineditingOrder->title}}</a><br>@endauth
          @if((Carbon\Carbon::now()->diffAsCarbonInterval(Carbon\Carbon::parse($ineditingOrder->writerEndDate),false))->invert ? 'minus ' : 'plus ' =='minus')
          <small>Due in: -{{Carbon\Carbon::now()->diffAsCarbonInterval(Carbon\Carbon::parse($ineditingOrder->writerEndDate),false)}}</small>
          @else 
          <small>Due in: {{Carbon\Carbon::now()->diffAsCarbonInterval(Carbon\Carbon::parse($ineditingOrder->writerEndDate),false)}}</small>
          @endif
        </td>
        <td>
          {{$ineditingOrder->noOfPages}}
        </td>
        <td>
          @auth('admin')<h6> <a href="{{ route('admin.inediting.show', $ineditingOrder)}}">{{substr($ineditingOrder['currency'],5)}} {{$ineditingOrder['totalPrice']}}</a></h6>@endauth
          @auth('web')<h6> <a href="{{ route('user'.'.'.$ineditingOrder->status.'.'.'show', $ineditingOrder)}}">{{substr($ineditingOrder['currency'],5)}} {{$ineditingOrder['totalPrice']}}</a></h6>@endauth
          @auth('writer')<h6> <a href="{{ route('writer'.'.'.$ineditingOrder->status.'.'.'show', $ineditingOrder)}}">Ksh. {{$ineditingOrder['writerAmount']}}</a></h6>@endauth
          @auth('editor')<h6> <a href="{{ route('editor.inediting.show', $ineditingOrder)}}">Ksh.{{$ineditingOrder['editorAmount']}}</a></h6>@endauth
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <div class="row">
    <div class="col-12 text-center d-flex justify-content-center pt-5">
      {{$ineditingOrders->links()}}
    </div>
  </div>
</div>