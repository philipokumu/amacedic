@auth('editor')

@extends('editor.layouts.app', ['activePage' => 'Messages', 'titlePage' => __('Messages')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary row">
            <span class="col-sm-12">
              <h4 class="card-title ">All order messages</h4>
              <p class="card-category">Click to view the message</p>
            </span>
          </div>
          
          @include('forms/messages/messagesshow')

        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@endauth