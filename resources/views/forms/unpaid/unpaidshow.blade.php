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
              <i class="material-icons">cloud</i> File uploads ({{$unpaidOrder->fileuploads->count()}})
              <div class="ripple-container"></div>
          </a>
          </li>
              <li class="nav-item">
                  <a class="nav-link" href="#messages" data-toggle="tab">
                  <i class="material-icons">message</i> Messages
                  <div class="ripple-container"></div>
                  </a>
              </li>
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
                  @if (auth('web')->check()==FALSE && count(App\Order::where('user_id', $unpaidOrder->user_id)->get())==1)
                    <span class="badge badge-warning">New</span>
                  @endif
                  @if ($unpaidOrder->isUrgent=='yes')
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
                    {{substr($unpaidOrder['academicLevel'], 4)}}
                </td>
                  <td>
                    <strong>Type of paper:</strong>
                  </td>
                  <td>
                    {{substr($unpaidOrder['typeOfPaper'],4)}}
                  </td>
                </tr>
                <tr>
                  <td>
                    <strong>Deadline:</strong><br />
                  </td>
                  <td>
                    {{substr($unpaidOrder['deadline'],5)}}
                  </td>
                    <td>
                      <strong>Title:</strong>
                    </td>
                    <td>
                      {{$unpaidOrder['title']}}
                    </td>
                </tr>
                <tr>
                  <td>
                    <strong>Subject Area:</strong>
                  </td>
                  <td>
                    {{substr($unpaidOrder['subjectArea'],4)}}
                  </td>
                  <td>
                      <strong>Citation:</strong>
                  </td>
                  <td>
                    {{$unpaidOrder['citation']}}
                  </td>
                </tr>
                <tr>
                  <td>
                    <strong>Spacing:</strong>
                  </td>
                  <td>
                    {{substr($unpaidOrder['spacing'],4)}}
                    @if (substr($unpaidOrder['spacing'],4)=='Double') ({{300 * $unpaidOrder['noOfPages']}} words) @elseif(substr($unpaidOrder['spacing'],4)=='Single') ({{600 * $unpaidOrder['noOfPages']}} words) @endif
                  </td>
                  <td>
                    <strong>Number of pages:</strong>
                  </td>
                  <td>
                    {{$unpaidOrder['noOfPages']}}
                  </td>
                </tr>
                <tr>
                  <td>
                    <strong>Powerpoint slides:</strong>
                  </td>
                  <td>
                    {{$unpaidOrder['powerpointSlides']}}
                  </td>
                  <td>
                    <strong>Sources:</strong>
                  </td>
                  <td>
                    {{$unpaidOrder['sources']}}
                  </td>
                </tr>
                <tr>
                  <td>
                    <strong>Writer ID:</strong>
                      
                  </td>
                  <td>
                    W{{$unpaidOrder['writer_id']}}
                    
                  </td>
                  <td>
                    <strong>Client ID:</strong>
                  </td>
                  <td>
                    C{{$unpaidOrder['user_id']}}
                  </td>
                </tr>
                <tr>
                  <td>
                    @if (auth('admin')->check()||auth('web')->check())
                      <strong>Total amount paid:</strong>
                    @endif
                  </td>
                  <td>
                    @if (auth('admin')->check()||auth('web')->check())
                      <strong>{{substr($unpaidOrder['currency'],5)}} {{$unpaidOrder['totalPrice']}}</strong>
                    @endif
                  </td>
                  <td>
                    @auth('admin')<strong>Editor ID:</strong>@endauth
                  </td>
                  <td>
                    
                  </td>
                  </tr>
                  @auth('admin')
                    <tr>
                      <td>
                        <strong>Writer's amount:</strong>
                      </td>
                      <td>
                          Ksh. {{$unpaidOrder['writerAmount']}}
                      </td>
                      <td>
                        <strong>Editor's amount:</strong>
                      </td>
                      <td>
                        Ksh. {{$unpaidOrder['editorAmount']}}
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <strong> Expenses amount: </strong>
                      </td>
                      <td>
                        Ksh. {{$unpaidOrder['expensesAmount']}}
                      </td>
                      <td>
                        <strong>Balance:</strong>
                      </td>
                      <td>
                        Ksh. {{$unpaidOrder['balance']}}
                      </td>
                    </tr>
                  @endauth
                  <tr>
                    <td colspan="4">
                    <h4><strong>Paper instructions</strong></h4>
                    {!!nl2br(e($unpaidOrder['paperInstructions']))!!}
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
                @foreach ($unpaidOrder->fileuploads as $file)
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
                @auth('web') <form method="POST" action="{{route('user.message.store',$unpaidOrder)}}" class="form-horizontal"> @endauth
                @auth('admin') <form method="POST" action="{{route('admin.message.store',$unpaidOrder)}}" class="form-horizontal"> @endauth
                  @csrf
                  <div class="col-lg-9 col-sm-12" style="background-color: #eee;">
                    <div class="form-group{{ $errors->has('recipient') ? ' has-danger' : '' }} pt-3">
                      <select class="form-control{{ $errors->has('recipient') ? ' is-invalid' : '' }}" name="recipient" id="recipient" type="recipient" value="{{ old('recipient') }}" required style="background-color: #fff;">
                        <option selected disabled>-Select recipient-</option>
                        @auth('web')
                            <option value="support">To Support</option>
                        @endauth
                        @auth('admin')
                            <option value="client">To Client</option>
                        @endauth
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
      </div>
    </div>
  </div>
</div>