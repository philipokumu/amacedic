              <hr/>
              
              <div class="row">
                <div class="col-sm-10">
                  <div class="row">
                    @if (isset($referredBy)) 
                      <input type="text" name="referredBy" value="{{$referredBy}}" hidden readonly>
                    @endif
                    @if(isset($referralId)) 
                      <input type="text" name="referralId" value="{{$referralId}}" hidden readonly>
                    @endif
                    <label class="col-sm-3  col-form-label">{{ __('Academic level') }}</label>
                    <div class="btn-group">
                      <div class="row" data-toggle="buttons">
                        <label class="col-sm-3 btn btn-info btn-round active">
                          <input type="radio" name="academicLevel" value="1.0#High school" @if (old('academicLevel')=='1.0#High school') checked @endif>High school
                        </label>
                        <label class="btn btn-info btn-round col-sm-3">
                          <input type="radio" name="academicLevel" value="1.2#Undergrad" @if (old('academicLevel')=='1.2#Undergrad') checked @endif checked>Undergrad
                        </label>
                        <label class="btn btn-info btn-round col-sm-3">
                          <input type="radio" name="academicLevel" value="1.4#Masters" @if (old('academicLevel')=='1.4#Masters') checked @endif>Masters
                        </label>          
                        <label class="btn btn-info btn-round col-sm-3">
                          <input type="radio" name="academicLevel" value="1.6#Doctoral" @if (old('academicLevel')=='1.6#Doctoral') checked @endif>Doctoral
                        </label>        
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    <label class="col-sm-3 col-form-label">{{ __('Type of Paper') }}</label>
                    <div class="col-sm-5 col-lg-7 col-md-6">
                      <div class="form-group{{ $errors->has('typeOfPaper') ? ' has-danger' : '' }}">
                        <select class="form-control{{ $errors->has('typeOfPaper') ? ' is-invalid' : '' }}" title="-Select type of paper-" data-style="btn btn-link" name="typeOfPaper" id="typeOfPaper" type="typeOfPaper" value="{{ old('typeOfPaper') }}" required >
                            <option value="1.0#Essay (Any Type)" @if (old('typeOfPaper')=='1.0#Essay (Any Type)') selected @endif>Essay (Any Type)</option>
                            <option value="1.0#Article (Any Type)" @if (old('typeOfPaper')=='1.0#Article (Any Type)') selected @endif>Article (Any Type)</option>
                            <option value="1.0#Assignment" @if (old('typeOfPaper')=='1.0#Assignment') selected @endif>Assignment</option>
                            <option value="1.0#Content (Any Type)" @if (old('typeOfPaper')=='1.0#Content (Any Type)') selected @endif>Content (Any Type)</option>
                            <option value="1.0#Admission Essay" @if (old('typeOfPaper')=='1.0#Admission Essay') selected @endif>Admission Essay</option>
                            <option value="1.0#Annotated Bibliography" @if (old('typeOfPaper')=='1.0#Annotated Bibliograph') selected @endif>Annotated Bibliography</option>
                            <option value="1.0#Argumentative Essay" @if (old('typeOfPaper')=='1.0#Argumentative Essay') selected @endif>Argumentative Essay</option>
                            <option value="1.0#Article Review" @if (old('typeOfPaper')=='1.0#Article Review') selected @endif>Article Review</option>
                            <option value="1.0#Book/Movie Review" @if (old('typeOfPaper')=='1.0#Book/Movie Review') selected @endif>Book/Movie Review</option>
                            <option value="1.0#Business Plan" @if (old('typeOfPaper')=='1.0#Business Plan') selected @endif>Business Plan</option>
                            <option value="1.0#Capstone Project" @if (old('typeOfPaper')=='1.0#Capstone Project') selected @endif>Capstone Project</option>
                            <option value="1.0#Case Study" @if (old('typeOfPaper')=='1.0#Case Study') selected @endif>Case Study</option>
                            <option value="1.0#Coursework" @if (old('typeOfPaper')=='1.0#Coursework') selected @endif>Coursework</option>
                            <option value="1.0#Creative Writing" @if (old('typeOfPaper')=='1.0#Creative Writing') selected @endif>Creative Writing</option>
                            <option value="1.0#Critical Thinking" @if (old('typeOfPaper')=='1.0#Critical Thinking') selected @endif>Critical Thinking</option>
                            <option value="1.3#Dissertation" @if (old('typeOfPaper')=='1.3#Dissertation') selected @endif>Dissertation</option>
                            <option value="1.0#Dissertation chapter" @if (old('typeOfPaper')=='1.0#Dissertation chapter') selected @endif>Dissertation chapter</option>
                            <option value="1.0#Lab Report" @if (old('typeOfPaper')=='1.0#Lab Report') selected @endif>Lab Report</option>
                            <option value="1.2#Math Problem" @if (old('typeOfPaper')=='1.2#Math Problem') selected @endif>Math Problem</option>
                            <option value="1.0#Research Paper" @if (old('typeOfPaper')=='1.0#Research Paper') selected @endif>Research Paper</option>
                            <option value="1.0#Research Proposal" @if (old('typeOfPaper')=='1.2#Math Problem') selected @endif>Research Proposal</option>
                            <option value="1.0#Research Summary" @if (old('typeOfPaper')=='1.0#Research Summary') selected @endif>Research Summary</option>
                            <option value="1.0#Scholarship Essay" @if (old('typeOfPaper')=='1.0#Scholarship Essay') selected @endif>Scholarship Essay</option>
                            <option value="1.0#Speech" @if (old('typeOfPaper')=='1.0#Speech') selected @endif>Speech</option>
                            <option value="1.0#Statistic Project" @if (old('typeOfPaper')=='1.0#Speech') selected @endif>Statistic Project</option>
                            <option value="1.0#Term Paper" @if (old('typeOfPaper')=='1.0#Term Paper') selected @endif>Term Paper</option>
                            <option value="1.0#Thesis/Thesis Chapter" @if (old('typeOfPaper')=='1.0#Term Paper') selected @endif>Thesis/Thesis Chapter</option>
                            <option value="1.0#Other" @if (old('typeOfPaper')=='1.0#Other') selected @endif>Other</option>
                            <option value="1.0#Presentation or Speech" @if (old('typeOfPaper')=='1.0#Presentation or Speech') selected @endif>Presentation or Speech</option>
                            <option value="1.0#Q&A" @if (old('typeOfPaper')=='1.0#Q&A') selected @endif>Q&A</option>
                            <option value="1.0#speech work" @if (old('typeOfPaper')=='1.0#speech work') selected @endif>speech work</option>
                            <option value="1.0#Application Paper" @if (old('typeOfPaper')=='1.0#Application Paper') selected @endif>Application Paper</option>
                            <option value="1.0#Analysis" @if (old('typeOfPaper')=='1.0#Analysis') selected @endif>Analysis</option>
                            <option value="1.0#Memo/Letter" @if (old('typeOfPaper')=='1.0#Memo/Letter') selected @endif>Memo/Letter</option>
                            <option value="1.0#Outline" @if (old('typeOfPaper')=='1.0#Outline') selected @endif>Outline</option>
                            <option value="1.0#Personal reflection" @if (old('typeOfPaper')=='1.0#Personal reflection') selected @endif>Personal reflection</option>
                            <option value="1.0#Presentation/PPT" @if (old('typeOfPaper')=='1.0#Presentation/PPT') selected @endif>Presentation/PPT</option>
                            <option value="1.0#Report (Any type)" @if (old('typeOfPaper')=='1.0#Report (Any type)') selected @endif>Report (Any type)</option>
                            <option value="1.0#Response Essay" @if (old('typeOfPaper')=='1.0#Response Essay') selected @endif>Response Essay</option>
                            <option value="1.0#Acceptance letter" @if (old('typeOfPaper')=='1.0#Acceptance letter') selected @endif>Acceptance letter</option>
                            <option value="2.0#Online Exam" @if (old('typeOfPaper')=='2.0#Online Exam') selected @endif>Online Exam</option>
                            <option value="1.0#Revision Paper" @if (old('typeOfPaper')=='1.0#Revision Paper') selected @endif>Revision Paper</option>
                            <option value="1.3#Blog Writing" @if (old('typeOfPaper')=='1.3#Blog Writing') selected @endif>Blog Writing</option>
                            <option value="1.0#Executive Summary" @if (old('typeOfPaper')=='1.0#Executive Summary') selected @endif>Executive Summary</option>
                            <option value="1.0#Extended Revision" @if (old('typeOfPaper')=='1.0#Extended Revision') selected @endif>Extended Revision</option>
                            <option value="1.5#Microsoft Project" @if (old('typeOfPaper')=='1.5#Microsoft Project') selected @endif>Microsoft Project</option>
                            <option value="1.0#Progressive Paper" @if (old('typeOfPaper')=='1.0#Progressive Paper') selected @endif>Progressive Paper</option>
                            <option value="1.0#Dissertation Editing" @if (old('typeOfPaper')=='1.0#Dissertation Editing') selected @endif>Dissertation Editing</option>
                            <option value="1.3#Grant proposal" @if (old('typeOfPaper')=='1.3#Grant proposal') selected @endif>Grant proposal</option>
                            <option value="1.0#Paraphrase" @if (old('typeOfPaper')=='1.0#Paraphrase') selected @endif>Paraphrase</option>
                            <option value="1.5#Nursing calculations" @if (old('typeOfPaper')=='1.5#Nursing calculations') selected @endif>Nursing calculations</option>
                            <option value="1.0#Combined Sections" @if (old('typeOfPaper')=='1.0#Combined Sections') selected @endif>Combined Sections</option>
                            <option value="1.0#Dissertation editing" @if (old('typeOfPaper')=='1.0#Dissertation editing') selected @endif>Dissertation editing</option>
                            <option value="1.0#Proofreading/editing" @if (old('typeOfPaper')=='1.0#Proofreading/editing') selected @endif>Proofreading/editing</option>
                            <option value="2.0#Brochure" @if (old('typeOfPaper')=='2.0#Brochure') selected @endif>Brochure</option>
                            <option value="1.0#Paper Editing" @if (old('typeOfPaper')=='1.0#Paper Editing') selected @endif>Paper Editing</option>
                            <option value="3.0#Brochure" @if (old('typeOfPaper')=='3.0#Brochure') selected @endif>Brochure</option>
                            <option value="1.5# MS Project" @if (old('typeOfPaper')=='1.5# MS Project') selected @endif> MS Project</option>
                            <option value="1.4#Microsoft Office project" @if (old('typeOfPaper')=='1.4#Microsoft Office project') selected @endif>Microsoft Office project</option>
                            <option value="1.0#Resume" @if (old('typeOfPaper')=='1.0#Resume') selected @endif>Resume</option>
                            <option value="2.0#Concept Map" @if (old('typeOfPaper')=='2.0#Concept Map') selected @endif>Concept Map</option>
                            <option value="2.0#Poster" @if (old('typeOfPaper')=='2.0#Poster') selected @endif>Poster</option>
                            <option value="2.0#Flyer" @if (old('typeOfPaper')=='2.0#Flyer') selected @endif>Flyer</option>
                            <option value="2.5#Pamphlet presentation" @if (old('typeOfPaper')=='2.5#Pamphlet presentation') selected @endif>Pamphlet presentation</option>
                          </select>
  
                        @if ($errors->has('typeOfPaper'))
                          <span id="typeOfPaper-error" class="error text-danger" for="typeOfPaper">{{ $errors->first('typeOfPaper') }}</span>
                        @endif
                      </div>
                    </div>
                  </div>
  
                  <div class="row">
                    <label class="col-sm-3 col-form-label">{{ __('Subject Area') }}</label>
                    <div class="col-sm-7">
                      <div class="form-group{{ $errors->has('subjectArea') ? ' has-danger' : '' }}">
                        <select class="form-control{{ $errors->has('subjectArea') ? ' is-invalid' : '' }}" name="subjectArea" id="subjectArea" type="subjectArea" value="{{ old('subjectArea') }}??0" required >
                          <option value="1.0#general" @if (old('subjectArea')=='1.0#general') selected @endif>General</option>
                          <option value="1.0#Archaeology" @if (old('subjectArea')=='1.0#Archaeology') selected @endif>Archaeology</option>
                          <option value="1.0#Art & Humanities" @if (old('subjectArea')=='1.0#Art & Humanities') selected @endif>Art & Humanities</option>
                          <option value="1.0#Astronomy" @if (old('subjectArea')=='1.0#Astronomy') selected @endif>Astronomy</option>
                          <option value="1.0#Biology" @if (old('subjectArea')=='1.0#Biology') selected @endif>Biology</option>
                          <option value="1.0#Chemistry" @if (old('subjectArea')=='1.0#Chemistry') selected @endif>Chemistry</option>
                          <option value="1.0#Childcare" @if (old('subjectArea')=='1.0#Childcare') selected @endif>Childcare</option>
                          <option value="2.0#Computer science" @if (old('subjectArea')=='2.0#Computer science') selected @endif>Computer science</option>
                          <option value="1.0#Counseling" @if (old('subjectArea')=='1.0#Counseling') selected @endif>Counseling</option>
                          <option value="1.0#Criminology" @if (old('subjectArea')=='1.0#Criminology') selected @endif>Criminology</option>
                          <option value="2.0#Engineering" @if (old('subjectArea')=='2.0#Engineering') selected @endif>Engineering</option>
                          <option value="1.0#Ethics" @if (old('subjectArea')=='1.0#Ethics') selected @endif>Ethics</option>
                          <option value="1.0#Ethnic-Studies" @if (old('subjectArea')=='1.0#Ethnic-Studies') selected @endif>Ethnic-Studies</option>
                          <option value="1.0#Food-Nutrition" @if (old('subjectArea')=='1.0#Food-Nutrition') selected @endif>Food-Nutrition</option>
                          <option value="1.0#Healthcare" @if (old('subjectArea')=='1.0#Healthcare') selected @endif>Healthcare</option>
                          <option value="2.0#Law" @if (old('subjectArea')=='2.0#Law') selected @endif>Law</option>
                          <option value="1.0#Medicine" @if (old('subjectArea')=='1.0#Medicine') selected @endif>Medicine</option>
                          <option value="1.0#Nursing" @if (old('subjectArea')=='1.0#Nursing') selected @endif>Nursing</option>
                          <option value="1.0#Nutrition" @if (old('subjectArea')=='1.0#Nutrition') selected @endif>Nutrition</option>
                          <option value="1.0#Philosophy" @if (old('subjectArea')=='1.0#Philosophy') selected @endif>Philosophy</option>
                          <option value="1.0#Physical-Education" @if (old('subjectArea')=='1.0#Physical-Education') selected @endif>Physical-Education</option>
                          <option value="1.0#Psychology" @if (old('subjectArea')=='1.0#Psychology') selected @endif>Psychology</option>
                          <option value="1.0#Sociology" @if (old('subjectArea')=='1.0#Sociology') selected @endif>Sociology</option>
                          <option value="2.0#Statistics" @if (old('subjectArea')=='2.0#Statistics') selected @endif>Statistics</option>
                          </select>
  
                        @if ($errors->has('subjectArea'))
                          <span id="subjectArea-error" class="error text-danger" for="subjectArea">{{ $errors->first('subjectArea') }}</span>
                        @endif
                      </div>
                    </div>
                  </div>
  
                  <div class="row">
                    <label class="col-sm-3 col-form-label">{{ __('Title') }}</label>
                    <div class="col-sm-7">
                      <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                        <input class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" id="input-title" type="text" placeholder="{{ __('Title') }}" value="{{ old('title')}}" required="true" aria-required="true" maxlength="80"/>
                        @if ($errors->has('title'))
                          <span id="title-error" class="error text-danger" for="input-title">{{ $errors->first('title') }}</span>
                        @endif
                      </div>
                    </div>
                  </div>
  
                  <div class="row">
                    <label class="col-sm-3 col-form-label">{{ __('Paper instructions') }}</label>
                    <div class="col-sm-7">
                      <div class="form-group{{ $errors->has('paperInstructions') ? ' has-danger' : '' }}">
                        <textarea class="form-control{{ $errors->has('paperInstructions') ? ' is-invalid' : '' }}" rows="5" name="paperInstructions" id="input-paperInstructions" type="text" placeholder="{{ __('Paper instructions') }}" required="true" aria-required="true">{{ old('paperInstructions')}}</textarea>
                        @if ($errors->has('paperInstructions'))
                          <span id="paperInstructions-error" class="error text-danger" for="input-paperInstructions">{{ $errors->first('paperInstructions') }}</span>
                        @endif
                      </div>
                    </div>               
                  </div>

                  <div class="row">
                    <label class="col-sm-3 col-form-label">{{ __('File uploads') }}</label>
                    <div class="col-sm-7">
                      <div class="form-group{{ $errors->has('fileUploads') ? ' has-danger' : '' }}">
                        <div class="form-group{{ $errors->has('fileUploads') ? ' is-invalid' : '' }} dropzone text-center py-5" id="awesomeDropzone">
                          <div class="dz-message">
                            <p><strong>  Click here to upload files. Or drag and Drop your files here.</strong></p>
                          </div>
                        </div>
                        <input class="form-control" name="fileUuid" id="fileUuid" type="text" value=0 readonly hidden aria-hidden="true"/>
                      </div>
                    </div>               
                  </div>

                  <div class="row">
                    <label class="col-sm-3 col-form-label">{{ __('preferred Writer ID (optional)') }}</label>
                    <div class="col-sm-7">
                      <div class="form-group{{ $errors->has('preferredWriter_id') ? ' has-danger' : '' }}">
                        <input class="form-control{{ $errors->has('preferredWriter_id') ? ' is-invalid' : '' }}" name="preferredWriter_id" id="input-preferredWriter_id" type="text" placeholder="{{ __('e.g W51') }}" value="{{ old('preferredWriter_id')}}"/>
                        @if ($errors->has('preferredWriter_id'))
                          <span id="preferredWriter_id-error" class="error text-danger" for="input-preferredWriter_id">{{ $errors->first('preferredWriter_id') }}</span>
                        @endif
                      </div>
                    </div>
                  </div>
  
                  <div class="row">
                    <label class="col-sm-2 col-form-label">{{ __('Citation') }}</label>
                    <div class="btn-group col-sm-9">
                      <div class="row" data-toggle="buttons">
                        <label class="btn btn-info btn-round col-sm-1.5 active">
                          <input type="radio" name="citation" value="APA" @if (old('citation')=='APA') checked @endif checked>APA
                        </label>
                        <label class="btn btn-info btn-round col-sm-1.5">
                          <input type="radio" name="citation" value="MLA" @if (old('citation')=='MLA') checked @endif>MLA
                        </label>
                        <label class="btn btn-info  btn-round col-sm-2">
                          <input type="radio" name="citation" value="Havard" @if (old('citation')=='Havard') checked @endif>Havard
                        </label>          
                        <label class="btn btn-info btn-round col-sm-2">
                          <input type="radio" name="citation" value="Chicago" @if (old('citation')=='Chicago') checked @endif>Chicago
                        </label>        
                        <label class="btn btn-info btn-round col-sm-2">
                          <input type="radio" name="citation" value="Turabian" @if (old('citation')=='Turabian') checked @endif>Turabian
                        </label>   
                        <label class="btn btn-info btn-round col-sm-2">
                          <input type="radio" name="citation" value="Other" @if (old('citation')=='Other') checked @endif>Other
                        </label>
                      </div>
                    </div>                  
                  </div>
  
                  <div class="row">
                    <label class="col-sm-3"> Spacing </label>
                    <div class="col-sm-8 btn-group">
                      <div class="row" data-toggle="buttons">
                        <label class="btn btn-info btn-round col-sm-6">
                          <input type="radio" name="spacing" value="1.0#Double" @if (old('spacing')=='1.0#Double') checked @endif checked>Double spacing
                        </label>
                        <label class="col-sm-6 btn btn-info btn-round active">
                          <input type="radio" name="spacing" value="2.0#Single" @if (old('spacing')=='2.0#Single') checked @endif>Single spacing
                        </label>
                       </div>
                    </div>                  
                  </div>
  
                  <hr/>
  
                  <div class="card-title">
                    <h3>Pricing details</h3>
                  </div>
  
                  <hr/>
  
                  <div class="row">
                    <label class="col-sm-3"> Currency </label>
                    <div class="col-sm-8 btn-group">
                      <div class="row" data-toggle="buttons">
                        <label class="col-sm-3 btn btn-info btn-round active">
                          <input type="radio" name="currency" value="1.00#USD" @if (old('currency')=='1.00#USD') checked @endif checked>USD
                        </label>
                        <label class="btn btn-info btn-round col-sm-3">
                          <input type="radio"  name="currency" value="0.92#EUR" @if (old('currency')=='0.92#EUR') checked @endif>EUR
                        </label>
                        <label class="btn btn-info btn-round col-sm-3">
                          <input type="radio"  name="currency" value="0.81#GBP" @if (old('currency')=='0.81#GBP') checked @endif>GBP
                        </label>          
                        <label class="btn btn-info btn-round col-sm-3">
                          <input type="radio"   name="currency" value="1.53#AUD" @if (old('currency')=='1.53#AUD') checked @endif>AUD
                        </label>        
                      </div>
                    </div>                  
                  </div>
  
                  <div class="form-group row">
                    <div class="col-sm-3"> <label >Number of Pages</label></div>
                      <div class="input-group{{ $errors->has('noOfPages') ? ' has-danger' : '' }} col-sm-4">                  
                          
                        <button type="button" class="btn btn-info btn-round btn-num" data-field="noOfPages" data-type="minus">
                          <i class="fa fa-minus" aria-hidden="true"></i>
                        </button>
                    
                        <input type="number" name="noOfPages" id="noOfPages" class="form-control input-number border-default col-sm-12 text-center"  value="{{ old('noOfPages')??0}}" placeholder="0" min="0" max="100"/>
                        
                        <button type="button" class="btn btn-success btn-round btn-num" data-field="noOfPages" data-type="plus">
                          <i class="fa fa-plus"></i>
                        </button>
                        @if ($errors->has('noOfPages'))
                          <span id="noOfPages-error" class="error text-danger" for="input-noOfPages">{{ $errors->first('noOfPages') }}</span>
                        @endif         
                      </div>
                      <div class="col"><label class="noOfWords">300 words approx</label></div>
                  </div>

                  <div class="form-group row">
                    <div class="col-sm-3"> <label>Powerpoint slides</label></div>
                      <div class="input-group col-sm-4">                  
                          
                        <button type="button" class="btn btn-info btn-round btn-num" data-field="powerpointSlides" data-type="minus">
                          <i class="fa fa-minus" aria-hidden="true"></i>
                        </button>
                    
                        <input type="number" name="powerpointSlides" id="powerpointSlides" class="form-control input-number border-default col-sm-12 text-center" value="{{ old('powerpointSlides')??0}}" placeholder="0" min="0" max="100" />
                        <button type="button" class="btn btn-success btn-round btn-num" data-field="powerpointSlides" data-type="plus">
                          <i class="fa fa-plus"></i>
                        </button>
                        @if ($errors->has('powerpointSlides'))
                          <span id="powerpointSlides-error" class="error text-danger" for="input-powerpointSlides">{{ $errors->first('powerpointSlides') }}</span>
                        @endif                
                      </div>
                    </div>
  
                  <div class="form-group row">
                    <div class="col-sm-3"> <label>Sources</label></div>
                      <div class="input-group col-sm-4">                  
                        
                      <button type="button" class="btn btn-info btn-round btn-num" data-field="sources" data-type="minus">
                        <i class="fa fa-minus" aria-hidden="true"></i>
                      </button>
                  
                      <input type="number" name="sources" id="sources" class="form-control input-number border-default col-sm-12 text-center" value="{{ old('sources')??0}}" placeholder="0" min="0" max="100"/>
                      <button type="button" class="plus btn btn-success btn-round btn-num" data-field="sources" data-type="plus">
                        <i class="fa fa-plus"></i>
                      </button> 
                      @if ($errors->has('sources'))
                          <span id="sources-error" class="error text-danger" for="input-sources">{{ $errors->first('sources') }}</span>
                        @endif                
                    </div>
                  </div>

                  <!--Deadline start -->
                  <div class="row">
                    <label class="col-sm-3 col-form-label">{{ __('Deadline') }}</label>
                    <div class="col-sm-7">
                      <div class="form-group{{ $errors->has('deadline') ? ' has-danger' : '' }}">
                        <select class="form-control{{ $errors->has('deadline') ? ' is-invalid' : '' }}" title="-Select Deadline-" name="deadline" id="deadline" type="deadline" value="{{ old('deadline') }}" required >
                          @if (Carbon\Carbon::parse(Carbon\Carbon::now()->isoFormat('dddd h:m'))->isBetween(Carbon\Carbon::parse('Friday 15:00'),Carbon\Carbon::parse('Saturday 14:59')))
                          @else
                            <option value="28.0#2 hours" @if (old('deadline')=='28.0#2 hours') selected @endif>2 hours</option>
                            <option value="27.0#4 hours" @if (old('deadline')=='27.0#4 hours') selected @endif>4 hours</option>
                            <option value="26.0#6 hours" @if (old('deadline')=='26.0#6 hours') selected @endif>6 hours</option>
                            <option value="24.0#8 hours" @if (old('deadline')=='24.0#8 hours') selected @endif>8 hours</option>
                            <option value="23.0#12 hours" @if (old('deadline')=='23.0#12 hours') selected @endif>12 hours</option>
                            <option value="22.0#18 hours" @if (old('deadline')=='22.0#18 hours') selected @endif>18 hours</option>
                            <option value="21.0#24 hours" @if (old('deadline')=='21.0#24 hours') selected @endif>24 hours</option>
                          @endif
                          <option value="20.5#25 hours" @if (old('deadline')=='20.5#25 hours') selected @endif>25 hours</option>
                          <option value="19.0#48 hours" @if (old('deadline')=='19.0#48 hours') selected @endif>48 hours</option>
                          <option value="18.5#3 days" @if (old('deadline')=='18.5#3 days') selected @endif>3 days</option>
                          <option value="18.2#4 days" @if (old('deadline')=='18.2#4 days') selected @endif>4 days</option>
                          <option value="18.0#7 days" @if (old('deadline')=='18.0#7 days') selected @endif>7 days</option>
                          <option value="17.8#11 days" @if (old('deadline')=='17.8#11 days') selected @endif selected>11 days</option>
                          <option value="17.7#14 days" @if (old('deadline')=='17.7#14 days') selected @endif>14 days</option>
                          <option value="17.5#21 days" @if (old('deadline')=='17.5#21 days') selected @endif>21 days</option>
                          <option value="17.3#30 days" @if (old('deadline')=='17.3#30 days') selected @endif>30 days</option>
                          <option value="17.0#60 days" @if (old('deadline')=='17.0#60 days') selected @endif>60 days</option>
                        </select>
                        <small><span class="card-title estimatedTime"></span></small>
                        @if ($errors->has('deadline'))
                          <span id="deadline-error" class="error text-danger" for="deadline">{{ $errors->first('deadline') }}</span>
                        @endif
                      </div>
                    </div>
                  </div>
                  <!--Deadline end-->
                
              </form>

              <!--Order amount start-->
              <div class="col-lg-8 col-md-8 col-sm-12">
                <div class="card card-stats" style="background-color: #eee;">
                  <div class="card-header card-header-success card-header-icon">
                    <div class="row">
                      <div class="col-3">
                        <div class="card-icon">
                          <i class="material-icons">shopping_cart</i>
                        </div>
                      </div>
                      <div class="col-9 pt-3">
                        <div class="row text-right">
                          <label class="col paperTypeLabel"> </label>
                          <label class="col paperType"> </label>
                        </div>
                        <div class="row text-right">
                          <label class="col academicLevelLabel"> </label>
                          <label class="col academicLevel"> </label>
                        </div>
                        <div class="row text-right">
                          <label class="col pagesLabel"> </label>
                          <label class="col pagesValue"> </label>
                        </div>
                        <div class="row text-right -mb-2">
                          <label class="col slidesLabel"> </label>
                          <label class="col slidesValue"> </label>
                        </div>
                        <hr>
                        <div class="row text-right">
                          <label class="col subtotal"><strong>Sub total:</strong></label>
                          <label class="col card-title totalPrice"> </label>
                          <input class="form-control" name="totalPrice" id="totalPrice" type="number" value="0" readonly hidden/>
                          <input class="form-control" name="pagePrice" id="pagePrice" type="number" value="0" readonly hidden/>
                        </div>
                        @auth
                          <div class="row text-right -mb-2">
                            <label class="col coupon-label"></label>
                            <input class="form-control" name="couponCode" id="couponCode" type="text" value="" readonly hidden/>
                            <label class="col card-title discount"> </label>
                            <input class="form-control" name="discount" id="discount" type="number" value="0" readonly hidden/>
                            <input class="form-control" name="coupon-value" id="coupon-value" type="number" value="0" readonly hidden/>
                            <input class="form-control" name="coupon-type" id="coupon-type" type="text" value="" readonly hidden/>
                            <input class="form-control" name="coupon" id="coupon" type="text" value="" readonly hidden/>
                          </div>
                        @endauth
                        <hr>
                        <div class="row text-right">
                          <label class="col discountedTotalPriceLabel"></label>
                          <label class="col discountedTotalPriceValue"></label>
                        </div>
                      </div>
                    </div>
                    
                    @auth
                    <form action="{{route('user.coupon.store')}}" method="POST" id="couponform">
                      @csrf
                      <div class="input-group{{ $errors->has('couponCode') ? ' has-danger' : '' }} py-2">
                        <input class="form-control{{ $errors->has('couponCode') ? ' is-invalid' : '' }} pl-2" name="couponCode" id="input-couponCode" type="text" style="background-color: #fff;" placeholder="{{ __('Enter coupon') }}" autocomplete="off" value="" aria-required="true" required/>
                        <button type="submit" id = "submit-c"  class="btn btn-info submit-c">{{ __('Apply') }}</button>
                        @if ($errors->has('couponCode'))
                        <span id="couponCode-error" class="error text-danger" for="input-couponCode">{{ $errors->first('couponCode') }}</span>
                        @endif
                      </div>
                    </form>
                    <span id="couponCode-error" class="error text-danger" for="input-couponCode"></span>
                    @endauth
                    
                  </div>
              </div>
              <!--Order amount end-->
