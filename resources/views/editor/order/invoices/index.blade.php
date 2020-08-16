@auth('editor')

@extends('editor.layouts.app', ['activePage' => 'Invoice', 'titlePage' => __('Invoices')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
              <h4 class="card-title ">Invoices from approved orders</h4>
              <p class="card-category">These are your payment records</p>
          </div>

          @include('forms/invoices/invoiceindex')
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@endauth