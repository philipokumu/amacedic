@extends('layouts.app', ['activePage' => 'Profile', 'titlePage' => __('My profile')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Edit my information') }}</h4>
                <p class="card-category"></p>
              </div>

              @include('forms/profiles/individual/profileedit')

            </div>
        </div>
      </div>
    </div>
  </div>
@endsection