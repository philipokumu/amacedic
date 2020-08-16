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
      @foreach ($cancelledOrders as $cancelledOrder)
      <tr>
        <td>
          {{$loop->iteration}}
        </td>
        <td>
          @auth('admin')<a href="{{ route('admin.cancelled.show', $cancelledOrder)}}">{{$cancelledOrder->id}}</a>@endauth
          @auth('web')<a href="{{ route('user.cancelled.show', $cancelledOrder)}}">{{$cancelledOrder->id}}</a>@endauth
          @auth('writer')<a href="{{ route('writer.cancelled.show', $cancelledOrder)}}">{{$cancelledOrder->id}}</a>@endauth
          @auth('editor')<a href="{{ route('editor.cancelled.show', $cancelledOrder)}}">{{$cancelledOrder->id}}</a>@endauth
          @if (auth('web')->check()==FALSE && count(App\Order::where('user_id', $cancelledOrder->user_id)->get())==1)
            <span class="badge badge-warning">New</span>
          @endif
        </td>
        <td>
          @auth('admin')<a href="{{ route('admin.cancelled.show', $cancelledOrder)}}">{{$cancelledOrder->title}}</a><br>@endauth
          @auth('web')<a href="{{ route('user.cancelled.show', $cancelledOrder)}}">{{$cancelledOrder->title}}</a><br>@endauth
          @auth('writer')<a href="{{ route('writer.cancelled.show', $cancelledOrder)}}">{{$cancelledOrder->title}}</a><br>@endauth
          @auth('editor')<a href="{{ route('editor.cancelled.show', $cancelledOrder)}}">{{$cancelledOrder->title}}</a><br>@endauth
          @if((Carbon\Carbon::now()->diffAsCarbonInterval(Carbon\Carbon::parse($cancelledOrder->writerEndDate),false))->invert ? 'minus ' : 'plus ' =='minus')
          <small>Due in: -{{Carbon\Carbon::now()->diffAsCarbonInterval(Carbon\Carbon::parse($cancelledOrder->writerEndDate),false)}}</small>
          @else 
          <small>Due in: {{Carbon\Carbon::now()->diffAsCarbonInterval(Carbon\Carbon::parse($cancelledOrder->writerEndDate),false)}}</small>
          @endif
        </td>
        <td>
          {{$cancelledOrder->noOfPages}}
        </td>
        <td>
          @auth('admin')<h6> <a href="{{ route('admin.cancelled.show', $cancelledOrder)}}">{{substr($cancelledOrder['currency'],5)}} {{$cancelledOrder['totalPrice']}}</a></h6>@endauth
          @auth('web')<h6> <a href="{{ route('user.cancelled.show', $cancelledOrder)}}">{{substr($cancelledOrder['currency'],5)}} {{$cancelledOrder['totalPrice']}}</a></h6>@endauth
          @auth('writer')<h6> <a href="{{ route('writer.cancelled.show', $cancelledOrder)}}">Ksh. {{$cancelledOrder['writerAmount']}}</a></h6>@endauth
          @auth('editor')<h6> <a href="{{ route('editor.cancelled.show', $cancelledOrder)}}">Ksh. {{$cancelledOrder['editorAmount']}}</a></h6>@endauth
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <div class="row">
    <div class="col-12 text-center d-flex justify-content-center pt-5">
      {{$cancelledOrders->links()}}
    </div>
  </div>
</div>