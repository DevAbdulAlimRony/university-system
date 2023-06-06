@extends('frontend/layouts/master')

@section('main-content')

  <div class="page">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          @include('frontend.pages.teachers.partials.sidebar')
        </div>
        <div class="col-md-9">
          <h2 class="text-primary text-bold border-bottom-green float-left">My Profiles Link</h2>
          <h2 class="text-primary text-bold float-right">
            <a href="#addProfiles" data-target="#addProfiles" class="btn btn-info btn-rounded" data-toggle="modal"><i class="fa fa-plus"></i> Add Link</a>
          </h2>
          <div class="clearfix"></div>

          <div class="modal fade" id="addProfiles" role="dialog" aria-labelledby="deleteTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered animated slideInDown" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Add Link</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div id="addProfiles" class="card card-body mb-2 collapse">
                    <form class="" action="{!! route('teacher.profiles.store') !!}" method="post" enctype="multipart/form-data">
                      @csrf
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="title" class="col-form-label">Site Name</label>
                          <input type="text" name="title" id="title" placeholder="Site Name" class="form-control" required>
                          <div class="invalid-feedback">
                            Please give site name
                          </div>
                        </div>
                        <div class="form-group col-md-6">
                          <label for="link"  title="Profile link is required">Profile Link<span class="text-danger">*</span></label>
                          <input type="url" class="form-control" id="link" name="link" placeholder="Enter your profile link" required>
                        <div class="invalid-feedback">
                          Please give your profile link
                        </div>
                      </div>
                      </div>
                      <div class="form-row">
                        <div class="col-md-6">
                        
                        </div>
                        <div class="form-group col-md-6">
                          <button type="submit" class="btn btn-primary mt-4"><i class="fa fa-check"></i> Add Link</button>
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
                @if ($teacher->profiles->count() != 0)
                  <thead>
                    <tr>
                      <th width="10%">Sl No.</th>
                      <th width="20%">Website</th>
                      <th width="20%">Profile</th>
                      <th width="30%">Manage</th>
                    </tr>
                  </thead>
                @endif


                @php $i = 1; @endphp
                @foreach ($teacher->profiles as $profile)
                  <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $profile->title }}</td>
                    <td><a class="btn btn-link" target="_blank" href="{{ $profile->link }}">{{ $profile->link }}</a></td>
                    <td>
                      <a href="#delete" class="btn btn-danger" data-toggle="modal" ><i class="fa fa-trash"></i> Delete</a>

                      <a href="#editProfile{{ $profile->id }}" class="btn btn-info" data-toggle="modal" ><i class="fa fa-edit"></i> Edit</a>

                      <!-- Modal -->
                      <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="deleteTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLongTitle">Are you sure delete the link permanently ?</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form action="{!! route('teacher.profiles.delete', $profile->id) !!}" method="post" style="display:inline">
                                @csrf
                                <button type="submit" class="btn btn-primary"> <i class="fa fa-trash"></i> Yes ! Confirm</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                              </form>

                            </div>
                          </div>
                        </div>
                      </div>

                      <!-- Edit Modal -->
                      <div class="modal fade" id="editProfile{{ $profile->id }}" role="dialog" aria-labelledby="deleteTitle" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered animated slideInDown" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLongTitle">Edit Link</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <div id="addProfile" class="card card-body mb-2 collapse">
                                <form class="" action="{!! route('teacher.profiles.update', $profile->id) !!}" method="post" enctype="multipart/form-data">
                                  @csrf
                                  <div class="form-row">
                                    <div class="form-group col-md-6">
                                      <label for="title" class="col-form-label">Site Name</label>
                                      <input type="text" value="{{ $profile->title }}" name="title" id="title" placeholder="Site Name" class="form-control" required>
                                      <div class="invalid-feedback">
                                        Please give site name
                                      </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                      <label for="link"  title="Profile link is required">Profile Link<span class="text-danger">*</span></label>
                                      <input type="url" value="{{ $profile->link }}" class="form-control" id="link" name="link" placeholder="Enter your profile link" required>
                                    <div class="invalid-feedback">
                                      Please give your profile link
                                    </div>
                                  </div>
                                    
                                  </div>
                                  <div class="form-row">
                                    <div class="col-md-6">
                                      
                                    </div>
                                    <div class="form-group col-md-6">
                                      <button type="submit" class="btn btn-primary mt-7"><i class="fa fa-check"></i> Update Link</button>
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
                    @php $i++; @endphp
                  </tr>
                @endforeach

              </table>
              @if ($teacher->profiles->count() == 0)
                <div class="alert alert-danger">
                  <strong>Oh no !! You have no links has added yet !!! </strong>
                </div>
              @endif
            </div>

          </div>
        </div>

      </div>
    </div>



  </div> <!-- End Main Page Info -->


@endsection

