@auth('admin')

@extends('admin.layouts.app', ['activePage' => 'My-invoices', 'titlePage' => __('Requested invoice')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary row">
            <span class="col-6">
              <h4 class="card-title ">Coins and orders for invoice {{$invoice->id}}</h4>
              <p class="card-category">Approved coins and orders that comprise this invoice</p>
            </span>
            <span class="col-6">
              <a href="{{route('admin.myinvoice.index')}}" class='btn btn-info pull-right'>Back to Invoices</a>
            </span>
          </div>

          <div class="card-body">
            <div class="table-responsive">
              <table class="table">
                <thead class=" text-primary">
                  <tr>
                    <th>
                      #
                    </th>
                    <th>
                      Admin coin ID
                    </th>
                    <th>
                      Order ID
                    </th>
                    <th>
                      Your amount
                    </th>
                    <th>
                      Order balance amount
                    </th>
                    <th>
                      Order full amount
                    </th>
                    <th>
                      Approval date
                    </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($adminCoinInvoices as $adminCoinInvoice)
                    <tr>
                      <td>
                        {{$loop->iteration}}
                      </td>
                    <td>
                        {{$adminCoinInvoice['id']}}
                    </td>
                    <td>
                        {{$adminCoinInvoice['order_id']}}
                    </td>
                    <td>
                      USD {{$adminCoinInvoice['amount']}}
                    </td>
                    <td>
                      USD {{$adminCoinInvoice->order->balance}}
                    </td>
                    <td>
                      {{substr($adminCoinInvoice->order->currency,5)}} {{$adminCoinInvoice->order->totalPrice}}
                    </td>
                    <td>
                      {{$adminCoinInvoice->order->approved_at}}
                    </td>
                    </tr>
                  @endforeach
                  <tr>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                      <h5><strong>Total:</strong></h5>
                    </td>
                    <td>
                      <h5><strong>USD: {{$totalRequestedAmount}}</strong></h5>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@endauth