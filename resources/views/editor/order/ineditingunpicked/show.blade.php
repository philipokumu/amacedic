@auth('editor')

@extends('editor.layouts.app', ['activePage' => 'Available', 'titlePage' => __('Available order for editing')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary row">
            <span class="col-6">
              <h4 class="card-title ">Order: {{$ineditingUnpickedOrder['id']}}</h4>
              <p class="card-category">Title: {{$ineditingUnpickedOrder['title']}}</p>
            </span>
            <span class="col-6">
              <a href="{{route('editor.inediting-unpicked.index')}}" class='btn btn-info pull-right'>Back to list</a>
            </span>
          </div>
          <table class="table -mb-2">
            <thead class=" text-primary">
              <tr>
                <th>
                  <span class="pull-right">
                    <form method="POST" action="{{route('editor.inediting-unpicked.update',$ineditingUnpickedOrder)}}" class="form-horizontal">
                      @csrf
                      @method('PATCH')
                      <button type="button" class="btn btn-success" data-original-title="submit" title="submit" onclick="confirm('{{ __("Are you sure? once you pick, you cannot return!") }}') ? this.parentElement.submit() : ''">
                        Pick
                        <div class="ripple-container"></div> 
                      </button>
                    </form>
                  </span>
                </th>
              </tr>
            </thead>
          </table>

          @include('forms/ineditingunpicked/ineditingunpickedshow')
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@endauth