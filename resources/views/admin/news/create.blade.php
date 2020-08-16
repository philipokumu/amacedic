@auth('admin')

@extends('admin.layouts.app', ['activePage' => 'Create-news', 'titlePage' => __('Create News')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary row">
            <span class="col-6">
              <h4 class="card-title ">Create news</h4>
              <p class="card-category">Fill in all the details</p>
            </span>
            <span class="col-6">
              <a href="{{route('admin.news.index')}}" class='btn btn-info pull-right'>Back to list</a>
            </span>
          </div>
          
          <div class="modal-body">
            <span>
              <form method="POST" action="{{route('admin.news.store')}}" class="form-horizontal">
                @csrf
                <div class="col-lg-9 col-sm-12" style="background-color: #eee;">
                  <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }} pt-3">
                    <input class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" id="input-title" type="text" placeholder="{{ __('Title') }}" value="{{ old('title', auth()->user()->title) }}" required="true" aria-required="true" autocomplete="off" style="background-color: #fff;"/>
                    @if ($errors->has('title'))
                        <span id="title-error" class="error text-danger" for="input-title">{{ $errors->first('title') }}</span>
                    @endif
                  </div>
                  <div class="form-group{{ $errors->has('recipient') ? ' has-danger' : '' }}">
                    <select class="form-control{{ $errors->has('recipient') ? ' is-invalid' : '' }}" name="recipient" id="recipient" type="recipient" value="{{ old('recipient') }}" required style="background-color: #fff;">
                      <option selected disabled>-Select recipient-</option>
                      <option value="writers">To Writers</option>
                      <option value="clients">To Clients</option>
                      <option value="editors">To Editors</option>
                      <option value="all">To All</option>
                    </select> 
                    @if ($errors->has('recipient'))
                      <div id="recipient-error" class="error text-danger" for="recipient">{{ $errors->first('recipient') }}</div>
                    @endif
                  </div>
                  
                  <div class="form-group{{ $errors->has('newsItem') ? ' has-danger' : '' }}">
                    <textarea class="form-control{{ $errors->has('newsItem') ? ' is-invalid' : '' }}" rows="4" name="newsItem" id="input-newsItem" type="text" placeholder="{{ __(' Your message') }}" value="{{ old('newsItem')}}" required="true" aria-required="true"  style="background-color: #fff;"></textarea>
                    @if ($errors->has('newsItem'))
                      <span id="newsItem-error" class="error text-danger" for="input-newsItem">{{ $errors->first('newsItem') }}</span>
                    @endif
                  </div>
                </div>
                <button type="button" class="btn btn-info" data-original-title="submit" title="submit" onclick="confirm('{{ __("Send news?") }}') ? this.parentElement.submit() : ''">
                  Send news
                  <div class="ripple-container"></div> 
                </button>
              </form>
            </span>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@endauth