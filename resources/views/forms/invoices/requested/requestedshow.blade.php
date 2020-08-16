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
        @foreach ($requestedOrders as $requestedOrder)
          <tr>
            <td>
              {{$loop->iteration}}
            </td>
            @if(isset($requestedOrder->order_id))
              <td>
                {{$requestedOrder['id']}}
              </td>
            @endif
            <td>
              @if(isset($requestedOrder->order_id))
                {{$requestedOrder['order_id']}}
              @else
                {{$requestedOrder['id']}}
              @endauth 
            </td>
            <td>
              @if(isset($requestedOrder->writerAmount))
                Ksh. {{$requestedOrder['writerAmount']}}
              @elseif(isset($requestedOrder->editorAmount))
                Ksh. {{$requestedOrder['editorAmount']}}
              @elseif(isset($requestedOrder->expensesAmount))
                Ksh. {{$requestedOrder['expensesAmount']}}
              @elseif(isset($requestedOrder->amount))
              Ksh. {{$requestedOrder['amount']}}
              @endauth
            </td>
            <td>
              @if(isset($requestedOrder->noOfPages))
                {{$requestedOrder['noOfPages']}}
              @else
                {{$requestedOrder->order->noOfPages}}
              @endif
            </td>
            <td class="text-primary">
              @if(isset($requestedOrder->approved_at))
                {{$requestedOrder['approved_at']}}
              @else
                {{$requestedOrder->order->approved_at}}
              @endif
            </td>
          </tr>
        @endforeach  
        <tr>
          @if(auth('admin') && $invoice->invoicer == 'admin')
            <td>
            </td>
          @endif
          <td>
          </td>
          <td>
            <h5><strong>Total: </strong></h5>
          </td>
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