@extends('frontend/layouts/master')

@section('main-content')
  <div class="main-page-notices-news pt-5">
    <div class="container">
      <div class="row">
        <div class="col-md-8 wow slideInLeft">
          {{-- <h2 class="text-primary text-bold float-left">{{ $research->title }}</h2> --}}
          <h2 class="text-primary text-bold float-right">
            <a href="{!! route('researches.create') !!}" class="btn btn-primary btn-rounded"><i class="fa fa-plus"></i> Add Journal</a>
          </h2>
          <div class="clearfix"></div>
          <div class="card mt-2">
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <h2 class="text-primary text-bold">{{ $research->title }}</h2>
                  <div class="notice-date">
                    Publication Date - {{ $research->publication_date }}
                  </div>
                  <hr>
                </div>
                <div class="col-md-12">

                  <div class="card-text">
                    <p><strong>Research Title : </strong>{{ $research->title }}</p>
                    <p><strong>Researched By : </strong><a href="{!! route('teachers.show', $research->teacher->username) !!}">{{ $research->teacher->first_name. ' ' . $research->teacher->last_name }}</a></p>
                    <p><strong>Research Publication Date : </strong>{{ $research->publication_date }}</p>
                    <p><strong>Research Online Link : </strong><a href="{{ $research->link }}">{{ $research->link }}</a></p>
                    <div class="border-top">
                      <p><strong>Research Description : </strong></p>
                      {!! $research->description !!}
                      <br>
                      <br>
                      @if ($research->file != NULL || $research->file != "")
                        <p>
                          @php $ext = substr($research->file, strripos($research->file, '.')); @endphp
                          @if ( $ext == ".pdf" || $ext == ".PDF")
                            <img src="{!! asset('images/defaults/pdf.png') !!}" alt="" class="img img-fluid" style="width: 30px">
                          @else
                            <img src="{!! asset('images/defaults/zip.png') !!}" style="width: 30px">
                          @endif
                          <a href="{!! asset('files/researches/'.$research->file) !!}" class="btn btn-warning btn-sm"><i class="fa fa-fw fa-download"></i>Download File</a>
                        </p>
                      @endif
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> <!-- Upcoming News and Updates -->

        <!-- Notice Page Sidebar -->
        <div class="col-md-4">
          @include('frontend.pages.researches.sidebar')
          <h3>Recent Reserches</h3>

            @foreach ($researches as $research)
            <div class="card single-news-border mt-2">
              <div class="card-body pointer" onclick="location.href='{!! route('researches.show', $research->slug) !!}'">
                <div class="row">
                    <h6 class="card-title"> <img src="{!! asset('images/defaults/journal.png') !!}" alt="" class="img img-fluid img-thumbnail width60">  {{ $research->title }}</h6>
                  </div>
                </div>
              </div>
            @endforeach
        </div>



      </div>
    </div><!-- End container -->
  </div><!-- End Main Page Faculty div -->
@endsection
