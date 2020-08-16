@auth('admin')

@extends('admin.layouts.app', ['activePage' => 'Approved', 'titlePage' => __('Approved orders')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Approved orders</h4>
          </div>
          @include('forms/approved/approvedindex')
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@endauth