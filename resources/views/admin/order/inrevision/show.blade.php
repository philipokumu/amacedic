@auth('admin')

@extends('admin.layouts.app', ['activePage' => 'In-revision', 'titlePage' => __('Inrevision order')])

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
              <a href="{{route('admin.inrevision.index')}}" class='btn btn-info pull-right'>Back to list</a>
            </span>
          </div>
          <table class="table -mb-2">
            <thead class=" text-primary">
              <tr>
                <th>
                  <span class="pull-right">
                    <button type="submit" class="btn btn btn-success" data-toggle="modal" data-target="#changeWAmountModal" data-original-title="submit" title="submit">
                      Adjust Writer Amount
                    </button>
                    <button type="submit" class="btn btn btn-info" data-toggle="modal" data-target="#extendDeadlineModal" data-original-title="submit" title="submit">
                      Extend writer deadline
                    </button>
                    <a href="{{route('admin.bids.index',$inrevisionOrder)}}" class='btn btn-danger'>Reassign</a>
                    <p>
                      @if ($errors->has('writerEndDate'))
                        <span id="writerEndDate-error" class="error text-danger" for="input-writerEndDate">{{ $errors->first('writerEndDate') }}</span>
                      @endif
                      @if ($errors->has('writerAmount'))
                        <span id="writerAmount-error" class="error text-danger" for="input-writerAmount">{{ $errors->first('writerAmount') }}</span>
                      @endif
                    </p>
                  </span>
                </th>
              </tr>
            </thead>
          </table>
          <!-- change deadline Modal -->
          <div class="modal fade" id="extendDeadlineModal" tabindex="-1" role="dialog" aria-labelledby="revisionModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="revisionModalLabel">Extend Writer Deadline</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form method="POST" action="{{route('admin.adjustdeadline.update',$inrevisionOrder)}}" class="form-horizontal">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                      <label class="col-sm-5 col-form-label">{{ __('Client deadline') }}</label>
                      <div class="col-sm-7">
                        <div class="form-group{{ $errors->has('endDate') ? ' has-danger' : '' }}">
                          <input type="text" id="endDate" name="endDate" class="form-control{{ $errors->has('endDate') ? ' is-invalid' : '' }} datetimepicker mt-1" value="{{ $endDate }}" readonly aria-readonly="true"/>
                          @if ($errors->has('endDate'))
                          <span id="endDate-error" class="error text-danger" for="input-endDate">{{ $errors->first('endDate') }}</span>
                          @endif
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <label class="col-sm-5 col-form-label">{{ __('Writer deadline') }}</label>
                      <div class="col-sm-7">
                        <div class="form-group{{ $errors->has('writerEndDate') ? ' has-danger' : '' }}">
                          <input type="text" id="writerEndDate" name="writerEndDate" class="form-control{{ $errors->has('writerEndDate') ? ' is-invalid' : '' }} datetimepicker mt-1" value="{{$writerEndDate }}"/>
                          @if ($errors->has('writerEndDate'))
                          <span id="writerEndDate-error" class="error text-danger" for="input-writerEndDate">{{ $errors->first('writerEndDate') }}</span>
                          @endif
                        </div>
                      </div>
                    </div>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" data-original-title="submit" title="submit" onclick="confirm('{{ __("Adjust writer deadline?") }}') ? this.parentElement.submit() : ''">
                      Adjust
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- change amount modal -->
          <div class="modal fade" id="changeWAmountModal" tabindex="-1" role="dialog" aria-labelledby="changeWAmountModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="changeWAmountModal">Adjust writer amount</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form method="POST" action="{{route('admin.adjustwritamount.update',$inrevisionOrder)}}" class="form-horizontal">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                      <label class="col-sm-5 col-form-label">{{ __('Original Writ. amount (Ksh.)') }}</label>
                      <div class="col-sm-7">
                        <div class="form-group{{ $errors->has('origWriterAmount') ? ' has-danger' : '' }}">
                          <input type="number" id="origWriterAmount" name="origWriterAmount" class="form-control{{ $errors->has('origWriterAmount') ? ' is-invalid' : '' }} mt-1" value="{{ $inrevisionOrder->originalWriterAmount }}" readonly aria-readonly="true"/>
                          @if ($errors->has('origWriterAmount'))
                          <span id="origWriterAmount-error" class="error text-danger" for="input-origWriterAmount">{{ $errors->first('origWriterAmount') }}</span>
                          @endif
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <label class="col-sm-5 col-form-label">{{ __('Writer amount (Ksh.)') }}</label>
                      <div class="col-sm-7">
                        <div class="form-group{{ $errors->has('writerAmount') ? ' has-danger' : '' }}">
                          <input type="number" id="writerAmount" name="writerAmount" class="form-control{{ $errors->has('writerAmount') ? ' is-invalid' : '' }} mt-1" value="{{$inrevisionOrder->writerAmount }}" min="0" max="{{ $inrevisionOrder->originalWriterAmount }}"/>
                          @if ($errors->has('writerAmount'))
                          <span id="writerAmount-error" class="error text-danger" for="input-writerAmount">{{ $errors->first('writerAmount') }}</span>
                          @endif
                        </div>
                      </div>
                    </div>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" data-original-title="submit" title="submit" onclick="confirm('{{ __("Adjust writer amount?") }}') ? this.parentElement.submit() : ''">
                      Adjust
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>

          @include('forms/inrevision/inrevisionshow')
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@endauth