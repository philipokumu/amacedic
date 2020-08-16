@auth('writer')

@extends('writer.layouts.app', ['activePage' => 'In-progress', 'titlePage' => __('Inprogress order')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary row">
            <span class="col-6">
              <h4 class="card-title ">Order: {{$inprogressOrder['id']}}</h4>
              <p class="card-category">Title: {{$inprogressOrder['title']}}</p>
            </span>
            <span class="col-6">
              <a href="{{route('writer.inprogress.index')}}" class='btn btn-info pull-right'>Back to list</a>
            </span>
          </div>
          <table class="table -mb-2">
            <thead class=" text-primary">
              <tr>
                <th>
                  <span class="pull-right">
                    <form method="POST" action="{{route('writer.inprogress.update',$inprogressOrder)}}" class="form-horizontal">
                      @csrf
                      @method('PATCH')
                      <button type="button" class="btn btn-success" data-original-title="submit" title="submit" onclick="confirm('{{ __("Are you sure you have addressed all issues?!") }}') ? this.parentElement.submit() : ''">
                          Submit to editor
                          <div class="ripple-container"></div> 
                      </button>
                    </form>
                  </span>
                  @if($writerExtensions->isNotEmpty())
                  <span class="pull-right">
                    <button type="submit" class="btn btn btn-warning" data-toggle="modal" data-target="#extendDeadlineModal" data-original-title="submit" title="submit">
                      Extend deadline
                    </button>
                    <p>
                      @if ($errors->has('extensionHours'))
                        <span id="extensionHours-error" class="error text-danger" for="input-extensionHours">{{ $errors->first('extensionHours') }}</span>
                      @endif
                    </p>
                  </span>
                  @endif
                </th>
              </tr>
            </thead>
          </table>
          @if($writerExtensions->isNotEmpty())
          <!-- Modal -->
          <div class="modal fade" id="extendDeadlineModal" tabindex="-1" role="dialog" aria-labelledby="extendDeadlineModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="revisionModalLabel">Extend Writer Deadline</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form method="POST" action="{{route('writer.adjust.update',$inprogressOrder)}}" class="form-horizontal">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                      <label class="col-sm-5 col-form-label">{{ __('Client deadline') }}</label>
                      <div class="col-sm-7">
                        <div class="form-group{{ $errors->has('extensionHours') ? ' has-danger' : '' }}">
                          <select class="form-control{{ $errors->has('extensionHours') ? ' is-invalid' : '' }}" name="extensionHours" id="extensionHours" type="extensionHours" value="{{ old('extensionHours') }}" required >
                            <option disabled aria-disabled="true" aria-selected="true" selected>- Select extension -</option>
                            @foreach ($writerExtensions as $extension)
                              <option value="{{$extension}}">Extend by {{$extension}} hours</option>
                            @endforeach 
                          </select> 
                          @if ($errors->has('extensionHours'))
                            <span id="extensionHours-error" class="error text-danger" for="input-extensionHours">{{ $errors->first('extensionHours') }}</span>
                          @endif
                        </div>
                      </div>
                    </div>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" data-original-title="submit" title="submit" onclick="confirm('{{ __("Adjust deadline?") }}') ? this.parentElement.submit() : ''">
                      Adjust
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          @endif

          @include('forms/inprogress/inprogressshow')
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@endauth