@auth('web')

@extends('layouts.app', ['activePage' => 'Assigned', 'titlePage' => __('All my assigned orders')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">All my assigned orders</h4>
          </div>
          @include('forms/assigned/assignedindex')
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@endauth