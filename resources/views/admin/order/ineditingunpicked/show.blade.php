@auth('admin')

@extends('admin.layouts.app', ['activePage' => 'In-editing Unpicked', 'titlePage' => __('Inediting-unpicked order')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary row">
            <span class="col-6">
              <h4 class="card-title ">Order: {{$ineditingUnpickedOrder['id']}}</h4>
              <p class="card-category">Title: {{$ineditingUnpickedOrder['title']}}</p>
            </span>
            <span class="col-6">
              <a href="{{route('admin.inediting-unpicked.index')}}" class='btn btn-info pull-right'>Back to list</a>
            </span>
          </div>
          
          @include('forms/ineditingunpicked/ineditingunpickedshow')
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@endauth