@auth('admin')

@extends('admin.layouts.app', ['activePage' => 'Admin-management', 'titlePage' => __('Admin Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title ">{{ __('admins') }}</h4>
                <p class="card-category"> {{ __('Here you can manage admins') }}</p>
              </div>
              <div class="card-body">
                @can('create', App\Admin::class)
                  <div class="row">
                    <div class="col-12 text-right">
                      <a href="{{ route('admin.admin.create') }}" class="btn btn-sm btn-primary">{{ __('Add admin') }}</a>
                    </div>
                  </div>
                @endcan

              @include('forms/profiles/adminmanaged/adminmanagedindex')

            </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@endauth