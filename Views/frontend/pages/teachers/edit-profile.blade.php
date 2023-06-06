@extends('frontend/layouts/master')

@section('title')
  My Dashboard - Edit Profile ({{ $teacher->first_name . ' ' . $teacher->last_name }})| {{ config('app.name') }}
@endsection

@section('stylesheets')
@endsection

@section('main-content')

  <div class="page" id="editPage">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          @include('frontend.pages.teachers.partials.sidebar')
        </div>
        <div class="col-md-9">
          <h2 class="text-primary text-bold border-bottom-green">Edit Profile</h2>
          <div class="edit-profile mt-2">
            <form action="{!! route('teacher.update') !!}" method="post" enctype="multipart/form-data" id="form">
              @csrf
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="first_name" class="col-form-label">First Name <strong class="text-danger">*</strong></label>
                  <input type="text" class="form-control" value="{{ $teacher->first_name }}" name="first_name" id="first_name" data-parsley-required>
                  <div class="invalid-feedback">
                    Please give your first name
                  </div>
                </div>
                <div class="form-group col-md-6">
                  <label for="last_name" class="col-form-label">Last Name</label>
                  <input type="text" class="form-control" value="{{ $teacher->last_name }}" name="last_name" id="last_name" required>
                  <div class="invalid-feedback">
                    Please give your last name
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="email" class="col-form-label">Email Address <strong class="text-danger">*</strong></label>
                  <input type="email" class="form-control" value="{{ $teacher->email }}" name="email" id="email" required>
                  <div class="invalid-feedback">
                    Please give your email address
                  </div>
                </div>
                <div class="form-group col-md-6">
                  <label for="username" class="col-form-label">Username <strong class="text-danger">*(e.g: For name S Rahman try username s-rahman)
                    <span class="text-info">
                      It will imporve looking your profile better.
                      Your Profile link will be like: <span class="text-primary">http://pstu.ac.bd/teachers/s-rahman</span>
                    </span>
                  </strong></label>
                  <input type="text" class="form-control" value="{{ $teacher->username }}" name="username" v-model="username" id="username" required>

                  <div class="username-check">
                    <span v-html="usernameStatus"></span>
                  </div>

                  <div class="invalid-feedback">
                    Please give your username
                  </div>
                </div>
                {{-- <div class="form-group col-md-2">
                <span id="usernameStatus">@{{ usernameStatus }}</span>
              </div> --}}
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="mobile_no" class="col-form-label">Mobile No. <strong class="text-danger">*</strong></label>
                <input type="text" class="form-control" value="{{ $teacher->mobile_no }}" name="mobile_no" id="mobile_no" required>
                <div class="invalid-feedback">
                  Please give your mobile number
                </div>
              </div>
              <div class="form-group col-md-6">
                <label for="faculty_id" class="col-form-label">Main Faculty <strong class="text-danger">*</strong></label>
                <select class="form-control" id="faculty_id" name="faculty_id" required>
                  @foreach($faculties as $faculty)
                    <option value="{{ $faculty->id }}" {{ $faculty->id == $teacher->faculty_id ? 'selected' : '' }}>
                      {{ $faculty->name }} ({{ $faculty->short_name }})
                    </option>
                  @endforeach
                </select>
                <div class="invalid-feedback">
                  Please choose your primary faculty
                </div>
              </div>

            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="department_id" class="col-form-label">Main Department <strong class="text-danger">*</strong></label>
                <select class="form-control select2DepartmentTeacher" id="department_id" name="department_id" required>
                  @foreach($departments as $department)
                    <option value="{{ $department->id }}" {{ $department->id == $teacher->department_id ? 'selected' : '' }} >
                      {{ $department->name }} ({{ $department->short_name }})
                    </option>
                  @endforeach
                </select>
                <div class="invalid-feedback">
                  Please choose your primary department
                </div>
              </div>
              <div class="form-group col-md-6">
                <label for="designation_id" class="col-form-label">Main Designation <strong class="text-danger">*</strong></label>
                <select class="form-control select2DesignationTeacher" id="designation_id" name="designation_id"  required>
                  @foreach($designations as $designation)
                    <option value="{{ $designation->id }}" {{ $designation->id == $teacher->designation_id ? 'selected' : '' }} >
                      {{ $designation->title }}
                    </option>
                  @endforeach
                </select>
                <div class="invalid-feedback">
                  Please choose your primary designation
                </div>
              </div>
            </div>
            
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="website_link" class="col-form-label">Your Website Link <strong class="text-info">(optional)</strong></label>
                <input type="url" class="form-control" value="{{ $teacher->website_link }}" name="website_link" id="website_link">
                <div class="invalid-feedback">
                  Please give a valid URL for your website
                </div>
              </div>                
              <div class="form-group col-md-6">
                <label for="facebook_link" class="col-form-label">Your Facebook Link <strong class="text-info">(optional)</strong></label>
                <input type="url" class="form-control" value="{{ $teacher->facebook_link }}" name="facebook_link" id="facebook_link">
                <div class="invalid-feedback">
                  Please give a valid URL for your facebook link
                </div>
              </div>
            </div>
                        
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="linkedin_link" class="col-form-label">Your Linked in Link <strong class="text-info">(optional)</strong></label>
                <input type="url" class="form-control" value="{{ $teacher->linkedin_link }}" name="linkedin_link" id="linkedin_link">
                <div class="invalid-feedback">
                  Please give a valid URL for your linkedin link
                </div>
              </div>                
              <div class="form-group col-md-6">
                <label for="twitter_link" class="col-form-label">Your Twitter Link <strong class="text-info">(optional)</strong></label>
                <input type="url" class="form-control" value="{{ $teacher->twitter_link }}" name="twitter_link" id="twitter_link">
                <div class="invalid-feedback">
                  Please give a valid URL for your twitter link
                </div>
              </div>
            </div>
            

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="home_address" class="col-form-label">Home Address <strong class="text-info">(optional)</strong></label>
                <input type="text" class="form-control" value="{{ $teacher->home_address }}" name="home_address" id="home_address">
              </div>
              <div class="form-group col-md-6">
                <label for="university_address" class="col-form-label">University Address <strong class="text-info">(optional)</strong></label>
                <input type="text" class="form-control" value="{{ $teacher->university_address }}" name="university_address" id="university_address">
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="phone_no" class="col-form-label">Phone No <strong class="text-info">(optional)</strong></label>
                <input type="text" class="form-control" value="{{ $teacher->phone_no }}" name="phone_no" id="phone_no">
              </div>
              <div class="form-group col-md-6">
                <label for="fax_no" class="col-form-label">Pabx No. <strong class="text-info">(optional)</strong></label>
                <input type="text" class="form-control" value="{{ $teacher->fax_no }}" name="fax_no" id="fax_no">
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="password" class="col-form-label">New Password <strong class="text-info">(optional)</strong></label>
                <input type="password" class="form-control" name="password" id="password">
              </div>
              <div class="form-group col-md-6">
                <label for="password_confirmation" class="col-form-label">Confirm New Password <strong class="text-info">(optional)</strong></label>
                <input type="password" class="form-control" value="{{ $teacher->password_confirmation }}" name="password_confirmation" id="password_confirmation">
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="education" class="col-form-label">Short Biography<strong class="text-info">(optional)</strong></label>
                <textarea name="education" class="form-control" rows="8" cols="70" id="editor">{!! $teacher->education !!}</textarea>
              </div>
              <div class="form-group col-md-6">
                <label for="awards" class="col-form-label">Received Awards <strong class="text-info">(optional)</strong></label>
                <textarea name="awards" class="form-control" rows="8" cols="70" id="editor2" required>{!! $teacher->awards !!}</textarea>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="completed_research" class="col-form-label">Add Research <strong class="text-info">(optional)</strong></label>
                <p><a href="{!! route('researches.create') !!}" target="_blank" class="btn btn-info btn-sm">Create A Research Now</a></p>
              </div>
              <div class="form-group col-md-6">
                <label for="completed_research" class="col-form-label">Add Publication <strong class="text-info">(optional)</strong></label>
                <p><a href="{!! route('publications.create') !!}" target="_blank" class="btn btn-info btn-sm">Create A Publication Now</a></p>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-12">
                <label for="cv_description" class="col-form-label">Write Curriculam Vitae - CV <strong class="text-info">(optional)</strong></label>
                <textarea name="cv_description" class="form-control" rows="8" cols="70" id="editor_cv">{!! $teacher->cv_description !!}</textarea>
              </div>
            </div>

            <div class="row">

              <div class="col-md-6">
                <div class="form-group mt-4">
                  <label for="image">Profile Picture (Choose to change Profile) <strong class="text-info">(optional)</strong> </label> <br  />
                  <a href="{!! asset(\App\Helpers\ReturnPathHelper::getTeacherImage($teacher->id)) !!}"><img src="{!! asset(\App\Helpers\ReturnPathHelper::getTeacherImage($teacher->id)) !!}" alt="" class="img img-fluid width100"></a>
                  <br /><br />

                  <input type="file" class="form-control" name="image" id="image">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group mt-4">
                  <label for="cv_file">CV File (Choose to change CV) <strong class="text-info">(optional)</strong></label> <br>
                  @if ($teacher->cv_file != null)
                    <a target="_blank" href="{!! asset('files/'. $teacher->cv_file) !!}">
                      <img src="{!! asset('images/defaults/pdf.png') !!}" alt="" class="img img-fluid width100">
                    </a>
                  @endif


                  <input type="file" class="form-control" name="cv_file" id="cv_file">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group mt-4">
                  <!-- Rounded switch to toggle teacher status-->
                  <label for="status">Your Current Status (Check To make you On duty otherwise uncheck it)</label>
                  <br>
                  <label class="switch">
                    <input type="checkbox" id="status" name="status" {{ $teacher->status ? 'checked' : '' }}>
                    <span class="slider round"></span>
                  </label>
                  <br>
                  <span>
                    @if ($teacher->status)
                      <span class="text text-success">Your mode is <mark>On duty</mark> Uncheck it to change your current status on leave and save</span>
                    @else
                      <span class="text text-danger">Your mode is  <mark>On Leave</mark> Check it to change your current status on duty and save</span>
                    @endif
                  </span>
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-success mt-2" name="submit"><i class="fa fa-check"></i> Save Informations</button>

          </form>
        </div>
      </div>

    </div>
  </div>

