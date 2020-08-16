@auth('admin')

@extends('admin.layouts.app', ['activePage' => 'Finances', 'titlePage' => __('Finances Dashboard')])

@section('content')
  <div class="content">
    <div class="container-fluid">

      <div class="row">
        <div class="col-md-4">
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
              <div class="card-icon">
                <i class="material-icons">attach_money</i>
              </div>
              <p class="card-category">Paid amount</p>
              <h3 class="card-title">Ksh. {{$allPaidAmount}}</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">access_time</i>
                <a href="{{route('admin.allpaidinvoices.index')}}">Go to paid invoice(s)</a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
              <div class="card-icon">
                <i class="material-icons">attach_money</i>
              </div>
              <p class="card-category">All ongoing amount</p>
              <h3 class="card-title">Ksh. {{$allOngoingAmount}}</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">access_time</i>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
              <div class="card-icon">
                <i class="material-icons">attach_money</i>
              </div>
              <p class="card-category">All approved amount</p>
              <h3 class="card-title">Ksh. {{$allApprovedAmount}}</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">access_time</i>
                <a href="{{route('admin.allrequestedinvoices.index')}}">Go to requested invoice(s)</a>
              </div>
            </div>
          </div>
        </div>  
      </div>

      <div class="card ">
        <div class="card-header card-header-primary row">
          <span class="col-6">
            <h4 class="card-title ">{{ __('Cost per page (CPP) - DO NOT EDIT!') }}</h4>
            <p class="card-category">{{ __('For writer, editor and expenses') }}</p>
          </span>
        </div>

        <div class="col-md-12">
          <form method="post" action="{{ route('admin.finances.update',$costPerPage) }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('PUT')

            <div class="card-body ">
              <table class="table table-hover">
                <thead class=" text-primary">
                  <tr>
                    <th>
                      Item
                    </th>
                    <th>
                      Page
                    </th>
                    <th>
                      Powerpoint
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      Writer CPPs in USD:
                    </td>
                    <td>
                      <input class="form-control{{ $errors->has('writerPageCPP') ? ' is-invalid' : '' }}" name="writerPageCPP" id="input-writerPageCPP" type="number" placeholder="{{ __('5') }}" value="{{ old('writerPageCPP',$costPerPage->writerPageCPP)}}" required="true" aria-required="true"/><br>
                      @if ($errors->has('writerPageCPP'))
                        <span id="writerPageCPP-error" class="error text-danger" for="input-writerPageCPP">{{ $errors->first('writerPageCPP') }}</span>
                      @endif
                    </td>
                    <td>
                      <input class="form-control{{ $errors->has('writerPowerpointCPP') ? ' is-invalid' : '' }}" name="writerPowerpointCPP" id="input-writerPowerpointCPP" type="number" placeholder="{{ __('4') }}" value="{{ old('writerPowerpointCPP',$costPerPage->writerPowerpointCPP)}}" required="true" aria-required="true"/><br>
                      @if ($errors->has('writerPowerpointCPP'))
                        <span id="writerPowerpointCPP-error" class="error text-danger" for="input-writerPowerpointCPP">{{ $errors->first('writerPowerpointCPP') }}</span>
                      @endif
                    </td>
                  </tr>
                  <tr>
                    <td>
                      Writer CPPs in USD<br> (urgent):
                    </td>
                    <td>
                      <input class="form-control{{ $errors->has('writerUrgentPageCPP') ? ' is-invalid' : '' }}" name="writerUrgentPageCPP" id="input-writerUrgentPageCPP" type="number" placeholder="{{ __('5') }}" value="{{ old('writerUrgentPageCPP',$costPerPage->writerUrgentPageCPP)}}" required="true" aria-required="true"/><br>
                      @if ($errors->has('writerUrgentPageCPP'))
                        <span id="writerUrgentPageCPP-error" class="error text-danger" for="input-writerUrgentPageCPP">{{ $errors->first('writerUrgentPageCPP') }}</span>
                      @endif
                    </td>
                    <td>
                      <input class="form-control{{ $errors->has('writerUrgentPPTCPP') ? ' is-invalid' : '' }}" name="writerUrgentPPTCPP" id="input-writerUrgentPPTCPP" type="number" placeholder="{{ __('4') }}" value="{{ old('writerUrgentPPTCPP',$costPerPage->writerUrgentPPTCPP)}}" required="true" aria-required="true"/><br>
                      @if ($errors->has('writerUrgentPPTCPP'))
                        <span id="writerUrgentPPTCPP-error" class="error text-danger" for="input-writerUrgentPPTCPP">{{ $errors->first('writerUrgentPPTCPP') }}</span>
                      @endif
                    </td>
                  </tr>
                  <tr>
                    <td>
                      Editor CPPs in USD:
                    </td>
                    <td>
                      <input class="form-control{{ $errors->has('editorPageCPP') ? ' is-invalid' : '' }}" name="editorPageCPP" id="input-editorPageCPP" type="number" placeholder="{{ __('1') }}" value="{{ old('editorPageCPP',$costPerPage->editorPageCPP)}}" required="true" aria-required="true"/><br>
                      @if ($errors->has('editorPageCPP'))
                        <span id="editorPageCPP-error" class="error text-danger" for="input-editorPageCPP">{{ $errors->first('editorPageCPP') }}</span>
                      @endif
                    </td>
                    <td>
                      <input class="form-control{{ $errors->has('editorPowerpointCPP') ? ' is-invalid' : '' }}" name="editorPowerpointCPP" id="input-editorPowerpointCPP" type="number" placeholder="{{ __('1') }}" value="{{ old('editorPowerpointCPP',$costPerPage->editorPowerpointCPP)}}" required="true" aria-required="true"/><br>
                      @if ($errors->has('editorPowerpointCPP'))
                        <span id="editorPowerpointCPP-error" class="error text-danger" for="input-editorPowerpointCPP">{{ $errors->first('editorPowerpointCPP') }}</span>
                      @endif
                    </td>
                  </tr>
                  <tr>
                    <td>
                      Expenses CPPs in USD:
                    </td>
                    <td>
                      <input class="form-control{{ $errors->has('expensesPageCPP') ? ' is-invalid' : '' }}" name="expensesPageCPP" id="input-expensesPageCPP" type="number" placeholder="{{ __('1') }}" value="{{ old('expensesPageCPP',$costPerPage->expensesPageCPP)}}" required="true" aria-required="true"/><br>
                      @if ($errors->has('expensesPageCPP'))
                        <span id="expensesPageCPP-error" class="error text-danger" for="input-expensesPageCPP">{{ $errors->first('expensesPageCPP') }}</span>
                      @endif
                    </td>
                    <td>
                      <input class="form-control{{ $errors->has('expensesPowerpointCPP') ? ' is-invalid' : '' }}" name="expensesPowerpointCPP" id="input-expensesPowerpointCPP" type="number" placeholder="{{ __('1') }}" value="{{ old('expensesPowerpointCPP',$costPerPage->expensesPowerpointCPP)}}" required="true" aria-required="true"/><br>
                      @if ($errors->has('expensesPowerpointCPP'))
                        <span id="expensesPowerpointCPP-error" class="error text-danger" for="input-expensesPowerpointCPP">{{ $errors->first('expensesPowerpointCPP') }}</span>
                      @endif
                    </td>
                  </tr>
                </tbody>
              </table>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-danger" onclick="confirm('{{ __("Are you sure about the changes?") }}') ? this.parentElement.submit() : ''">{{ __('Submit') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>

    </div>
  </div>
@endsection

@endauth