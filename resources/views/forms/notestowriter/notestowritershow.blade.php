<div class="modal-body">
  @auth('writer')
  <h5>Overall rating: <input id="input-1" required="true" name="rating" class="rating rating-loading" data-min="0" data-max="5" data-step="0.5" data-size="x"
    value="{{$avgRating}}" readonly></h5>
  @endauth
  <div id="accordion" role="tablist">
    <div class="card card-collapse">
      @foreach ($editorNotes as $note)
          
    <div class="card-header pb-1" role="tab" id="heading.{{$loop->iteration}}">
          <h5 class="mb-0">
            <a data-toggle="collapse" href="#collapse.{{$loop->iteration}}" aria-expanded="true" aria-controls="collapse.{{$loop->iteration}}">
              <span class="pull-left">
                @if (auth('admin')->check()||auth('editor')->check())
                  <h5 class=""><strong>Writer: W{{$note->writer_id}}</strong></h5>
                  <p><label for="overallRating">Writer overall rating: </label> <input id="input-1" required="true" name="rating" class="rating rating-loading" data-min="0" data-max="5" data-step="0.5" data-size="x"
                      value="{{App\EditorToWriterNote::where('writer_id',$note->writer_id)->avg('rating')}}" readonly></p>
                @endif
                <p><label for="orderRating">Writer order rating: </label> <input id="input-1" required="true" name="rating" class="rating rating-loading" data-min="0" data-max="5" data-step="0.5" data-size="x"
                  value="{{$note->rating}}" readonly></p>
            </span>
                
              <span class="pull-right">
                <h6 class="">Date: {{$note->created_at->format('y-m-d')}}</h6>
                <i class="material-icons">keyboard_arrow_down</i>
              </span>
            </a>
          </h5>
        </div>
        <hr>
    
        <div id="collapse.{{$loop->iteration}}" class="collapse" role="tabpanel" aria-labelledby="heading.{{$loop->iteration}}" data-parent="#accordion">
          <div class="card-body">
            <span class="pull-left">
              {!!nl2br(e($note->noteToWriter))!!}
            </span>
            @auth('admin')
            <span class="pull-right">
              <form action="{{ route('admin.notes.delete',$note) }}" method="POST">
                @csrf
                @method('delete')
            
                <input type="text" value="{{$note->id}}" name="notes" hidden readonly>
                <button type="button" class="btn btn-danger btn-link" data-original-title="" title="" onclick="confirm('{{ __("Are you sure you want to delete this editor note?") }}') ? this.parentElement.submit() : ''">
                    <i class="material-icons">close</i>
                    <div class="ripple-container"></div>
                </button>
              </form>
            </span>
            @endauth
          </div>
        </div>
      @endforeach
    </div>
  </div>
</div>