@auth('admin')

@extends('admin.layouts.app', ['activePage' => 'Client-management', 'titlePage' => __('Client Management')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card ">
          <div class="card-header card-header-primary">
          <h4 class="card-title">{{ __('Edit profile for writer:')}} {{$profile->id}}</h4>
            <p class="card-category">{{ __('Writer information') }}</p>
          </div>
          <div class="modal-body -mb-6">
            <div class="row">
              <div class="col-md-12 text-right">
                  <a href="{{ route('admin.client.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
              </div>
            </div>

          @include('forms/profiles/adminmanaged/adminmanagededit')

        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@endauth