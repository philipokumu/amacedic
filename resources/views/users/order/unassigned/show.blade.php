@extends('layouts.app', ['activePage' => 'Available', 'titlePage' => __('Unassigned order')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary row">
            <span class="col-6">
              <h4 class="card-title ">Unassigned order: {{$order['id']}}</h4>
              <p class="card-category">Title: {{$order['title']}}</p>
            </span>
            <span class="col-6">
              <a href="{{route('user.unassigned.index')}}" class='btn btn-info pull-right'>Back to list</a>
            </span>
          </div>
          @include('forms/unassigned/unassignedshow')
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
