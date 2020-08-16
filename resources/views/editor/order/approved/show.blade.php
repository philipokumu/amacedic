@auth('editor')

@extends('editor.layouts.app', ['activePage' => 'Approved', 'titlePage' => __('Approved order')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary row">
            <span class="col-6">
              <h4 class="card-title ">Order: {{$approvedOrder['id']}}</h4>
              <p class="card-category">Title: {{$approvedOrder['title']}}</p>
            </span>
            <span class="col-6">
              <a href="{{route('editor.approved.index')}}" class='btn btn-info pull-right'>Back to list</a>
            </span>
          </div>

          @include('forms/approved/approvedshow')
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@endauth