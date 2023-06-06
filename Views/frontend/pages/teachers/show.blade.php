@extends('frontend/layouts/master')

@section('title')
  {{ $teacher->first_name . ' ' . $teacher->last_name }} (Teacher) | {{ config('app.name') }}
@endsection

@section('main-content')

  <div class="page" >
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h2 class="text-primary text-bold  wow slideInLeft float-left" id="teacher">
            <span class="text-left">{{ $teacher->first_name .' '. $teacher->last_name }}</span>
            
            <span class="mt-2 badge badge-pill {{ $teacher->status ? 'badge-success' : 'badge-danger' }}">
              {{ $teacher->status ? 'On Duty' : 'On Leave' }}
            </span><br>
            <span class="text-left">{{ $teacher->designation->title }}</span>
          </h2>
          <h2 class="float-right wow slideInRight">
            <a href="{!! route('teachers.index') !!}" class="btn btn-primary btn-rounded btn-sm"><i class="fa fa-arrow-left"></i> See All Teachers</a>
          </h2>
          <div class="clearfix"></div>

          <div class="border-bottom-green"></div>
          <div class="single-profile-full">
            <div class="row">
              <div class="col-md-3 border-right">
                <img src="{!! asset(\App\Helpers\ReturnPathHelper::getTeacherImage($teacher->id)) !!}" alt="" class="img img-fluid rounded-circle"> <br  />

                @if (Auth::guard('teacher')->check())
                  @if (Auth::guard('teacher')->user()->id != $teacher->id)
                    <a href="#sendMessageModalFull" data-target="#sendMessageModalFull" class="mt-2 btn btn-success btn-rounded btn-sm" data-toggle="modal"><i class="fa fa-send"></i> Send him a message</a>
                    @include('frontend.pages.teachers.partials.sendMessageModalFull')
                  @endif

                @else
                  <a href="#sendMessageModalFull" data-target="#sendMessageModalFull" class="mt-2 btn btn-success btn-rounded btn-sm" data-toggle="modal" disabled><i class="fa fa-send"></i> Send him a message</a>
                @endif

                {{-- <ul>
                  <li>
                    @if ($teacher->profiles->count() != 0 )
                    @foreach ($teacher->profiles as $profile)
                     <a href="{{ $profile->link }}" target="_blank" class="mr-3" style="text-decoration: underline;">{{ $profile->title }}</a>
                    @endforeach
                     @endif
                 </li>
                </ul> --}}

                <a href="{!! route('teacher.materials', $teacher->username) !!}" class="btn btn-warning mt-5 btn-block btn-sm"><i class="fa fa-download"></i> Download My Course Materials</a>
              </div>
              @include('frontend.pages.teachers.partials.sendMessageModalFull')

              <div class="col-md-9 text-left">
                <div class="biography" style="margin-bottom: 10px; font-family: poppins; font-size: 120%;">
                  @if ($teacher->education != null &&  $teacher->education != '<p>&nbsp;</p>')
                  <h2 style="">About  {{ $teacher->first_name . ' ' . $teacher->last_name }} Shortly</h2>
                          {!! $teacher->education !!}
                        @else
                          <div class="">
                            
                          </div>
                        @endif
                </div>
                <div class="teacher-info-more wow slideInUp">
                  <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">

                      <a class="nav-item nav-link active" id="nav-primary-info-tab" data-toggle="tab" href="#nav-primary-info" role="tab" aria-controls="nav-primary-info" aria-selected="true">Primary Information</a>
                      <a class="nav-item nav-link" id="nav-education-tab" data-toggle="tab" href="#nav-education" role="tab" aria-controls="nav-education" aria-selected="false">Education</a>

                      <a class="nav-item nav-link" id="nav-research-tab" data-toggle="tab" href="#nav-research" role="tab" aria-controls="nav-research" aria-selected="false">Reasearches</a>
                      <a class="nav-item nav-link" id="nav-publication-tab" data-toggle="tab" href="#nav-publication" role="tab" aria-controls="nav-publication" aria-selected="false">Publications</a>
                      <a class="nav-item nav-link" id="nav-project-tab" data-toggle="tab" href="#nav-project" role="tab" aria-controls="nav-project" aria-selected="false">Projects</a>
                      <a class="nav-item nav-link" id="nav-award-tab" data-toggle="tab" href="#nav-award" role="tab" aria-controls="nav-award" aria-selected="false">Awards</a>
                      <a class="nav-item nav-link" id="nav-cv-tab" data-toggle="tab" href="#nav-cv" role="tab" aria-controls="nav-cv" aria-selected="false">CV</a>
                    </div>
                  </nav>
                  <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-primary-info" role="tabpanel" aria-labelledby="nav-primary-info-tab">
                      <div class="teacher-info-head">
                        <div class="border-bottom"></div>
                        <h2 class="mt-2 text-primary">Contact Information</h2>
                        <ul class="list-teacher-info">
                          <li><strong>Office Address : </strong> <i class="fa fa-address"></i> {{ $teacher->university_address }}</li>
                          <li><strong>Home Address : </strong> <i class="fa fa-address"></i> {{ $teacher->home_address }}</li>
                          <li><strong>Mobile No : </strong> <a href="tel:{{ $teacher->mobile_no }}"><i class="fa fa-phone"></i> {{ $teacher->mobile_no }}</a></li>
                          
                          @if ($teacher->phone_no != null && $teacher->phone_no != '')
                            <li><strong>Phone No : </strong> <a href="tel:{{ $teacher->phone_no }}"><i class="fa fa-phone"></i> {{ $teacher->phone_no }}</a></li>
                          @endif
                          
                          @if ($teacher->fax_no != null && $teacher->fax_no != '')
                            <li><strong>Pabx No : </strong> <a href="tel:{{ $teacher->fax_no }}"><i class="fa fa-fax"></i> {{ $teacher->fax_no }}</a></li>
                          @endif

                          <li><strong>Email : </strong> <a href="mailto:{{ $teacher->email }}"><i class="fa fa-envelope"></i> {{ $teacher->email }}</a></li>
                          
                          @if ($teacher->website_link != null && $teacher->website_link != '')
                            <li><strong>Website Link : </strong> <a href="{{ $teacher->website_link }}" target="_blank"><i class="fa fa-link"></i> {{ $teacher->website_link }}</a></li>
                          @endif
                          
                          @if ($teacher->facebook_link != null || $teacher->linkedin_link != null || $teacher->twitter_link != null)
                          
                            <li>
                                <strong>Social Links : </strong> 
                                <a href="{{ $teacher->facebook_link }}" target="_blank" class="mr-3"><i class="fa fa-facebook"></i> Facebook</a>
                                <a href="{{ $teacher->linkedin_link }}" target="_blank" class="mr-3"><i class="fa fa-linkedin"></i> LinkedIn</a>
                                <a href="{{ $teacher->twitter_link }}" target="_blank" class="mr-3"><i class="fa fa-twitter"></i> Twitter</a>
                            </li>
                          @endif

                        <li>
                        <strong>Reasearch Profile: </strong> 
                         @if ($teacher->profiles->count() != 0 )
                         @foreach ($teacher->profiles as $profile)
                          <a href="{{ $profile->link }}" target="_blank" class="mr-3" style="text-decoration: underline;">{{ $profile->title }}</a>
                         @endforeach
                          @endif
                        </li>
                        </ul>
                        <div class="border-bottom"></div>
                      </div>

                    </div>

          <div class="tab-pane fade" id="nav-education" role="tabpanel" aria-labelledby="nav-education-tab">                
          <div class="row">
            <div class="col-md-12">
              @if ($teacher->educations != null && $teacher->educations != '<p>&nbsp;</p>')
              <table class="table table-bordered table-responsive beautiful-table">
                @if ($teacher->educations->count() != 0)
                  <thead>
                    <tr>
                      <th width="20">Degree</th>
                      <th width="20%">Institute</th>
                      <th width="20%">Major/Group/Department/Faculty</th>
                      <th width="20%">Country</th>
                      <th width="20%">Passing Year</th>
                    </tr>
                  </thead>
                @endif

                @foreach ($teacher->educations as $education)
                  <tr>
                    <td>{{ $education->degree }}</td>
                    <td>{{ $education->institute }}</td>
                    <td>{{ $education->major }}</td>
                    <td>{{ $education->country }}</td>
                    <td>{{ $education->passing_year }}</td>
                  </tr>
                  @endforeach
                </table>
                @else
                <div class="text-danger">
                  No Education Information is updated by teacher yet !!
                </div>
              @endif
              </div>
            </div>
          </div>

                    <div class="tab-pane fade" id="nav-research" role="tabpanel" aria-labelledby="nav-research-tab">
                      <h2 class=" mt-2 text-primary">Researches</h2>
                      <div>
                        @if ($teacher->researches->count() != 0 )
                          @foreach ($teacher->researches as $research)

                            <div class="card single-news-border mt-2">
                              <div class="card-body pointer" onclick="location.href='{!! route('researches.show', $research->slug) !!}'">
                                <div class="row">
                                  <div class="col-md-3">
                                    <img src="{!! asset('images/defaults/journal.png') !!}" alt="" class="img img-fluid img-thumbnail width60"> <br>
                                    <span class="text-muted">Publication Date - {{ $research->publication_date }}</span>
                                  </div>
                                  <div class="col-md-9">
                                    <h5 class="card-title">{{ $research->title }}</h5>
                                    <a href="{!! route('researches.show', $research->slug) !!}" class="float-right btn btn-link btn-rounded btn-sm">Read More...</a>
                                  </div>
                                </div>
                              </div>
                            </div>
                          @endforeach

                        @else
                          <div class="text-danger">
                            No Research is updated by teacher yet !!
                          </div>
                        @endif
                      </div>
                    </div>

                    <div class="tab-pane fade" id="nav-publication" role="tabpanel" aria-labelledby="nav-publication-tab">

                      <h2 class="mt-2 text-primary">Publications</h2>
                      <div>
                        @if ($teacher->publications->count() != 0 )
                          @foreach ($teacher->publications as $publication)
                            <div class="card single-news-border mt-2">
                              <div class="card-body pointer" onclick="location.href='{!! route('publications.show', $publication->slug) !!}'">
                                <div class="row">
                                  <div class="col-md-3">
                                    <img src="{!! asset('images/defaults/journal.png') !!}" alt="" class="img img-fluid img-thumbnail width60"> <br>
                                    <span class="text-muted">Publication Date - {{ $publication->publication_date }}</span>
                                  </div>
                                  <div class="col-md-9">
                                    <h5 class="card-title">{{ $publication->title }}</h5>
                                    <a href="{!! route('publications.show', $publication->slug) !!}" class="float-right btn btn-link btn-rounded btn-sm">Read More...</a>
                                  </div>
                                </div>
                              </div>
                            </div>
                          @endforeach

                        @else
                          <div class="text-danger">
                            No Publication is updated by teacher yet !!
                          </div>
                        @endif
                      </div>
                    </div>

                    <div class="tab-pane fade" id="nav-project" role="tabpanel" aria-labelledby="nav-project-tab">

                      <h2 class="mt-2 text-primary">Projects</h2>
                      <div>
                        @if ($teacher->projects->count() != 0 )
                          @foreach ($teacher->projects as $project)
                            <div class="card single-news-border mt-2">
                              <div class="card-body pointer" onclick="location.href='{!! route('projects.show', $project->slug) !!}'">
                                <div class="row">
                                  <div class="col-md-3">
                                    <img src="{!! asset('images/defaults/journal.png') !!}" alt="" class="img img-fluid img-thumbnail width60"> <br>
                                    <span class="text-muted">Publication Date - {{ $project->publication_date }}</span>
                                  </div>
                                  <div class="col-md-9">
                                    <h5 class="card-title">{{ $project->title }}</h5>
                                    <a href="{!! route('projects.show', $project->slug) !!}" class="float-right btn btn-link btn-rounded btn-sm">Read More...</a>
                                  </div>
                                </div>
                              </div>
                            </div>
                          @endforeach

                        @else
                          <div class="text-danger">
                            No Project is updated by teacher yet !!
                          </div>
                        @endif
                      </div>
                    </div>


                    <div class="tab-pane fade" id="nav-award" role="tabpanel" aria-labelledby="nav-award-tab">
                      <h2 class="mt-2 text-primary">Awards</h2>
                      
                      <div>
                        @if ($teacher->awards != null &&  $teacher->awards != '<p>&nbsp;</p>')
                          {!! $teacher->awards !!}
                        @else
                          <div class="text-danger">
                            No Award is updated by teacher yet !!
                          </div>
                        @endif
                      </div>
                      <div class="border-bottom"></div>
                    </div>
                    <div class="tab-pane fade" id="nav-cv" role="tabpanel" aria-labelledby="nav-contact-tab">
                      <h2 class="mt-2 text-primary">Curriculame Vitae</h2>
                      <div class="cv">
                        @if ($teacher->cv_description != NULL && $teacher->cv_description != '<p>&nbsp;</p>')
                          {!! $teacher->cv_description !!}
                        @else
                          <div class="text-danger">
                            No CV is updated by teacher yet !!
                          </div>
                        @endif
                      </div>
                      @if ($teacher->cv_file != null)
                        <h3 class="mt-4 bold text-primary">See CV as PDF</h3>
                        <a target="_blank" href="{!! asset('files/cv/'. $teacher->cv_file) !!}">
                          <img src="{!! asset('images/defaults/pdf.png') !!}" alt="" class="img img-fluid width100">
                        </a>
                      @endif
                    </div>
                  </div>
                  <div class="mt-4 float-right teacher-info-more-links">
                    <a href="{!! route('faculties.show', $teacher->faculty->short_name) !!}" class="btn btn-success btn-rounded"> <i class="fa fa-arrow-left"></i> See More Teachers of his Faculty</a>
                    <a href="{!! route('departments.show', $teacher->department->short_name) !!}" class="btn btn-primary btn-rounded"> <i class="fa fa-arrow-left"></i> See More Teachers of his Department</a>
                  </div>
                </div>
              </div> <!-- End .col-md-9 -->

            </div>
          </div>
        </div>
        {{-- <div class="col-md-4">
        @include('frontend.partials.front-page-sidebar')
      </div> --}}
    </div>
  </div>
</div> <!-- End Main Page Info -->


@endsection

@section('scripts')

<!--<link rel="stylesheet" href="{!! asset('css/select2/select2.min.css') !!}" />-->
<!--<script src="{!! asset('js/select2/select2.min.js') !!}"></script>-->

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

  <script type="text/javascript">
  $('.select2SendTeacherMessage').select2();
  </script>

<style>
  .beautiful-table{
    font-size: 1.3em;
    font-family: patua;
    min-width: 100%;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
    position: relative;
    overflow-x: auto;
}
.beautiful-table thead tr{
    background-color: #386d81;
    color: #ffffff;
    text-align: center;
}
.beautiful-table thead{
  position: sticky;
  top: 0;
  
}
.beautiful-table th,
.beautiful-table td {
    padding: 12px 15px;
    text-align: center;
    vertical-align: center;
}
.beautiful-table tbody tr:last-of-type {
    border-bottom: 3px solid #386d81;
}
.report-title:hover{
  text-decoration: underline;
  cursor:pointer;
}

</style>
@endsection
