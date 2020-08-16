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
      @foreach ($inprogressOrders as $inprogressOrder)
      <tr>
        <td>
          {{$loop->iteration}}
        </td>
        <td>
          @auth('admin')<a href="{{ route('admin.inprogress.show', $inprogressOrder)}}">{{$inprogressOrder->id}}</a>@endauth
          @auth('web')<a href="{{ route('user.inprogress.show', $inprogressOrder)}}">{{$inprogressOrder->id}}</a>@endauth
          @auth('writer')<a href="{{ route('writer.inprogress.show', $inprogressOrder)}}">{{$inprogressOrder->id}}</a>@endauth
          @if (auth('web')->check()==FALSE && count(App\Order::where('user_id', $inprogressOrder->user_id)->get())==1)
            <span class="badge badge-warning">New</span>
          @endif
          @if ($inprogressOrder->isUrgent=='yes')
            <span class="badge badge-danger">CO</span>
          @endif
        </td>
        <td>
          @auth('admin')<a href="{{ route('admin.inprogress.show', $inprogressOrder)}}">{{$inprogressOrder->title}}</a><br>@endauth
          @auth('web')<a href="{{ route('user.inprogress.show', $inprogressOrder)}}">{{$inprogressOrder->title}}</a><br>@endauth
          @auth('writer')<a href="{{ route('writer.inprogress.show', $inprogressOrder)}}">{{$inprogressOrder->title}}</a><br>@endauth
          @if((Carbon\Carbon::now()->diffAsCarbonInterval(Carbon\Carbon::parse($inprogressOrder->writerEndDate),false))->invert ? 'minus ' : 'plus ' =='minus')
          <small>Due in: -{{Carbon\Carbon::now()->diffAsCarbonInterval(Carbon\Carbon::parse($inprogressOrder->writerEndDate),false)}}</small>
          @else 
          <small>Due in: {{Carbon\Carbon::now()->diffAsCarbonInterval(Carbon\Carbon::parse($inprogressOrder->writerEndDate),false)}}</small>
          @endif
        </td>
        <td>
          {{$inprogressOrder->noOfPages}}
        </td>
        <td>
          @auth('admin')<h6> <a href="{{ route('admin.inprogress.show', $inprogressOrder)}}">{{substr($inprogressOrder['currency'],5)}} {{$inprogressOrder['totalPrice']}}</a></h6>@endauth
          @auth('web')<h6> <a href="{{ route('user.inprogress.show', $inprogressOrder)}}">{{substr($inprogressOrder['currency'],5)}} {{$inprogressOrder['totalPrice']}}</a></h6>@endauth
          @auth('writer')<h6> <a href="{{ route('writer.inprogress.show', $inprogressOrder)}}">Ksh. {{$inprogressOrder['writerAmount']}}</a></h6>@endauth
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <div class="row">
    <div class="col-12 text-center d-flex justify-content-center pt-5">
      {{$inprogressOrders->links()}}
    </div>
  </div>
</div>