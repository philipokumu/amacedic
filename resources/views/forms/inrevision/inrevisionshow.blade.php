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
              <i class="material-icons">cloud</i> File uploads ({{$inrevisionOrder->fileuploads->count()}})
              <div class="ripple-container"></div>
          </a>
          </li>
              <li class="nav-item">
                  <a class="nav-link" href="#messages" data-toggle="tab">
                  <i class="material-icons">message</i> Messages
                  <div class="ripple-container"></div>
                  </a>
              </li>
          
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
                @if (auth('web')->check()==FALSE && count(App\Order::where('user_id', $inrevisionOrder->user_id)->get())==1)
                  <span class="badge badge-warning">New</span>
                @endif
                @if ($inrevisionOrder->isUrgent=='yes')
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
                  {{substr($inrevisionOrder['academicLevel'], 4)}}
              </td>
                <td>
                  <strong>Type of paper:</strong>
                </td>
                <td>
                  {{substr($inrevisionOrder['typeOfPaper'],4)}}
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
                    {{$inrevisionOrder['title']}}
                  </td>
              </tr>
              <tr>
                <td>
                  <strong>Subject Area:</strong>
                </td>
                <td>
                  {{substr($inrevisionOrder['subjectArea'],4)}}
                </td>
                <td>
                    <strong>Citation:</strong>
                </td>
                <td>
                  {{$inrevisionOrder['citation']}}
                </td>
              </tr>
              <tr>
                <td>
                  <strong>Spacing:</strong>
                </td>
                <td>
                  {{substr($inrevisionOrder['spacing'],4)}}
                  @if (substr($inrevisionOrder['spacing'],4)=='Double') ({{300 * $inrevisionOrder['noOfPages']}} words) @elseif(substr($inrevisionOrder['spacing'],4)=='Single') ({{600 * $inrevisionOrder['noOfPages']}} words) @endif
                </td>
                <td>
                  <strong>Number of pages:</strong>
                </td>
                <td>
                  {{$inrevisionOrder['noOfPages']}}
                </td>
              </tr>
              <tr>
                <td>
                  <strong>Powerpoint slides:</strong>
                </td>
                <td>
                  {{$inrevisionOrder['powerpointSlides']}}
                </td>
                <td>
                  <strong>Sources:</strong>
                </td>
                <td>
                  {{$inrevisionOrder['sources']}}
                </td>
              </tr>
              <tr>
                <td>
                  <strong>Writer ID:</strong>
                    
                </td>
                <td>
                  W{{$inrevisionOrder['writer_id']}}
                  
                </td>
                <td>
                  <strong>Client ID:</strong>
                </td>
                <td>
                  C{{$inrevisionOrder['user_id']}}
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
                    <strong>{{substr($inrevisionOrder['currency'],5)}} {{$inrevisionOrder['totalPrice']}}</strong>
                  @endif
                @auth('writer') 
                  @if ($inrevisionOrder->originalWriterAmount == $inrevisionOrder->writerAmount)
                    Ksh. {{$inrevisionOrder['writerAmount']}}
                  @else 
                    <span class="text-danger">Ksh. {{$inrevisionOrder['writerAmount']}}</span>
                  @endif
                @endauth
                @auth('editor') 
                  Ksh. {{$inrevisionOrder['editorAmount']}}
                @endauth 
                </td>
                <td>
                  @auth('admin')<strong>Editor ID:</strong>@endauth
                </td>
                <td>
                  @auth('admin')E{{$inrevisionOrder['editor_id']}}@endauth
                </td>
                </tr>
                @auth('admin')
                  <tr>
                    <td>
                      <strong>Writer's amount:</strong>
                    </td>
                    <td>
                      @if ($inrevisionOrder->originalWriterAmount == $inrevisionOrder->writerAmount)
                        Ksh. {{$inrevisionOrder['writerAmount']}}
                      @else 
                        <span class="text-danger">Ksh. {{$inrevisionOrder['writerAmount']}}</span>
                      @endif
                    </td>
                    <td>
                      <strong>Editor's amount:</strong>
                    </td>
                    <td>
                      Ksh. {{$inrevisionOrder['editorAmount']}}
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <strong> Expenses amount: </strong>
                    </td>
                    <td>
                      Ksh. {{$inrevisionOrder['expensesAmount']}}
                    </td>
                    <td>
                      <strong>Balance:</strong>
                    </td>
                    <td>
                      Ksh. {{$inrevisionOrder['balance']}}
                    </td>
                  </tr>
                @endauth
                <tr>
                  <td colspan="4">
                  <h4><strong>Paper instructions</strong></h4>
                  {!!nl2br(e($inrevisionOrder['paperInstructions']))!!}
                  </td>
                </tr>
              </tbody>
          </table>
          <div class="card modal-body"> 
              <h4><strong><u>Revision instructions</u></strong></h4>
                  @foreach ($inrevisionInstructions as $inrevisionInstruction)
                      <table>
                          <tr>
                              <td>
                                  {{$loop->iteration}}.) <strong>{{$inrevisionInstruction['messageSender']}}:</strong>   {!!nl2br(e($inrevisionInstruction['revisionInstructions']))!!}
                              </td>
                          </tr>
                      </table>
                  @endforeach
          </div>
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
              @foreach ($inrevisionOrder->fileuploads as $file)
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
              <tr>
                <td colspan="5">
                  <div class="form-group{{ $errors->has('fileUploads') ? ' has-danger' : '' }}">
                    <div class="form-group{{ $errors->has('fileUploads') ? ' is-invalid' : '' }} dropzone text-center py-5" id="awesomeDropzone">
                      <div class="dz-message">
                        <p><strong>  Click here to upload files. Or drag and Drop your files here.</strong></p>
                      </div>
                    </div>
                      <input class="form-control" name="order_id" id="order_id" type="number" value={{$inrevisionOrder->id}} readonly hidden/>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

          <div class="tab-pane" id="messages">
            <div class="card modal-body">    
              <h4><strong><u>Messages</u></strong></h4>
              @foreach ($messages as $message)
                  <table>
                      <tr>
                          <td>
                              {{$loop->iteration}}.) <strong>{{$message['messageSender']}} to {{$message['recipient']}}:</strong>   {!!nl2br(e($message['message']))!!}
                          </td>
                      </tr>
                  </table>
              @endforeach
            </div>
            <span>
              @auth('web') <form method="POST" action="{{route('user.message.store',$inrevisionOrder)}}" class="form-horizontal"> @endauth
              @auth('admin') <form method="POST" action="{{route('admin.message.store',$inrevisionOrder)}}" class="form-horizontal"> @endauth
              @auth('writer') <form method="POST" action="{{route('writer.message.store',$inrevisionOrder)}}" class="form-horizontal"> @endauth
              @auth('editor') <form method="POST" action="{{route('editor.message.store',$inrevisionOrder)}}" class="form-horizontal"> @endauth
                @csrf
                <div class="col-lg-9 col-sm-12" style="background-color: #eee;">
                  <div class="form-group{{ $errors->has('recipient') ? ' has-danger' : '' }} pt-3">
                    <select class="form-control{{ $errors->has('recipient') ? ' is-invalid' : '' }}" name="recipient" id="recipient" type="recipient" value="{{ old('recipient') }}" required style="background-color: #fff;">
                      <option selected disabled>-Select recipient-</option>
                      @if (auth('admin')->check()||auth('web')->check()||auth('editor')->check())
                          <option value="writer">To Writer</option>
                      @endif
                      @if (auth('writer')->check()||auth('web')->check()||auth('editor')->check())
                          <option value="support">To Support</option>
                      @endif
                      @if (auth('writer')->check()||auth('admin')->check())
                          <option value="client">To Client</option>
                      @endif
                        @if (auth('writer')->check()||auth('admin')->check())
                            <option value="editor">To Editor</option>
                        @endif
                    </select> 
                    @if ($errors->has('recipient'))
                      <div id="recipient-error" class="error text-danger" for="recipient">{{ $errors->first('recipient') }}</div>
                    @endif
                  </div>
                  
                  <div class="form-group{{ $errors->has('orderMessage') ? ' has-danger' : '' }}">
                    <textarea class="form-control{{ $errors->has('orderMessage') ? ' is-invalid' : '' }}" rows="4" name="orderMessage" id="input-orderMessage" type="text" placeholder="{{ __(' Your message') }}" value="{{ old('orderMessage')}}" required="true" aria-required="true"  style="background-color: #fff;"></textarea>
                    @if ($errors->has('orderMessage'))
                      <span id="orderMessage-error" class="error text-danger" for="input-orderMessage">{{ $errors->first('orderMessage') }}</span>
                    @endif
                  </div>
                </div>
                <button type="button" class="btn btn-info" data-original-title="submit" title="submit" onclick="confirm('{{ __("Send message?") }}') ? this.parentElement.submit() : ''">
                  Send message
                  <div class="ripple-container"></div> 
                </button>
              </form>
            </span>
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
                  @if ($inrevisionOrder->id != $order->id)
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