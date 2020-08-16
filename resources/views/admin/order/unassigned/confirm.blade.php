@extends('admin.layouts.app', ['activePage' => 'New-Order', 'titlePage' => __('Confirm order')])

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
                      Academic Level
                    </td>
                    <td>
                      {{substr($newOrder['academicLevel'], 4)}}
                    </td>
                  </tr>
                  <tr>
                    <td>
                      Type of paper
                    </td>
                    <td>
                      {{substr($newOrder['typeOfPaper'],4)}}
                    </td>
                  </tr>
                  <tr>
                    <td>
                      Subject area
                    </td>
                    <td>
                      {{substr($newOrder['subjectArea'],4)}}
                    </td>
                  </tr>
                  <tr>
                    <td>
                      Title
                    </td>
                    <td>
                      {{$newOrder['title']}}
                    </td>
                  </tr>
                  <tr>
                    <td>
                      Paper instructions
                    </td>
                    <td>
                      {{$newOrder['paperInstructions']}}
                    </td>
                  </tr>
                  <tr>
                    <td>
                      Citation
                    </td>
                    <td>
                      {{$newOrder['citation']}}
                    </td>
                  </tr>
                  <tr>
                    <td>
                      Spacing
                    </td>
                    <td>
                      {{substr($newOrder['spacing'],4)}}
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
                        Number of pages
                      </td>
                      <td>
                        {{$newOrder['noOfPages']}}
                      </td>
                    </tr>
                    @endif
                    @if ($newOrder['powerpointSlides'])
                    <tr>
                      <td>
                        Powerpoint slides
                      </td>
                      <td>
                        {{$newOrder['powerpointSlides']}}
                      </td>
                    </tr>
                    @endif
                    @if ($newOrder['sources'])
                    <tr>
                      <td>
                        Sources
                      </td>
                      <td>
                        {{$newOrder['sources']}}
                      </td>
                    </tr>
                    @endif
                    <tr>
                      <td>
                        Deadline
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
                      </td>
                    </tr>
                </tbody>
              </table>
              <form method="POST" action="{{ route('admin.order.store') }}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
                @csrf
              <button type='submit' class='btn btn-primary'>Confirm your order</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection