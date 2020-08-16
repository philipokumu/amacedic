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
      @foreach ($approvedOrders as $approvedOrder)
      <tr>
        <td>
          {{$loop->iteration}}
        </td>
        <td>
          @auth('admin')<a href="{{ route('admin.approved.show', $approvedOrder)}}">{{$approvedOrder->id}}</a>@endauth
          @auth('web')<a href="{{ route('user.approved.show', $approvedOrder)}}">{{$approvedOrder->id}}</a>@endauth
          @auth('writer')<a href="{{ route('writer.approved.show', $approvedOrder)}}">{{$approvedOrder->id}}</a>@endauth
          @auth('editor')<a href="{{ route('editor.approved.show', $approvedOrder)}}">{{$approvedOrder->id}}</a>@endauth
          @if (auth('web')->check()==FALSE && count(App\Order::where('user_id', $approvedOrder->user_id)->get())==1)
            <span class="badge badge-warning">New</span>
          @endif
        </td>
        <td>
          @auth('admin')<a href="{{ route('admin.approved.show', $approvedOrder)}}">{{$approvedOrder->title}}</a><br>@endauth
          @auth('web')<a href="{{ route('user.approved.show', $approvedOrder)}}">{{$approvedOrder->title}}</a><br>@endauth
          @auth('writer')<a href="{{ route('writer.approved.show', $approvedOrder)}}">{{$approvedOrder->title}}</a><br>@endauth
          @auth('editor')<a href="{{ route('editor.approved.show', $approvedOrder)}}">{{$approvedOrder->title}}</a><br>@endauth
          @if((Carbon\Carbon::now()->diffAsCarbonInterval(Carbon\Carbon::parse($approvedOrder->writerEndDate),false))->invert ? 'minus ' : 'plus ' =='minus')
            <small>Due in: -{{Carbon\Carbon::now()->diffAsCarbonInterval(Carbon\Carbon::parse($approvedOrder->writerEndDate),false)}}</small>
          @else 
          <small>Due in: {{Carbon\Carbon::now()->diffAsCarbonInterval(Carbon\Carbon::parse($approvedOrder->writerEndDate),false)}}</small>
          @endif
        </td>
        <td>
          {{$approvedOrder->noOfPages}}
        </td>
        <td>
          @auth('admin')<h6> <a href="{{ route('admin.approved.show', $approvedOrder)}}">{{substr($approvedOrder['currency'],5)}} {{$approvedOrder['totalPrice']}}</a></h6>@endauth
          @auth('web')<h6> <a href="{{ route('user.approved.show', $approvedOrder)}}">{{substr($approvedOrder['currency'],5)}} {{$approvedOrder['totalPrice']}}</a></h6>@endauth
          @auth('writer')<h6> <a href="{{ route('writer.approved.show', $approvedOrder)}}">Ksh. {{$approvedOrder['writerAmount']}}</a></h6>@endauth
          @auth('editor')<h6> <a href="{{ route('editor.approved.show', $approvedOrder)}}">Ksh. {{$approvedOrder['editorAmount']}}</a></h6>@endauth
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <div class="row">
    <div class="col-12 text-center d-flex justify-content-center pt-5">
      {{$approvedOrders->links()}}
    </div>
  </div>
</div>