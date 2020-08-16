@auth('editor')

@extends('editor.layouts.app', ['activePage' => 'Invoice', 'titlePage' => __('Requested invoice')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary row">
            <span class="col-6">
              <h4 class="card-title ">Orders for invoice {{$invoice->id}}</h4>
              <p class="card-category">Approved orders that comprise this invoice</p>
            </span>
            <span class="col-6">
              <a href="{{route('editor.invoice.index')}}" class='btn btn-info pull-right'>Back to Invoices</a>
            </span>
          </div>

          @include('forms/invoices/requested/requestedshow')
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@endauth