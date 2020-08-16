@auth('admin')

@extends('admin.layouts.app', ['activePage' => 'In-progress', 'titlePage' => __('Inprogress orders')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Inprogress orders</h4>
          </div>
          @include('forms/inprogress/inprogressindex')
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@endauth