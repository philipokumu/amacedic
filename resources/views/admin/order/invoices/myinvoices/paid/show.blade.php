@auth('admin')

@extends('admin.layouts.app', ['activePage' => 'My-invoices', 'titlePage' => __('Paid invoice')])

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
                  @foreach ($adminCoinPaidInvoices as $adminCoinPaidInvoice)
                    <tr>
                      <td>
                        {{$loop->iteration}}
                      </td>
                    <td>
                        {{$adminCoinPaidInvoice['id']}}
                    </td>
                    <td>
                        {{$adminCoinPaidInvoice['order_id']}}
                    </td>
                    <td>
                      USD {{$adminCoinPaidInvoice['amount']}}
                    </td>
                    <td>
                      USD {{$adminCoinPaidInvoice->order->balance}}
                    </td>
                    <td>
                      {{substr($adminCoinPaidInvoice->order->currency,5)}} {{$adminCoinPaidInvoice->order->totalPrice}}
                    </td>
                    <td>
                      {{$adminCoinPaidInvoice->order->approved_at}}
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
                      <h5><strong>USD: {{$totalPaidAmount}}</strong></h5>
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