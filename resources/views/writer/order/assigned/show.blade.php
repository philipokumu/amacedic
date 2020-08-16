@auth('writer')

@extends('writer.layouts.app', ['activePage' => 'Assigned', 'titlePage' => __('Assigned order')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary row">
            <span class="col-6">
              <h4 class="card-title ">Order: {{$assignedOrder['id']}}</h4>
              <p class="card-category">Title: {{$assignedOrder['title']}}</p>
            </span>
            <span class="col-6">
              <a href="{{route('writer.assigned.index')}}" class='btn btn-info pull-right'>Back to list</a>
            </span>
          </div>
          <table class="table -mb-2">
            <thead class=" text-primary">
              <tr>
                <th>
                    <span class="pull-right">
                        <form method="POST" action="{{route('writer.assigned.update',$assignedOrder)}}" autocomplete="off" class="form-horizontal"> 
                          @method('PATCH')
                          @csrf
                          <input type="hidden" name="reject" value="0" readonly>
                          <button type="button" class="btn btn-danger" data-original-title="" title="" onclick="confirm('{{ __("Are you sure? Once rejected you cannot get this order!") }}') ? this.parentElement.submit() : ''">
                            Reject
                            <div class="ripple-container"></div>
                          </button>
                        </form>
                      </span>
                      <span class="pull-right">
                        <form method="POST" action="{{route('writer.assigned.update',$assignedOrder)}}" class="form-horizontal">
                          @csrf
                          @method('PATCH')
                          <input type="hidden" name="accept" value="1" readonly>
                          <button type="button" class="btn btn-success" data-original-title="submit" title="submit" onclick="confirm('{{ __("Are you sure? Once accepted you cannot return the order!") }}') ? this.parentElement.submit() : ''">
                              Accept
                              <div class="ripple-container"></div> 
                            </button>
                        </form>
                    </span>
                </th>
              </tr>
            </thead>
          </table>

          @include('forms/assigned/assignedshow')
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@endauth