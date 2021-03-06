@auth('admin')

@extends('admin.layouts.app', ['activePage' => 'Assigned', 'titlePage' => __('Assigned order')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary row">
            <span class="col-6">
              <h4 class="card-title ">Order: {{$assignedOrder['id']}}</h4>
              <p class="card-category">Title: {{$assignedOrder['title']}}</p>
            </span>
            <span class="col-6">
              <a href="{{route('admin.assigned.index')}}" class='btn btn-info pull-right'>Back to list</a>
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
                    <p>
                      @if ($errors->has('writerAmount'))
                        <span id="writerAmount-error" class="error text-danger" for="input-writerAmount">{{ $errors->first('writerAmount') }}</span>
                      @endif
                    </p>
                  </span>
                  <span class="pull-right">
                      <a href="{{route('admin.bids.index',$assignedOrder)}}" class='btn btn-danger'>Reassign</a>
                  </span>
                </th>
              </tr>
            </thead>
          </table>
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
                <form method="POST" action="{{route('admin.adjustwritamount.update',$assignedOrder)}}" class="form-horizontal">
                  @csrf
                  @method('PATCH')
                  <div class="row">
                    <label class="col-sm-5 col-form-label">{{ __('Original Writ. amount (Ksh.)') }}</label>
                    <div class="col-sm-7">
                      <div class="form-group{{ $errors->has('origWriterAmount') ? ' has-danger' : '' }}">
                        <input type="number" id="origWriterAmount" name="origWriterAmount" class="form-control{{ $errors->has('origWriterAmount') ? ' is-invalid' : '' }} mt-1" value="{{ $assignedOrder->originalWriterAmount }}" readonly aria-readonly="true"/>
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
                        <input type="number" id="writerAmount" name="writerAmount" class="form-control{{ $errors->has('writerAmount') ? ' is-invalid' : '' }} mt-1" value="{{$assignedOrder->writerAmount }}" min="0" max="{{ $assignedOrder->originalWriterAmount }}"/>
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

          @include('forms/assigned/assignedshow')
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@endauth