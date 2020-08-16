@auth('admin')

@extends('admin.layouts.app', ['activePage' => 'Client-management', 'titlePage' => __('Client Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title ">{{ __('clients') }}</h4>
                <p class="card-category"> {{ __('Here you can manage clients') }}</p>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-12 text-right">
                    <a href="{{ route('admin.client.create') }}" class="btn btn-sm btn-primary">{{ __('Add client') }}</a>
                  </div>
                </div>

                @include('forms/profiles/adminmanaged/adminmanagedindex')
                

              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@endauth