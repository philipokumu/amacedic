<div class="wrapper ">
  @include('editor.layouts.navbars.sidebar')
  <div class="main-panel">
    @include('editor.layouts.navbars.navs.auth')
    @yield('content')
    @include('editor.layouts.footers.auth')
  </div>
</div>