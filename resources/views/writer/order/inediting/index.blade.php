@auth('writer')

@extends('writer.layouts.app', ['activePage' => 'In-editing', 'titlePage' => __('All my inediting orders')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">All my inediting orders</h4>
          </div>
          @include('forms/inediting/ineditingindex')
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@endauth