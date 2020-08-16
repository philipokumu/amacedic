@auth('editor')

@extends('editor.layouts.app', ['activePage' => 'Completed', 'titlePage' => __('All my completed orders')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">All my completed orders</h4>
          </div>
          @include('forms/completed/completedindex')
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@endauth