
  <div class="modal-body -mb-6">
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
      @if ($owner=='admin'||$owner=='writer'||$owner=='editor')
        <li class="nav-item">
            <a class="nav-link" href="#payment" data-toggle="tab">
            <i class="material-icons">credit_card</i> Payment details
            <div class="ripple-container"></div>
            </a>
        </li>
      @endif
    </ul>
    <hr>
</div>

<div class="tab-content">
  <div class="tab-pane active" id="accountinfo">
    <form method="post" action="{{ route($owner.'.'.'profile.update') }}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
      @csrf
      @method('put')
      <div class="col-md-12">
        <div class="card-body ">

          @if ($owner=='admin'||$owner=='writer'||$owner=='editor')
            <div class="row">
              <label class="col-sm-2 col-form-label">{{ __('Profile photo') }}</label>
              <div class="col-sm-3">
                <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                  <div class="fileinput-new thumbnail img-raised" style="max-width: 150px; max-height: 150px;" data-trigger="fileinput">
                  @if (isset(auth()->user()->profilePhoto))
                    <img class="img-fluid" src="{{asset('storage/profilephotos/'.auth()->user()->profilePhoto) }}" alt="{{ auth()->user()->name }}" style="max-width: 150px; max-height: 150px;">
                  @else
                    <img src="https://epicattorneymarketing.com/wp-content/uploads/2016/07/Headshot-Placeholder-1.png" alt="..." style="max-width: 150px; max-height: 150px;">
                  @endif
                  </div>
                  <div class="fileinput-preview fileinput-exists thumbnail img-raised" style="max-width: 150px; max-height: 150px;"></div>
                  <div>
                <span class="btn btn-raised btn-round btn-rose btn-file">
                    <span class="fileinput-new">Select image</span>
                    <span class="fileinput-exists">Change</span>
                    <input type="file" name="profilePhoto" />
                </span>
                    <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput">
                    <i class="fa fa-times"></i> Remove</a>
                  </div>
              </div>
              @if ($errors->has('profilePhoto')) 
                  <span id="profilePhoto-error" class="error text-danger" for="input-profilePhoto">{{ $errors->first('profilePhoto') }}</span>
                @endif
              </div>
            </div>
          @endif

          <div class="row">
            <label class="col-sm-2 col-form-label">{{ __('Account ID') }}</label>
            <div class="col-sm-7">
              <div class="form-group{{ $errors->has('profileId') ? ' has-danger' : '' }}">
                @auth('admin')<input class="form-control{{ $errors->has('profileId') ? ' is-invalid' : '' }}" name="profileId" id="input-profileId" type="text" placeholder="{{ __('profileId') }}" value="{{ 'A'.auth()->id() }}" readonly/>@endauth
                @auth('writer')<input class="form-control{{ $errors->has('profileId') ? ' is-invalid' : '' }}" name="profileId" id="input-profileId" type="text" placeholder="{{ __('profileId') }}" value="{{ 'W'.auth()->id() }}" readonly/>@endauth
                @auth('editor')<input class="form-control{{ $errors->has('profileId') ? ' is-invalid' : '' }}" name="profileId" id="input-profileId" type="text" placeholder="{{ __('profileId') }}" value="{{ 'E'.auth()->id() }}" readonly/>@endauth
                @auth('web')<input class="form-control{{ $errors->has('profileId') ? ' is-invalid' : '' }}" name="profileId" id="input-profileId" type="text" placeholder="{{ __('profileId') }}" value="{{ 'C'.auth()->id() }}" readonly/>@endauth
                @if ($errors->has('profileId'))
                  <span id="profileId-error" class="error text-danger" for="input-profileId">{{ $errors->first('profileId') }}</span>
                @endif
              </div>
            </div>
          </div>

          <div class="row">
            <label class="col-sm-2 col-form-label">{{ __('Name') }}</label>
            <div class="col-sm-7">
              <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="input-name" type="text" placeholder="{{ __('Name') }}" value="{{ old('name', auth()->user()->name) }}" required="true" aria-required="true"/>
                @if ($errors->has('name'))
                  <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('name') }}</span>
                @endif
              </div>
            </div>
            
          </div>
          <div class="row">
            <label class="col-sm-2 col-form-label">{{ __('Email') }}</label>
            <div class="col-sm-7">
              <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="input-email" type="email" placeholder="{{ __('Email') }}" value="{{ old('email', auth()->user()->email) }}" required />
                @if ($errors->has('email'))
                  <span id="email-error" class="error text-danger" for="input-email">{{ $errors->first('email') }}</span>
                @endif
              </div>
            </div>
          </div>
          
          <div class="row">
            <label class="col-sm-2 col-form-label">{{ __('Status') }}</label>
            <div class="col-sm-7">
              @if(auth('admin')->check())
                <div class="form-group{{ $errors->has('status') ? ' has-danger' : '' }}">
                  <select class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" name="status" id="input-status" type="text" placeholder="{{ __('status') }}" required="true" aria-required="true">
                    <option disabled selected>-Select status-</option>
                    <option value="active" @if (old('status')=='active') selected @elseif (auth()->user()->status=='active') selected @endif>Active</option>
                    <option value="inactive" @if (old('status')=='inactive') selected  @elseif (auth()->user()->status=='inactive') selected @endif>Inactive</option>
                  </select>
                  @if ($errors->has('status'))
                    <span id="status-error" class="error text-danger" for="input-status">{{ $errors->first('status') }}</span>
                  @endif
                </div>
              @else 
                <input class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" name="status" id="input-status" type="text" placeholder="{{ __('status') }}" value="{{ auth()->user()->status }}" readonly/>
              @endif
            </div>
          </div>

          @if (auth('web')->check()==false)
            <div class="row">
              <label class="col-sm-2 col-form-label">{{ __('nickname') }}</label>
              <div class="col-sm-7">
                <div class="form-group{{ $errors->has('nickname') ? ' has-danger' : '' }}">
                  <input class="form-control{{ $errors->has('nickname') ? ' is-invalid' : '' }}" name="nickname" id="input-nickname" type="text" placeholder="{{ __('nickname') }}" value="{{ old('nickname', auth()->user()->nickname) }}"/>
                  @if ($errors->has('nickname'))
                    <span id="nickname-error" class="error text-danger" for="input-nickname">{{ $errors->first('nickname') }}</span>
                  @endif
                </div>
              </div>
            </div>
          @endif

          <div class="row">
            <label class="col-sm-2 col-form-label">{{ __('country') }}</label>
            <div class="col-sm-7">
              <div class="form-group{{ $errors->has('country') ? ' has-danger' : '' }}">
                <input class="form-control{{ $errors->has('country') ? ' is-invalid' : '' }}" name="country" id="input-country" type="text" placeholder="{{ __('country') }}" value="{{ old('country', auth()->user()->country) }}" required="true" aria-required="true"/>
                @if ($errors->has('country'))
                  <span id="country-error" class="error text-danger" for="input-country">{{ $errors->first('country') }}</span>
                @endif
              </div>
            </div>
          </div>
          <div class="row">
            <label class="col-sm-2 col-form-label">{{ __('phone') }}</label>
            <div class="col-sm-7">
              <div class="form-group{{ $errors->has('phone') ? ' has-danger' : '' }}">
                <input class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" id="input-phone" type="text" placeholder="{{ __('phone') }}" value="{{ old('phone', auth()->user()->phone) }}" required="true" aria-required="true"/>
                @if ($errors->has('phone'))
                  <span id="phone-error" class="error text-danger" for="input-phone">{{ $errors->first('phone') }}</span>
                @endif
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer ml-auto mr-auto pull-center">
          <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
        </div>
      </div>
    </form>
    
    <div class="row">
      <div class="col-md-12">
        <form method="post" action="{{ route($owner.'.'.'profile.password',auth()->user()) }}" class="form-horizontal">
          @csrf
          @method('put')

          <div class="card ">
            <div class="card-header card-header-primary">
              <h4 class="card-title">{{ __('Change password') }}</h4>
              <p class="card-category">{{ __('Password') }}</p>
            </div>
            <div class="card-body ">
              <div class="row">
                <label class="col-sm-2 col-form-label" for="input-current-password">{{ __('Current Password') }}</label>
                <div class="col-sm-7">
                  <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                    <input class="form-control{{ $errors->has('old_password') ? ' is-invalid' : '' }}" input type="password" name="old_password" id="input-current-password" placeholder="{{ __('Current Password') }}" value="" required />
                    @if ($errors->has('old_password'))
                      <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('old_password') }}</span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="row">
                <label class="col-sm-2 col-form-label" for="input-password">{{ __('New Password') }}</label>
                <div class="col-sm-7">
                  <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                    <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="input-password" type="password" placeholder="{{ __('New Password') }}" value="" required />
                    @if ($errors->has('password'))
                      <span id="password-error" class="error text-danger" for="input-password">{{ $errors->first('password') }}</span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="row">
                <label class="col-sm-2 col-form-label" for="input-password-confirmation">{{ __('Confirm New Password') }}</label>
                <div class="col-sm-7">
                  <div class="form-group">
                    <input class="form-control" name="password_confirmation" id="input-password-confirmation" type="password" placeholder="{{ __('Confirm New Password') }}" value="" required />
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer ml-auto mr-auto">
              <button type="submit" class="btn btn-primary" onclick="confirm('{{ __("Are you sure you want to change your password?!") }}') ? this.parentElement.submit() : ''">{{ __('Change password') }}</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  @if (($owner=='editor')||($owner=='writer'))
    <div class="tab-pane" id="education">
      <div class="col-md-12">
        <form method="post" action="{{ route($owner.'.'.'profile.education',auth()->user()) }}" autocomplete="off" class="form-horizontal">
          @csrf
          @method('put')
          <div class="card-body">
            <div class="row">
              <label class="col-sm-2 col-form-label">{{ __('Education Level') }}</label>
              <div class="col-sm-7">
                <div class="form-group{{ $errors->has('educationLevel') ? ' has-danger' : '' }}">
                  <select class="form-control{{ $errors->has('educationLevel') ? ' is-invalid' : '' }}" name="educationLevel" id="input-educationLevel" type="text" required="true" aria-required="true">
                    <option disabled selected>-Select education level-</option>
                    <option value="highschool" @if (old('educationLevel')=='highschool') selected @elseif (auth()->user()->educationLevel=='highschool') selected @endif>High school</option>
                    <option value="undergraduate" @if (old('educationLevel')=='undergraduate') selected @elseif (auth()->user()->educationLevel=='undergraduate') selected @endif>Under graduate</option>
                    <option value="postgraduate" @if (old('educationLevel')=='postgraduate') selected @elseif (auth()->user()->educationLevel=='postgraduate') selected @endif>Post graduate</option>
                    <option value="masters" @if (old('educationLevel')=='masters') selected @elseif (auth()->user()->educationLevel=='masters') selected @endif>Masters</option>
                    <option value="PHD" @if (old('educationLevel')=='PHD') selected @elseif (auth()->user()->educationLevel=='PHD') selected @endif>PHD</option>
                  </select>
                  @if ($errors->has('educationLevel'))
                    <span id="educationLevel-error" class="error text-danger" for="input-educationLevel">{{ $errors->first('educationLevel') }}</span>
                  @endif
                </div>
              </div>
            </div>

            <div class="row">
              <label class="col-sm-2 col-form-label">{{ __('My bio') }}</label>
              <div class="col-sm-7">
                <div class="form-group{{ $errors->has('bio') ? ' has-danger' : '' }}">
                  <textarea class="form-control{{ $errors->has('bio') ? ' is-invalid' : '' }}" rows="5" name="bio" id="input-bio" type="text" placeholder="{{ __('My bio') }}" required="true" aria-required="true">{{ old('bio', auth()->user()->bio)}}</textarea>
                  @if ($errors->has('bio'))
                    <span id="bio-error" class="error text-danger" for="input-bio">{{ $errors->first('bio') }}</span>
                  @endif
                </div>
              </div>               
            </div>

            <div class="row">
              <label class="col-sm-2 col-form-label">{{ __('Subject area') }}</label>
              <div class="col-sm-7">
                @foreach ($subjects as $subject)
                <strong>{{$subject}},</strong>
                @endforeach
                <table class="table -mb-2">
                  <tbody>
                    <tr>
                      <td>
                        <span class="form-check"><input type="checkbox" name="subjectArea[]" value="Archaeology">Archaeology</span>
                        <span class="form-check"><input type="checkbox" name="subjectArea[]" value="Architecture">Architecture</span>
                        <span class="form-check"><input type="checkbox" name="subjectArea[]" value="Arts">Arts</span>
                        <span class="form-check"><input type="checkbox" name="subjectArea[]" value="Astronomy">Astronomy</span>
                        <span class="form-check"><input type="checkbox" name="subjectArea[]" value="Biology">Biology</span>
                        <span class="form-check"><input type="checkbox" name="subjectArea[]" value="Business">Business</span>
                        <span class="form-check"><input type="checkbox" name="subjectArea[]" value="Chemistry">Chemistry</span>
                        <span class="form-check"><input type="checkbox" name="subjectArea[]" value="Childcare">Childcare</span>
                        <span class="form-check"><input type="checkbox" name="subjectArea[]" value="Computers">Computers</span>
                        <span class="form-check"><input type="checkbox" name="subjectArea[]" value="Counseling">Counseling</span>
                        <span class="form-check"><input type="checkbox" name="subjectArea[]" value="Criminology">Criminology</span>
                        <span class="form-check"><input type="checkbox" name="subjectArea[]" value="Economics">Economics</span>
                        <span class="form-check"><input type="checkbox" name="subjectArea[]" value="Education">Education</span>
                        <span class="form-check"><input type="checkbox" name="subjectArea[]" value="Engineering">Engineering</span>
                      </td>
                      <td>
                        <span class="form-check"><input type="checkbox" name="subjectArea[]" value="Environmental-Studies">Environmental-Studies</span>
                        <span class="form-check"><input type="checkbox" name="subjectArea[]" value="Ethics">Ethics</span>
                        <span class="form-check"><input type="checkbox" name="subjectArea[]" value="Ethnic-Studies">Ethnic-Studies</span>
                        <span class="form-check"><input type="checkbox" name="subjectArea[]" value="Finance">Finance</span>
                        <span class="form-check"><input type="checkbox" name="subjectArea[]" value="Food-Nutrition">Food-Nutrition</span>
                        <span class="form-check"><input type="checkbox" name="subjectArea[]" value="Geography">Geography</span>
                        <span class="form-check"><input type="checkbox" name="subjectArea[]" value="Healthcare">Healthcare</span>
                        <span class="form-check"><input type="checkbox" name="subjectArea[]" value="History">History</span>
                        <span class="form-check"><input type="checkbox" name="subjectArea[]" value="Law">Law</span>
                        <span class="form-check"><input type="checkbox" name="subjectArea[]" value="Linguistics">Linguistics</span>
                        <span class="form-check"><input type="checkbox" name="subjectArea[]" value="Literature">Literature</span>
                        <span class="form-check"><input type="checkbox" name="subjectArea[]" value="Management">Management</span>
                        <span class="form-check"><input type="checkbox" name="subjectArea[]" value="Marketing">Marketing</span>
                        <span class="form-check"><input type="checkbox" name="subjectArea[]" value="Mathematics">Mathematics</span>
                      </td>
                      <td>
                        <span class="form-check"><input type="checkbox" name="subjectArea[]" value="Medicine">Medicine</span>
                        <span class="form-check"><input type="checkbox" name="subjectArea[]" value="Music">Music</span>
                        <span class="form-check"><input type="checkbox" name="subjectArea[]" value="Nursing">Nursing</span>
                        <span class="form-check"><input type="checkbox" name="subjectArea[]" value="Philosophy">Philosophy</span>
                        <span class="form-check"><input type="checkbox" name="subjectArea[]" value="Physical-Education">Physical-Education</span>
                        <span class="form-check"><input type="checkbox" name="subjectArea[]" value="Physics">Physics</span>
                        <span class="form-check"><input type="checkbox" name="subjectArea[]" value="Political-Science">Political-Science</span>
                        <span class="form-check"><input type="checkbox" name="subjectArea[]" value="Programming">Programming</span>
                        <span class="form-check"><input type="checkbox" name="subjectArea[]" value="Psychology">Psychology</span>
                        <span class="form-check"><input type="checkbox" name="subjectArea[]" value="Religion">Religion</span>
                        <span class="form-check"><input type="checkbox" name="subjectArea[]" value="Sociology">Sociology</span>
                        <span class="form-check"><input type="checkbox" name="subjectArea[]" value="Statistics">Statistics</span>
                      </td>
                    </tr>
                  </tbody>
                </table>
                @if ($errors->has('subjectArea'))
                  <span id="subjectArea-error" class="error text-danger" for="input-subjectArea">{{ $errors->first('subjectArea') }}</span>
                @endif
              </div>
            </div>
          </div>

          <div class="card-footer ml-auto mr-auto">
            <button type="submit" class="btn btn-primary" onclick="confirm('{{ __("Are you sure you want to edit these details?!") }}') ? this.parentElement.submit() : ''">{{ __('Save') }}</button>
          </div>
        </form>
      </div>
    </div>
  @endif

  @if ($owner=='admin'||$owner=='writer'||$owner=='editor')
    <div class="tab-pane" id="payment">
      <div class="col-md-12">
        <form method="post" action="{{ route($owner.'.'.'profile.payment',auth()->user()) }}" autocomplete="off" class="form-horizontal">
          @csrf
          @method('put')
          <div class="card-body ">

            <div class="row">
              <label class="col-sm-2 col-form-label">{{ __('Account type') }}</label>
              <div class="col-sm-7">
                <div class="form-group{{ $errors->has('accountType') ? ' has-danger' : '' }}">
                  <select class="form-control{{ $errors->has('accountType') ? ' is-invalid' : '' }}" name="accountType" id="input-accountType" type="text" placeholder="{{ __('accountType') }}" required="true" aria-required="true">
                    <option disabled selected>-Select account type-</option>
                    <option value="bank" @if (old('accountType')=='bank') selected @elseif (auth()->user()->accountType=='bank') selected @endif>Bank</option>
                    <option value="mpesa" @if (old('accountType')=='mpesa') selected @elseif (auth()->user()->accountType=='mpesa') selected @endif>Mpesa</option>
                  </select>
                  @if ($errors->has('accountType'))
                    <span id="accountType-error" class="error text-danger" for="input-accountType">{{ $errors->first('accountType') }}</span>
                  @endif
                </div>
              </div>
            </div>

            <div class="row">
              <label class="col-sm-2 col-form-label">{{ __('Bank name') }}</label>
              <div class="col-sm-7">
                <div class="form-group{{ $errors->has('bankName') ? ' has-danger' : '' }}">
                  <input class="form-control{{ $errors->has('bankName') ? ' is-invalid' : '' }}" name="bankName" id="input-bankName" type="text" placeholder="{{ __('Only if your selected account type is bank. Leave empty otherwise') }}" value="{{ old('bankName', auth()->user()->bankName) }}"/>
                  @if ($errors->has('bankName'))
                    <span id="bankName-error" class="error text-danger" for="input-bankName">{{ $errors->first('bankName') }}</span>
                  @endif
                </div>
              </div>
            </div>

            <div class="row">
              <label class="col-sm-2 col-form-label">{{ __('Account name') }}</label>
              <div class="col-sm-7">
                <div class="form-group{{ $errors->has('accountName') ? ' has-danger' : '' }}">
                  <input class="form-control{{ $errors->has('accountName') ? ' is-invalid' : '' }}" name="accountName" id="input-accountName" type="text" placeholder="{{ __('Bank or Mpesa name') }}" value="{{ old('accountName', auth()->user()->accountName) }}" required="true" aria-required="true"/>
                  @if ($errors->has('accountName'))
                    <span id="accountName-error" class="error text-danger" for="input-accountName">{{ $errors->first('accountName') }}</span>
                  @endif
                </div>
              </div>
            </div>

            <div class="row">
              <label class="col-sm-2 col-form-label">{{ __('Account number') }}</label>
              <div class="col-sm-7">
                <div class="form-group{{ $errors->has('accountNumber') ? ' has-danger' : '' }}">
                  <input class="form-control{{ $errors->has('accountNumber') ? ' is-invalid' : '' }}" name="accountNumber" id="input-accountNumber" type="text" placeholder="{{ __('Bank or Mpesa number') }}" value="{{ old('accountNumber', auth()->user()->accountNumber) }}" required="true" aria-required="true"/>
                  @if ($errors->has('accountNumber'))
                    <span id="accountNumber-error" class="error text-danger" for="input-accountNumber">{{ $errors->first('accountNumber') }}</span>
                  @endif
                </div>
              </div>
            </div>

            <div class="card-footer ml-auto mr-auto">
              <button type="submit" class="btn btn-primary" onclick="confirm('{{ __("Are you sure you want to change these details?!") }}') ? this.parentElement.submit() : ''">{{ __('Save') }}</button>
            </div>

          </div>
        </form>
      </div>
    </div>
  @endif
</div>