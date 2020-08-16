@auth('web')

@extends('layouts.app', ['activePage' => 'Completed', 'titlePage' => __('Completed order')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary row">
            <span class="col-6">
              <h4 class="card-title ">Order: {{$completedOrder['id']}}</h4>
              <p class="card-category">Title: {{$completedOrder['title']}}</p>
            </span>
            <span class="col-6">
              <a href="{{route('user.completed.index')}}" class='btn btn-info pull-right'>Back to list</a>
            </span>
          </div>
          <table class="table -mb-2">
            <thead class=" text-primary">
              <tr>
                <th>
                    
                    {{-- Cancelled modal start  --}}

                    <span class="pull-right">
                      <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#cancelModal" data-original-title="submit" title="submit">
                          Cancel
                          <div class="ripple-container"></div> 
                      </button>
                      <div>
                        @if ($errors->has('clientCancelReason'))
                          <span id="clientCancelReason-error" class="error text-danger" for="input-clientCancelReason">{{ $errors->first('clientCancelReason') }}</span>
                        @endif
                      </div>
                    </span>
                    <!-- Modal -->
                    <div class="modal fade" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="cancelModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="cancelModalLabel">Your reason for cancelling</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form method="POST" action="{{route('user.completed.update',$completedOrder)}}" class="form-horizontal">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="cancel" value="0" readonly>
                                <div class="form-group{{ $errors->has('clientCancelReason') ? ' has-danger' : '' }}">
                                  <textarea class="form-control{{ $errors->has('clientCancelReason') ? ' is-invalid' : '' }}" rows="3" name="clientCancelReason" id="input-clientCancelReason" type="text" placeholder="{{ __(' Your detailed reason to help us serve you better') }}" value="{{ old('clientCancelReason')}}" required="true" aria-required="true" style="background-color: #fff;"></textarea>
                                  @if ($errors->has('clientCancelReason'))
                                    <span id="clientCancelReason-error" class="error text-danger" for="input-clientCancelReason">{{ $errors->first('clientCancelReason') }}</span>
                                  @endif
                                </div>
                              {{-- <div class="modal-footer"> --}}
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-danger" data-original-title="submit" title="submit" onclick="confirm('{{ __("Are you sure? you may incur some charges for cancelling these order!") }}') ? this.parentElement.submit() : ''">
                                    Submit
                                </button>
                              {{-- </div> --}}
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>

                    {{-- Revision modal start  --}}
                    
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
                      <!-- Modal -->
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
                              <form method="POST" action="{{route('user.completed.update',$completedOrder)}}" class="form-horizontal">
                                @csrf
                                @method('PATCH')

                                <input type="hidden" name="revision" value="1" readonly>
                                <div class="form-group{{ $errors->has('revisionInstructions') ? ' has-danger' : '' }}">
                                  <textarea class="form-control{{ $errors->has('revisionInstructions') ? ' is-invalid' : '' }}" rows="3" name="revisionInstructions" id="input-revisionInstructions" type="text" placeholder="{{ __(' Type your revision instructions here...') }}" value="{{ old('revisionInstructions')}}" required="true" aria-required="true"  style="background-color: #fff;"></textarea>
                                  @if ($errors->has('revisionInstructions'))
                                    <span id="revisionInstructions-error" class="error text-danger" for="input-revisionInstructions">{{ $errors->first('revisionInstructions') }}</span>
                                  @endif
                                </div>

                                @if ($needsTimer == 'yes')
                                  <div class="row">
                                    <label class="col-sm-5 col-form-label">{{ __('Revision duration') }}</label>
                                    <div class="col-sm-6">
                                      <div class="form-group{{ $errors->has('revisionDuration') ? ' has-danger' : '' }}">
                                        <select class="form-control{{ $errors->has('revisionDuration') ? ' is-invalid' : '' }}" name="revisionDuration" id="revisionDuration" type="revisionDuration" value="{{ old('revisionDuration') }}??0" required >
                                          <option selected disabled>-Select hours-</option>
                                          <option value="3">3 Hours</option>
                                          <option value="4">4 Hours</option>
                                          <option value="5">5 Hours</option>
                                          <option value="6">6 Hours</option>
                                        </select>
                                        @if ($errors->has('revisionDuration'))
                                          <span id="revisionDuration-error" class="error text-danger" for="revisionDuration">{{ $errors->first('revisionDuration') }}</span>
                                        @endif
                                      </div>
                                    </div>
                                  </div>
                                @endif

                                {{-- <div class="modal-footer"> --}}
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="button" class="btn btn-success" data-original-title="submit" title="submit" onclick="confirm('{{ __("Do you need a rectification?") }}') ? this.parentElement.submit() : ''">
                                    Submit
                                  </button>
                                {{-- </div> --}}
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>

                      {{-- Approved modal start  --}}
                    
                    <span class="pull-right">
                        <button type="button" class="btn btn-success"  data-toggle="modal" data-target="#approveModal" data-original-title="submit" title="submit">
                            Approve order
                            <div class="ripple-container"></div> 
                          </button>
                        <div>
                          @if ($errors->has('rating'))
                            <span id="rating-error" class="error text-danger" for="input-rating">{{ $errors->first('rating') }}</span>
                          @endif
                        </div>
                      </span>
                      <!-- Modal -->
                      <div class="modal fade" id="approveModal" tabindex="-1" role="dialog" aria-labelledby="approveModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="revisionModalLabel">Rate and approve order</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form method="POST" action="{{route('user.completed.update',$completedOrder)}}" class="form-horizontal">
                                  @csrf
                                  @method('PATCH')
                                  <input type="hidden" name="approve" value="2" readonly>
                                  
                                  <div class="rating form-group{{ $errors->has('rating') ? ' has-danger' : '' }}">
                                    <input id="input-1" required="true" name="rating" class="rating rating-loading" data-min="0" data-max="5" data-step="0.5" data-size="xs" autocomplete="off">
                                    @if ($errors->has('rating'))
                                      <span id="rating-error" class="error text-danger" for="input-rating">{{ $errors->first('rating') }}</span>
                                    @endif
                                  </div>
                                  
                                  <div class="form-group{{ $errors->has('ratingComment') ? ' has-danger' : '' }}">
                                    <textarea class="form-control{{ $errors->has('ratingComment') ? ' is-invalid' : '' }}" rows="3" name="ratingComment" id="input-ratingComment" type="text" placeholder="{{ __(' Your approval comment') }}" value="{{ old('ratingComment')}}" required="true" aria-required="true" style="background-color: #fff;"></textarea>
                                    @if ($errors->has('ratingComment'))
                                      <span id="ratingComment-error" class="error text-danger" for="input-ratingComment">{{ $errors->first('ratingComment') }}</span>
                                    @endif
                                  </div>
                                {{-- <div class="modal-footer"> --}}
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="button" class="btn btn-success" data-original-title="submit" title="submit" onclick="confirm('{{ __("satisfied?") }}') ? this.parentElement.submit() : ''">
                                    Submit
                                  </button>
                                {{-- </div> --}}
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>

                </th>
              </tr>
            </thead>
          </table>

          @include('forms/completed/completedshow')
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@endauth