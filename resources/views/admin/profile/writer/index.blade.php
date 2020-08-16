@auth('admin')

@extends('admin.layouts.app', ['activePage' => 'Writer-management', 'titlePage' => __('Writer Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title ">{{ __('Writers') }}</h4>
                <p class="card-category"> {{ __('Here you can manage writers') }}</p>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-12 text-right">
                    <a href="{{ route('admin.writer.create') }}" class="btn btn-sm btn-primary">{{ __('Add writer') }}</a>
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