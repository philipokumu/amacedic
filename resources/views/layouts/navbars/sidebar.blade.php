@auth('web')

<div class="sidebar" data-color="orange" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
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
        <a class="nav-link" href="{{ route('home') }}">
          <i class="material-icons">dashboard</i>
            <p>{{ __('Dashboard') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'New-Order' ? ' active' : '' }} -mb-6">
        <a class="nav-link" href="{{ route('order.create') }}">
          <i class="material-icons">fiber_new</i>
            <h6><strong><p>{{ __('Make new order') }} </p></strong></h6>
        </a>
      </li>
      <hr>
      <li class="nav-item{{ $activePage == 'Available' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('user.unassigned.index') }}">
          <i class="material-icons">assignment_turned_in</i>
          <p>{{ __('New orders') }} ({{count(App\Order::where(['user_id'=>auth()->id(),'status'=>'unassigned'])->get())}})</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'Assigned' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('user.assigned.index') }}">
          <i class="material-icons">assignment</i>
          <p>{{ __('Assigned') }} ({{count(App\Order::where(['user_id'=>auth()->id(),'status'=>'assigned'])->get())}})</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'In-progress' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('user.inprogress.index') }}">
          <i class="material-icons">play_circle_outline</i>
            <p>{{ __('Inprogress') }} ({{count(App\Order::where(['user_id'=>auth()->id(),'status'=>'inprogress'])->get())}})</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'In-editing' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('user.inediting.index') }}">
          <i class="material-icons">rate_review</i>
          <p>{{ __('Inediting') }} ({{count(App\Order::where('user_id',auth()->id())->whereIn('status',['inediting','inediting-unpicked'])->get())}})</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'Completed' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('user.completed.index') }}">
          <i class="material-icons">done</i>
          <p>{{ __('Completed') }} ({{count(App\Order::where(['user_id'=>auth()->id(),'status'=>'completed'])->get())}})</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'In-revision' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('user.inrevision.index') }}">
          <i class="material-icons">arrow_back</i>
          <p>{{ __('Inrevision') }} ({{count(App\Order::where(['user_id'=>auth()->id(),'status'=>'inrevision'])->get())}})</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'Approved' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('user.approved.index') }}">
          <i class="material-icons">done_all</i>
          <p>{{ __('Approved') }} ({{count(App\Order::where(['user_id'=>auth()->id(),'status'=>'approved'])->get())}})</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'Cancelled' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('user.cancelled.index') }}">
          <i class="material-icons">cancel</i>
          <p>{{ __('Cancelled') }} ({{count(App\Order::where(['user_id'=>auth()->id(),'status'=>'cancelled'])->get())}})</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'Unpaid' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('user.unpaid.index') }}">
          <i class="material-icons">snooze</i>
          <p>{{ __('Unpaid') }} ({{count(App\Order::where(['user_id'=>auth()->id(),'status'=>'unpaid'])->get())}})</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'Messages' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('user.message.index') }}">
          <i class="material-icons">message</i>
          <p>{{ __('Messages') }} </p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'News' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('user.news.index') }}">
          <i class="material-icons">article</i>
          <p>{{ __('News') }} ({{App\News::where(['recipient'=>'clients'])->orwhere('recipient','all')->count()}})</p>
        </a>
      </li>

      <li class="nav-item{{$activePage == 'My-coupons' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('user.coupon.index') }}">
          <i class="material-icons">card_giftcard</i>
          <p>{{ __('My coupons') }} </p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'Profile' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('user.profile.edit') }}">
          <i class="material-icons">person</i>
          <span class="sidebar-normal">{{ __('User profile') }} </span>
        </a>
      </li>
    </ul>
  </div>
</div>

@endauth