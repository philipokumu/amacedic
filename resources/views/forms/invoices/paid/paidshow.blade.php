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
        @foreach ($paidOrders as $paidOrder)
          <tr>
            <td>
              {{$loop->iteration}}
            </td>
            @if(isset($paidOrder->order_id))
              <td>
                {{$paidOrder['id']}}
              </td>
            @endif
            <td>
              @if(isset($paidOrder->order_id))
                {{$paidOrder['order_id']}}
              @else
                {{$paidOrder['id']}}
              @endauth 
            </td>
            <td>
              @if(isset($paidOrder->writerAmount))
                Ksh. {{$paidOrder['writerAmount']}}
              @elseif(isset($paidOrder->editorAmount))
                Ksh. {{$paidOrder['editorAmount']}}
              @elseif(isset($paidOrder->expensesAmount))
                Ksh. {{$paidOrder['expensesAmount']}}
              @elseif(isset($paidOrder->amount))
                Ksh. {{$paidOrder['amount']}}
              @endauth
            </td>
            <td>
              @if(isset($paidOrder->noOfPages))
                {{$paidOrder['noOfPages']}}
              @else
                {{$paidOrder->order->noOfPages}}
              @endif
            </td>
            <td class="text-primary">
              @if(isset($paidOrder->approved_at))
                {{$paidOrder['approved_at']}}
              @else
                {{$paidOrder->order->approved_at}}
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
              <h5><strong>Ksh. {{$totalPaidAmount}} </strong></h5>
          </td>
          <td></td>
          <td></td>
        </tr>            
      </tbody>
    </table>
  </div>
</div>