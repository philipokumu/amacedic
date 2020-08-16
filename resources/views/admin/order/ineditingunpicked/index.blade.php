@auth('admin')

@extends('admin.layouts.app', ['activePage' => 'In-editing Unpicked', 'titlePage' => __('All orders to be edited')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">All orders to be edited</h4>
          </div>
          @include('forms/ineditingunpicked/ineditingunpickedindex')
        </div> 
      </div>
    </div>
  </div>
</div>
@endsection

@endauth