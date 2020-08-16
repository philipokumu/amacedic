@auth('admin')

@extends('admin.layouts.app', ['activePage' => 'Paid-invoices', 'titlePage' => __('paid invoices')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
              <h4 class="card-title ">All paid invoices </h4>
              <p class="card-category">Paid invoices for all system users. Click any invoice to view its related orders</p>
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
                    Invoice ID
                  </th>
                  <th>
                    Invoicer ID
                  </th>
                  <th>
                    Invoicer
                  </th>
                  <th>
                    Name
                  </th>
                  <th>
                    Amount
                  </th>
                  <th>
                    Paid date
                  </th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($paidInvoices as $paidInvoice)
                    <tr>
                      <td>
                        {{$loop->iteration}}
                      </td>
                      <td>
                        <a href="{{route('admin.allpaidinvoices.show', $paidInvoice)}}">
                            {{$paidInvoice['id']}}
                        </a>
                    </td>
                    <td>
                      <a href="{{route('admin.allpaidinvoices.show', $paidInvoice)}}">
                        {{$paidInvoice['invoicer_id']}}
                      </a>
                    </td>
                      <td>
                        <a href="{{route('admin.allpaidinvoices.show', $paidInvoice)}}">
                          {{$paidInvoice['invoicer']}}
                        </a>
                      </td>
                      <td>
                        <a href="{{route('admin.allpaidinvoices.show', $paidInvoice)}}">
                          @if($paidInvoice->invoicer=='writer')
                            {{$paidInvoice->writer->name}}
                          @elseif ($paidInvoice->invoicer=='editor')
                            {{$paidInvoice->editor->name}}
                          @else
                            {{$paidInvoice->admin->name}}
                          @endif
                        </a>
                    </td>
                      <td>
                        Ksh. {{$paidInvoice['amount']}}
                    </td>
                      <td>
                        <a href="{{route('admin.allpaidinvoices.show', $paidInvoice)}}">
                          {{$paidInvoice['updated_at']}}
                        </a>
                      </td>
                    </tr>
                  @endforeach  
                  <tr>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                      <h5><strong>Total: </strong></h5>
                    </td>
                    <td>
                    </td>
                    <td></td>
                    <td>
                      <h5><strong>Ksh. {{$totalPaidAmount}} </strong></h5>
                    </td>
                    <td></td>
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