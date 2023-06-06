@extends('frontend/layouts/master')

@section('main-content')
  <div class="main-page-notices-news pt-5">
    
    <div class="container">
      <div class="row">
        <div class="col-md-8 wow fadeIn">
            
          <div class="card mt-2">
            <div class="card-head mt-3 mb-3 p-3">
                <h2 style="font-family: 'Lato' sans-serif; color: #32677d;">{{ $reportSubCategory->subcategory_title }}</h2>
                <div class="notice-date">
                    {{ $reportSubCategory->created_at->toFormattedDateString() }} | {{ $reportSubCategory->created_at->diffForHumans() }}
                </div>
            </div>
            <div class="card-body row">
                <div class="col-12 ">
                    <table class="table table-bordered table-responsive beautiful-table">
                        @if ($reports->count() != 0)
                          <thead>
                            <tr>
                              <th width="50%">Title</th>
                              <th width="50%">Publish Date</th>
                              <th width="25%">Download</th>
                            </tr>
                          </thead>
                        @endif
        
                       <tbody>
                        @foreach ($reports as $file)
                        <tr>
                          <td class="report-title" onclick="location.href='{!! asset('files/cabinets/'.$file->file) !!}'">{{ $file->title }}</td>
                          <td>{{ $file->created_at->toFormattedDateString() }}</td>
                          <td>
                              <i fa fa-download></i>
                              <a href="{!! asset('files/cabinets/'.$file->file) !!}" class="sublink"><i class="fa fa-download"></i> Download</a>
                          </td>
                          </tr>
                      @endforeach
                       </tbody>
                        </table>
                </div>
                    @if ($reports->count() == 0)
                    <div class="alert alert-danger">
                      <strong>Oh no !! No Information has added yet !!! </strong>
                    </div>
                  @endif
            </div>
          </div>
        </div>

        <!-- Notice Page Sidebar -->
        <div class="col-md-4">
          @include('frontend.pages.notices.sidebar')
        </div>



      </div>
    </div><!-- End container -->
  </div><!-- End Main Page Faculty div -->
@endsection

@section(scripts)
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
    background-color: #28a745;
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
}
.beautiful-table tbody tr:last-of-type {
    border-bottom: 3px solid #28a745;
}
.report-title:hover{
  text-decoration: underline;
  cursor:pointer;
}

</style>
@endsection
