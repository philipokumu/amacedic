@auth('writer')

<div class="sidebar" data-color="orange" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-2.jpg">
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
        <a class="nav-link" href="{{ route('writer.home') }}">
          <i class="material-icons">dashboard</i>
            <p>{{ __('Dashboard') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'Available' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('writer.unassigned.index') }}">
          <i class="material-icons">assignment_turned_in</i>
          @if (auth()->user()->status == 'active')
            <p>{{ __('Available orders') }} ({{count(App\Order::where(['status'=>'unassigned'])->get())}})</p>
            @else
            <p>{{ __('Available orders') }} (0)</p>
          @endif
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'Bids' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('writer.bids.index') }}">
          <i class="material-icons">touch_app</i>
            <p>{{ __('Bids') }} ({{count(App\Bid::where(['writer_id'=>auth()->id()])->get())}})</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'Assigned' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('writer.assigned.index') }}">
          <i class="material-icons">assignment</i>
          <p>{{ __('Assigned') }} ({{count(App\Order::where(['writer_id'=>auth()->id(),'status'=>'assigned'])->get())}})</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'In-progress' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('writer.inprogress.index') }}">
          <i class="material-icons">play_circle_outline</i>
            <p>{{ __('Inprogress') }} ({{count(App\Order::where(['writer_id'=>auth()->id(),'status'=>'inprogress'])->get())}})</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'In-editing' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('writer.inediting.index') }}">
          <i class="material-icons">rate_review</i>
          <p>{{ __('Inediting') }} ({{count(App\Order::where('writer_id',auth()->id())->whereIn('status',['inediting','inediting-unpicked'])->get())}})</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'Completed' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('writer.completed.index') }}">
          <i class="material-icons">done</i>
          <p>{{ __('Completed') }} ({{count(App\Order::where(['writer_id'=>auth()->id(),'status'=>'completed'])->get())}})</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'In-revision' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('writer.inrevision.index') }}">
          <i class="material-icons">arrow_back</i>
          <p>{{ __('Inrevision') }} ({{count(App\Order::where(['writer_id'=>auth()->id(),'status'=>'inrevision'])->get())}})</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'Approved' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('writer.approved.index') }}">
          <i class="material-icons">done_all</i>
          <p>{{ __('Approved') }} ({{count(App\Order::where(['writer_id'=>auth()->id(),'status'=>'approved'])->get())}})</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'Cancelled' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('writer.cancelled.index') }}">
          <i class="material-icons">cancel</i>
          <p>{{ __('Cancelled') }} ({{count(App\Order::where(['writer_id'=>auth()->id(),'status'=>'cancelled'])->get())}})</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'Messages' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('writer.message.index') }}">
          <i class="material-icons">message</i>
          <p class="sidebar-normal">{{ __('Messages') }} </p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'News' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('writer.news.index') }}">
          <i class="material-icons">article</i>
          <p>{{ __('News') }} ({{App\News::where(['recipient'=>'writers'])->orwhere('recipient','all')->count()}})</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'Editor-notes' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('writer.notes.index') }}">
          <i class="material-icons">notes</i>
          <p>{{ __('Editor notes') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'Invoice' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('writer.invoice.index') }}">
          <i class="material-icons">attach_money</i>
          <p class="sidebar-normal">{{ __('Invoices') }} </p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'My-profile' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('writer.profile.edit') }}">
          <i class="material-icons">person</i>
          <p class="sidebar-normal">{{ __('My profile') }} </p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'Customer-reviews' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('writer.customerreviews.index') }}">
          <i class="material-icons">star_rate</i>
            <p>{{ __('My ratings') }}</p>
        </a>
      </li>

    </ul>
  </div>
</div>

@endauth