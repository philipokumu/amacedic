@auth('admin')

@extends('admin.layouts.app', ['activePage' => 'admin-management', 'titlePage' => __('Admin Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('admin.admin.store') }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('post')

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Add admin') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('admin.admin.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                  </div>
                </div>
                
                @include('forms/profiles/adminmanaged/adminmanagedcreate')

              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-primary" onclick="confirm('{{ __("Add new admin?!") }}') ? this.parentElement.submit() : ''">{{ __('Add admin') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@endauth