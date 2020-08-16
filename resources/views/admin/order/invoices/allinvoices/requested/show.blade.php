@auth('admin')

@extends('admin.layouts.app', ['activePage' => 'Requested-invoices', 'titlePage' => __('Requested invoice')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary row">
            <span class="col-6">
            <h4 class="card-title ">Orders for invoice {{$invoice->id}} by {{$invoice->invoicer}} {{$invoice->invoicer_id}}</h4>
              <p class="card-category">Approved orders that comprise this invoice</p>
            </span>
            <span class="col-6">
              <a href="{{route('admin.allrequestedinvoices.index')}}" class='btn btn-info pull-right'>Back to Invoices</a>
            </span>
          </div>

          <table class="table -mb-2">
            <thead class=" text-primary">
              <tr>
                <th>
                  <span class="pull-right">
                    <form method="POST" id="submit-invoice" class="form-horizontal" action="{{route('admin.allrequestedinvoices.update', $invoice)}}">
                      @csrf
                      @method('PATCH')
                      <button type="button" class="btn btn-success" data-original-title="" title="" onclick="confirm('{{ __("Have you paid?") }}') ? this.parentElement.submit() : ''">
                        Pay
                      </button>
                    </form>
                  </span>
                  <span class="pull-right mr-3 mt-3">
                    @if ($invoice->invoicer=='admin'||$invoice->invoicer=='adminexpenses')
                          <a href="{{route('admin.admin.show',$invoice->invoicer_id)}}" target="_blank">
                            Account details
                          </a>
                        @elseif ($invoice->invoicer=='writer')
                          <a href="{{route('admin.writer.show',$invoice->invoicer_id)}}" target="_blank">
                          Account details
                          </a>
                          @elseif ($invoice->invoicer=='editor')
                          <a href="{{route('admin.editor.show',$invoice->invoicer_id)}}" target="_blank">
                          Account details
                          </a>
                        @endif 
                  </span>
                </th>
              </tr>
            </thead>
          </table>

          @include('forms/invoices/requested/requestedshow')
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@endauth