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
        <li class="breadcrumb-item active">Edit Teacher</li>
    </ol>

  <div class="admin-page">
    <h2 class="text-info">Teacher Information</h2>
    <form class="form-group" action="{{ route('admin.teachers.update', $teacher->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-row">
            <div class="col-md-6">
                <div class="form-group mt-2">
                    <label for="first_name">First Name <span class="text-danger"><b>*</b></span></label>
                    <input type="text" class="form-control" value="{{ $teacher->first_name }}" name="first_name" id="first_name">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mt-2">
                    <label for="last_name">Last Name</label>
                    <input type="text" class="form-control" value="{{ $teacher->last_name }}" name="last_name" id="last_name">
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-6">
                <div class="form-group mt-2">
                    <label for="email">Email <span class="text-danger"><b>*</b></span></label>
                    <input type="text" class="form-control" value="{{ $teacher->email }}" name="email" id="email">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mt-2">
                    <label for="mobile_no">Mobile No <span class="text-info"><b>(optional)</b></span></label>
                    <input type="text" class="form-control" value="{{ $teacher->mobile_no }}" name="mobile_no" id="mobile_no">
                </div>
            </div>
        </div>
        
        <div class="form-row">
            <div class="col-md-6">
                <div class="form-group mt-2">
                    <label for="phone_no">Phone No<span class="text-info"><b>(optional)</b></span></label>
                    <input type="text" class="form-control" value="{{ $teacher->phone_no }}" name="phone_no" id="phone_no">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mt-2">
                    <label for="website_link">Website Link <span class="text-info"><b>(optional)</b></span></label>
                    <input type="url" class="form-control" value="{{ $teacher->website_link }}" name="website_link" id="website_link">
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-6">
                <div class="form-group mt-2">
                    <label for="faculty_id">Faculty <span class="text-danger"><b>*</b></span> (If empty then add Faculty first <a href="{{ route('admin.faculties.create') }}"  target="_blank"> Here</a>)</label>
                    <select class="form-control select2-faculty" id="faculty_id" name="faculty_id">
                        @foreach($faculties as $faculty)
                            <option value="{{ $faculty->id }}"
                                @if($faculty->id == $teacher->faculty_id)
                                    selected
                                @endif
                                >
                                {{ $faculty->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mt-2">
                    <label for="department_id">Department <span class="text-danger"><b>*</b></span> (If empty then add Department first <a href="{{ route('admin.departments.create') }}"  target="_blank"> Here</a>)</label>
                    <select class="form-control select2-department" id="department_id" name="department_id">
                        @foreach($departments as $department)
                            <option value="{{ $department->id }}"
                                @if($department->id == $teacher->department_id)
                                    selected
                                @endif
                                >
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
                    <select class="form-control select2-designation" id="designation_id" name="designation_id">
                        @foreach($designations as $designation)
                            <option value="{{ $designation->id }}"
                                @if($designation->id == $teacher->designation_id)
                                    selected
                                @endif
                                >
                                {{ $designation->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mt-2">
                    <label for="fax_no">Fax Number </label>
                    <input type="text" class="form-control" value="{{ $teacher->fax_no }}" name="fax_no" id="fax_no">
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-6">
                <div class="form-group mt-2">
                    <label for="home_address">Permanent Address </label>
                    <input type="text" class="form-control" value="{{ $teacher->home_address }}" name="home_address" id="home_address">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mt-2">
                    <label for="university_address">University Address </label>
                    <input type="text" class="form-control" value="{{ $teacher->university_address }}" name="university_address" id="university_address">
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-6">
                <div class="form-group mt-2">
                    <label for="education">Short Biography</label>
                    <textarea name="education" rows="8" cols="70" id="education">{{ $teacher->education }}</textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mt-2">
                    <label for="image">Image @if($teacher->image) <a href="{{ asset('images/teachers/'.$teacher->image) }}" target="_blank" class="btn btn-success btn-sm"><i class="fa fa-fw fa-download"></i>Previous Image</a> @endif</label>
                    <input type="file" class="form-control" name="image" id="image">
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-6">
                <div class="form-group mt-4">
                    <label for="">On duty</label><br>
                    <label class="switch">
                      <input type="checkbox" name="on_duty" id="on_duty" value="1" @if($teacher->status == 1) checked @endif>
                      <span class="slider round"></span>
                    </label>
                </div>
            </div>
        </div>

        <div class="form-row">
          <div class="col-md-6"></div>
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
