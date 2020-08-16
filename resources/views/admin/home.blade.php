@auth('admin')

@extends('admin.layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Admin Dashboard')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
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
                  <a href="{{route('admin.message.index')}}">View message(s)</a>
                </div>
              </div>
            </div>
          </div>

        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
              <div class="card-icon">
                <i class="material-icons">star</i>
              </div>
              <p class="card-category">Unassigned orders</p>
              <h3 class="card-title">{{$unassignedOrders}}
              </h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">access_time</i>
                <a href="{{route('admin.unassigned.index')}}">View order(s)</a>
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
                <a href="{{route('admin.approved.index')}}">View order(s)</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
              <div class="card-icon">
                <i class="material-icons">access_time</i>
              </div>
              <p class="card-category">Cancelled orders</p>
              <h3 class="card-title">{{$cancelledOrders}}</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">update</i>
                <a href="{{route('admin.cancelled.index')}}">View order(s)</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">

        <div class="col-sm-4">
            <div class="card card-stats">
              <div class="card-header card-header-warning card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">store</i>
                </div>
                <p class="card-category">Completed orders</p>
                <p class="card-category">(Awaiting approval)</p>
                <h3 class="card-title">{{$completedOrders}}</h3>
              </div>
              <div class="card-footer">
                <div class="stats">
                  <i class="material-icons">access_time</i>
                  <a href="{{route('admin.completed.index')}}">View order(s)</a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card card-stats">
              <div class="card-header card-header-success card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">attach_money</i>
                </div>
                <p class="card-category">My approved balance</p>
                <h3 class="card-title">Ksh. {{$myApprovedBalance}}</h3>
              </div>
              <div class="card-footer">
                <div class="stats">
                  <i class="material-icons">access_time</i>
                  <a href="{{route('admin.completed.index')}}">Go to invoice(s)</a>
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
              <p class="card-category">All ongoing amount</p>
              <h3 class="card-title">Ksh. {{$allOngoingAmount}}</h3>
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
              <p class="card-category">All approved amount</p>
              <h3 class="card-title">Ksh. {{$allApprovedAmount}}</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">access_time</i>
                <a href="{{route('admin.allrequestedinvoices.index')}}">Go to requested invoice(s)</a>
              </div>
            </div>
          </div>
        </div>  
      </div>
    </div>
  </div>
@endsection

@endauth