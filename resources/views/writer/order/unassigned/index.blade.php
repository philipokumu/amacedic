@auth('writer')

@extends('writer.layouts.app', ['activePage' => 'Available', 'titlePage' => __('All available orders')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">All orders</h4>
          </div>
          @include('forms/unassigned/unassignedindex')
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@endauth