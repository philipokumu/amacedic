@auth('admin')

@extends('admin.layouts.app', ['activePage' => 'Unpaid', 'titlePage' => __('All unpaid orders')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">All unpaid orders</h4>
          </div>
          @include('forms/unpaid/unpaidindex')
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@endauth