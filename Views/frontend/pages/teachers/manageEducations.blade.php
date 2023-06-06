@extends('frontend/layouts/master')

@section('main-content')

  <div class="page">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          @include('frontend.pages.teachers.partials.sidebar')
        </div>
        <div class="col-md-9">
          <h2 class="text-primary text-bold border-bottom-green float-left">My Educational Information</h2>
          <h2 class="text-primary text-bold float-right">
            <a href="#addEducations" data-target="#addEducations" class="btn btn-info btn-rounded" data-toggle="modal"><i class="fa fa-plus"></i> Add Degree</a>
          </h2>
          <div class="clearfix"></div>

          <div class="modal fade" id="addEducations" role="dialog" aria-labelledby="deleteTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered animated slideInDown" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Add Degree</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div id="addEducations" class="card card-body mb-2 collapse">
                    <form class="" action="{!! route('teacher.educations.store') !!}" method="post" enctype="multipart/form-data">
                      @csrf
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="degree" class="col-form-label">Degree Name<span class="text-danger">*</span></label>
                          <input type="text" name="degree" id="degree" placeholder="Degree Name" class="form-control" required>
                          <div class="invalid-feedback">
                            Please give degree name
                          </div>
                        </div>
                        <div class="form-group col-md-6">
                          <label for="major"  title="">Major Subject/Group/Department/Faculty<span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="major" name="major" placeholder=" Subject Name" required>
                        <div class="invalid-feedback">
                          Please give your major subject
                        </div>
                      </div></div>

                      <div class="form-row">
                        <div class="form-group col-md-12">
                          <label for="institute" class="col-form-label">Institute Name<span class="text-danger">*</span></label>
                          <input type="text" name="institute" id="institute" placeholder="Institute Name" class="form-control" required>
                          <div class="invalid-feedback">
                            Please give institute name
                          </div>
                        </div>
                      </div>

                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="country" class="col-form-label">Country Name<span class="text-danger">*</span></label>
                          <input type="text" name="country" id="country" placeholder="Country Name" class="form-control" required>
                          <div class="invalid-feedback">
                            Please give country name
                          </div>
                        </div>
                        <div class="form-group col-md-6">
                          <label for="year"  title="">Passing Year<span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="year" name="passing_year" placeholder="Passing Year">
                      
                      </div></div>
                      
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <button type="submit" class="btn btn-primary mt-4"><i class="fa fa-check"></i> Add Degree</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>



          <div class="row">
            <div class="col-md-12">
              <table class="table table-bordered table-responsive">
                @if ($teacher->educations->count() != 0)
                  <thead>
                    <tr>
                      <th width="10%">Degree</th>
                      <th width="28%">Institute</th>
                      <th width="17%">Major/Group/Department/Faculty</th>
                      <th width="10%">Country</th>
                      <th width="5%">Passing Year</th>
                      <th width="30%">Manage</th>
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
                    <td>
                      <a href="#delete" class="btn btn-danger" data-toggle="modal" ><i class="fa fa-trash"></i> Delete</a>
                      <a href="#editEducation{{ $education->id }}" class="btn btn-info" data-toggle="modal" ><i class="fa fa-edit"></i> Edit</a>
                    </td>

                      <!-- Modal -->
                      <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="deleteTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLongTitle">Are you sure delete the degree permanently ?</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form action="{!! route('teacher.educations.delete', $education->id) !!}" method="post" style="display:inline">
                                @csrf
                                <button type="submit" class="btn btn-primary"> <i class="fa fa-trash"></i> Yes ! Confirm</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                              </form>

                            </div>
                          </div>
                        </div>
                      </div>

                      <!-- Edit Modal -->
                      <div class="modal fade" id="editEducation{{ $education->id }}" role="dialog" aria-labelledby="deleteTitle" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered animated slideInDown" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLongTitle">Edit Degree</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <div id="addEducation" class="card card-body mb-2 collapse">
                                <form class="" action="{!! route('teacher.educations.update', $education->id) !!}" method="post" enctype="multipart/form-data">
                                  @csrf
                                  
                                  <div class="form-row">
                                    <div class="form-group col-md-6">
                                      <label for="degree" class="col-form-label">Degree Name<span class="text-danger">*</span></label>
                                      <input type="text" value={{ $education->degree }} name="degree" id="degree" placeholder="Degree Name" class="form-control" required>
                                      <div class="invalid-feedback">
                                        Please give degree name
                                      </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                      <label for="major"  title="">Major Subject/Group/Department/Faculty<span class="text-danger">*</span></label>
                                      <input type="text" value={{ $education->major }} class="form-control" id="major" name="major" placeholder=" Subject Name" required>
                                    <div class="invalid-feedback">
                                      Please give your major subject
                                    </div>
                                  </div></div>
            
                                  <div class="form-row">
                                    <div class="form-group col-md-12">
                                      <label for="institute" class="col-form-label">Institute Name<span class="text-danger">*</span></label>
                                      <input type="text" value={{ $education->institute }} name="institute" id="institute" placeholder="Institute Name" class="form-control" required>
                                      <div class="invalid-feedback">
                                        Please give institute name
                                      </div>
                                    </div>
                                  </div>
            
                                  <div class="form-row">
                                    <div class="form-group col-md-6">
                                      <label for="country" class="col-form-label">Country Name<span class="text-danger">*</span></label>
                                      <input type="text" value={{ $education->country }} name="country" id="country" placeholder="Country Name" class="form-control" required>
                                      <div class="invalid-feedback">
                                        Please give country name
                                      </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                      <label for="year"  title="">Passing Year<span class="text-danger">*</span></label>
                                      <input type="text" value={{ $education->passing_year }} class="form-control" id="year" name="passing_year" placeholder="Passing Year">
                                    
                                  </div></div>
                                  
                                  <div class="form-row">
                                    <div class="form-group col-md-6">
                                      <button type="submit" class="btn btn-primary mt-4"><i class="fa fa-check"></i> Edit Degree</button>
                                    </div>
                                  </div>

                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- End Edit Modal -->

                    </td>
                  </tr>
                @endforeach

              </table>
              @if ($teacher->educations->count() == 0)
                <div class="alert alert-danger">
                  <strong>Oh no !! You haven't added any information yet !!! </strong>
                </div>
              @endif
            </div>

          </div>
        </div>

      </div>
    </div>



  </div> <!-- End Main Page Info -->
@endsection

