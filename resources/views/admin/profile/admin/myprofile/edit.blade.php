@auth('admin')

@extends('admin.layouts.app', ['activePage' => 'My-profile', 'titlePage' => __('Admin Profile')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card ">
            <div class="card-header card-header-primary">
              <h4 class="card-title">{{ __('Edit Profile') }}</h4>
              <p class="card-category">{{ __('Admin information') }}</p>
            </div>

            @include('forms/profiles/individual/profileedit')

          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@endauth