@auth('writer')

@extends('writer.layouts.app', ['activePage' => 'In-editing', 'titlePage' => __('Inediting order')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary row">
            <span class="col-6">
              <h4 class="card-title ">Order: {{$ineditingOrder['id']}}</h4>
              <p class="card-category">Title: {{$ineditingOrder['title']}}</p>
            </span>
            <span class="col-6">
              <a href="{{route('writer.inediting.index')}}" class='btn btn-info pull-right'>Back to list</a>
            </span>
          </div>
          
          @include('forms/inediting/ineditingshow')
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@endauth