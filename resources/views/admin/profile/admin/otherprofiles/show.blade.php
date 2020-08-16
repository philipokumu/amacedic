@auth('admin')

@extends('admin.layouts.app', ['activePage' => 'Admin-profile', 'titlePage' => __('Admin Profile')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card ">
            <div class="card-header card-header-primary">
            <h4 class="card-title">{{ __('Profile for admin:' ) }} {{$profile->id}}</h4>
              <p class="card-category">{{ __('Admin information') }}</p>
            </div>
            <div class="modal-body -mb-6">
              <div class="row">
                <div class="col-md-12 text-right">
                    <a href="{{ route('admin.admin.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
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