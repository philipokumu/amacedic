@auth('admin')

@extends('admin.layouts.app', ['activePage' => 'Expenses-invoices', 'titlePage' => __('Paid invoice')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary row">
            <span class="col-6">
              <h4 class="card-title ">Orders for invoice {{$invoice->id}}  by {{$invoice->invoicer}} {{$invoice->invoicer_id}}</h4>
              <p class="card-category">Approved orders that comprise this invoice</p>
            </span>
            <span class="col-6">
              <a href="{{route('admin.expensesinvoice.index')}}" class='btn btn-info pull-right'>Back to Invoices</a>
            </span>
          </div>

          @include('forms/invoices/paid/paidshow')
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@endauth