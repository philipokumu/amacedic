@extends('layouts.app', ['activePage' => 'New-Order', 'titlePage' => __('Confirm order')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Confirm your order</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table">
                <thead class=" text-primary">
                  <th>
                    Label
                  </th>
                  <th>
                    Value
                  </th>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      <strong>Academic Level:</strong>
                    </td>
                    <td>
                      {{substr($newOrder['academicLevel'], 4)}}
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <strong>Type of paper:</strong>
                    </td>
                    <td>
                      {{substr($newOrder['typeOfPaper'],4)}}
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <strong>Subject area:</strong>
                    </td>
                    <td>
                      {{substr($newOrder['subjectArea'],4)}}
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <strong>Title:</strong>
                    </td>
                    <td>
                      {{$newOrder['title']}}
                    </td>
                  </tr>
                  
                  <tr>
                    <td>
                      <strong>Citation:</strong>
                    </td>
                    <td>
                      {{$newOrder['citation']}}
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <strong>Spacing:</strong>
                    </td>
                    <td>
                      {{substr($newOrder['spacing'],4)}}
                    </td>
                  </tr>
                  @if ($newOrder['sources'])
                  <tr>
                    <td>
                      <strong>Sources:</strong>
                    </td>
                    <td>
                      {{$newOrder['sources']}}
                    </td>
                  </tr>
                @endif
                  <tr>
                    <td colspan="2">
                      <strong>Paper instructions:</strong><br>
                      {!!nl2br(e($newOrder['paperInstructions']))!!}
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2">
                      <strong><h3>Pricing details</h3></strong>
                    </td>
                  </tr>
                  @if ($newOrder['noOfPages'])
                    <tr>
                      <td>
                        <strong>Number of pages:</strong>
                      </td>
                      <td>
                        {{$newOrder['noOfPages']}}
                      </td>
                    </tr>
                    @endif
                    @if ($newOrder['powerpointSlides'])
                    <tr>
                      <td>
                        <strong>Powerpoint slides:</strong>
                      </td>
                      <td>
                        {{$newOrder['powerpointSlides']}}
                      </td>
                    </tr>
                    @endif
                    <tr>
                      <td>
                        <strong>Deadline:</strong>
                      </td>
                      <td>
                        {{substr($newOrder['deadline'],5)}}
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <h4><strong>Total amount payable</strong></h4>
                      </td>
                      <td>
                        <h4><strong>{{substr($newOrder['currency'],5)}} {{$newOrder['totalPrice']}}</strong></h4>
                        <input type="text" value="{{"'".substr($newOrder['currency'],5)."'"}}" name="currency" hidden aria-hidden="true" readonly aria-readonly="true">
                        <input type="text" value="{{$newOrder['totalPrice']}}" name="totalPrice" hidden aria-hidden="true" readonly aria-readonly="true">
                      </td>
                    </tr>
                </tbody>
              </table>
              <form method="POST" action="{{ route('user.unassigned.store') }}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
                @csrf
                <button type='submit' class='btn btn-info' id='paybutton'>Confirm order</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection