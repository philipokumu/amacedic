@auth('editor')

<div class="sidebar" data-color="orange" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-4.jpg">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a href="#" class="simple-text logo-normal">
      {{ __('A-Quality Papers') }}
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('editor.home') }}">
          <i class="material-icons">dashboard</i>
            <p>{{ __('Dashboard') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'Available' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('editor.inediting-unpicked.index') }}">
          <i class="material-icons">assignment_turned_in</i>
          @if (auth()->user()->status=='active')
            <p>{{ __('Available orders') }} ({{App\Order::where(['status'=>'inediting-unpicked'])->count()}})</p>
          @else
            <p>{{ __('Available orders') }} (0)</p>
          @endif
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'In-editing' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('editor.inediting.index') }}">
          <i class="material-icons">rate_review</i>
          <p>{{ __('Inediting') }} ({{App\Order::where(['editor_id'=>auth()->id(),'status'=>'inediting'])->count()}})</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'Completed' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('editor.completed.index') }}">
          <i class="material-icons">done</i>
          <p>{{ __('Completed') }} ({{App\Order::where(['editor_id'=>auth()->id(),'status'=>'completed'])->count()}})</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'In-revision' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('editor.inrevision.index') }}">
          <i class="material-icons">arrow_back</i>
          <p>{{ __('Inrevision') }} ({{App\Order::where(['editor_id'=>auth()->id(),'status'=>'inrevision'])->count()}})</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'Approved' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('editor.approved.index') }}">
          <i class="material-icons">done_all</i>
          <p>{{ __('Approved') }} ({{App\Order::where(['editor_id'=>auth()->id(),'status'=>'approved'])->count()}})</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'Cancelled' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('editor.cancelled.index') }}">
          <i class="material-icons">cancel</i>
          <p>{{ __('Cancelled') }} ({{App\Order::where(['editor_id'=>auth()->id(),'status'=>'cancelled'])->count()}})</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'Messages' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('editor.message.index') }}">
          <i class="material-icons">message</i>
          <p class="sidebar-normal">{{ __('Messages') }} </p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'News' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('editor.news.index') }}">
          <i class="material-icons">article</i>
          <p>{{ __('News') }} ({{App\News::where(['recipient'=>'editors'])->orwhere('recipient','all')->count()}})</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'Editor-notes' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('editor.notes.index') }}">
          <i class="material-icons">notes</i>
          <p>{{ __('Editor notes') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'Invoice' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('editor.invoice.index') }}">
          <i class="material-icons">attach_money</i>
          <p class="sidebar-normal">{{ __('Invoices') }} </p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'My-profile' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('editor.profile.edit') }}">
          <i class="material-icons">person</i>
          <p class="sidebar-normal">{{ __('My profile') }} </p>
        </a>
      </li>

    </ul>
  </div>
</div>

@endauth