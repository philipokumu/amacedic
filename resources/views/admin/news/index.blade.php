@auth('admin')

@extends('admin.layouts.app', ['activePage' => 'News-list', 'titlePage' => __('News')])

@section('content')

<div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary row">
              <span class="col-sm-12">
                <h4 class="card-title ">All news</h4>
                <p class="card-category">Click to view the news</p>
              </span>
            </div>
            
            @include('forms/news/newsshow')

         </div>
       </div>
     </div>
   </div>
</div>

@endsection

@endauth