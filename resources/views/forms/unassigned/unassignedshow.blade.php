<div class="card-body">
  <div class="table-responsive">
    <div>
      <ul class="nav nav-pills nav-pills-primary col-md-12" role="tablist" id="tabMenu">
          <li class="nav-item">
          <a class="nav-link active" href="#instructions" data-toggle="tab">
              <i class="material-icons">assignment</i> Instructions
              <div class="ripple-container"></div>
          </a>
          </li>
          <li class="nav-item">
          <a class="nav-link" href="#fileuploads" data-toggle="tab">
              <i class="material-icons">cloud</i> File uploads ({{$order->fileuploads->count()}})
              <div class="ripple-container"></div>
          </a>
        </ul>
        <hr>
        
  </div>
    <div class="card-body -mt-8">
        <div class="tab-content">
        <div class="tab-pane active" id="instructions">
          <table class="table">
            <thead class=" text-primary">
            <tr>
              <th>
                Label
                @if (auth('web')->check()==FALSE && count(App\Order::where('user_id', $order->user_id)->get())==1)
                  <span class="badge badge-warning">New</span>
                @endif
                @if ($order->isUrgent=='yes')
                  <span class="badge badge-danger">CO</span>
                @endif
              </th>
              <th>
                Value
              </th>
              <th>
                Label
              </th>
              <th>
                Value
              </th>
            </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <strong>Academic Level:</strong>
                </td>
              <td>
                  {{substr($order['academicLevel'], 4)}}
              </td>
                <td>
                  <strong>Type of paper:</strong>
                </td>
                <td>
                  {{substr($order['typeOfPaper'],4)}}
                </td>
              </tr>
              <tr>
                <td>
                    <strong>Deadline:</strong><br />
                    @if (auth('admin')->check()||auth('editor')->check())
                      <strong>Writer deadline:</strong>
                    @endif
                </td>
                <td>
                    @if (auth('admin')->check()||auth('web')->check()||auth('editor')->check())
                    {{$deadline->invert ? '-' : ''}}{{$deadline}} <br />
                    @endif
                    @if (auth('admin')->check()||auth('writer')->check()||auth('editor')->check())
                      {{$writerDeadline->invert ? '-' : ''}}{{$writerDeadline}}
                    @endif
                </td>
                  <td>
                    <strong>Title:</strong>
                  </td>
                  <td>
                    {{$order['title']}}
                  </td>
              </tr>
              <tr>
                <td>
                  <strong>Subject Area:</strong>
                </td>
                <td>
                  {{substr($order['subjectArea'],4)}}
                </td>
                <td>
                    <strong>Citation:</strong>
                </td>
                <td>
                  {{$order['citation']}}
                </td>
              </tr>
              <tr>
                <td>
                  <strong>Spacing:</strong>
                </td>
                <td>
                  {{substr($order['spacing'],4)}}
                  @if (substr($order['spacing'],4)=='Double') ({{300 * $order['noOfPages']}} words) @elseif(substr($order['spacing'],4)=='Single') ({{600 * $order['noOfPages']}} words) @endif
                </td>
                <td>
                  <strong>Number of pages:</strong>
                </td>
                <td>
                  {{$order['noOfPages']}}
                </td>
              </tr>
              <tr>
                <td>
                  <strong>Powerpoint slides:</strong>
                </td>
                <td>
                  {{$order['powerpointSlides']}}
                </td>
                <td>
                  <strong>Sources:</strong>
                </td>
                <td>
                  {{$order['sources']}}
                </td>
              </tr>
              <tr>
                <td>
                  <strong>Writer ID:</strong>
                    
                </td>
                <td>
                  {{$order['writer_id']}}
                  
                </td>
                <td>
                  <strong>Client ID:</strong>
                </td>
                <td>
                  C{{$order['user_id']}}
                </td>
              </tr>
              <tr>
                <td>
                  @if (auth('admin')->check()||auth('web')->check())
                    <strong>Total amount paid:</strong>
                  @endif
                  @auth('writer')<strong>Writer amount:</strong>@endauth
                  @auth('editor')<strong>Editor amount:</strong>@endauth
                </td>
                <td>
                  @if (auth('admin')->check()||auth('web')->check())
                    <strong>{{substr($order['currency'],5)}} {{$order['totalPrice']}}</strong>
                  @endif
                @auth('writer') 
                  @if ($order->originalWriterAmount == $order->writerAmount)
                    Ksh. {{$order['writerAmount']}}
                  @else 
                    <span class="text-danger">Ksh. {{$order['writerAmount']}}</span>
                  @endif
                @endauth
                @auth('editor') 
                  Ksh. {{$order['editorAmount']}}
                @endauth 
                </td>
                <td>
                  @auth('admin')<strong>Editor ID:</strong>@endauth
                </td>
                <td>
                  @auth('admin'){{$order['editor_id']}}@endauth
                </td>
                </tr>
                @auth('admin')
                  <tr>
                    <td>
                      <strong>Writer's amount:</strong>
                    </td>
                    <td>
                      @if ($order->originalWriterAmount == $order->writerAmount)
                        Ksh. {{$order['writerAmount']}}
                      @else 
                        <span class="text-danger">Ksh. {{$order['writerAmount']}}</span>
                      @endif
                    </td>
                    <td>
                      <strong>Editor's amount:</strong>
                    </td>
                    <td>
                      Ksh. {{$order['editorAmount']}}
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <strong> Expenses amount: </strong>
                    </td>
                    <td>
                      Ksh. {{$order['expensesAmount']}}
                    </td>
                    <td>
                      <strong>Balance:</strong>
                    </td>
                    <td>
                      Ksh. {{$order['balance']}}
                    </td>
                  </tr>
                @endauth
                <tr>
                  <td colspan="4">
                  <h4><strong>Paper instructions</strong></h4>
                    {!!nl2br(e($order['paperInstructions']))!!}
                  </td>
                </tr>
              </tbody>
          </table>

        </div>
        <div class="tab-pane pb-4" id="fileuploads">
          <table class="table">
            <thead class=" text-primary">
              <tr>
                <th>
                  #
                </th>
                <th>
                  File name
                </th>
                <th>
                  Uploaded by
                </th>
                <th>
                  Uploaded date
                </th>
                @auth('admin')
                  <th>
                    Action
                  </th>
                @endauth
              </tr>
            </thead>
            <tbody>
              @foreach ($order->fileuploads as $file)
                <tr>
                  <td>
                    <a href="{{ asset('storage/fileuploads')}}/{{$file->filename}}" target="_blank">{{$loop->iteration}}</a>
                  </td>
                  <td>
                    <a href="{{ asset('storage/fileuploads')}}/{{$file->filename}}" target="_blank">{{$file->filename}}</a>
                  </td>
                  <td>
                    <a href="{{ asset('storage/fileuploads')}}/{{$file->filename}}" target="_blank">{{$file->uploader}}</a>
                  </td>
                  <td>
                    <a href="{{ asset('storage/fileuploads')}}/{{$file->filename}}" target="_blank">{{$file->created_at}}</a>
                  </td>
                  @auth('admin')
                    <td>
                      <form action="{{ route('admin.fileupload.delete', $file->filename) }}" method="POST">
                        @csrf
                    
                        <input type="text" value="{{$file->filename}}" name="id" hidden>
                        <button type="button" class="btn btn-danger btn-link" data-original-title="" title="" onclick="confirm('{{ __("Are you sure you want to delete this file?") }}') ? this.parentElement.submit() : ''">
                            <i class="material-icons">close</i>
                            <div class="ripple-container"></div>
                        </button>
                      </form>
                    </td>
                    @endauth
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>

      </div>
    </div>
  </div>
</div>