<div class="wrapper ">
  @include('writer.layouts.navbars.sidebar')
  <div class="main-panel">
    @include('writer.layouts.navbars.navs.auth')
    @yield('content')
    @include('writer.layouts.footers.auth')
  </div>
</div>