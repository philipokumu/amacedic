@auth('admin')

@extends('admin.layouts.app', ['activePage' => 'Search-invoices', 'titlePage' => __('Search invoice')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary row">
            <span class="col-6">
            <h4 class="card-title ">{{$invoice->status}} orders for invoice {{$invoice->id}} by {{$invoice->invoicer}} {{$invoice->invoicer_id}}</h4>
              <p class="card-category">Orders that comprise this invoice</p>
            </span>
            <span class="col-6">
              @if ($invoice->invoicer=='writer'||$invoice->invoicer=='editor')
                <a href="{{route('admin.searchinvoices.show', ['role'=>$invoice->invoicer, 'user'=>$invoice->invoicer_id])}}" class='btn btn-info pull-right'>Back to invoices</a>
              @else
                <a href="{{route('admin.searchinvoices.show', ['role'=>'admin', 'user'=>$invoice->invoicer_id])}}" class='btn btn-info pull-right'>Back to invoices</a>
              @endif
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
                  @if($invoice->invoicer == 'admin')
                  <th>
                    AdminCoin ID
                  </th>
                  @endif
                  <th>
                    Order ID
                  </th>
                  <th>
                    Amount
                  </th>
                  <th>
                    No of pages
                  </th>
                  <th>
                    Date approved
                  </th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($searchOrders as $searchOrder)
                    <tr>
                      <td>
                        {{$loop->iteration}}
                      </td>
                      @if(isset($searchOrder->order_id))
                        <td>
                          {{$searchOrder['id']}}
                        </td>
                      @endif
                      <td>
                        @if(isset($searchOrder->order_id))
                          {{$searchOrder['order_id']}}
                        @else
                          {{$searchOrder['id']}}
                        @endauth 
                      </td>
                      <td>
                        @if(isset($searchOrder->writerAmount))
                          USD {{$searchOrder['writerAmount']}}
                        @elseif(isset($searchOrder->editorAmount))
                          USD {{$searchOrder['editorAmount']}}
                        @elseif(isset($searchOrder->expensesAmount))
                          USD {{$searchOrder['expensesAmount']}}
                        @elseif(isset($searchOrder->amount))
                        USD {{$searchOrder['amount']}}
                        @endauth
                      </td>
                      <td>
                        @if(isset($searchOrder->noOfPages))
                          {{$searchOrder['noOfPages']}}
                        @else
                          {{$searchOrder->order->noOfPages}}
                        @endif
                      </td>
                      <td class="text-primary">
                        @if(isset($searchOrder->approved_at))
                          {{$searchOrder['approved_at']}}
                        @else
                          {{$searchOrder->order->approved_at}}
                        @endif
                      </td>
                    </tr>
                  @endforeach  
                  <tr>
                    @if($invoice->invoicer == 'admin')
                      <td>
                      </td>
                    @endif
                    <td>
                    </td>
                    <td>
                      <h5><strong>Total: </strong></h5>
                    </td>
                    <td>
                        <h5><strong>USD {{$totalAmount}} </strong></h5>
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