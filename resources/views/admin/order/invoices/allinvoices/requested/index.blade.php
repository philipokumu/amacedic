@auth('admin')

@extends('admin.layouts.app', ['activePage' => 'Requested-invoices', 'titlePage' => __('Requested invoices')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
              <h4 class="card-title ">All requested invoices </h4>
              <p class="card-category">Payment requests by all system users. Click any invoice to view its related orders</p>
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
                    Request date
                  </th>
                  <th>
                    Action
                  </th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($requestedInvoices as $requestedInvoice)
                    <tr>
                      <td>
                        {{$loop->iteration}}
                      </td>
                      <td>
                        <a href="{{route('admin.allrequestedinvoices.show', $requestedInvoice)}}">
                            {{$requestedInvoice['id']}}
                        </a>
                    </td>
                    <td>
                      <a href="{{route('admin.allrequestedinvoices.show', $requestedInvoice)}}">
                        {{$requestedInvoice['invoicer_id']}}
                      </a>
                    </td>
                    <td>
                      <a href="{{route('admin.allrequestedinvoices.show', $requestedInvoice)}}">
                        {{$requestedInvoice['invoicer']}}
                      </a>
                    </td>
                      <td>
                        <a href="{{route('admin.allrequestedinvoices.show', $requestedInvoice)}}">
                          @if($requestedInvoice->invoicer=='writer')
                            {{$requestedInvoice->writer->name}}
                          @elseif ($requestedInvoice->invoicer=='editor')
                            {{$requestedInvoice->editor->name}}
                          @else
                            {{$requestedInvoice->admin->name}}
                        @endif
                        </a>
                    </td>
                      <td>
                          Ksh. {{$requestedInvoice['amount']}}
                    </td>
                      <td>
                        <a href="{{route('admin.allrequestedinvoices.show', $requestedInvoice)}}">
                          {{$requestedInvoice['created_at']->format('y-m-d')}}
                        </a>
                      </td>
                      <td>
                        <span class="pull-right">
                          <form method="POST" id="submit-invoice" class="form-horizontal" action="{{route('admin.allrequestedinvoices.update', $requestedInvoice)}}">
                            @csrf
                            @method('PATCH')
                            <button type="button" class="btn btn-success" data-original-title="" title="" onclick="confirm('{{ __("Have you paid?") }}') ? this.parentElement.submit() : ''">
                              Pay
                            </button>
                          </form>
                        @if ($requestedInvoice->invoicer=='admin'||$requestedInvoice->invoicer=='adminexpenses')
                          <a href="{{route('admin.admin.show',$requestedInvoice->invoicer_id)}}" target="_blank">
                            Account details
                          </a>
                        @elseif ($requestedInvoice->invoicer=='writer')
                          <a href="{{route('admin.writer.show',$requestedInvoice->invoicer_id)}}" target="_blank">
                          Account details
                          </a>
                          @elseif ($requestedInvoice->invoicer=='editor')
                          <a href="{{route('admin.editor.show',$requestedInvoice->invoicer_id)}}" target="_blank">
                          Account details
                          </a>
                        @endif  
                        </span>

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
                      <h5><strong>Ksh. {{$totalRequestedAmount}} </strong></h5>
                    </td>
                    <td></td>
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