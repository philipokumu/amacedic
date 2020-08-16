@auth('writer')

@extends('writer.layouts.app', ['activePage' => 'Editor-notes', 'titlePage' => __('Editor Notes')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary row">
            <span class="col-sm-12">
              <h4 class="card-title ">Notes from editors to you</h4>
              <p class="card-category">Click to see the notes</p>
            </span>
          </div>
          
          @include('forms/notestowriter/notestowritershow')

        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@endauth