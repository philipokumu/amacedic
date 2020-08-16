<div class="modal-body">
  <table class="table -mb-2">
    <thead class=" text-primary">
      <tr>
        <th>
          Order ID
        </th>
        <th>
          Message to
        </th>
        <th>
          Date sent
        </th>
        <th>
        </th>
      </tr>
    </thead>
  </table>
  <div id="accordion" role="tablist">
    <div class="card card-collapse">
      @foreach ($messages as $message)
          
    <div class="card-header" role="tab" id="heading.{{$loop->iteration}}">
          <h5 class="mb-0">
            <button class="btn btn-link" data-toggle="collapse" href="#collapse.{{$loop->iteration}}" aria-expanded="true" aria-controls="collapse.{{$loop->iteration}}">
                <h5 class="pull-left mr-12">
                  @auth('admin')<a href="{{ route('admin'.'.'.$message->order->status.'.'.'show', $message->order_id)}}">#{{$message->order_id}}</a>@endauth
                  @auth('writer')<a href="{{ route('writer'.'.'.$message->order->status.'.'.'show', $message->order_id)}}">#{{$message->order_id}}</a>@endauth
                  @auth('web')<a href="{{ route('user'.'.'.$message->order->status.'.'.'show', $message->order_id)}}">#{{$message->order_id}}</a>@endauth
                  @auth('editor')<a href="{{ route('editor'.'.'.$message->order->status.'.'.'show', $message->order_id)}}">#{{$message->order_id}}</a>@endauth
                </h5>
              <h6 class="pull-left mr-15">{{$message->messageSender}} to {{$message->recipient}}</h6>
              <h6 class="pull-left mr-12">{{$message->created_at->format('y-m-d')}}</h6>
              <i class="material-icons">keyboard_arrow_down</i>
            </button>
          </h5>
        </div>
        <hr>
    
        <div id="collapse.{{$loop->iteration}}" class="collapse" role="tabpanel" aria-labelledby="heading.{{$loop->iteration}}" data-parent="#accordion">
          <div class="card-body">
            <span class="pull-left">
              {!!nl2br(e($message->message))!!}

            </span>
            @auth('admin')
            <span class="pull-right">
              <form action="{{ route('admin.message.delete', $message) }}" method="POST">
                @csrf
                @method('delete')
            
                <button type="button" class="btn btn-danger btn-link" data-original-title="" title="" onclick="confirm('{{ __("Are you sure you want to delete this message?") }}') ? this.parentElement.submit() : ''">
                  <i class="material-icons">close</i>
                  <div class="ripple-container"></div>
                </button>
              </form>
            </span>
            @endauth
          </div>
        </div>
      @endforeach
    </div>

  </div>
</div>
        