@auth('editor')

@extends('editor.layouts.app', ['activePage' => 'In-revision', 'titlePage' => __('inrevision orders')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">All my inrevision orders</h4>
          </div>
          @include('forms/inrevision/inrevisionindex')
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@endauth