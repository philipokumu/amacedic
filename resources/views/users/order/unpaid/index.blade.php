@auth('web')

@extends('layouts.app', ['activePage' => 'Unpaid', 'titlePage' => __('All my unpaid orders')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">All my unpaid orders</h4>
          </div>
          @include('forms/unpaid/unpaidindex')
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@endauth