@auth('web')

@extends('layouts.app', ['activePage' => 'In-revision', 'titlePage' => __('Inrevision order')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary row">
            <span class="col-6">
              <h4 class="card-title ">Order: {{$inrevisionOrder['id']}}</h4>
              <p class="card-category">Title: {{$inrevisionOrder['title']}}</p>
            </span>
            <span class="col-6">
              <a href="{{route('user.inrevision.index')}}" class='btn btn-info pull-right'>Back to list</a>
            </span>
          </div>

          @include('forms/inrevision/inrevisionshow')
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@endauth