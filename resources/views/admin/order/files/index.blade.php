@auth('admin')

@extends('admin.layouts.app', ['activePage' => 'Files', 'titlePage' => __('Files')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary row">
            <span class="col-sm-12">
              <h4 class="card-title ">All order files</h4>
              <p class="card-category">Delete all overstayed files not tied to an order i.e. with file Uuid or overstayed pending orders</p>
            </span>
          </div>
          
          <div class="modal-body">
            <table class="table -mb-2">
              <thead class=" text-primary">
                <tr>
                  <th>
                    Filename
                  </th>
                  <th>
                    File Uuid/#Order ID
                  </th>
                  <th>
                    Order status
                  </th>
                  <th>
                    Time since upload
                  </th>
                  <th>
                    Action
                  </th>
                </tr>
              </thead>
              <tbody>
                @foreach ($files as $file)
                <tr>
                  <td>
                    <a href="{{ asset('storage/fileuploads')}}/{{$file->filename}}" target="_blank">{{$file->filename}}</a>
                  </td>
                  <td>
                    @if ($file->fileUuid != NULL)
                      {{$file->fileUuid}}
                    @else
                      #{{$file->order_id}}
                    @endif
                  </td>
                  <td>
                    @if ($file->fileUuid == NULL)
                    {{$file->order->status}}
                    @endif
                  </td>
                  <td>
                    {{Carbon\CarbonInterval::make(Carbon\Carbon::parse($file->updated_at)->diff(Carbon\Carbon::now()))->cascade()->forHumans()}}
                  </td>
                  <td>
                      <form action="{{ route('admin.fileupload.delete', $file->filename) }}" method="POST">
                        @csrf
                    
                        <input type="text" value="{{$file->filename}}" name="id" hidden readonly>
                        <button type="button" class="btn btn-danger btn-link" data-original-title="" title="" onclick="confirm('{{ __("Are you sure you want to delete this file?") }}') ? this.parentElement.submit() : ''">
                            <i class="material-icons">close</i>
                            <div class="ripple-container"></div>
                        </button>
                      </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>

        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@endauth