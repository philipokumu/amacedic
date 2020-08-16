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
                <i class="material-icons">cloud</i> File uploads ({{$assignedOrder->fileuploads->count()}})
                <div class="ripple-container"></div>
            </a>
            
            @if (auth('editor')->check()==false)
                <li class="nav-item">
                    <a class="nav-link" href="#history" data-toggle="tab">
                    <i class="material-icons">history</i> History with client ({{$historyOrders->count() - 1}})
                    <div class="ripple-container"></div>
                    </a>
                </li>
            @endif
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
                  @if (auth('web')->check()==FALSE && count(App\Order::where('user_id', $assignedOrder->user_id)->get())==1)
                    <span class="badge badge-warning">New</span>
                  @endif
                  @if ($assignedOrder->isUrgent=='yes')
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
                    {{substr($assignedOrder['academicLevel'], 4)}}
                </td>
                  <td>
                    <strong>Type of paper:</strong>
                  </td>
                  <td>
                    {{substr($assignedOrder['typeOfPaper'],4)}}
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
                      {{$assignedOrder['title']}}
                    </td>
                </tr>
                <tr>
                  <td>
                    <strong>Subject Area:</strong>
                  </td>
                  <td>
                    {{substr($assignedOrder['subjectArea'],4)}}
                  </td>
                  <td>
                      <strong>Citation:</strong>
                  </td>
                  <td>
                    {{$assignedOrder['citation']}}
                  </td>
                </tr>
                <tr>
                  <td>
                    <strong>Spacing:</strong>
                  </td>
                  <td>
                    {{substr($assignedOrder['spacing'],4)}}
                    @if (substr($assignedOrder['spacing'],4)=='Double') ({{300 * $assignedOrder['noOfPages']}} words) @elseif(substr($assignedOrder['spacing'],4)=='Single') ({{600 * $assignedOrder['noOfPages']}} words) @endif
                  </td>
                  <td>
                    <strong>Number of pages:</strong>
                  </td>
                  <td>
                    {{$assignedOrder['noOfPages']}}
                  </td>
                </tr>
                <tr>
                  <td>
                    <strong>Powerpoint slides:</strong>
                  </td>
                  <td>
                    {{$assignedOrder['powerpointSlides']}}
                  </td>
                  <td>
                    <strong>Sources:</strong>
                  </td>
                  <td>
                    {{$assignedOrder['sources']}}
                  </td>
                </tr>
                <tr>
                  <td>
                    <strong>Writer ID:</strong>
                      
                  </td>
                  <td>
                    W{{$assignedOrder['writer_id']}}
                    
                  </td>
                  <td>
                    <strong>Client ID:</strong>
                  </td>
                  <td>
                    C{{$assignedOrder['user_id']}}
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
                      <strong>{{substr($assignedOrder['currency'],5)}} {{$assignedOrder['totalPrice']}}</strong>
                    @endif
                  @auth('writer') 
                    @if ($assignedOrder->originalWriterAmount == $assignedOrder->writerAmount)
                      Ksh. {{$assignedOrder['writerAmount']}}
                    @else 
                      <span class="text-danger">Ksh. {{$assignedOrder['writerAmount']}}</span>
                    @endif
                  @endauth
                  @auth('editor') 
                    Ksh. {{$assignedOrder['editorAmount']}}
                  @endauth 
                  </td>
                  <td>
                    @auth('admin')<strong>Editor ID:</strong>@endauth
                  </td>
                  <td>
                    @auth E{{$assignedOrder['editor_id']}}@endauth
                  </td>
                  </tr>
                  @auth('admin')
                    <tr>
                      <td>
                        <strong>Writer's amount:</strong>
                      </td>
                      <td>
                        @if ($assignedOrder->originalWriterAmount == $assignedOrder->writerAmount)
                          Ksh. {{$assignedOrder['writerAmount']}}
                        @else 
                          <span class="text-danger">Ksh. {{$assignedOrder['writerAmount']}}</span>
                        @endif
                      </td>
                      <td>
                        <strong>Editor's amount:</strong>
                      </td>
                      <td>
                        Ksh. {{$assignedOrder['editorAmount']}}
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <strong> Expenses amount: </strong>
                      </td>
                      <td>
                        Ksh. {{$assignedOrder['expensesAmount']}}
                      </td>
                      <td>
                        <strong>Balance:</strong>
                      </td>
                      <td>
                        Ksh. {{$assignedOrder['balance']}}
                      </td>
                    </tr>
                  @endauth
                  <tr>
                    <td colspan="4">
                    <h4><strong>Paper instructions</strong></h4>
                    {!!nl2br(e($assignedOrder['paperInstructions']))!!}
                    </td>
                  </tr>
                </tbody>
            </table>

          </div>
          <div class="tab-pane" id="fileuploads">
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
                @foreach ($assignedOrder->fileuploads as $file)
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
  
          @if (auth('editor')->check()==false)
            <div class="tab-pane" id="history">
              <table class="table table-hover">
                <thead class=" text-primary">
                <tr>
                  <th>
                    Order ID
                  </th>
                  <th>
                    Title
                  </th>
                  <th>
                    Status
                  </th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($historyOrders as $order)
                  @if ($assignedOrder->id != $order->id)
                    <tr>
                      <td>
                        @auth('web')<a href="{{ route('user'.'.'.$order->status.'.'.'show', $order)}}"><strong>#{{$order->id}}</strong></a>@endauth
                        @auth('admin')<a href="{{ route('admin'.'.'.$order->status.'.'.'show', $order)}}"><strong>#{{$order->id}}</strong></a>@endauth
                        @auth('writer')<a href="{{ route('writer'.'.'.$order->status.'.'.'show', $order)}}"><strong>#{{$order->id}}</strong></a>@endauth
                      </td>
                    <td>
                        {{$order->title}}
                    </td>
                      <td>
                        <strong>{{$order->status}}</strong>
                      </td>
                    </tr>
                  @endif
                  @endforeach
                  </tbody>
              </table>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>