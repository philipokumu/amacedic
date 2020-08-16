@auth('editor')

@extends('editor.layouts.app', ['activePage' => 'Approved', 'titlePage' => __('All my approved orders')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">All my approved orders</h4>
          </div>
          @include('forms/approved/approvedindex')
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@endauth