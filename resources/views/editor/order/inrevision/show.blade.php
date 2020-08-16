@auth('editor')

@extends('editor.layouts.app', ['activePage' => 'In-revision', 'titlePage' => __('Inrevision order')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary row">
            <span class="col-6">
              <h4 class="card-title ">Order: {{$inrevisionOrder['id']}}</h4>
              <p class="card-category">Title: {{$inrevisionOrder['title']}}</p>
            </span>
            <span class="col-6">
              <a href="{{route('editor.inrevision.index')}}" class='btn btn-info pull-right'>Back to list</a>
            </span>
          </div>
          <table class="table -mb-2">
            <thead class=" text-primary">
              <tr>
                <th>
                    <span class="pull-right">
                      <form method="POST" action="{{route('editor.inrevision.update',$inrevisionOrder)}}" class="form-horizontal">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="completed" value="0" readonly>
                        <button type="button" class="btn btn-success" data-original-title="submit" title="submit" onclick="confirm('{{ __("Are you sure you have addressed all issues?!") }}') ? this.parentElement.submit() : ''">
                            Mark as completed
                            <div class="ripple-container"></div> 
                          </button>
                      </form>
                    </span>
                </th>
              </tr>
            </thead>
          </table>

          @include('forms/inrevision/inrevisionshow')
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@endauth