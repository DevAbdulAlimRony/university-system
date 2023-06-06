@extends('frontend/layouts/master')

@section('title')
  My Dashboard | {{ config('app.name') }}
@endsection

@section('main-content')

  <div class="page">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          @include('frontend.pages.teachers.partials.sidebar')
        </div>
        <div class="col-md-9">
          <h2 class="text-primary text-bold border-bottom-green">My Dashboard</h2>
          <div class="row">
            <div class="col-md-12">
              <h2>Hello {{ $teacher->first_name . ' '. $teacher->last_name }} Sir</h2>
              <p>
                Welcome to your dashboard panel. In this place you can change your
                Profile Informations, Your Educations, Your Completed research, Your interested research,
                Your Password and all other things.
              </p>
              <div class="mt-3">
                <div class="row text-center">
                  <div class="col-md-3">
                    <div class="card card-body bg-seen single-profile-full single-profile pointer wow slideInRight" onclick="location.href='{{ route('teacher.edit') }}'">
                      <h2 class="text-center mt-2">
                        <i class="fa fa-edit"></i> <br>
                        Change Profile
                      </h2>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="card card-body bg-seen single-profile-full single-profile pointer wow slideInRight" onclick="location.href='{{ route('teacher.educations.manage') }}'">
                      <h2 class="text-center mt-2">
                        <i class="fa fa-link"></i> <br>
                        Manage Educations
                      </h2>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="card card-body bg-seen single-profile-full single-profile pointer wow slideInRight" onclick="location.href='{{ route('teacher.messages') }}'">
                      <h2 class="text-center mt-2">
                        <i class="fa fa-envelope-open"></i> <br>
                        Inbox Messages
                        <span class="badge badge-success">{{ $teacher->messages->where('is_seen_by_receiver', 0)->count() }}</span>
                      </h2>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="card card-body bg-seen single-profile-full single-profile pointer wow slideInRight" onclick="location.href='{{ route('teacher.researches') }}'">
                      <h2 class="text-center mt-2">
                        <i class="fa fa-book"></i> <br>
                        Manage Researches
                      </h2>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="card card-body bg-seen single-profile-full single-profile pointer wow slideInRight" onclick="location.href='{{ route('teacher.publications') }}'">
                      <h2 class="text-center mt-2">
                        <i class="fa fa-book"></i> <br>
                        Manage Publications
                      </h2>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="card card-body bg-seen single-profile-full single-profile pointer wow slideInRight" onclick="location.href='{{ route('teacher.projects') }}'">
                      <h2 class="text-center mt-2">
                        <i class="fa fa-book"></i> <br>
                        Manage Projects
                      </h2>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="card card-body bg-seen single-profile-full single-profile pointer wow slideInRight" onclick="location.href='{{ route('teacher.materials.manage') }}'">
                      <h2 class="text-center mt-2">
                        <i class="fa fa-th"></i> <br>
                        Manage Materials
                      </h2>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="card card-body bg-seen single-profile-full single-profile pointer wow slideInRight" onclick="location.href='{{ route('teacher.profiles.manage') }}'">
                      <h2 class="text-center mt-2">
                        <i class="fa fa-link"></i> <br>
                        Manage </br> Links
                      </h2>
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="card card-body bg-seen single-profile-full single-profile pointer wow slideInRight" href="#changePassword" data-toggle="modal">
                      <h2 class="text-center mt-2">
                        <i class="fa fa-lock"></i> <br>
                        Change Password
                      </h2>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>

      </div>
    </div>

  </div> <!-- End Main Page Info -->
@endsection
