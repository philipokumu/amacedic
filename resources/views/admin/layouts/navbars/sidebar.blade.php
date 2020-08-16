@auth('admin')

<div class="sidebar" data-color="orange" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-3.jpg">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a href="#" class="simple-text logo-normal">
      {{ __('Top Notch Homeworks') }}
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('admin.home') }}">
          <i class="material-icons">dashboard</i>
            <p>{{ __('Dashboard') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'New-Order' ? ' active' : '' }} -mb-6">
        <a class="nav-link" href="{{ route('admin.unassigned.create') }}">
          <i class="material-icons">fiber_new</i>
          <h6><strong><p>{{ __('Make new order') }} </p></strong></h6>
        </a>
      </li>
      <hr>
      <li class="nav-item{{ $activePage == 'Urgent-orders' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('admin.urgent.index') }}">
          <i class="material-icons">timelapse</i>
            <p>{{ __('Urgent orders') }} ({{App\Order::where('isUrgent','yes')->count()}})</p></p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'Search' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('admin.search.index') }}">
          <i class="material-icons">search</i>
          <p>{{ __('Search order') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'Available' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('admin.unassigned.index') }}">
          <i class="material-icons">assignment_turned_in</i>
            <p>{{ __('Available orders') }} ({{App\Order::where('status','unassigned')->count()}})</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'Assigned' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('admin.assigned.index') }}">
          <i class="material-icons">assignment</i>
          <p>{{ __('Assigned') }} ({{App\Order::where('status','assigned')->count()}})</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'In-progress' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('admin.inprogress.index') }}">
          <i class="material-icons">play_circle_outline</i>
            <p>{{ __('Inprogress') }} ({{App\Order::where(['status'=>'inprogress'])->count()}})</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'In-editing Unpicked' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('admin.inediting-unpicked.index') }}">
          <i class="material-icons">rate_review</i>
          <p>{{ __('Inediting Unpicked') }} ({{App\Order::where(['status'=>'inediting-unpicked'])->count()}})</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'In-editing' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('admin.inediting.index') }}">
          <i class="material-icons">rate_review</i>
          <p>{{ __('Inediting') }} ({{App\Order::where(['status'=>'inediting'])->count()}})</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'Completed' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('admin.completed.index') }}">
          <i class="material-icons">done</i>
          <p>{{ __('Completed') }} ({{App\Order::where(['status'=>'completed'])->count()}})</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'In-revision' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('admin.inrevision.index') }}">
          <i class="material-icons">arrow_back</i>
          <p>{{ __('Inrevision') }} ({{App\Order::where(['status'=>'inrevision'])->count()}})</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'Approved' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('admin.approved.index') }}">
          <i class="material-icons">done_all</i>
          <p>{{ __('Approved') }} ({{App\Order::where(['status'=>'approved'])->count()}})</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'Cancelled' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('admin.cancelled.index') }}">
          <i class="material-icons">cancel</i>
          <p>{{ __('Cancelled') }} ({{App\Order::where(['status'=>'cancelled'])->count()}})</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'Unpaid' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('admin.unpaid.index') }}">
          <i class="material-icons">snooze</i>
          <p>{{ __('Unpaid') }} ({{App\Order::where(['status'=>'unpaid'])->count()}})</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'Messages' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('admin.message.index') }}">
          <i class="material-icons">message</i>
          <p>{{ __('Messages') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'Editor-notes' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('admin.notes.index') }}">
          <i class="material-icons">notes</i>
          <p>{{ __('Editor notes') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'Files' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('admin.fileupload.index') }}">
          <i class="material-icons">attach_file</i>
            <p>{{ __('All files') }} </p>
        </a>
      </li>
      <li class="nav-item {{ ($activePage == 'News-list' || $activePage == 'Create-news') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#news" aria-expanded="false">
          <i class="material-icons">new_releases</i>
          <p>{{ __('News') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse" id="news">
          <ul class="nav">
            <li class="nav-item{{$activePage == 'News-list' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('admin.news.index') }}">
                <span class="sidebar-mini"> NL </span>
                <span class="sidebar-normal">{{ __('News list') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'Create-news' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('admin.news.create') }}">
                <span class="sidebar-mini"> CN </span>
                <span class="sidebar-normal">{{ __('Create news') }} </span>
              </a>
            </li>
            
          </ul>
        </div>

      <li class="nav-item {{ ($activePage == 'Create-coupon' || $activePage == 'View-coupons') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#coupons" aria-expanded="false">
          <i class="material-icons">card_giftcard</i>
          <p>{{ __('Coupons') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse" id="coupons">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'Create-coupon' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('admin.coupon.create') }}">
                <span class="sidebar-mini"> CC </span>
                <span class="sidebar-normal">{{ __('Create coupons') }} </span>
              </a>
            </li>
            <li class="nav-item{{$activePage == 'Coupon-list' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('admin.coupon.index') }}">
                <span class="sidebar-mini"> CL </span>
                <span class="sidebar-normal">{{ __('Coupon list') }} </span>
              </a>
            </li>
          </ul>
        </div>
      
        <li class="nav-item {{ ($activePage == 'Unrefunded' || $activePage == 'Refunded') ? ' active' : '' }}">
          <a class="nav-link" data-toggle="collapse" href="#refunds" aria-expanded="false">
            <i class="material-icons">money_off</i>
            <p>{{ __('Refunds') }}
              <b class="caret"></b>
            </p>
          </a>
          <div class="collapse" id="refunds">
            <ul class="nav">
              <li class="nav-item{{ $activePage == 'Unrefunded' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('admin.unrefunded.index') }}">
                  <span class="sidebar-mini"> U </span>
                  <span class="sidebar-normal">{{ __('Unrefunded') }} </span>
                </a>
              </li>
              <li class="nav-item{{$activePage == 'Refunded' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('admin.refunded.index') }}">
                  <span class="sidebar-mini"> R </span>
                  <span class="sidebar-normal">{{ __('Refunded') }} </span>
                </a>
              </li>
            </ul>
          </div>
      
      <li class="nav-item {{ ($activePage == 'Requested-invoices' || $activePage == 'Paid-invoices' || $activePage == 'User-invoices' || $activePage == 'My-invoices') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#Invoices" aria-expanded="false">
          <i class="material-icons">attach_money</i>
          <p>{{ __('Invoices') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse" id="Invoices">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'Finances' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('admin.finances.index') }}">
                <span class="sidebar-mini"> RI </span>
                <span class="sidebar-normal">{{ __('All finances') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'Requested-invoices' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('admin.allrequestedinvoices.index') }}">
                <span class="sidebar-mini"> RI </span>
                <span class="sidebar-normal">{{ __('Requested invoices') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'Paid-invoices' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('admin.allpaidinvoices.index') }}">
                <span class="sidebar-mini"> PI </span>
                <span class="sidebar-normal">{{ __('Paid invoices') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'Expenses-invoices' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('admin.expensesinvoice.index') }}">
                <span class="sidebar-mini"> EI </span>
                <span class="sidebar-normal"> {{ __('Expenses invoices') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'My-invoices' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('admin.myinvoice.index') }}">
                <span class="sidebar-mini"> MI </span>
                <span class="sidebar-normal"> {{ __('My invoices') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'Search-invoices' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('admin.searchinvoices.index') }}">
                <span class="sidebar-mini"> UI </span>
                <span class="sidebar-normal"> {{ __('Search invoices') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>

      <li class="nav-item {{ ($activePage == 'My-profile' || $activePage == 'Writer-management' || $activePage == 'Editor-management' || $activePage == 'Admin-management'|| $activePage == 'User-management') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#usermanagement" aria-expanded="false">
          <i class="material-icons">person</i>
          <p>{{ __('User management') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse" id="usermanagement">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'My-profile' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('admin.profile.edit') }}">
                <span class="sidebar-mini"> MP </span>
                <span class="sidebar-normal">{{ __('My profile') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'Writer-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('admin.writer.index') }}">
                <span class="sidebar-mini"> W </span>
                <span class="sidebar-normal">{{ __('Writers') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'Editor-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('admin.editor.index') }}">
                <span class="sidebar-mini"> E </span>
                <span class="sidebar-normal">{{ __('Editors') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'Client-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('admin.client.index') }}">
                <span class="sidebar-mini"> C </span>
                <span class="sidebar-normal">{{ __('Clients') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'Admin-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('admin.admin.index') }}">
                <span class="sidebar-mini"> A </span>
                <span class="sidebar-normal">{{ __('Admins') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
    </ul>
  </div>
</div>

@endauth