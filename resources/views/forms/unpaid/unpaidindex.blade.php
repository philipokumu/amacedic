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
      @auth('web')
      <th>
        Pay
      </th>
      @endauth
      <th>
        Delete
      </th>
    </thead>
    <tbody>
      @foreach ($unpaidOrders as $unpaidOrder)
      <tr>
        <td>
          {{$loop->iteration}}
        </td>
        <td>
          @auth('admin')<a href="{{ route('admin.unpaid.show', $unpaidOrder)}}">{{$unpaidOrder->id}}</a>@endauth
          @auth('web')<a href="{{ route('user.unpaid.show', $unpaidOrder)}}">{{$unpaidOrder->id}}</a>@endauth
          @if (auth('web')->check()==FALSE && count(App\Order::where('user_id', $unpaidOrder->user_id)->get())==1)
            <span class="badge badge-warning">New</span>
          @endif
          @if ($unpaidOrder->isUrgent=='yes')
            <span class="badge badge-danger">CO</span>
          @endif
        </td>
        <td>
          @auth('admin')<a href="{{ route('admin.unpaid.show', $unpaidOrder)}}">{{$unpaidOrder->title}}</a><br>@endauth
          @auth('web')<a href="{{ route('user.unpaid.show', $unpaidOrder)}}">{{$unpaidOrder->title}}</a><br>@endauth
        </td>
        <td>
          {{$unpaidOrder->noOfPages}}
        </td>
        <td>
          @auth('admin')<h6> <a href="{{ route('admin.unpaid.show', $unpaidOrder)}}">{{substr($unpaidOrder['currency'],5)}} {{$unpaidOrder['totalPrice']}}</a></h6>@endauth
          @auth('web')<h6> <a href="{{ route('user.unpaid.show', $unpaidOrder)}}">{{substr($unpaidOrder['currency'],5)}} {{$unpaidOrder['totalPrice']}}</a></h6>@endauth
        </td>
        @auth('web')
          <td>
            <form action="{{ route('user.unpaid.update', $unpaidOrder) }}" method="post">
              @csrf
              @method('patch')
              <button type="button" class="btn btn-success btn-sm" data-original-title="" title="" onclick="confirm('{{ __("Pay for this order?") }}') ? this.parentElement.submit() : ''">
                Pay
              </button>
            </form>
          </td>
        @endauth
        <td>
          @auth('web')<form action="{{ route('user.unpaid.destroy', $unpaidOrder) }}" method="post">@endauth
            @auth('admin')<form action="{{ route('admin.unpaid.destroy', $unpaidOrder) }}" method="post">@endauth
            @csrf
            @method('delete')
        
            <button type="button" class="btn btn-danger btn-link" onclick="confirm('{{ __("Are you sure you want to delete this order?") }}') ? this.parentElement.submit() : ''">
                <i class="material-icons">close</i>
                <div class="ripple-container"></div>
            </button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <div class="row">
    <div class="col-12 text-center d-flex justify-content-center pt-5">
      {{$unpaidOrders->links()}}
    </div>
  </div>
</div>