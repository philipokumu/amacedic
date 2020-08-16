@auth('admin')

@extends('admin.layouts.app', ['activePage' => 'In-editing', 'titlePage' => __('Inediting orders')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Inediting orders</h4>
          </div>
          @include('forms/inediting/ineditingindex')
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@endauth