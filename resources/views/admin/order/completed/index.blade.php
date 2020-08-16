@auth('admin')

@extends('admin.layouts.app', ['activePage' => 'Completed', 'titlePage' => __('Completed orders')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Completed orders</h4>
          </div>
          @include('forms/completed/completedindex')
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@endauth