@auth('editor')

@extends('editor.layouts.app', ['activePage' => 'Cancelled', 'titlePage' => __('All my cancelled orders')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">All my cancelled orders</h4>
          </div>
          @include('forms/cancelled/cancelledindex')
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@endauth