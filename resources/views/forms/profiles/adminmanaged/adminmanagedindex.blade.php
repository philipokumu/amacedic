<div class="table-responsive">
  <table class="table">
    <thead class=" text-primary">
      <th>
          {{ __('Name') }}
      </th>
      <th>
        {{ __('Email') }}
      </th>
      <th>
        {{ __('Status') }}
      </th>
      <th>
        {{ __('Creation date') }}
      </th>
      <th class="text-right">
        {{ __('Actions') }}
      </th>
    </thead>
    <tbody>
      @foreach($profiles as $profile)
        <tr>
          <td>
            {{ $profile->name }}
          </td>
          <td>
            {{ $profile->email }}
          </td>
          <td>
            {{ $profile->status }}
          </td>
          <td>
            {{ $profile->created_at->format('Y-m-d') }}
          </td>
          <td class="td-actions text-right">
            @if ($owner=='admin' && $profile->id != auth()->id())
                
            <form action="{{ route('admin.admin.destroy', $profile) }}" method="post">
                @csrf
                @method('delete')
            
                <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('admin.admin.edit', $profile) }}" data-original-title="" title="">
                  <i class="material-icons">edit</i>
                  <div class="ripple-container"></div>
                </a>
                <button type="button" class="btn btn-danger btn-link" data-original-title="" title="" onclick="confirm('{{ __("Are you sure you want to delete this admin?") }}') ? this.parentElement.submit() : ''">
                    <i class="material-icons">close</i>
                    <div class="ripple-container"></div>
                </button>
            </form>
            @elseif ($owner=='admin' && $profile->id == auth()->id())
              <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('admin.profile.edit') }}" data-original-title="" title="">
                <i class="material-icons">edit</i>
                <div class="ripple-container"></div>
              </a>
            @else 
            <form action="{{ route('admin'.'.'.$owner.'.'.'destroy', $profile) }}" method="post">
              @csrf
              @method('delete')
          
              <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('admin'.'.'.$owner.'.'.'edit', $profile) }}" data-original-title="" title="">
                <i class="material-icons">edit</i>
                <div class="ripple-container"></div>
              </a>
              <button type="button" class="btn btn-danger btn-link" data-original-title="" title="" onclick="confirm('{{ __("Are you sure you want to delete this account?") }}') ? this.parentElement.submit() : ''">
                  <i class="material-icons">close</i>
                  <div class="ripple-container"></div>
              </button>
            </form>
            @endif
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>