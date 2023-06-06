<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
  <a class="navbar-brand" href="{!! route('admin.dashboard') !!}">PSTU Admin Panel</a>
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarResponsive">
    <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
    @if(Auth::guard('admin')->check())
      <li class="nav-item {{ Route::is('admin.dashboard') ? 'sidenav-active' : '' }}" data-toggle="tooltip" data-placement="right" title="Dashboard">
        <a class="nav-link" href="{!! route('admin.dashboard') !!}">
          <i class="fa fa-fw fa-dashboard"></i>
          <span class="nav-link-text">Dashboard</span>
        </a>
      </li>
      <li class="nav-item {{ (Route::is('admin.notices.index') || Route::is('admin.notices.create') || Route::is('admin.notices.edit') || Route::is('admin.admissions.notices.create') || Route::is('admin.admissions.notices.edit')) ? 'sidenav-active' : '' }}" data-toggle="tooltip" data-placement="right" title="Manage Notices">
        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#manageNotices" data-parent="#exampleAccordion">
          <i class="fa fa-fw fa-exchange"></i>
          <span class="nav-link-text">Manage Notices</span>
        </a>
        <ul class="sidenav-second-level collapse {{ (Route::is('admin.notices.index') || Route::is('admin.notices.show') || Route::is('admin.admissions.notices.index') || Route::is('admin.admissions.notices.create') || Route::is('admin.notices.create') || Route::is('admin.notices.edit') || Route::is('admin.admissions.notices.edit')) ? 'show' : '' }}" id="manageNotices">
          <li>
            <a href="{!! route('admin.notices.index') !!}">Manage Notices</a>
          </li>
          <li>
            <a href="{!! route('admin.admissions.notices.index') !!}">Manage Admission Notices</a>
          </li>
        </ul>
      </li>
      <li class="nav-item {{ (Route::is('admin.admissions.index') || Route::is('admin.admissions.create') || Route::is('admin.admissions.edit')) ? 'sidenav-active' : '' }}" data-toggle="tooltip" data-placement="right" title="Manage Admissions">
        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#manageAdmissions" data-parent="#exampleAccordion">
          <i class="fa fa-fw fa-exchange"></i>
          <span class="nav-link-text">Manage Admissions</span>
        </a>
        <ul class="sidenav-second-level collapse {{ (Route::is('admin.admissions.index') || Route::is('admin.admissions.show') || Route::is('admin.admissions.edit') || Route::is('admin.admissions.create')) ? 'show' : '' }}" id="manageAdmissions">
          <li>
            <a href="{!! route('admin.admissions.notices.index') !!}">Manage Admission Notices</a>
          </li>
          <li>
            <a href="{!! route('admin.admissions.index') !!}">Manage Admission Type</a>
          </li>
        </ul>
      </li>
      <li class="nav-item {{ (Route::is('admin.forms.index') || Route::is('admin.formCategories.index')) ? 'sidenav-active' : '' }}" data-toggle="tooltip" data-placement="right" title="Manage Forms">
        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#manageForms" data-parent="#exampleAccordion">
          <i class="fa fa-fw fa-user"></i>
          <span class="nav-link-text">Manage Forms</span>
        </a>
        <ul class="sidenav-second-level collapse {{ (Route::is('admin.forms.index') || Route::is('admin.formCategories.index')) ? 'show' : '' }}" id="manageForms">
          <li>
            <a href="{!! route('admin.forms.index') !!}">Manage Forms</a>
          </li>
          <li>
            <a href="{!! route('admin.formCategories.index') !!}">Manage Form Categories</a>
          </li>
        </ul>
      </li>

      <!--Cabinet Files Manage Menu-->
      <li class="nav-item {{ (Route::is('admin.cabinetCategories.index')) ? 'sidenav-active' : '' }}" data-toggle="tooltip" data-placement="right" title="Manage Reports">
        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#manageCabinets" data-parent="#exampleAccordion">
          <i class="fa fa-fw fa-user"></i>
          <span class="nav-link-text">Report Files</span>
        </a>
        <ul class="sidenav-second-level collapse {{ (Route::is('admin.cabinetCategories.index')) ? 'show' : '' }}" id="manageCabinets">
          <li>
            <a href="{!! route('admin.cabinetCategories.index') !!}">Report Categries</a>
          </li>
         <li>
            <a href="{!! route('admin.cabinetSubCategories.index') !!}">Report Sub Vategories</a>
          </li>
          <li>
            <a href="{!! route('admin.cabinetFiles.index') !!}">Report Files</a>
          </li>
        </ul>
      </li>

      <li class="nav-item {{ (Route::is('admin.administrators.index') || Route::is('admin.administrators.create') || Route::is('admin.administrators.edit')) ? 'sidenav-active' : '' }}" data-toggle="tooltip" data-placement="right" title="Manage Administrators">
        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#manageAdministrators" data-parent="#exampleAccordion">
          <i class="fa fa-fw fa-user"></i>
          <span class="nav-link-text">Manage Administrators</span>
        </a>
        <ul class="sidenav-second-level collapse {{ (Route::is('admin.administrators.index') || Route::is('admin.administrators.show') || Route::is('admin.administrators.create') || Route::is('admin.administrators.edit')) ? 'show' : '' }}" id="manageAdministrators">
          <li>
            <a href="{!! route('admin.administrators.index') !!}">Manage Administrators</a>
          </li>
          <li>
            <a href="{!! route('admin.offices.index') !!}">Manage Offices</a>
          </li>
        </ul>
      </li>
      <li class="nav-item {{ (Route::is('admin.teachers.index') || Route::is('admin.teachers.create') || Route::is('admin.teachers.edit') || Route::is('admin.teachers.departments')) ? 'sidenav-active' : '' }}" data-toggle="tooltip" data-placement="right" title="Manage Teachers">
        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#manageTeachers" data-parent="#exampleAccordion">
          <i class="fa fa-fw fa-user"></i>
          <span class="nav-link-text">Manage Teachers</span>
        </a>
        <ul class="sidenav-second-level collapse {{ (Route::is('admin.teachers.index') || Route::is('admin.teachers.show') || Route::is('admin.teachers.create') || Route::is('admin.teachers.departments') || Route::is('admin.teacher.departmentSort') || Route::is('admin.teachers.editPriority') || Route::is('admin.teachers.edit')) ? 'show' : '' }}" id="manageTeachers">
          <li>
            <a href="{!! route('admin.teachers.index') !!}">Manage Teachers</a>
          </li>
          <li>
            <a href="{!! route('admin.teachers.create') !!}">Add Teacher</a>
          </li>
          <li>
            <a href="{!! route('admin.project.index') !!}">Manage Project</a>
          </li>
          <li>
            <a href="{!! route('admin.teachers.departments') !!}">Department wise sorting</a>
          </li>
        </ul>
      </li>
      <li class="nav-item {{ (Route::is('admin.governances.index') || Route::is('admin.governances.create') || Route::is('admin.governanceType.index') || Route::is('admin.governances.edit')) ? 'sidenav-active' : '' }}" data-toggle="tooltip" data-placement="right" title="Manage Governance">
        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#manageGovernances" data-parent="#exampleAccordion">
          <i class="fa fa-fw fa-user"></i>
          <span class="nav-link-text">Manage Governances</span>
        </a>
        <ul class="sidenav-second-level collapse {{ (Route::is('admin.governances.index') || Route::is('admin.governances.create') || Route::is('admin.governanceType.index') || Route::is('admin.governances.edit')) ? 'show' : '' }}" id="manageGovernances">
          <li>
            <a href="{!! route('admin.governances.index') !!}">Manage Governances</a>
          </li>
          <li>
            <a href="{!! route('admin.governanceType.index') !!}">Manage Governance Types</a>
          </li>
        </ul>
      </li>
      <li class="nav-item {{ (Route::is('admin.employees.index') || Route::is('admin.employees.create')) ? 'sidenav-active' : '' }}" data-toggle="tooltip" data-placement="right" title="Manage Employees">
        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#manageEmployees" data-parent="#exampleAccordion">
          <i class="fa fa-fw fa-user"></i>
          <span class="nav-link-text">Manage Employees</span>
        </a>
        <ul class="sidenav-second-level collapse {{ (Route::is('admin.employees.index') || Route::is('admin.employees.show')) ? 'show' : '' }}" id="manageEmployees">
          <li>
            <a href="{!! route('admin.employees.index') !!}">Manage Employees</a>
          </li>
          <li>
            <a href="{!! route('admin.offices.index') !!}">Manage Offices</a>
          </li>
        </ul>
      </li>
      
      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Manage Pages">
        <a class="nav-link" href="{{ route('admin.page.index') }}">
          <i class="fa fa-fw fa-dashboard"></i>
          <span class="nav-link-text">Manage Pages</span>
        </a>
      </li>
      
      
      <li class="nav-item {{ (Route::is('admin.collaborations.index') || Route::is('admin.collaborations.create') || Route::is('admin.collaborations.edit')) ? 'sidenav-active' : '' }}" data-toggle="tooltip" data-placement="right" title="Manage Collaboration">
        <a class="nav-link" href="{{ route('admin.collaborations.index') }}">
          <i class="fa fa-fw fa-exchange"></i>
          <span class="nav-link-text">Manage Collaborations</span>
        </a>
      </li>
      <li class="nav-item {{ (Route::is('admin.nocs.index') || Route::is('admin.nocs.create') || Route::is('admin.nocs.edit')) ? 'sidenav-active' : '' }}" data-toggle="tooltip" data-placement="right" title="Manage NOC">
        <a class="nav-link" href="{{ route('admin.nocs.index') }}">
          <i class="fa fa-fw fa-exchange"></i>
          <span class="nav-link-text">Manage NOC</span>
        </a>
      </li>
      <li class="nav-item {{ (Route::is('admin.courses.index') || Route::is('admin.courses.edit')) ? 'sidenav-active' : '' }}" data-toggle="tooltip" data-placement="right" title="Form Categories">
        <a class="nav-link" href="{{ route('admin.courses.index') }}">
          <i class="fa fa-fw fa-exchange"></i>
          <span class="nav-link-text">Manage Courses
          </span>
        </a>
      </li>
      <li class="nav-item {{ (Route::is('admin.faculties.index') || Route::is('admin.faculties.create') || Route::is('admin.faculties.edit')) ? 'sidenav-active' : '' }}" data-toggle="tooltip" data-placement="right" title="Manage Faculties">
        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#manageFaculties" data-parent="#exampleAccordion">
          <i class="fa fa-fw fa-exchange"></i>
          <span class="nav-link-text">Manage Faculties</span>
        </a>
        <ul class="sidenav-second-level collapse {{ (Route::is('admin.faculties.index') || Route::is('admin.faculties.show') || Route::is('admin.faculties.create') || Route::is('admin.faculties.edit')) ? 'show' : '' }}" id="manageFaculties">
          <li>
            <a href="{!! route('admin.faculties.index') !!}">Manage Faculties</a>
          </li>
          <li>
            <a href="{!! route('admin.faculties.create') !!}">Add Faculty</a>
          </li>
        </ul>
      </li>
      <li class="nav-item {{ (Route::is('admin.departments.index') || Route::is('admin.departments.create') || Route::is('admin.departments.edit')) ? 'sidenav-active' : '' }}" data-toggle="tooltip" data-placement="right" title="Manage Departments">
        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#manageDepartments" data-parent="#exampleAccordion">
          <i class="fa fa-fw fa-exchange"></i>
          <span class="nav-link-text">Manage Departments</span>
        </a>
        <ul class="sidenav-second-level collapse {{ (Route::is('admin.departments.index') || Route::is('admin.departments.create') || Route::is('admin.departments.edit')) ? 'show' : '' }}" id="manageDepartments">
          <li>
            <a href="{!! route('admin.departments.index') !!}">Manage Departments</a>
          </li>
          <li>
            <a href="{!! route('admin.departments.create') !!}">Add Department</a>
          </li>
        </ul>
      </li>
      <li class="nav-item {{ (Route::is('admin.halls.index') || Route::is('admin.halls.create') || Route::is('admin.halls.edit')) ? 'sidenav-active' : '' }}" data-toggle="tooltip" data-placement="right" title="Manage Halls">
        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#manageHalls" data-parent="#exampleAccordion">
          <i class="fa fa-fw fa-exchange"></i>
          <span class="nav-link-text">Manage Halls</span>
        </a>
        <ul class="sidenav-second-level collapse {{ (Route::is('admin.halls.index') || Route::is('admin.halls.show') || Route::is('admin.halls.create') || Route::is('admin.halls.edit')) ? 'show' : '' }}" id="manageHalls">
          <li>
            <a href="{!! route('admin.halls.index') !!}">Manage Halls</a>
          </li>
          <li>
            <a href="{!! route('admin.halls.create') !!}">Add Hall</a>
          </li>
        </ul>
      </li>
      <li class="nav-item {{ (Route::is('admin.organizations.index') || Route::is('admin.organizations.create') || Route::is('admin.organizations.edit')) ? 'sidenav-active' : '' }}" data-toggle="tooltip" data-placement="right" title="Manage Organizations">
        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#manageOrganizations" data-parent="#exampleAccordion">
          <i class="fa fa-fw fa-exchange"></i>
          <span class="nav-link-text">Manage Organizations</span>
        </a>
        <ul class="sidenav-second-level collapse {{ (Route::is('admin.organizations.index') || Route::is('admin.organizations.show') || Route::is('admin.organizations.edit') || Route::is('admin.organizations.create')) ? 'show' : '' }}" id="manageOrganizations">
          <li>
            <a href="{!! route('admin.organizations.index') !!}">Manage Organizations</a>
          </li>
          <li>
            <a href="{!! route('admin.organizations.create') !!}">Add Organization</a>
          </li>
        </ul>
      </li>
      <li class="nav-item {{ (Route::is('admin.galleries.index') || Route::is('admin.galleryCategories.index') || Route::is('admin.videos.index')) ? 'sidenav-active' : '' }}" data-toggle="tooltip" data-placement="right" title="Manage Governance">
        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#manageGalleries" data-parent="#exampleAccordion">
          <i class="fa fa-fw fa-user"></i>
          <span class="nav-link-text">Manage Galleries</span>
        </a>
        <ul class="sidenav-second-level collapse {{ (Route::is('admin.galleries.index') || Route::is('admin.galleryCategories.index')) ? 'show' : '' }}" id="manageGalleries">
          <li>
            <a href="{!! route('admin.galleries.index') !!}">Manage Photo Galleries</a>
          </li>
          <li>
            <a href="{!! route('admin.galleryCategories.index') !!}">Manage Photo Galleries Category</a>
          </li>
          <li>
            <a href="{!! route('admin.videos.index') !!}">Manage Video Galleries</a>
          </li>
        </ul>
      </li>
      <li class="nav-item {{ Route::is('admin.sliders.index') ? 'sidenav-active' : '' }}" data-toggle="tooltip" data-placement="right" title="Manage Sliders">
        <a class="nav-link" href="{{ route('admin.sliders.index') }}">
          <i class="fa fa-fw fa-file-image-o"></i>
          <span class="nav-link-text">Manage Sliders</span>
        </a>
      </li>
      <li class="nav-item {{ Route::is('admin.designations.index') ? 'sidenav-active' : '' }}" data-toggle="tooltip" data-placement="right" title="Manage Designation">
        <a class="nav-link" href="{{ route('admin.designations.index') }}">
          <i class="fa fa-fw fa-exchange"></i>
          <span class="nav-link-text">Manage Designation</span>
        </a>
      </li>
      <li class="nav-item {{ (Route::is('admin.contact.index') || Route::is('admin.contact.show')) ? 'sidenav-active' : '' }}" data-toggle="tooltip" data-placement="right" title="Manage Contact">
        <a class="nav-link" href="{{ route('admin.contact.index') }}">
          <i class="fa fa-fw fa-exchange"></i>
          <span class="nav-link-text">Manage Messages
          </span>
        </a>
      </li>
      <li class="nav-item {{ (Route::is('admin.about.index') || Route::is('admin.about.create')) ? 'sidenav-active' : '' }}" data-toggle="tooltip" data-placement="right" title="Manage About">
        <a class="nav-link" href="{{ route('admin.about.index') }}">
          <i class="fa fa-fw fa-exchange"></i>
          <span class="nav-link-text">Manage About</span>
        </a>
      </li>
      <li class="nav-item {{ (Route::is('admin.academic.index') || Route::is('admin.academic.create')) ? 'sidenav-active' : '' }}" data-toggle="tooltip" data-placement="right" title="Academic Page">
        <a class="nav-link" href="{{ route('admin.academic.index') }}">
          <i class="fa fa-fw fa-exchange"></i>
          <span class="nav-link-text">Manage Academic Page</span>
        </a>
      </li>
      <li class="nav-item {{ (Route::is('admin.campus.index') || Route::is('admin.campus.create') )? 'sidenav-active' : '' }}" data-toggle="tooltip" data-placement="right" title="Campus Page">
        <a class="nav-link" href="{{ route('admin.campus.index') }}">
          <i class="fa fa-fw fa-exchange"></i>
          <span class="nav-link-text">Manage Campus Page</span>
        </a>
      </li>
      <li class="nav-item {{ (Route::is('admin.settings.index') || Route::is('admin.settings.create')) ? 'sidenav-active' : '' }}" data-toggle="tooltip" data-placement="right" title="Settings">
        <a class="nav-link" href="{{ route('admin.settings.index') }}">
          <i class="fa fa-fw fa-cog"></i>
          <span class="nav-link-text">Settings</span>
        </a>
      </li>
      <li class="nav-item {{ Route::is('admin.changePasswordForm') ? 'sidenav-active' : '' }}" data-toggle="tooltip" data-placement="right" title="Change Password">
        <a class="nav-link" href="{{ route('admin.changePasswordForm') }}">
          <i class="fa fa-fw fa-cog"></i>
          <span class="nav-link-text">Change Password</span>
        </a>
      </li>
    @elseif(Auth::guard('security')->check())
      <li class="nav-item {{ (Route::is('admin.developers.index') || Route::is('admin.developers.create')) ? 'sidenav-active' : '' }}" data-toggle="tooltip" data-placement="right" title="Manage Developers">
          <a class="nav-link" href="{{ route('admin.developers.index') }}">
            <i class="fa fa-fw fa-user"></i>
            <span class="nav-link-text">Manage Developers</span>
          </a>
        </li>
        <li class="nav-item {{ (Route::is('admin.developer.changePasswordForm')) ? 'sidenav-active' : '' }}" data-toggle="tooltip" data-placement="right" title="Manage Developers">
          <a class="nav-link" href="{{ route('admin.developer.changePasswordForm') }}">
            <i class="fa fa-fw fa-cog"></i>
            <span class="nav-link-text">Change Password</span>
          </a>
        </li>
      @endif
      
    </ul>
    <ul class="navbar-nav sidenav-toggler">
      <li class="nav-item">
        <a class="nav-link text-center" id="sidenavToggler">
          <i class="fa fa-fw fa-angle-left"></i>
        </a>
      </li>
    </ul>
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" target="_blank" href="{!! route('index') !!}">
          <i class="fa fa-fw fa-eye"></i> View Site</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
          @if(Auth::guard('admin')->check())
        <li class="nav-item dropdown mr-5">
          @php
          $allContact = \App\Models\Contact::where('seen', 0)->get();
          $count = count($allContact);
          @endphp
          <a class="nav-link dropdown-toggle mr-5" id="messagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-envelope float-left incoming-message-sign"></i>
            <span class="badge badge-primary float-right incoming-message">{{ $count }}</span>
          </a>
          <div class="clearfix"></div>
          <div class="dropdown-menu" aria-labelledby="messagesDropdown">
            <h6 class="dropdown-header">New Messages:</h6>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              @foreach(\App\Models\Contact::where('seen', 0)->get() as $message)
                <a href="{{ route('admin.contact.show', $message->id) }}" class="pl-3">
                  <strong>Message From - {{ $message->name }} <br /> </strong>
                </a>
                <span class="text-muted ml-4">({{ $message->email }})</span>
                <div class="dropdown-divider"></div>
              @endforeach
            </a>

            <a class="dropdown-item small" href="{{ route('admin.contact.index') }}">View all messages</a>
          </div>
        </li>
                @endif

        <li class="nav-item dropdown">
          <div class="dropdown-menu" aria-labelledby="alertsDropdown">

             @if(Auth::guard('admin')->check())
              <li class="nav-item">
                <a class="nav-link" data-toggle="modal" data-target="#adminLogoutModal"><i class="fa fa-sign-out"></i>Logout</a>
                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
              </li>
            @elseif(Auth::guard('security')->check())
              <li class="nav-item">
                <a class="nav-link" data-toggle="modal" data-target="#securityLogoutModal"><i class="fa fa-sign-out"></i>Logout</a>
                <form id="security-logout-form" action="{{ route('security.logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
              </li>
            @endif
            
          </ul>
        </div>
      </nav>


      {{-- Logout Modal --}}
      <div class="modal fade" id="adminLogoutModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="deleteModalLabel">Are you want to logout ?</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-footer">
              <form class="" action="{!! route('admin.logout') !!}" method="post">
                @csrf
                <button type="submit" class="btn btn-outline-danger" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();"><i class="fa fa-trash"></i> Logout</button>
              </form>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
      
      
      <div class="modal fade" id="securityLogoutModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="deleteModalLabel">Are you want to logout ?</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-footer">
              <form class="" action="{!! route('security.logout') !!}" method="post">
                @csrf
                <button type="submit" class="btn btn-outline-danger" onclick="event.preventDefault();
                document.getElementById('security-logout-form').submit();"><i class="fa fa-trash"></i> Logout</button>
              </form>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
      
      
