@auth('web')

@extends('layouts.app', ['activePage' => 'Cancelled', 'titlePage' => __('Cancelled order')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary row">
            <span class="col-6">
              <h4 class="card-title ">Order: {{$cancelledOrder['id']}}</h4>
              <p class="card-category">Title: {{$cancelledOrder['title']}}</p>
            </span>
            <span class="col-6">
              <a href="{{route('user.cancelled.index')}}" class='btn btn-info pull-right'>Back to list</a>
            </span>
          </div>

          @include('forms/cancelled/cancelledshow')
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@endauth