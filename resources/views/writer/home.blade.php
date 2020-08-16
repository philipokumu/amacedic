@auth('writer')

@extends('writer.layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
              <div class="card-icon">
                <i class="material-icons">star</i>
              </div>
              <p class="card-category">Total orders</p>
              <h3 class="card-title">{{$totalOrders}}
              </h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">access_time</i>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
              <div class="card-icon">
                <i class="material-icons">store</i>
              </div>
              <p class="card-category">Ongoing orders</p>
              <h3 class="card-title">{{$ongoingOrdersCount}}</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">access_time</i>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
              <div class="card-icon">
                <i class="material-icons">verified</i>
              </div>
              <p class="card-category">Approved orders</p>
            <h3 class="card-title">{{$approvedOrdersCount}}</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">access_time</i>
                <a href="{{route('writer.approved.index')}}">View order(s)</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
              <div class="card-icon">
                <i class="material-icons">cancel</i>
              </div>
              <p class="card-category">Cancelled orders</p>
              <h3 class="card-title">{{$cancelledOrders}}</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">access_time</i>
                <a href="{{route('writer.cancelled.index')}}">View order(s)</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">

        <div class="col-md-4">
            <div class="card card-stats">
              <div class="card-header card-header-warning card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">message</i>
                </div>
                <p class="card-category">Unread messages</p>
                <h3 class="card-title">{{$messagesCount}}</h3>
              </div>
              <div class="card-footer">
                <div class="stats">
                  <i class="material-icons">access_time</i>
                  <a href="{{route('writer.message.index')}}">View message(s)</a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card card-stats">
              <div class="card-header card-header-success card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">done</i>
                </div>
                <p class="card-category">Completed Orders</p>
                <p class="card-category">(Awaiting approval)</p>
                <h3 class="card-title">{{$completedOrders}}</h3>
              </div>
              <div class="card-footer">
                <div class="stats">
                  <i class="material-icons">access_time</i>
                  <a href="{{route('writer.completed.index')}}">View order(s)</a>
                </div>
              </div>
            </div>
          </div>

        <div class="col-md-4">
          <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
              <div class="card-icon">
                <i class="material-icons">attach_money</i>
              </div>
              <p class="card-category">Ongoing Balance</p>
              <h3 class="card-title">Ksh. {{$ongoingBalance}}</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">access_time</i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
            <div class="card card-stats">
              <div class="card-header card-header-success card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">attach_money</i>
                </div>
                <p class="card-category">Approved Balance</p>
                <h3 class="card-title">Ksh. {{$approvedBalance}}</h3>
              </div>
              <div class="card-footer">
                <div class="stats">
                  <i class="material-icons">access_time</i>
                  <a href="{{route('writer.invoice.index')}}">Go to invoice(s)</a>
                </div>
              </div>
            </div>
          </div>  
      </div>
    </div>
  </div>
@endsection

@endauth