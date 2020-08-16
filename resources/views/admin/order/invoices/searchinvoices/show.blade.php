@auth('admin')

@extends('admin.layouts.app', ['activePage' => 'Search-invoices', 'titlePage' => __('Invoicer invoice')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary row">
            <span class="col-6">
              <h4 class="card-title ">Invoices for {{$role}} {{$user}}</h4>
              <p class="card-category">Click to view related orders</p>
            </span>
            <span class="col-6">
              <a href="{{route('admin.searchinvoices.index')}}" class='btn btn-info pull-right'>Back to search</a>
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
                    invoice ID
                  </th>
                  <th>
                    Amount
                  </th>
                  <th>
                    Status
                  </th>
                  <th>
                    Date
                  </th>
                  <th>
                    Action
                  </th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($invoices as $invoice)
                    <tr>
                      <td>
                        {{$loop->iteration}}
                      </td>
                      <td>
                        {{$invoice->id}}
                    </td>
                      <td>
                        {{$invoice->amount}}
                    </td>
                    <td>
                      {{$invoice->status}}
                    </td>
                    <td>
                      @if($invoice->status=='requested') {{$invoice->created_at}}
                      @else {{$invoice->updated_at}}
                      @endif
                    </td>
                      <td>
                        <i><a href="{{route('admin.searchinvoicesorders.show', ['role'=>$invoice->invoicer, 'user'=>$invoice->invoicer_id, 'invoice'=>$invoice->id])}}">
                          click to view orders in this<br /> invoice</a></i>
                      </td>
                    </tr>
                  @endforeach  
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