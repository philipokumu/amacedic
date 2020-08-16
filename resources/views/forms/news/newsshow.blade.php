         
<div class="modal-body">
  <div id="accordion" role="tablist">
    <div class="card card-collapse">
      @foreach ($newsCollection as $news)
          
    <div class="card-header" role="tab" id="heading.{{$loop->iteration}}">
          <h5 class="mb-0">
            <a data-toggle="collapse" href="#collapse.{{$loop->iteration}}" aria-expanded="true" aria-controls="collapse.{{$loop->iteration}}">
              <span class="pull-left">
                <h6>{{$news->title}}</h6>
                @auth('admin')<h6>To: {{$news->recipient}}</h6>@endauth
                <h6>{{$news->created_at->format('y-m-d')}} @auth('admin')by admin: {{$news->admin_id}}@endauth</h6>
              </span>
              <span class="pull-right">
                <i class="material-icons">keyboard_arrow_down</i>
              </span>
            </a>
          </h5>
        </div>
        <hr>
        <div id="collapse.{{$loop->iteration}}" class="collapse" role="tabpanel" aria-labelledby="heading.{{$loop->iteration}}" data-parent="#accordion">
          <div class="card-body">
            {!!nl2br(e($news->newsItem))!!}
          </div>
        </div>
      @endforeach
    </div>
  </div>
</div>