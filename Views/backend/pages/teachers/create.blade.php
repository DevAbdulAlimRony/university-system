@extends('backend.layouts.master')

@section('stylesheets')
  <link rel="stylesheet" href="{{ asset('css/select2/select2.min.css') }}">
@endsection

@section('main-content')
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{!! route('admin.dashboard') !!}">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">
      <a href="{{ route('admin.teachers.index') }}">Teacher</a>
    </li>
    <li class="breadcrumb-item active">Add Teacher</li>
  </ol>

  <div class="admin-page">
    <h2 class="text-info">Teacher Information</h2>
    <form class="form-group" action="{{ route('admin.teachers.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="form-row">
        <div class="col-md-6">
          <div class="form-group mt-2">
            <label for="first_name">First Name <span class="text-danger"><b>*</b></span></label>
            <input type="text" class="form-control" placeholder="First Name" name="first_name" id="first_name" required>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group mt-2">
            <label for="last_name">Last Name</label>
            <input type="text" class="form-control" placeholder="Last Name" name="last_name" id="last_name">
          </div>
        </div>
      </div>

        <div class="form-row">
            <div class="col-md-6">
                <div class="form-group mt-2">
                    <label for="email">Email <span class="text-danger"><b>*</b></span></label>
                    <input type="text" class="form-control" name="email" id="email" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mt-2">
                    <label for="mobile_no">Mobile No <span class="text-info"><b>(optional)</b></span></label>
                    <input type="text" class="form-control" name="mobile_no" id="mobile_no">
                </div>
            </div>
        </div>
        
        <div class="form-row">
            <div class="col-md-6">
                <div class="form-group mt-2">
                    <label for="phone_no">Phone <span class="text-info"><b>(optional)</b></span></label>
                    <input type="text" class="form-control" name="phone_no" id="phone_no">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mt-2">
                    <label for="website_link">Website Link <span class="text-info"><b>(optional)</b></span></label>
                    <input type="text" class="form-control" name="website_link" id="website_link">
                </div>
            </div>
        </div>

      <div class="form-row">
        <div class="col-md-6">
          <div class="form-group mt-2">
            <label for="faculty_id">Faculty <span class="text-danger"><b>*</b></span> (If empty then add Faculty first <a href="{{ route('admin.faculties.create') }}"  target="_blank"> Here</a>)</label>
            <select class="form-control select2-faculty" id="faculty_id" name="faculty_id" required>
              <option value="">Select Faculty</option>
              @foreach($faculties as $faculty)
                <option value="{{ $faculty->id }}">
                  {{ $faculty->name }}
                </option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group mt-2">
            <label for="department_id">Department <span class="text-danger"><b>*</b></span> (If empty then add Department first <a href="{{ route('admin.departments.create') }}"  target="_blank"> Here</a>)</label>
            <select class="form-control select2-department" id="department_id" name="department_id" required>
              <option>Select Department</option>
              @foreach($departments as $department)
                <option value="{{ $department->id }}">
                  {{ $department->name }}
                </option>
              @endforeach
            </select>
          </div>
        </div>
      </div>

      <div class="form-row">
        <div class="col-md-6">
          <div class="form-group mt-2">
            <label for="designation_id">Designation <span class="text-danger"><b>*</b></span> (If empty then add Designation first <a href="{{ route('admin.designations.index') }}"  target="_blank"> Here</a>)</label>
            <select class="form-control select2-designation" id="designation_id" name="designation_id" required>
              <option>Select Designation</option>
              @foreach($designations as $designation)
                <option value="{{ $designation->id }}">
                  {{ $designation->title }}
                </option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group mt-2">
            <label for="fax_no">Fax Number </label>
            <input type="text" class="form-control" placeholder="Fax Number" name="fax_no" id="fax_no">
          </div>
        </div>
      </div>

      <div class="form-row">
        <div class="col-md-6">
          <div class="form-group mt-2">
            <label for="home_address">Permanent Address </label>
            <input type="text" class="form-control" placeholder="Permanent Address" name="home_address" id="home_address">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group mt-2">
            <label for="university_address">University Address </label>
            <input type="text" class="form-control" placeholder="University Address" name="university_address" id="university_address">
          </div>
        </div>
      </div>

      <div class="form-row">
        <div class="col-md-6">
          <div class="form-group mt-2">
            <label for="education">Short Biography</label>
            <textarea name="education" rows="8" cols="70" id="education"></textarea>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group mt-2">
            <label for="image">Image </label>
            <input type="file" class="form-control" name="image" id="image">
          </div>
        </div>
      </div>

      <div class="form-row">
        <div class="col-md-6">
            <div class="form-group">
                <label>On Duty</label><br>
                <label class="switch">
                  <input type="checkbox" value="1" name="on_duty" id="on_duty" checked>
                  <span class="slider round"></span>
                </label>
            </div>
        </div>
        <div class="col-md-6">
          <button type="submit" class="btn btn-primary float-right mt-2 btn-lg" name="submit">Save Information</button>
        </div>
      </div>
    </form>
  </div>

@endsection


@section('scripts')
  <script src="{{ asset('js/ckeditor/ckeditor-classic.js') }}"></script>
  <script src="{{ asset('js/select2/select2.min.js') }}"></script>
  <script>
  ClassicEditor
  .create( document.querySelector( '#education' ), {})
  .catch( error => {
    console.error( error );
  });

  $(document).ready(function () {
    //Initialize Select2 Elements
    $('.select2-designation').select2();
    $('.select2-department').select2();
    $('.select2-faculty').select2();
  });
  </script>
@endsection
