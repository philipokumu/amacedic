@auth('web')

@extends('layouts.app', ['activePage' => 'Unpaid', 'titlePage' => __('Unpaid order')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary row">
            <span class="col-6">
              <h4 class="card-title ">Order: {{$unpaidOrder['id']}}</h4>
              <p class="card-category">Title: {{$unpaidOrder['title']}}</p>
            </span>
            <span class="col-6">
              <a href="{{route('user.unpaid.index')}}" class='btn btn-info pull-right'>Back to list</a>
            </span>
          </div>
          <table class="table -mb-2">
            <thead class=" text-primary">
              <tr>
                <th>
                  <span class="pull-right">
                    <form action="{{ route('user.unpaid.destroy', $unpaidOrder) }}" method="post">
                      @csrf
                      @method('delete')
                  
                      <button type="button" class="btn btn-danger" onclick="confirm('{{ __("Are you sure you want to delete this order?") }}') ? this.parentElement.submit() : ''">
                          Delete
                      </button>
                    </form>
                  </span>
                  <span class="pull-right">
                    <form action="{{ route('user.unpaid.update', $unpaidOrder) }}" method="post">
                      @csrf
                      @method('patch')
                      <button type="button" class="btn btn-success" data-original-title="" title="" onclick="confirm('{{ __("Pay for this order?") }}') ? this.parentElement.submit() : ''">
                        Pay
                      </button>
                    </form>
                  </span>
                </th>
              </tr>
            </thead>
          </table>

          @include('forms/unpaid/unpaidshow')
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@endauth