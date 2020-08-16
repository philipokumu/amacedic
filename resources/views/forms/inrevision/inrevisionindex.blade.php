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
      @foreach ($inrevisionOrders as $inrevisionOrder)
      <tr>
        <td>
          {{$loop->iteration}}
        </td>
        <td>
          @auth('admin')<a href="{{ route('admin.inrevision.show', $inrevisionOrder)}}">{{$inrevisionOrder->id}}</a>@endauth
          @auth('web')<a href="{{ route('user.inrevision.show', $inrevisionOrder)}}">{{$inrevisionOrder->id}}</a>@endauth
          @auth('writer')<a href="{{ route('writer.inrevision.show', $inrevisionOrder)}}">{{$inrevisionOrder->id}}</a>@endauth
          @auth('editor')<a href="{{ route('editor.inrevision.show', $inrevisionOrder)}}">{{$inrevisionOrder->id}}</a>@endauth
          
          @if (auth('web')->check()==FALSE && count(App\Order::where('user_id', $inrevisionOrder->user_id)->get())==1)
            <span class="badge badge-warning">New</span>
          @endif
          @if ($inrevisionOrder->isUrgent=='yes')
            <span class="badge badge-danger">CO</span>
          @endif
        </td>
        <td>
          @auth('admin')<a href="{{ route('admin.inrevision.show', $inrevisionOrder)}}">{{$inrevisionOrder->title}}</a><br>@endauth
          @auth('web')<a href="{{ route('user.inrevision.show', $inrevisionOrder)}}">{{$inrevisionOrder->title}}</a><br>@endauth
          @auth('writer')<a href="{{ route('writer.inrevision.show', $inrevisionOrder)}}">{{$inrevisionOrder->title}}</a><br>@endauth
          @auth('editor')<a href="{{ route('editor.inrevision.show', $inrevisionOrder)}}">{{$inrevisionOrder->title}}</a><br>@endauth
          @if((Carbon\Carbon::now()->diffAsCarbonInterval(Carbon\Carbon::parse($inrevisionOrder->writerEndDate),false))->invert ? 'minus ' : 'plus ' =='minus')
          <small>Due in: -{{Carbon\Carbon::now()->diffAsCarbonInterval(Carbon\Carbon::parse($inrevisionOrder->writerEndDate),false)}}</small>
          @else 
          <small>Due in: {{Carbon\Carbon::now()->diffAsCarbonInterval(Carbon\Carbon::parse($inrevisionOrder->writerEndDate),false)}}</small>
          @endif
        </td>
        <td>
          {{$inrevisionOrder->noOfPages}}
        </td>
        <td>
          @auth('admin')<h6> <a href="{{ route('admin.inrevision.show', $inrevisionOrder)}}">{{substr($inrevisionOrder['currency'],5)}} {{$inrevisionOrder['totalPrice']}}</a></h6>@endauth
          @auth('web')<h6> <a href="{{ route('user.inrevision.show', $inrevisionOrder)}}">{{substr($inrevisionOrder['currency'],5)}} {{$inrevisionOrder['totalPrice']}}</a></h6>@endauth
          @auth('writer')<h6> <a href="{{ route('writer.inrevision.show', $inrevisionOrder)}}">Ksh. {{$inrevisionOrder['writerAmount']}}</a></h6>@endauth
          @auth('editor')<h6> <a href="{{ route('editor.inrevision.show', $inrevisionOrder)}}">Ksh. {{$inrevisionOrder['editorAmount']}}</a></h6>@endauth
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <div class="row">
    <div class="col-12 text-center d-flex justify-content-center pt-5">
      {{$inrevisionOrders->links()}}
    </div>
  </div>
</div>