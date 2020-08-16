@auth('admin')

@extends('admin.layouts.app', ['activePage' => 'Editor-management', 'titlePage' => __('Editor Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title ">{{ __('Editors') }}</h4>
                <p class="card-category"> {{ __('Here you can manage editors') }}</p>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-12 text-right">
                    <a href="{{ route('admin.editor.create') }}" class="btn btn-sm btn-primary">{{ __('Add editor') }}</a>
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