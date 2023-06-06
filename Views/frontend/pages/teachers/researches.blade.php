@extends('frontend/layouts/master')

@section('main-content')

  <div class="page">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          @include('frontend.pages.teachers.partials.sidebar')
        </div>
        <div class="col-md-9">
          <h2 class="text-primary text-bold border-bottom-green float-left">My Researches</h2>
          <h2 class="text-primary text-bold float-right">
            <a href="{!! route('researches.create') !!}" class="btn btn-primary btn-rounded"><i class="fa fa-plus"></i> Add Research</a>
          </h2>
          <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-12">
              <table class="table table-bordered table-responsive">
                <tr>
                  <th width="10%">Sl No.</th>
                  <th width="20%">Title</th>
                  <th width="20%">View Link</th>
                  <th width="30%">Manage</th>
                </tr>

                @php $i = 1; @endphp
                @foreach ($teacher->researches as $research)
                  <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $research->title }}</td>
                    <td><a target="_blank" href="{{ route('researches.show', $research->slug) }}">{{ route('researches.show', $research->slug) }}</a></td>
                    <td>
                      <a href="{!! route('researches.edit', $research->slug) !!}" class="btn btn-info"><i class="fa fa-edit"></i> Edit</a>
                      <a href="#delete" class="btn btn-danger" data-toggle="modal" ><i class="fa fa-trash"></i> Delete</a>

                      <!-- Modal -->
                      <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="deleteTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLongTitle">Are you sure delete the journal ?</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form action="{!! route('researches.delete', $research->id) !!}" method="post" style="display:inline">
                              @csrf
                              <button type="submit" class="btn btn-primary"> <i class="fa fa-trash"></i> Yes ! Confirm</button>
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            </form>

                            </div>
                          </div>
                        </div>
                      </div>

                    </td>
                    @php $i++; @endphp
                  </tr>
                @endforeach

              </table>
            </div>

          </div>
        </div>

      </div>
    </div>



  </div> <!-- End Main Page Info -->


@endsection