</div> <!-- End Main Page Info -->
@endsection

@section('scripts')
  <link rel="stylesheet" href="{!! asset('js/parsley/parsley.css') !!}" />
  <script type="text/javascript" src="{!! asset('js/parsley/parsley.min.js') !!}"></script>
  <script>
  $('#form').parsley();
</script>


<!--<link rel="stylesheet" href="{!! asset('css/select2/select2.min.css') !!}" />-->
<!--<script src="{!! asset('js/select2/select2.min.js') !!}"></script>-->

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

{{-- <script src="{!! asset('js/ckeditor/ckeditor-inline.js') !!}"></script> --}}
<script src="{!! asset('js/ckeditor/ckeditor-classic.js') !!}"></script>
<script>

</script>

{{-- <script  type="text/javascript" src="{!! asset('js/vue/vue.js') !!}"></script>
<script  type="text/javascript" src="{!! asset('js/vue/lodash.min.js') !!}"></script>
<script  type="text/javascript" src="{!! asset('js/vue/axios.min.js') !!}"></script> --}}

<script  type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.16/vue.min.js"></script>
<script  type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.10/lodash.min.js"></script>
<script  type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>



<script type="text/javascript">
window.addEventListener('load', function () {
  var app = new Vue({
    el: "#full_app",
    data:{
      username 			: '{{ $teacher->username }}',
      usernameStatus	 	: ""
    },
    mounted:function(){
      //For select2
      $('.select2DepartmentTeacher').select2();
      $('.select2DesignationTeacher').select2();

      ClassicEditor
      .create( document.querySelector( '#editor' ), {
        toolbar: [ 'bold', 'numberedList' ]
      })
      .catch( error => {
        console.error( error );
      } );

      ClassicEditor
      .create( document.querySelector( '#editor2' ), {
        toolbar: [ 'bold', 'numberedList' ]
      })
      .catch( error => {
        console.error( error );
      } );

      ClassicEditor
      .create( document.querySelector( '#editor3' ), {
        toolbar: [ 'bold', 'numberedList' ]
      })
      .catch( error => {
        console.error( error );
      } );

      ClassicEditor
      .create( document.querySelector( '#editor4' ), {
        toolbar: [ 'bold', 'numberedList' ]
      })
      .catch( error => {
        console.error( error );
      } );

      ClassicEditor
      .create( document.querySelector( '#editor_cv' ), {
        // toolbar: [ 'bold', 'numberedList' ]
      })
      .catch( error => {
        console.error( error );
      } );

    },
    watch: {
      username: function(){
        this.usernameStatus = ""
        if (this.username.length >= 1) {
          //starting to check the username
          this.lookUpUsername();
        }
      }
    },

    methods: {
      lookUpUsername: _.debounce(function(){
        var app = this;
        app.usernameStatus = "Checking...";
        app.username = app.username.toLowerCase();

        axios.get('{{ url("/") }}'+'/api/check-teacher/'+app.username)
        .then(function(response){
          if (app.username == '{{ $teacher->username }}') {
            app.usernameStatus = "<span class='text-primary'><i class='fa fa-check'></i> Username is available</span>"
          }else {
            app.usernameStatus = response.data.stat
          }

          // resultElement.innerHTML = generateSuccessHTMLOutput(response);
        })
      }, 500)
    }


  })
});
</script>

@endsection
