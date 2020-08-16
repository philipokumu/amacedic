@auth('admin')
@extends('admin.layouts.app', ['activePage' => 'Available', 'titlePage' => __('Bids')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Writers to assign order {{$orderBids}}</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-hover">
                <thead class=" text-primary">
                  <tr>
                    <th colspan="7">
                      <h4>
                        <strong>
                        @if($preferredWriter != NULL)
                          All writer bids (<i>Preferred Writer is W{{$preferredWriter}}</i>
                        @else
                          All writer bids
                        @endif
                        </strong>
                      </h4>
                    </th>
                  </tr>
                  <tr>
                    <th>
                      #
                    </th>
                    <th>
                      Writer ID
                    </th>
                    <th>
                      Writer name
                    </th>
                    <th>
                      Rating
                    </th>
                    <th>
                      Orders from this client
                    </th>
                    <th>
                      Accomplishments
                    </th>
                    <th>
                      Action 
                    </th>
                  </thead>
                  <tbody>
                    @foreach ($writers as $writer)
                      <tr>
                        <td>
                          {{$loop->iteration}}
                        </td>
                        <td>
                          <a href="{{route('admin.writer.show', $writer)}}" target="_blank">{{$writer->id}}</a>
                        </td>
                        <td>
                          <a href="{{route('admin.writer.show', $writer)}}" target="_blank">{{$writer->name}}</a>
                        </td>
                        <td>
                          Client
                          <input id="input-1" required="true" name="rating" class="rating rating-loading" data-min="0" data-max="5" data-step="0.5" data-size="x"
                        value="{{App\Order::where(['writer_id'=>$writer->id])->avg('rating')}}" readonly>
                        <p>
                          Editor
                          <input id="input-2" required="true" name="rating2" class="rating rating-loading" data-min="0" data-max="5" data-step="0.5" data-size="x"
                        value="{{App\EditorToWriterNote::where(['writer_id'=>$writer->id])->avg('rating')}}" readonly>
                        </p>
                        </td>
                        <td>
                        <strong>Assigned orders:</strong> {{count(App\Order::where(['writer_id'=>$writer->id,'status'=>'assigned','user_id'=>$userId])->get())}}<br />
                          <strong>Inprogress orders:</strong> {{count(App\Order::where(['writer_id'=>$writer->id,'status'=>'inprogress','user_id'=>$userId])->get())}}<br />
                          <strong>Inediting orders:</strong> {{count(App\Order::where(['writer_id'=>$writer->id,'status'=>'inediting','user_id'=>$userId])->get())}}<br />
                          <strong>completed orders:</strong> {{count(App\Order::where(['writer_id'=>$writer->id,'status'=>'completed','user_id'=>$userId])->get())}}<br />
                          <strong>Inrevision orders:</strong> {{count(App\Order::where(['writer_id'=>$writer->id,'status'=>'inrevision','user_id'=>$userId])->get())}}<br />
                          <strong>Approved orders:</strong> {{count(App\Order::where(['writer_id'=>$writer->id,'status'=>'approved','user_id'=>$userId])->get())}}<br />
                          <strong>cancelled orders:</strong> {{count(App\Order::where(['writer_id'=>$writer->id,'status'=>'cancelled','user_id'=>$userId])->get())}}<br />
                        </td>
                        <td>
                          <strong>Assigned orders:</strong> {{count(App\Order::where(['writer_id'=>$writer->id,'status'=>'assigned'])->get())}} <br />
                          <strong>Inprogress orders:</strong> {{count(App\Order::where(['writer_id'=>$writer->id,'status'=>'inprogress'])->get())}}<br />
                          <strong>Inediting orders:</strong> {{count(App\Order::where(['writer_id'=>$writer->id,'status'=>'inediting'])->get())}}<br />
                          <strong>completed orders:</strong> {{count(App\Order::where(['writer_id'=>$writer->id,'status'=>'completed'])->get())}}<br />
                          <strong>Inrevision orders:</strong> {{count(App\Order::where(['writer_id'=>$writer->id,'status'=>'inrevision'])->get())}}<br />
                          <strong>Approved orders:</strong> {{count(App\Order::where(['writer_id'=>$writer->id,'status'=>'approved'])->get())}}<br />
                          <strong>cancelled orders:</strong> {{count(App\Order::where(['writer_id'=>$writer->id,'status'=>'cancelled'])->get())}}<br />
                        </td>
                        <td>
                          <form method="POST" action="{{ route('admin.assign.update', $orderBids)}}" autocomplete="off" class="form-horizontal"> 
                            @method('PATCH')
                            @csrf
                            
                            @if(App\Order::where(['id'=> $orderBids, 'writer_id'=>$writer->id])->exists())
                              <input type="hidden" name="status" value="Unassign" readonly hidden>
                              <button type="button" class="btn btn-danger" data-original-title="" title="" onclick="confirm('{{ __("Remove order from this writer?") }}') ? this.parentElement.submit() : ''">
                                Unassign
                                <div class="ripple-container"></div> 
                              </button>
                            @else
                              <input type="hidden" name="writer_id" value="{{$writer->id}}" readonly hidden>
                              <button type="button" class="btn btn-success" data-original-title="" title="" onclick="confirm('{{ __("Assign order to this writer?") }}') ? this.parentElement.submit() : ''">
                                Assign
                                <div class="ripple-container"></div>
                              </button>
                            @endif
                            <p>
                              <a href="{{route('admin.writer.show',$writer->id)}}" target="_blank">
                                View education
                              </a>
                            </p>
                          </form>
                        </td>
                      </tr>
                  </tr>
                  @endforeach
                  <tr>
                    <td colspan="7">
                      <h4>
                        <strong>
                          Other writers
                        </strong>
                      </h4>
                    </td>
                  </tr>
                  @foreach ($otherWriters as $otherWriter)
                      <tr>
                        <td>
                          {{$loop->iteration}}
                        </td>
                        <td>
                          <a href="{{route('admin.writer.show', $otherWriter)}}" target="_blank">{{$otherWriter->id}}</a>
                        </td>
                        <td>
                          <a href="{{route('admin.writer.show', $otherWriter)}}" target="_blank">{{$otherWriter->name}}</a>
                        </td>
                        <td>
                          Client
                        <input id="input-1" required="true" name="rating" class="rating rating-loading" data-min="0" data-max="5" data-step="0.5" data-size="x"
                        value="{{App\Order::where(['writer_id'=>$otherWriter->id])->avg('rating')}}" readonly>
                        <p>
                          Editor
                          <input id="input-2" required="true" name="rating2" class="rating rating-loading" data-min="0" data-max="5" data-step="0.5" data-size="x"
                        value="{{App\EditorToWriterNote::where(['writer_id'=>$otherWriter->id])->avg('rating')}}" readonly>
                        </p>
                        </td>
                        <td>
                          <strong>Assigned orders:</strong> {{count(App\Order::where(['writer_id'=>$otherWriter->id,'status'=>'assigned','user_id'=>$userId])->get())}} <br />
                          <strong>Inprogress orders:</strong> {{count(App\Order::where(['writer_id'=>$otherWriter->id,'status'=>'inprogress','user_id'=>$userId])->get())}}<br />
                          <strong>Inediting orders:</strong> {{count(App\Order::where(['writer_id'=>$otherWriter->id,'status'=>'inediting','user_id'=>$userId])->get())}}<br />
                          <strong>completed orders:</strong> {{count(App\Order::where(['writer_id'=>$otherWriter->id,'status'=>'completed','user_id'=>$userId])->get())}}<br />
                          <strong>Inrevision orders:</strong> {{count(App\Order::where(['writer_id'=>$otherWriter->id,'status'=>'inrevision','user_id'=>$userId])->get())}}<br />
                          <strong>Approved orders:</strong> {{count(App\Order::where(['writer_id'=>$otherWriter->id,'status'=>'approved','user_id'=>$userId])->get())}}<br />
                          <strong>cancelled orders:</strong> {{count(App\Order::where(['writer_id'=>$otherWriter->id,'status'=>'cancelled','user_id'=>$userId])->get())}}<br />
                        </td>
                        <td>
                          <strong>Assigned orders:</strong> {{count(App\Order::where(['writer_id'=>$otherWriter->id,'status'=>'assigned'])->get())}} <br />
                          <strong>Inprogress orders:</strong> {{count(App\Order::where(['writer_id'=>$otherWriter->id,'status'=>'inprogress'])->get())}}<br />
                          <strong>Inediting orders:</strong> {{count(App\Order::where(['writer_id'=>$otherWriter->id,'status'=>'inediting'])->get())}}<br />
                          <strong>completed orders:</strong> {{count(App\Order::where(['writer_id'=>$otherWriter->id,'status'=>'completed'])->get())}}<br />
                          <strong>Inrevision orders:</strong> {{count(App\Order::where(['writer_id'=>$otherWriter->id,'status'=>'inrevision'])->get())}}<br />
                          <strong>Approved orders:</strong> {{count(App\Order::where(['writer_id'=>$otherWriter->id,'status'=>'approved'])->get())}}<br />
                          <strong>cancelled orders:</strong> {{count(App\Order::where(['writer_id'=>$otherWriter->id,'status'=>'cancelled'])->get())}}<br />
                        </td>
                        <td>
                          <form method="POST" action="{{ route('admin.assign.update',$orderBids)}}" autocomplete="off" class="form-horizontal"> 
                            @method('PATCH')
                            @csrf
                            @if(App\Order::where(['id'=> $orderBids, 'writer_id'=>$otherWriter->id])->exists()) 
                              <input type="hidden" name="status" value="Unassign" readonly hidden>
                              <button type="button" class="btn btn-danger" data-original-title="" title="" onclick="confirm('{{ __("Remove order from this writer?") }}') ? this.parentElement.submit() : ''">
                                Unassign
                                <div class="ripple-container"></div>
                              </button>
                            @else
                              <input type="hidden" name="writer_id" value="{{$otherWriter->id}}" readonly>
                              <button type="button" class="btn btn-success" data-original-title="" title="" onclick="confirm('{{ __("Assign order to this writer?") }}') ? this.parentElement.submit() : ''">
                                Assign
                                <div class="ripple-container"></div>
                              </button>
                            @endif
                            <p>
                              <a href="{{route('admin.writer.show',$otherWriter->id)}}" target="_blank">
                                View education
                              </a>
                            </p>
                          </form>
                        </td>
                      </tr>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              {{-- <div class="row">
                <div class="col-12 text-center d-flex justify-content-center pt-5">
                  {{$orders->links()}}
                </div>
              </div> --}}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@endauth