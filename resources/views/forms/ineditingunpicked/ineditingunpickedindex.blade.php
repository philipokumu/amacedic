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
      @auth('editor')
      <th>
        Action
      </th>
      @endauth
    </thead>
    <tbody>
      @foreach ($ineditingUnpickedOrders as $ineditingUnpickedOrder)
      <tr>
        <td>
          {{$loop->iteration}}
        </td>
        <td>
          @auth('admin')<a href="{{ route('admin.inediting-unpicked.show', $ineditingUnpickedOrder)}}">{{$ineditingUnpickedOrder->id}}</a>@endauth
          @auth('editor')<a href="{{ route('editor.inediting-unpicked.show', $ineditingUnpickedOrder)}}">{{$ineditingUnpickedOrder->id}}</a>@endauth
          @if (auth('web')->check()==FALSE && count(App\Order::where('user_id', $ineditingUnpickedOrder->user_id)->get())==1)
            <span class="badge badge-warning">New</span>
          @endif
          @if ($ineditingUnpickedOrder->isUrgent=='yes')
            <span class="badge badge-danger">CO</span>
          @endif
        </td>
        <td>
          @auth('admin')<a href="{{ route('admin.inediting-unpicked.show', $ineditingUnpickedOrder)}}">{{$ineditingUnpickedOrder->title}}</a><br>@endauth
          @auth('editor')<a href="{{ route('editor.inediting-unpicked.show', $ineditingUnpickedOrder)}}">{{$ineditingUnpickedOrder->title}}</a><br>@endauth
          @if((Carbon\Carbon::now()->diffAsCarbonInterval(Carbon\Carbon::parse($ineditingUnpickedOrder->writerEndDate),false))->invert ? 'minus ' : 'plus ' =='minus')
          <small>Due in: -{{Carbon\Carbon::now()->diffAsCarbonInterval(Carbon\Carbon::parse($ineditingUnpickedOrder->writerEndDate),false)}}</small>
          @else 
          <small>Due in: {{Carbon\Carbon::now()->diffAsCarbonInterval(Carbon\Carbon::parse($ineditingUnpickedOrder->writerEndDate),false)}}</small>
          @endif
        </td>
        <td>
          {{$ineditingUnpickedOrder->noOfPages}}
        </td>
        <td>
          @auth('admin')<h6> <a href="{{ route('admin.inediting-unpicked.show', $ineditingUnpickedOrder)}}">{{substr($ineditingUnpickedOrder['currency'],5)}} {{$ineditingUnpickedOrder['totalPrice']}}</a></h6>@endauth
          @auth('editor')<h6> <a href="{{ route('editor.inediting-unpicked.show', $ineditingUnpickedOrder)}}">Ksh. {{$ineditingUnpickedOrder['editorAmount']}}</a></h6>@endauth
        </td>
        <td>
          @auth('editor')
            <span class="pull-right">
              <form method="POST" action="{{route('editor.inediting-unpicked.update',$ineditingUnpickedOrder)}}" class="form-horizontal">
                @csrf
                @method('PATCH')
                <button type="button" class="btn btn-success" data-original-title="submit" title="submit" onclick="confirm('{{ __("Are you sure? once you pick, you cannot return!") }}') ? this.parentElement.submit() : ''">
                  Pick
                  <div class="ripple-container"></div> 
                </button>
              </form>
            </span>
          @endauth
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  @if($ineditingUnpickedOrders->isNotEmpty())
    <div class="row">
      <div class="col-12 text-center d-flex justify-content-center pt-5">
        {{$ineditingUnpickedOrders->links()}}
      </div>
    </div>
  @endif
</div>