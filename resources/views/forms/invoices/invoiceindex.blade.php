<div class="card-body">
  <div class="table-responsive">
    <div>
      <ul class="nav nav-pills nav-pills-primary col-md-12" role="tablist" id="tabMenu">
          <li class="nav-item">
          <a class="nav-link active" href="#unrequested" data-toggle="tab">
              <i class="material-icons">list</i> unrequested
              <div class="ripple-container"></div>
          </a>
          </li>
          <li class="nav-item">
          <a class="nav-link" href="#requested" data-toggle="tab">
              <i class="material-icons">redeem</i> Requested
              <div class="ripple-container"></div>
          </a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="#paid" data-toggle="tab">
              <i class="material-icons">money</i> Paid
              <div class="ripple-container"></div>
              </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#paymentdetails" data-toggle="tab">
            <i class="material-icons">payment</i> Payment details
            <div class="ripple-container"></div>
            </a>
        </li>
        </ul>
        <hr>
  </div>
    <div class="card-body -mt-8">
        <div class="tab-content">
        <div class="tab-pane active" id="unrequested">
          <table class="table">
            <thead class=" text-primary">
              <tr>
                <th colspan="7">
                  <span class="pull-right">
                      @auth('writer') 
                          <form method="POST" action="{{route('writer.invoice.store')}}" class="form-horizontal">
                      @endauth
                      @auth('editor') 
                          <form method="POST" action="{{route('editor.invoice.store')}}" class="form-horizontal">
                      @endauth
                      @auth('admin') 
                        @if (isset($approvedInvoiceOrders))
                          <form method="POST" action="{{route('admin.expensesinvoice.store')}}" class="form-horizontal">
                        @endif
                        @if (isset($adminCoinInvoices))
                          <form method="POST" action="{{route('admin.myinvoice.store')}}" class="form-horizontal">
                        @endif
                      @endauth
                        @csrf
                          <button type="button" class="btn btn-success" data-original-title="submit" title="submit" onclick="confirm('{{ __("Request for payment?") }}') ? this.parentElement.submit() : ''">
                              Request payment
                              <div class="ripple-container"></div> 
                          </button>
                        </form>
                      </span>
                    </th>
                  </tr>

              @if(isset($approvedInvoiceOrders))
                <tr>
                  <th>
                    #
                  </th>
                  <th>
                    Order ID
                  </th>
                  <th>
                    Amount
                  </th>
                  <th>
                    Approval date
                  </th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($approvedInvoiceOrders as $approvedInvoiceOrder)
                    <tr>
                      <td>
                        {{$loop->iteration}}
                      </td>
                    <td>
                        {{$approvedInvoiceOrder['id']}}
                    </td>
                      <td>
                        @auth('writer') 
                          Ksh. {{$approvedInvoiceOrder['writerAmount']}}
                        @endauth
                        @auth('editor') 
                          Ksh. {{$approvedInvoiceOrder['editorAmount']}}
                        @endauth
                        @auth('admin') 
                          Ksh. {{$approvedInvoiceOrder['expensesAmount']}}
                        @endauth
                      </td>
                      <td>
                        {{$approvedInvoiceOrder['approved_at']}}
                      </td>
                    </tr>
                  @endforeach
                  <tr>
                    <td>
                    </td>
                    <td>
                      <h5><strong>Total: </strong></h5>
                    </td>
                    <td>
                      <h5><strong>Ksh. {{$totalApprovedAmount}} </strong></h5>
                    </td>
                    <td></td>
                  </tr>
              @elseif (isset($adminCoinInvoices))
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
                    Ksh. {{$adminCoinInvoice['amount']}}
                  </td>
                  <td>
                    Ksh. {{$adminCoinInvoice->order->balance}}
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
                    <h5><strong>Total: </strong></h5>
                  </td>
                  <td>
                  </td>
                  <td>
                    <h5><strong>Ksh. {{$totalAdminCoinAmount}} </strong></h5>
                  </td>
                  <td>
                  </td>
                  <td></td>
                  <td></td>
                </tr>
              @endif
              </tbody>
            </table>
        </div>
        <div class="tab-pane" id="requested">
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
                Amount
              </th>
              <th>
                Requested date
              </th>
              <th class="text-primary">
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
                    {{$requestedInvoice['id']}}
                </td>
                  <td>
                      Ksh. {{$requestedInvoice['amount']}}
                  </td>
                  <td>
                      {{$requestedInvoice['created_at']}}
                  </td>
                  <td class="text-primary">
                    @auth('writer')<i><a href="{{route('writer.invoice.requested.show', $requestedInvoice)}}">click to view orders  in this<br /> invoice</a></i>@endauth
                    @auth('editor')<i><a href="{{route('editor.invoice.requested.show', $requestedInvoice)}}">click to view orders  in this<br /> invoice</a></i>@endauth
                    @auth('admin')
                      @if(isset($expenses))
                        <i><a href="{{route('admin.expensesinvoice.requested.show', $requestedInvoice)}}">click to view orders  in this<br /> invoice</a></i>
                      @else
                        <i><a href="{{route('admin.myinvoice.requested.show', $requestedInvoice)}}">click to view orders  in this<br /> invoice</a></i>
                      @endif
                    @endauth
                  </td>
                </tr>
              @endforeach  
              <tr>
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

          <div class="tab-pane" id="paid">
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
                  Amount
                </th>
                <th>
                  Paid date
                </th>
                <th class="text-primary">
                  Action
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
                      {{$paidInvoice['id']}}
                  </td>
                    <td>
                        Ksh. {{$paidInvoice['amount']}}
                    </td>
                    <td>
                        {{$paidInvoice['updated_at']}}
                    </td>
                    <td class="text-primary">
                      @auth('writer')<i><a href="{{route('writer.invoice.paid.show', $paidInvoice)}}">click to view orders in this<br /> invoice</a></i>@endauth
                      @auth('editor')<i><a href="{{route('editor.invoice.paid.show', $paidInvoice)}}">click to view orders in this<br /> invoice</a></i>@endauth
                      @auth('admin')
                      @if(isset($expenses))
                        <i><a href="{{route('admin.expensesinvoice.paid.show', $paidInvoice)}}">click to view orders  in this<br /> invoice</a></i>
                      @else
                        <i><a href="{{route('admin.myinvoice.paid.show', $paidInvoice)}}">click to view orders  in this<br /> invoice</a></i>
                      @endif
                    @endauth
                    </td>
                  </tr>
                @endforeach
                <tr>
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
          <div class="tab-pane" id="paymentdetails">
            <div class="col-md-12">
              <div class="card-body ">

                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Account type:') }}</label>
                  <div class="col-sm-7">
                    <strong>{{auth()->user()->accountType}}</strong>
                    <span class="pull-right">
                      @auth('admin')
                      <h5><a href="{{route('admin.profile.editpayment')}}">Edit</a></h5>
                      @endauth
                      @auth('writer')
                      <h5><a href="{{route('writer.profile.editpayment')}}">Edit</a></h5>
                      @endauth
                      @auth('editor')
                      <h5><a href="{{route('editor.profile.editpayment')}}">Edit</a></h5>
                      @endauth
                    </span>
                  </div>
                </div>

                @if (auth()->user()->accountType=='bank')
                  <div class="row">
                    <label class="col-sm-2 col-form-label">{{ __('Bank name:') }}</label>
                    <div class="col-sm-7">
                      <strong>{{auth()->user()->bankName}}</strong>
                    </div>
                  </div>
                @endif

                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Account name:') }}</label>
                  <div class="col-sm-7">
                    <strong>{{auth()->user()->accountName}}</strong>
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Account number:') }}</label>
                  <div class="col-sm-7">
                    <strong>{{auth()->user()->accountNumber}}</strong>
                  </div>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>