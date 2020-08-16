@auth('admin')

@extends('admin.layouts.app', ['activePage' => 'Writer-profile', 'titlePage' => __('Writer Profile')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card ">
            <div class="card-header card-header-primary">
            <h4 class="card-title">{{ __('Profile for writer:' ) }} {{$profile->id}}</h4>
              <p class="card-category">{{ __('Writer information') }}</p>
            </div>
            <div class="modal-body -mb-6">
              <div class="row">
                <div class="col-md-12 text-right">
                    <a href="{{ route('admin.writer.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                </div>
              </div>

              @include('forms/profiles/adminmanaged/adminmanagedshow')

          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@endauth