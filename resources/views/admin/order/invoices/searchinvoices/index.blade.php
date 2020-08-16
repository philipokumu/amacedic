@auth('admin')

@extends('admin.layouts.app', ['activePage' => 'Search-invoices', 'titlePage' => __('Search invoices')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
              <h4 class="card-title ">Active system users</h4>
              <p class="card-category">Select to view related invoices</p>
          </div>

          <div class="card-body">
            <div class="table-responsive">
              <table class="table">
                <thead class=" text-primary">
                <tr>
                  <th>
                    #
                  </th>
                  <th>
                    Invoicer ID
                  </th>
                  <th>
                    Role
                  </th>
                  <th>
                    Name
                  </th>
                  <th>
                    Status
                  </th>
                  <th>
                    Action
                  </th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($writers as $writer)
                    <tr>
                      <td>
                        {{$loop->iteration}}
                      </td>
                      <td>
                        {{$writer->id}}
                      </td>
                      <td>
                        {{$writer->role}}
                    </td>
                    <td>
                      {{$writer->name}}
                      </td>
                      <td>
                        {{$writer->status}}
                      </td>
                      <td>
                        <i><a href="{{route('admin.searchinvoices.show', ['role'=>$writer->role, 'user'=>$writer])}}">click to view orders in this<br /> invoice</a></i>

                      </td>
                    </tr>
                  @endforeach  
                  @foreach ($editors as $editor)
                    <tr>
                      <td>
                        {{$loop->iteration}}
                      </td>
                      <td>
                        {{$editor->id}}
                      </td>
                      <td>
                        {{$editor->role}}
                    </td>
                    <td>
                      {{$editor->name}}
                    </td>
                      <td>
                        {{$editor->status}}
                      </td>
                      <td>
                        <i><a href="{{route('admin.searchinvoices.show', ['role'=>$editor->role, 'user'=>$editor])}}">click to view orders in this<br /> invoice</a></i>
                      </td>
                    </tr>
                  @endforeach    
                  @foreach ($admins as $admin)
                    <tr>
                      <td>
                        {{$loop->iteration}}
                      </td>
                      <td>
                        {{$admin->id}}
                      </td>
                      <td>
                        {{$admin->role}}
                    </td>
                    <td>
                      {{$admin->name}}
                      </td>
                      <td>
                        {{$admin->status}}
                      </td>
                      <td>
                        <i><a href="{{route('admin.searchinvoices.show',['role'=>$admin->role, 'user'=>$admin])}}">click to view orders in this<br /> invoice</a></i>
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
  </div>
</div>

@endsection

@endauth