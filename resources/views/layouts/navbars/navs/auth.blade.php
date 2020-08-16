@auth('web')

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
  <div class="container-fluid">
    <div class="navbar-wrapper">
      <a class="navbar-brand" href="#">{{ $titlePage }}</a>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
    <span class="sr-only">Toggle navigation</span>
    <span class="navbar-toggler-icon icon-bar"></span>
    <span class="navbar-toggler-icon icon-bar"></span>
    <span class="navbar-toggler-icon icon-bar"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end">
      <div class="navbar-form">
        <div class="input-group no-border">
          <span class="pull-right">
            Welcome {{auth()->user()->name}}
          </span>
        </div>
      </div>
      <ul class="navbar-nav">
        <li>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('home') }}">
            <i class="material-icons">dashboard</i>
            <p class="d-lg-none d-md-block">
              {{ __('Stats') }}
            </p>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="material-icons">notifications</i>
            @if (count((App\Message::where('hasClientRead','no')->whereIn('order_id', App\Order::where('user_id',auth()->id())->get('id')))->get()) > 0)
              <span class="notification">{{count((App\Message::where('hasClientRead','no')->whereIn('order_id', App\Order::where('user_id',auth()->id())->get('id')))->get())}}</span>
            @endif
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
            @if (count((App\Message::where('hasClientRead','no')->whereIn('order_id', App\Order::where('user_id',auth()->id())->get('id')))->get()) > 0)
              <a class="dropdown-item" href="{{route('user.message.update')}}">
                You have {{count((App\Message::where('hasClientRead','no')->whereIn('order_id', App\Order::where('user_id',auth()->id())->get('id')))->get())}} unread message(s)
              </a>
            @else
              <a class="dropdown-item" href="{{route('user.message.index')}}">
                You have no unread messages
              </a>
            @endif
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link" href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="material-icons">person</i>
            <p class="d-lg-none d-md-block">
              {{ __('Account') }}
            </p>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
            <a class="dropdown-item" href="{{ route('user.profile.edit') }}">{{ __('Profile') }}</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Log out') }}</a>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>

@endauth
