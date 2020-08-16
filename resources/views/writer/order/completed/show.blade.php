@auth('writer')

@extends('writer.layouts.app', ['activePage' => 'Completed', 'titlePage' => __('Completed order')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary row">
            <span class="col-6">
              <h4 class="card-title ">Order: {{$completedOrder['id']}}</h4>
              <p class="card-category">Title: {{$completedOrder['title']}}</p>
            </span>
            <span class="col-6">
              <a href="{{route('writer.inediting.index')}}" class='btn btn-info pull-right'>Back to list</a>
            </span>
          </div>

          @include('forms/completed/completedshow')
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@endauth