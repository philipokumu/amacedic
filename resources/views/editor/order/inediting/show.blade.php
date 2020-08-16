@auth('editor')

@extends('editor.layouts.app', ['activePage' => 'In-editing', 'titlePage' => __('Inediting order')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary row">
            <span class="col-6">
              <h4 class="card-title ">Order: {{$ineditingOrder['id']}}</h4>
              <p class="card-category">Title: {{$ineditingOrder['title']}}</p>
            </span>
            <span class="col-6">
              <a href="{{route('editor.inediting.index')}}" class='btn btn-info pull-right'>Back to list</a>
            </span>
          </div>
          <table class="table -mb-2">
            <thead class=" text-primary">
              <tr>
                <th>
                    <span class="pull-right">
                        <form method="POST" action="{{route('editor.inediting.update',$ineditingOrder)}}" class="form-horizontal">
                          @csrf
                          @method('PATCH')
                          <input type="hidden" name="completed" value="1" readonly>
                          <button type="button" class="btn btn-success"  data-toggle="modal" data-target="#completedModal" data-original-title="submit" title="submit">
                              Mark as completed
                              <div class="ripple-container"></div> 
                            </button>
                            <div>
                              @if ($errors->has('noteToWriter'))
                                <span id="noteToWriter-error" class="error text-danger" for="input-noteToWriter">{{ $errors->first('noteToWriter') }}</span>
                              @endif
                              @if ($errors->has('rating'))
                                <span id="rating-error" class="error text-danger" for="input-rating">{{ $errors->first('rating') }}</span>
                              @endif
                            </div>
                        </form>
                    </span>
                    <span class="pull-right">
                      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#revisionModal" data-original-title="submit" title="submit">
                          Return for revision
                          <div class="ripple-container"></div> 
                      </button>
                      <div>
                        @if ($errors->has('revisionInstructions'))
                          <span id="revisionInstructions-error" class="error text-danger" for="input-revisionInstructions">{{ $errors->first('revisionInstructions') }}</span>
                        @endif
                      </div>
                    </span>
                    <!-- Revision modal start-->
                    <div class="modal fade" id="revisionModal" tabindex="-1" role="dialog" aria-labelledby="revisionModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="revisionModalLabel">Revision Instructions</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form method="POST" action="{{route('editor.inediting.update',$ineditingOrder)}}" class="form-horizontal">
                              @csrf
                              @method('PATCH')
                              <input type="hidden" name="revision" value="1" readonly>
                              <div class="form-group{{ $errors->has('revisionInstructions') ? ' has-danger' : '' }}">
                                <textarea class="form-control{{ $errors->has('revisionInstructions') ? ' is-invalid' : '' }}" rows="3" name="revisionInstructions" id="input-revisionInstructions" type="text" placeholder="{{ __(' Type your revision instructions here...') }}" value="{{ old('revisionInstructions')}}" required="true" aria-required="true"  style="background-color: #fff;"></textarea>
                                @if ($errors->has('revisionInstructions'))
                                  <span id="revisionInstructions-error" class="error text-danger" for="input-revisionInstructions">{{ $errors->first('revisionInstructions') }}</span>
                                @endif
                              </div>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-success" data-original-title="submit" title="submit" onclick="confirm('{{ __("Do you need a rectification?") }}') ? this.parentElement.submit() : ''">
                                  Return for revision
                                </button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- Revision modal end-->
                    <!-- completed modal start-->
                    <div class="modal fade" id="completedModal" tabindex="-1" role="dialog" aria-labelledby="completedModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="completedModalLabel">Notes to writer (if any) before submitting</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form method="POST" action="{{route('editor.inediting.update',$ineditingOrder)}}" class="form-horizontal">
                              @csrf
                              @method('PATCH')
                              <input type="hidden" name="completed" value="1" readonly>
                              <input id="input-1" required="true" name="rating" class="rating rating-loading" data-min="0" data-max="5" data-step="0.5" data-size="xs" autocomplete="off">
                              @if ($errors->has('rating'))
                                <span id="rating-error" class="error text-danger" for="input-rating">{{ $errors->first('rating') }}</span>
                              @endif
                              <div class="form-group{{ $errors->has('noteToWriter') ? ' has-danger' : '' }}">
                                <textarea class="form-control{{ $errors->has('noteToWriter') ? ' is-invalid' : '' }}" rows="3" name="noteToWriter" id="input-noteToWriter" type="text" placeholder="{{ __(' Your notes to writer (optional)...') }}" value="{{ old('noteToWriter')}}" required="true" aria-required="true"  style="background-color: #fff;"></textarea>
                                @if ($errors->has('noteToWriter'))
                                  <span id="noteToWriter-error" class="error text-danger" for="input-noteToWriter">{{ $errors->first('noteToWriter') }}</span>
                                @endif
                              </div>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-success" data-original-title="submit" title="submit" onclick="confirm('{{ __("Are you sure you have addressed all issues?!") }}') ? this.parentElement.submit() : ''">
                                  Mark as completed
                                </button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- completed modal end-->

                </th>
              </tr>
            </thead>
          </table>

          @include('forms/inediting/ineditingshow')
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@endauth