@auth('writer')

@extends('writer.layouts.app', ['activePage' => 'Available', 'titlePage' => __('Unassigned Order')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary row">
            <span class="col-6">
              <h4 class="card-title ">Unassigned order: {{$order['id']}}</h4>
              <p class="card-category">Title: {{$order['title']}}</p>
            </span>
            <span class="col-6">
              <a href="{{route('writer.unassigned.index')}}" class='btn btn-info pull-right'>Back to list</a>
            </span>
          </div>
          <table class="table -mb-2">
            <thead class=" text-primary">
              <tr>
                <th>
                    <span class="pull-right">
                        @if(App\Bid::where(['order_id'=> $order->id,'writer_id'=> Auth::id()])->exists())
                          <form method="POST" action="{{ route('bid.destroy', App\Bid::where(['order_id'=>$order->id,'writer_id'=>Auth::id()])->first())}}" class="form-horizontal">
                            @csrf
                            <button type="button" class="btn btn-danger" data-original-title="submit" title="submit" onclick="confirm('{{ __("Are you sure you want to remove your bid?") }}') ? this.parentElement.submit() : ''">
                                Remove your bid
                                <div class="ripple-container"></div> 
                              </button>
                          </form>
                        @else
                          <form method="POST" action="{{ route('bid.store')}}" autocomplete="off" class="form-horizontal"> 
                            @csrf
                            <input type="hidden" name="order_id" value="{{$order->id}}" readonly>
                            <button type="button" class="btn btn-success" data-original-title="" title="" onclick="confirm('{{ __("Are you sure you want to bid for this order?") }}') ? this.parentElement.submit() : ''">
                              Make your bid
                              <div class="ripple-container"></div>
                            </button>
                          </form>
                        @endif
                      </span>
                </th>
              </tr>
            </thead>
          </table>

          @include('forms/unassigned/unassignedshow')
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@endauth