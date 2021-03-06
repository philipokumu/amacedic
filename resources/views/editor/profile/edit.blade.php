@auth('editor')

@extends('editor.layouts.app', ['activePage' => 'My-profile', 'titlePage' => __('Editor Profile')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card ">
            <div class="card-header card-header-primary">
              <h4 class="card-title">{{ __('Edit Profile') }}</h4>
              <p class="card-category">{{ __('editor information') }}</p>
            </div>
            
            @include('forms/profiles/individual/profileedit')

          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@endauth