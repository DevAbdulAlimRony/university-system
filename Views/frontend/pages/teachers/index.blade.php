@extends('frontend/layouts/master')

@section('main-content')

  <div class="page">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          @include('frontend.partials.front-page-sidebar')
        </div>
        <div class="col-md-9">
          <h2 class="text-primary text-bold border-bottom-green float-left">Search Teachers...</h2>
          <div class="float-right">
            {{-- <form class="form-inline" action="{!! route('teachers.search') !!}" method="get" style="display:inline">
            <div class="input-group mb-2">
            <input type="text" class="form-control" name="t" placeholder="Search Any Teacher" aria-label="Recipient's username" aria-describedby="basic-addon2" autofocus>
            <div class="input-group-append">
            <button class="btn btn-outline-danger" type="button"><i class="fa fa-search"></i></button>
          </div>
        </div>
      </form> --}}
      <form class="form-inline" action="{!! route('teachers.search') !!}" method="get" style="display:inline">
        <div class="input-group mb-2">
          <input type="search" name="t" class="form-control searchFormControl" v-model="search" v-on:keyup="searchTeacher()" placeholder="Please search teacher by typing name, email or anything">
          <div class="input-group-append">
            <button class="btn btn-outline-danger" type="submit"><i class="fa fa-search"></i></button>
          </div>
        </div>
      </form>

      <div v-if="!loading" class="card card-body searchDiv mb-2">
        <ul v-if="teachers.length">
          <a v-for="teacher in teachers" @click="goTeacher(teacher.username)" class="pointer dropdown-item">@{{ teacher.first_name }} @{{ teacher.last_name }} </a>
        </ul>
        <p class="text-danger" v-else>
          No teacher has found by <mark>@{{ search }}</mark>. Hit search button to get more relavant teachers
        </p>
      </div>
      <div v-else class="card card-body searchDiv mb-2">
        Searching ... <i class="fa fa-spinner fa-spin fa-2x fa-fw"></i>
      </div>



    </div>
    <div class="clearfix"></div>



    @if (Route::is('teachers.search'))
      <div class="alert alert-success">
        <p>
          Search - <mark>{{ $search }}</mark> <br>
          <mark>{{ $teachers->count() }}</mark> Teachers Found By this query
        </p>
      </div>
    @endif
    <div class="row">

      @php
      // Sort the teacher according to their designation
      $teachers_sorted = $teachers->sortBy('designation.priority');
      $teachers_sorted = $teachers_sorted->values()->all();
      @endphp
      @foreach ($teachers_sorted as $teacher)
        <div class="col-md-4 wow slideInRight">
          <div class="single-profile" onclick="location.href='{{ route('teachers.show', $teacher->username) }}'">
            <img src='{!! asset(\App\Helpers\ReturnPathHelper::getTeacherImage($teacher->id)) !!}' alt="" class="img img-fluid rounded-circle">
            <h3 class="mt-2 text-primary bold">{{ $teacher->first_name .' '. $teacher->last_name }}</h3>
            <p>{{ $teacher->designation->title }}</p>
          </div>
        </div>
      @endforeach

    </div>
    <div class="text-center mt-4">
      {{ $teachers->links() }}
    </div>

  </div>

</div>
</div>



</div> <!-- End Main Page Info -->


@endsection

@section('scripts')

{{-- <script  type="text/javascript" src="{!! asset('js/vue/vue.js') !!}"></script>
<script  type="text/javascript" src="{!! asset('js/vue/lodash.min.js') !!}"></script>
<script  type="text/javascript" src="{!! asset('js/vue/axios.min.js') !!}"></script> --}}

<script  type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.16/vue.min.js"></script>
<script  type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.10/lodash.min.js"></script>
<script  type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>


  <script>
  //Off the div
  $('.searchDiv').innerHTML = "sd";
  $('.searchDiv').hide();

  var app = new Vue({
    el: "#full_app",
    data:{
      search: '',
      loading: true,
      teachers: [],
    },
    methods: {
      searchTeacher() {
        if (this.search.length > 0) {
          $('.searchDiv').show('slow')
        }else{
          $('.searchDiv').hide('slow')
        }

        axios.get("{{ url('/') }}" + "/"+ 'api/teacher/search/'+this.search)
        .then(response => {
          this.teachers = response.data
          this.loading = false
        })
      },
      goTeacher(username){
        window.location = "{{ url('/') }}" + '/'+ 'teachers/'+username
      }
    }
  });

  </script>

@endsection
