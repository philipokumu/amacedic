<ul class="nav nav-pills nav-pills-primary col-md-12" role="tablist" id="tabMenu">
  <li class="nav-item">
  <a class="nav-link active" href="#accountinfo" data-toggle="tab">
      <i class="material-icons">account_box</i> Account info
      <div class="ripple-container"></div>
  </a>
  </li>
  @if (($owner=='writer')|| ($owner== 'editor'))
    <li class="nav-item">
      <a class="nav-link" href="#education" data-toggle="tab">
          <i class="material-icons">description</i> Education
          <div class="ripple-container"></div>
      </a>
    </li>
  @endif
  <li class="nav-item">
    <a class="nav-link" href="#payment" data-toggle="tab">
    <i class="material-icons">credit_card</i> Payment details
    <div class="ripple-container"></div>
    </a>
  </li>
</ul>
<hr>
</div>

<div class="tab-content">
<div class="tab-pane active" id="accountinfo">
    <div class="col-md-12">
      <div class="card-body ">

        <div class="row">
          <label class="col-sm-2 col-form-label">{{ __('Profile photo') }}</label>
          <div class="col-sm-3">
            <div class="fileinput fileinput-new text-center" data-provides="fileinput">
              <div class="fileinput-new thumbnail img-raised" style="max-width: 150px; max-height: 150px;" data-trigger="fileinput">
              @if (isset($profile->profilePhoto))
                <img class="img-fluid" src="{{asset('storage/profilephotos/'.$profile->profilePhoto) }}" alt="{{ $profile->name }}" style="max-width: 150px; max-height: 150px;">
              @else
                <img src="https://epicattorneymarketing.com/wp-content/uploads/2016/07/Headshot-Placeholder-1.png" alt="..." style="max-width: 150px; max-height: 150px;">
              @endif
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <label class="col-sm-2 col-form-label">{{ __('Name') }}</label>
          <div class="col-sm-7">
            <strong>{{$profile->name}}</strong>
            </div>
          </div>
          
        <div class="row">
          <label class="col-sm-2 col-form-label">{{ __('Email') }}</label>
          <div class="col-sm-7">
            <strong>{{$profile->email}}</strong>
          </div>
        </div>
        <div class="row">
          <label class="col-sm-2 col-form-label">{{ __('Status') }}</label>
          <div class="col-sm-7">
            <strong>{{$profile->status}}</strong>
          </div>
        </div>
        <div class="row">
          <label class="col-sm-2 col-form-label">{{ __('nickname') }}</label>
          <div class="col-sm-7">
            <strong>{{$profile->nickname}}</strong>
          </div>
        </div>
        <div class="row">
          <label class="col-sm-2 col-form-label">{{ __('country') }}</label>
          <div class="col-sm-7">
            <strong>{{$profile->country}}</strong>
          </div>
        </div>
        <div class="row">
          <label class="col-sm-2 col-form-label">{{ __('phone') }}</label>
          <div class="col-sm-7">
            <strong>{{$profile->phone}}</strong>
          </div>
        </div>
      </div>
    </div>

</div>

@if (($owner=='editor')||($owner=='writer'))
  <div class="tab-pane" id="education">
    <div class="col-md-12">
        <div class="card-body">
          <div class="row">
            <label class="col-sm-2 col-form-label">{{ __('Education Level') }}</label>
            <div class="col-sm-7">
              <strong>{{$profile->educationLevel}}</strong>
            </div>
          </div>

          <div class="row">
            <label class="col-sm-2 col-form-label">{{ __('My bio') }}</label>
            <div class="col-sm-7">
              <strong>{{$profile->bio}}</strong>
            </div>               
          </div>

          <div class="row">
            <label class="col-sm-2 col-form-label">{{ __('Subject area') }}</label>
            <div class="col-sm-7">
              @foreach ($subjects as $subject)
              <strong>{{$subject}},</strong>
              @endforeach
            </div>
          </div>
        </div>

    </div>
  </div>
@endif

<div class="tab-pane" id="payment">
  <div class="col-md-12">
    <div class="card-body ">

      <div class="row">
        <label class="col-sm-2 col-form-label">{{ __('Account type') }}</label>
        <div class="col-sm-7">
          <strong>{{$profile->accountType}}</strong>
        </div>
      </div>

      @if ($profile->accountType=='bank')
        <div class="row">
          <label class="col-sm-2 col-form-label">{{ __('Bank name') }}</label>
          <div class="col-sm-7">
            <strong>{{$profile->bankName}}</strong>
          </div>
        </div>
      @endif

      <div class="row">
        <label class="col-sm-2 col-form-label">{{ __('Account name') }}</label>
        <div class="col-sm-7">
          <strong>{{$profile->accountName}}</strong>
        </div>
      </div>

      <div class="row">
        <label class="col-sm-2 col-form-label">{{ __('Account number') }}</label>
        <div class="col-sm-7">
          <strong>{{$profile->accountNumber}}</strong>
        </div>
      </div>
    </div>
  </div>
</div>
</div>