<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'Frontend\PagesController@index')->name('index');
Route::get('/about', 'Frontend\PagesController@about')->name('about');
//Meeting Reports Show on FrontEnd
Route::get('reports/{category_slug}/{subcategory_slug}', 'Frontend\MeetingReportsController@show')->name('reports.show');



/**  About Page Routes */
Route::group(['prefix' => 'about'], function(){
  Route::get('/overview', 'Frontend\AboutController@overview')->name('about.index');
  Route::get('/mission', 'Frontend\AboutController@mission')->name('about.mission');
  Route::get('/vision', 'Frontend\AboutController@vision')->name('about.vision');
  Route::get('/location', 'Frontend\AboutController@location')->name('about.location');
  Route::get('/at-a-glance', 'Frontend\AboutController@total_info')->name('about.total_info');

  Route::group(['prefix' => 'galleries'], function(){
    Route::get('/', 'Frontend\GalleryController@index')->name('about.galleries');
    Route::get('/faculties', 'Frontend\GalleryController@facultiesAll')->name('about.galleries.facultiesAll');
    Route::get('/faculties/{short_name}', 'Frontend\GalleryController@faculties')->name('about.galleries.faculties');
    Route::get('/halls', 'Frontend\GalleryController@hallsAll')->name('about.galleries.hallsAll');
    Route::get('/halls/{slug}', 'Frontend\GalleryController@halls')->name('about.galleries.halls');
    Route::get('/offices', 'Frontend\GalleryController@officesAll')->name('about.galleries.officesAll');
    Route::get('/office/{short_name}', 'Frontend\GalleryController@offices')->name('about.galleries.offices');
    Route::get('/others', 'Frontend\GalleryController@others')->name('about.galleries.others');
    Route::get('/categories/{slug}', 'Frontend\GalleryController@categories')->name('about.galleries.categories');

  });
});


/** Contact Routes **/
Route::group(['prefix' => 'contact-us'], function(){
  Route::get('/', 'Frontend\ContactsController@index')->name('contacts.index');
  Route::post('/store', 'Frontend\ContactsController@store')->name('contacts.store');
});


/** Collaboration Routes **/
Route::group(['prefix' => 'collaborations'], function(){
  Route::get('/', 'Frontend\CollaborationsController@index')->name('collaborations.index');
  Route::get('/show/{id}', 'Frontend\CollaborationsController@show')->name('collaborations.show');
});

/** Nocs and others Routes **/
Route::group(['prefix' => 'nocs'], function(){
  Route::get('/', 'Frontend\NocsController@index')->name('nocs.index');
  Route::get('/show/{slug}', 'Frontend\NocsController@show')->name('nocs.show');
});

/** Pages Routes */
Route::get('/p/{slug}', 'Frontend\SitePagesController@show')->name('pages.show');


/** Developer Routes **/
Route::group(['prefix' => 'developers'], function(){
  Route::get('/', 'Frontend\DevelopersController@index')->name('developers.index');
  Route::get('/{slug}', 'Frontend\DevelopersController@show')->name('developers.show');
  Route::get('/others/special-thanks', 'Frontend\DevelopersController@others')->name('developers.others');
});



/** Academic Routes **/
Route::group(['prefix' => 'academic'], function(){
  Route::get('/calendar', 'Frontend\AcademicController@calendar')->name('academic.calendar');
  Route::get('/scholarship-and-award', 'Frontend\AcademicController@scholarship')->name('academic.scholarship');
  Route::get('/info-and-policy', 'Frontend\AcademicController@info')->name('academic.info');
  Route::get('/governance', 'Frontend\AcademicController@governance')->name('academic.governance');
});



/** Offices Routes **/
Route::group(['prefix' => 'offices'], function(){
  Route::get('/', 'Frontend\OfficesController@index')->name('offices.index');
  Route::get('/{office_short_name}', 'Frontend\OfficesController@show')->name('offices.show');
  Route::get('/{office_short_name}/staffs', 'Frontend\OfficesController@staffs')->name('offices.staffs');
  Route::get('/{office_short_name}/sub/staffs', 'Frontend\OfficesController@subOfficeStaffs')->name('offices.suboffices.staffs');

  Route::get('/forms/downloads', 'Frontend\OfficesController@forms')->name('offices.forms');
});



/** Admission Routes **/
Route::group(['prefix' => 'admission'], function(){
  Route::get('/', 'Frontend\AdmissionsController@index')->name('admissions.index');
  Route::get('/{slug}', 'Frontend\AdmissionsController@show')->name('admissions.show');
  Route::get('/{slug}/rules', 'Frontend\AdmissionsController@rules')->name('admissions.rules');
  Route::get('/{slug}/notices', 'Frontend\AdmissionsController@singleAdmissionsNotices')->name('admissions.single.notices');
  Route::get('/seat-plan/{slug}', 'Frontend\AdmissionsController@seat_plan')->name('admissions.seat_plan');
//   Route::get('/result/new', 'Frontend\AdmissionsController@result')->name('admissions.result');

  //Notices routes
  Route::group(['prefix' => 'notices'], function(){
    Route::get('/all', 'Frontend\AdmissionNoticesController@index')->name('admissions.notices.index');
    Route::get('/{slug}', 'Frontend\AdmissionNoticesController@show')->name('admissions.notices.show');
  });
});



/** Employees Routes **/
Route::group(['prefix' => 'employees'], function(){
  Route::get('/', 'Frontend\EmployeesController@index')->name('employees.index');
  Route::get('/{username}', 'Frontend\EmployeesController@show')->name('employees.show');
});



/** Campus Routes **/
Route::group(['prefix' => 'campus'], function(){
  Route::get('/', 'Frontend\CampusController@campus')->name('campus.index');
  Route::get('/cultural', 'Frontend\CampusController@cultural')->name('campus.cultural');

  Route::get('/organizations', 'Frontend\CampusController@organizations')->name('campus.organizations');
  Route::get('/organization/{slug}', 'Frontend\CampusController@organizationShow')->name('campus.organizations.show');

  Route::get('/halls', 'Frontend\HallsController@index')->name('halls.index');
  Route::get('/hall/{slug}', 'Frontend\HallsController@show')->name('halls.show');
});



/** Teachers Routes **/
Route::group(['prefix' => 'teachers'], function(){
  Route::get('/', 'Frontend\TeachersController@index')->name('teachers.index');
  Route::get('/search', 'Frontend\TeachersController@search')->name('teachers.search');
  Route::get('/{username}', 'Frontend\TeachersController@show')->name('teachers.show');
});




/** Teacher Dashboard + Settings Routes **/
Route::group(['prefix' => 'teacher'], function(){
  /** Teacher Login Options **/
  Route::get('/login', 'Auth\Teacher\LoginController@showLoginForm')->name('teacher.login');
  Route::post('/login', 'Auth\Teacher\LoginController@login')->name('teacher.login.submit');
  Route::post('/logout', 'Auth\Teacher\LoginController@logout')->name('teacher.logout');
  Route::get('/password/reset', 'Auth\Teacher\ForgotPasswordController@showLinkRequestForm')->name('teacher.password.request');
  Route::post('/password/email', 'Auth\Teacher\ForgotPasswordController@sendResetLinkEmail')->name('teacher.password.email');
  Route::get('/password/reset/{token}', 'Auth\Teacher\ResetPasswordController@showResetForm')->name('teacher.password.reset');
  Route::post('/password/reset', 'Auth\Teacher\ResetPasswordController@reset');
  Route::post('/change-password', 'Frontend\TeachersController@changePassword')->name('teacher.changePassword');

  Route::get('/dashboard', 'Frontend\TeachersController@dashboard')->name('teacher.dashboard');
  Route::get('/edit-profile', 'Frontend\TeachersController@edit')->name('teacher.edit');
  Route::post('/edit-profile', 'Frontend\TeachersController@update')->name('teacher.update');
  Route::get('/researches', 'Frontend\TeachersController@researches')->name('teacher.researches');
  Route::get('/publications', 'Frontend\TeachersController@publications')->name('teacher.publications');
  Route::get('/projects', 'Frontend\TeachersController@projects')->name('teacher.projects');
  Route::get('/profiles', 'Frontend\TeachersController@profiles')->name('teacher.profiles');


  Route::get('/messages', 'Frontend\MessagesController@messages')->name('teacher.messages');
  Route::get('/message/{id}', 'Frontend\MessagesController@show')->name('teacher.message.show');
  Route::post('/sendMessage', 'Frontend\MessagesController@sendMessage')->name('teacher.sendMessage');
  Route::post('/message/delete/{id}', 'Frontend\MessagesController@delete')->name('teacher.message.delete');

  /** Teacher Education routes **/
  Route::group(['prefix' => '/educations'], function(){
    Route::get('/manage/all', 'Frontend\TeacherEducationsController@manageEducations')->name('teacher.educations.manage');
    Route::post('/store', 'Frontend\TeacherEducationsController@store')->name('teacher.educations.store');
    Route::post('/{id}/update', 'Frontend\TeacherEducationsController@update')->name('teacher.educations.update');
    Route::post('/{id}/delete', 'Frontend\TeacherEducationsController@delete')->name('teacher.educations.delete');
  });

  /** Teacher Materials routes **/
  Route::group(['prefix' => '/materials'], function(){
    Route::get('/{username}', 'Frontend\TeacherMaterialsController@index')->name('teacher.materials');
    Route::get('/manage/all', 'Frontend\TeacherMaterialsController@manageMaterials')->name('teacher.materials.manage');
    Route::post('/store', 'Frontend\TeacherMaterialsController@store')->name('teacher.materials.store');
    Route::post('/{id}/update', 'Frontend\TeacherMaterialsController@update')->name('teacher.materials.update');
    Route::post('/{id}/delete', 'Frontend\TeacherMaterialsController@delete')->name('teacher.materials.delete');
  });

  /** Teacher Profile routes **/
  Route::group(['prefix' => '/profiles'], function(){
    // Route::get('/{username}', 'Frontend\TeacherProfileLinksController@index')->name('teacher.materials');
    Route::get('/manage/all', 'Frontend\TeacherProfileLinksController@manageProfiles')->name('teacher.profiles.manage');
    Route::post('/store', 'Frontend\TeacherProfileLinksController@store')->name('teacher.profiles.store');
    Route::post('/{id}/update', 'Frontend\TeacherProfileLinksController@update')->name('teacher.profiles.update');
    Route::post('/{id}/delete', 'Frontend\TeacherProfileLinksController@delete')->name('teacher.profiles.delete');
  });
  

});




/** Administrator Routes **/
Route::group(['prefix' => 'administrator'], function(){
  /** Teacher Login Options **/
  Route::get('/login', 'Auth\Administrator\LoginController@showLoginForm')->name('administrator.login');
  Route::post('/login', 'Auth\Administrator\LoginController@login')->name('administrator.login.submit');
  Route::post('/logout', 'Auth\Administrator\LoginController@logout')->name('administrator.logout');

  Route::get('/password/reset', 'Auth\Administrator\ForgotPasswordController@showLinkRequestForm')->name('administrator.password.request');
  // Route::post('/password/advance-reset', 'Auth\Administrator\ForgotPasswordController@advancePasswordReset')->name('administrator.password.advance_request');

  Route::post('/password/email', 'Auth\Administrator\ForgotPasswordController@sendResetLinkEmail')->name('administrator.password.email');
  Route::get('/password/reset/{token}', 'Auth\Administrator\ResetPasswordController@showResetForm')->name('administrator.password.reset');
  Route::post('/password/reset', 'Auth\Administrator\ResetPasswordController@reset');

  Route::get('/dashboard', 'Frontend\AdministratorsController@dashboard')->name('administrator.dashboard');

  Route::get('/edit-profile', 'Frontend\AdministratorsController@edit')->name('administrator.edit');
  Route::post('/edit-profile', 'Frontend\AdministratorsController@update')->name('administrator.update');

  Route::post('/change-password', 'Frontend\AdministratorsController@changePassword')->name('administrator.changePassword');
  Route::get('/{username}', 'Frontend\AdministratorsController@show')->name('administrators.show');


  Route::get('/office/message', 'Frontend\AdministratorsController@message')->name('administrator.message');

  Route::post('/office-message/change', 'Frontend\AdministratorsController@changeMessage')->name('administrator.changeMessage');

  Route::post('/hall/{id}/change', 'Frontend\AdministratorsController@changeHallMessage')->name('administrator.changeHallMessage');
  Route::post('/faculty/{id}/change', 'Frontend\AdministratorsController@changeFacultyMessage')->name('administrator.changeFacultyMessage');
  Route::post('/office/{id}/change', 'Frontend\AdministratorsController@changeOfficeMessage')->name('administrator.changeOfficeMessage');


});



/** Faculties Routes **/
Route::group(['prefix' => 'faculties'], function(){
  Route::get('/', 'Frontend\FacultiesController@index')->name('faculties.index');
  Route::get('/{short_name}', 'Frontend\FacultiesController@show')->name('faculties.show');
  Route::get('/{short_name}/staffs', 'Frontend\FacultiesController@staffs')->name('faculties.staffs');
  Route::get('/{short_name}/message', 'Frontend\FacultiesController@message')->name('faculties.message');
  Route::get('/{short_name}/degree-requirements', 'Frontend\FacultiesController@degree_requirements')->name('faculties.degree_requirements');
});


/** Departments Routes **/
Route::group(['prefix' => 'departments'], function(){
  Route::get('/', 'Frontend\DepartmentsController@index')->name('departments.index');
  Route::get('/{short_name}', 'Frontend\DepartmentsController@show')->name('departments.show');
  Route::get('/{short_name}/teachers', 'Frontend\DepartmentsController@teachers')->name('departments.teacher');
  Route::get('/{short_name}/staffs', 'Frontend\DepartmentsController@staffs')->name('departments.staffs');
});



/** Journal Routes **/
Route::group(['prefix' => 'journals'], function(){
  Route::get('/', 'Frontend\ResearchesController@index')->name('researches.index');
  Route::get('/{slug}', 'Frontend\ResearchesController@show')->name('researches.show');
});

Route::group(['prefix' => 'publications'], function(){
  Route::get('/', 'Frontend\PublicationsController@index')->name('publications.index');
  Route::get('/{slug}', 'Frontend\PublicationsController@show')->name('publications.show');
});


Route::group(['prefix' => 'projects'], function(){
  Route::get('/', 'Frontend\ProjectsController@index')->name('projects.index');
  Route::get('/{slug}', 'Frontend\ProjectsController@show')->name('projects.show');
});


Route::group(['prefix' => 'journal'], function(){
  Route::get('/add-jounral', 'Frontend\ResearchesController@create')->name('researches.create');
  Route::get('/edit/{slug}', 'Frontend\ResearchesController@edit')->name('researches.edit');
  Route::post('/update/{slug}', 'Frontend\ResearchesController@update')->name('researches.update');
  Route::post('/delete/{id}', 'Frontend\ResearchesController@delete')->name('researches.delete');
  Route::post('/store', 'Frontend\ResearchesController@store')->name('researches.store');
});

Route::group(['prefix' => 'publication'], function(){
  Route::get('/add-publication', 'Frontend\PublicationsController@create')->name('publications.create');
  Route::get('/edit/{slug}', 'Frontend\PublicationsController@edit')->name('publications.edit');
  Route::post('/update/{slug}', 'Frontend\PublicationsController@update')->name('publications.update');
  Route::post('/delete/{id}', 'Frontend\PublicationsController@delete')->name('publications.delete');
  Route::post('/store', 'Frontend\PublicationsController@store')->name('publications.store');
});

Route::group(['prefix' => 'project'], function(){
  Route::get('/add-project', 'Frontend\ProjectsController@create')->name('projects.create');
  Route::get('/edit/{slug}', 'Frontend\ProjectsController@edit')->name('projects.edit');
  Route::post('/update/{slug}', 'Frontend\ProjectsController@update')->name('projects.update');
  Route::post('/delete/{id}', 'Frontend\ProjectsController@delete')->name('projects.delete');
  Route::post('/store', 'Frontend\ProjectsController@store')->name('projects.store');
});


/** Notices and news Routes **/
Route::group(['prefix' => 'notices'], function(){
  Route::get('/', 'Frontend\NoticesController@notices')->name('notices.index');
  Route::get('/before-last-month', 'Frontend\NoticesController@last_month_notices')->name('notices.last_month');
  Route::get('/{slug}', 'Frontend\NoticesController@showNotice')->name('notices.show');
});
Route::group(['prefix' => 'news'], function(){
  Route::get('/', 'Frontend\NoticesController@news')->name('news.index');
  Route::get('/before-last-month', 'Frontend\NoticesController@last_month_news')->name('news.last_month');
  Route::get('/{slug}', 'Frontend\NoticesController@showNotice')->name('news.show');
});






/**
* Admin Routes
*/
Route::group(['prefix' => 'admin'], function(){
  // Admin Login
  Route::get('/login', 'Auth\Admin\LoginController@showLoginForm')->name('admin.login');
  Route::post('/login', 'Auth\Admin\LoginController@login')->name('admin.login.submit');
  Route::post('/logout', 'Auth\Admin\LoginController@logout')->name('admin.logout');

  // Admin Reset Password
  Route::get('/password/reset', 'Auth\Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
  Route::post('/password/email', 'Auth\Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
  Route::get('/password/reset/{token}', 'Auth\Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');
  Route::post('/password/reset', 'Auth\Admin\ResetPasswordController@reset');


  // Admin Change Password
  Route::get('/', 'Backend\PagesController@index')->name('admin.dashboard');
  Route::get('/change-password', 'Backend\PagesController@changePasswordForm')->name('admin.changePasswordForm');
  Route::post('/change-password', 'Backend\PagesController@changePassword')->name('admin.changePassword');


  // Teacher
  Route::group(['prefix' => 'teachers'], function(){
    Route::get('/', 'Backend\TeachersController@index')->name('admin.teachers.index');
    Route::get('/departments', 'Backend\TeachersController@departments')->name('admin.teachers.departments');
    Route::post('/departmentSort', 'Backend\TeachersController@departmentSort')->name('admin.teacher.departmentSort');
    Route::post('/edit-priority/{id}', 'Backend\TeachersController@editPriority')->name('admin.teachers.editPriority');
    Route::get('/{id}/show', 'Backend\TeachersController@show')->name('admin.teachers.show');
    Route::get('/create', 'Backend\TeachersController@create')->name('admin.teachers.create');
    Route::post('/create', 'Backend\TeachersController@store')->name('admin.teachers.store');
    Route::get('/edit/{id}', 'Backend\TeachersController@edit')->name('admin.teachers.edit');
    Route::post('/edit/{id}', 'Backend\TeachersController@update')->name('admin.teachers.update');
    Route::post('/delete/{id}', 'Backend\TeachersController@destroy')->name('admin.teachers.delete');
    Route::get('/{faculty_short_name}', 'Backend\TeachersController@facultyTeachers')->name('admin.teachers.faculty');
    Route::get('/{faculty_short_name}/{department_short_name}', 'Backend\TeachersController@departmentTeachers')->name('admin.teachers.department');
    Route::post('/excel', 'Backend\TeachersController@addFromExcel')->name('admin.teachers.excel');
    Route::post('/send-password/{id}', 'Backend\TeachersController@sendPassword')->name('admin.teachers.sendPassword');
  });


  // Administrator
  Route::group(['prefix' => 'administrators'], function(){
    Route::get('/', 'Backend\AdministratorsController@index')->name('admin.administrators.index');
    Route::get('/{id}/show', 'Backend\AdministratorsController@show')->name('admin.administrators.show');
    Route::get('/create', 'Backend\AdministratorsController@create')->name('admin.administrators.create');
    Route::post('/create/{type}', 'Backend\AdministratorsController@store')->name('admin.administrators.store');
    Route::get('/edit/{id}', 'Backend\AdministratorsController@edit')->name('admin.administrators.edit');
    Route::post('/edit/{type}/{id}', 'Backend\AdministratorsController@update')->name('admin.administrators.update');
    Route::post('/delete/{id}', 'Backend\AdministratorsController@destroy')->name('admin.administrators.delete');
  });


  // Governance
  Route::group(['prefix' => 'governances'], function(){
    Route::get('/', 'Backend\GovernancesController@index')->name('admin.governances.index');
    Route::get('/{id}/show', 'Backend\GovernancesController@show')->name('admin.governances.show');
    Route::get('/create', 'Backend\GovernancesController@create')->name('admin.governances.create');
    Route::post('/create', 'Backend\GovernancesController@store')->name('admin.governances.store');
    Route::get('/edit/{id}', 'Backend\GovernancesController@edit')->name('admin.governances.edit');
    Route::post('/edit/{id}', 'Backend\GovernancesController@update')->name('admin.governances.update');
    Route::post('/delete/{id}', 'Backend\GovernancesController@destroy')->name('admin.governances.delete');
    Route::post('/excel', 'Backend\GovernancesController@addFromExcel')->name('admin.governances.excel');
  });


  // Employee
  Route::group(['prefix' => 'employees'], function(){
    Route::get('/', 'Backend\EmployeesController@index')->name('admin.employees.index');
    Route::get('/{id}/show', 'Backend\EmployeesController@show')->name('admin.employees.show');
    Route::get('/create', 'Backend\EmployeesController@create')->name('admin.employees.create');
    Route::post('/create/{type}', 'Backend\EmployeesController@store')->name('admin.employees.store');
    Route::get('/edit/{id}', 'Backend\EmployeesController@edit')->name('admin.employees.edit');
    Route::post('/edit/{type}/{id}', 'Backend\EmployeesController@update')->name('admin.employees.update');
    Route::post('/delete/{id}', 'Backend\EmployeesController@destroy')->name('admin.employees.delete');
    Route::get('/{section_type}/{section_id}', 'Backend\EmployeesController@sectionEmployee')->name('admin.employees.section');
    Route::post('/{section_type}/excel', 'Backend\EmployeesController@addFromExcel')->name('admin.employees.excel');
  });


  // Faculty
  Route::group(['prefix' => 'faculties'], function(){
    Route::get('/', 'Backend\FacultiesController@index')->name('admin.faculties.index');
    Route::get('/{id}/show', 'Backend\FacultiesController@show')->name('admin.faculties.show');
    Route::get('/create', 'Backend\FacultiesController@create')->name('admin.faculties.create');
    Route::post('/create', 'Backend\FacultiesController@store')->name('admin.faculties.store');
    Route::get('/edit/{id}', 'Backend\FacultiesController@edit')->name('admin.faculties.edit');
    Route::post('/edit/{id}', 'Backend\FacultiesController@update')->name('admin.faculties.update');
    Route::post('/delete/{id}', 'Backend\FacultiesController@destroy')->name('admin.faculties.delete');
  });


  // Department
  Route::group(['prefix' => 'departments'], function(){
    Route::get('/', 'Backend\DepartmentsController@index')->name('admin.departments.index');
    Route::get('/{id}/show', 'Backend\DepartmentsController@show')->name('admin.departments.show');
    Route::get('/create', 'Backend\DepartmentsController@create')->name('admin.departments.create');
    Route::post('/create', 'Backend\DepartmentsController@store')->name('admin.departments.store');
    Route::get('/edit/{id}', 'Backend\DepartmentsController@edit')->name('admin.departments.edit');
    Route::post('/edit/{id}', 'Backend\DepartmentsController@update')->name('admin.departments.update');
    Route::post('/delete/{id}', 'Backend\DepartmentsController@destroy')->name('admin.departments.delete');
    Route::get('/{faculty_short_name}', 'Backend\DepartmentsController@facultyDepartments')->name('admin.faculties.department');
    Route::post('/excel', 'Backend\DepartmentsController@addFromExcel')->name('admin.departments.excel');
  });


  // Hall
  Route::group(['prefix' => 'halls'], function(){
    Route::get('/', 'Backend\HallsController@index')->name('admin.halls.index');
    Route::get('/{id}/show', 'Backend\HallsController@show')->name('admin.halls.show');
    Route::get('/create', 'Backend\HallsController@create')->name('admin.halls.create');
    Route::post('/create', 'Backend\HallsController@store')->name('admin.halls.store');
    Route::get('/edit/{id}', 'Backend\HallsController@edit')->name('admin.halls.edit');
    Route::post('/edit/{id}', 'Backend\HallsController@update')->name('admin.halls.update');
    Route::post('/delete/{id}', 'Backend\HallsController@destroy')->name('admin.halls.delete');
  });


  // Course
  Route::group(['prefix' => 'courses'], function(){
    Route::get('/', 'Backend\CoursesController@index')->name('admin.courses.index');
    Route::post('/create', 'Backend\CoursesController@store')->name('admin.courses.store');
    Route::get('/edit/{id}', 'Backend\CoursesController@edit')->name('admin.courses.edit');
    Route::post('/edit/{id}', 'Backend\CoursesController@update')->name('admin.courses.update');
    Route::post('/delete/{id}', 'Backend\CoursesController@destroy')->name('admin.courses.delete');
    Route::get('/{faculty_short_name}', 'Backend\CoursesController@facultyCourse')->name('admin.courses.facultyCourse');
    Route::get('/dept/{department_short_name}', 'Backend\CoursesController@departmentCourse')->name('admin.courses.departmentCourse');
    Route::post('/excel', 'Backend\CoursesController@addFromExcel')->name('admin.courses.excel');
  });
  
  
  // Project
  Route::group(['prefix' => 'project'], function(){
    Route::get('/', 'Backend\ProjectController@index')->name('admin.project.index');
    Route::get('/{id}/show', 'Backend\ProjectController@show')->name('admin.project.show');
    Route::get('/create', 'Backend\ProjectController@create')->name('admin.project.create');
    Route::post('/create', 'Backend\ProjectController@store')->name('admin.project.store');
    Route::get('/edit/{id}', 'Backend\ProjectController@edit')->name('admin.project.edit');
    Route::post('/edit/{id}', 'Backend\ProjectController@update')->name('admin.project.update');
    Route::post('/delete/{id}', 'Backend\ProjectController@destroy')->name('admin.project.delete');
  });
  
  
  // Collaboration
  Route::group(['prefix' => 'collaborations'], function(){
    Route::get('/', 'Backend\CollaborationController@index')->name('admin.collaborations.index');
    Route::get('/{id}/show', 'Backend\CollaborationController@show')->name('admin.collaborations.show');
    Route::get('/create', 'Backend\CollaborationController@create')->name('admin.collaborations.create');
    Route::post('/create', 'Backend\CollaborationController@store')->name('admin.collaborations.store');
    Route::get('/edit/{id}', 'Backend\CollaborationController@edit')->name('admin.collaborations.edit');
    Route::post('/edit/{id}', 'Backend\CollaborationController@update')->name('admin.collaborations.update');
    Route::post('/delete/{id}', 'Backend\CollaborationController@destroy')->name('admin.collaborations.delete');
  });
  
  
  // Noc
  Route::group(['prefix' => 'nocs'], function(){
    Route::get('/', 'Backend\NocController@index')->name('admin.nocs.index');
    Route::get('/{id}/show', 'Backend\NocController@show')->name('admin.nocs.show');
    Route::get('/create', 'Backend\NocController@create')->name('admin.nocs.create');
    Route::post('/create', 'Backend\NocController@store')->name('admin.nocs.store');
    Route::get('/edit/{id}', 'Backend\NocController@edit')->name('admin.nocs.edit');
    Route::post('/edit/{id}', 'Backend\NocController@update')->name('admin.nocs.update');
    Route::post('/delete/{id}', 'Backend\NocController@destroy')->name('admin.nocs.delete');
  });


  // Office
  Route::group(['prefix' => 'offices'], function(){
    Route::get('/', 'Backend\OfficesController@index')->name('admin.offices.index');
    Route::get('/{id}/show', 'Backend\OfficesController@show')->name('admin.offices.show');
    Route::get('/create', 'Backend\OfficesController@create')->name('admin.offices.create');
    Route::post('/create', 'Backend\OfficesController@store')->name('admin.offices.store');
    Route::get('/edit/{id}', 'Backend\OfficesController@edit')->name('admin.offices.edit');
    Route::post('/edit/{id}', 'Backend\OfficesController@update')->name('admin.offices.update');
    
    
    Route::get('/create-suboffice', 'Backend\OfficesController@createSubOffice')->name('admin.offices.createSubOffice');
    Route::post('/create-suboffice', 'Backend\OfficesController@storeSubOffice')->name('admin.offices.storeSubOffice');
    Route::get('/edit-suboffice/{id}', 'Backend\OfficesController@editSubOffice')->name('admin.offices.editSubOffice');
    Route::post('/edit-suboffice/{id}', 'Backend\OfficesController@updateSubOffice')->name('admin.offices.updateSubOffice');

    Route::post('/delete/{id}', 'Backend\OfficesController@destroy')->name('admin.offices.delete');
  });


  // Designation
  Route::group(['prefix' => 'designations'], function(){
    Route::get('/', 'Backend\DesignationsController@index')->name('admin.designations.index');
    Route::get('/{id}/show', 'Backend\DesignationsController@show')->name('admin.designations.show');
    Route::post('/create', 'Backend\DesignationsController@store')->name('admin.designations.store');
    Route::post('/edit/{id}', 'Backend\DesignationsController@update')->name('admin.designations.update');
    Route::post('/delete/{id}', 'Backend\DesignationsController@destroy')->name('admin.designations.delete');
  });


  // Organization
  Route::group(['prefix' => 'organizations'], function(){
    Route::get('/', 'Backend\OrganizationsController@index')->name('admin.organizations.index');
    Route::get('/{id}/show', 'Backend\OrganizationsController@show')->name('admin.organizations.show');
    Route::get('/create', 'Backend\OrganizationsController@create')->name('admin.organizations.create');
    Route::post('/create', 'Backend\OrganizationsController@store')->name('admin.organizations.store');
    Route::get('/edit/{id}', 'Backend\OrganizationsController@edit')->name('admin.organizations.edit');
    Route::post('/edit/{id}', 'Backend\OrganizationsController@update')->name('admin.organizations.update');
    Route::post('/delete/{id}', 'Backend\OrganizationsController@destroy')->name('admin.organizations.delete');
  });


  // Notice
  Route::group(['prefix' => 'notices'], function(){
    Route::get('/', 'Backend\NoticesController@index')->name('admin.notices.index');
    Route::get('/{id}/show', 'Backend\NoticesController@show')->name('admin.notices.show');
    Route::get('/create', 'Backend\NoticesController@create')->name('admin.notices.create');
    Route::post('/create/{type}', 'Backend\NoticesController@store')->name('admin.notices.store');
    Route::get('/edit/{id}', 'Backend\NoticesController@edit')->name('admin.notices.edit');
    Route::post('/edit/{type}/{id}', 'Backend\NoticesController@update')->name('admin.notices.update');
    Route::post('/delete/{id}', 'Backend\NoticesController@destroy')->name('admin.notices.delete');
    Route::get('/{type}/{short_name}', 'Backend\NoticesController@officeNotices')->name('admin.notices.office');
  });


  // About
  Route::group(['prefix' => 'about'], function(){
    Route::get('/', 'Backend\AboutController@index')->name('admin.about.index');
    Route::get('/create', 'Backend\AboutController@create')->name('admin.about.create');
    Route::post('/create', 'Backend\AboutController@store')->name('admin.about.store');
    // Route::get('/delete', 'Backend\AboutController@delete')->name('admin.about.delete');
  });


  // Video
  Route::group(['prefix' => 'videos'], function(){
    Route::get('/', 'Backend\VideosController@index')->name('admin.videos.index');
    Route::post('/create', 'Backend\VideosController@store')->name('admin.videos.store');
    Route::post('/edit/{id}', 'Backend\VideosController@update')->name('admin.videos.update');
    Route::post('/delete/{id}', 'Backend\VideosController@destroy')->name('admin.videos.delete');
  });
  
   // Gallery Category
    Route::group(['prefix' => 'gallery-categories'], function(){
      Route::get('/', 'Backend\GalleryCategoriesController@index')->name('admin.galleryCategories.index');
      Route::get('/{id}/show', 'Backend\GalleryCategoriesController@show')->name('admin.galleryCategories.show');
      Route::post('/create', 'Backend\GalleryCategoriesController@store')->name('admin.galleryCategories.store');
      Route::post('/edit/{id}', 'Backend\GalleryCategoriesController@update')->name('admin.galleryCategories.update');
      Route::post('/delete/{id}', 'Backend\GalleryCategoriesController@destroy')->name('admin.galleryCategories.delete');
    });

  // Settings
  Route::group(['prefix' => 'settings'], function(){
    Route::get('/', 'Backend\SettingsController@index')->name('admin.settings.index');
    Route::get('/create', 'Backend\SettingsController@create')->name('admin.settings.create');
    Route::post('/create', 'Backend\SettingsController@store')->name('admin.settings.store');
    // Route::get('/delete', 'Backend\SettingsController@delete')->name('admin.settings.delete');
  });


  // Academic
  Route::group(['prefix' => 'academic'], function(){
    Route::get('/', 'Backend\AcademicsController@index')->name('admin.academic.index');
    Route::get('/create', 'Backend\AcademicsController@create')->name('admin.academic.create');
    Route::post('/create', 'Backend\AcademicsController@store')->name('admin.academic.store');
    // Route::get('/delete', 'Backend\AcademicsController@delete')->name('admin.academic.delete');
  });

    // Pages Route
    Route::group(['prefix' => 'page'], function(){
        Route::get('/', 'Backend\PageSettingsController@index')->name('admin.page.index');
        Route::post('/create', 'Backend\PageSettingsController@store')->name('admin.page.store');
        Route::put('/edit/{id}', 'Backend\PageSettingsController@update')->name('admin.page.update');
        Route::delete('/delete/{id}', 'Backend\PageSettingsController@destroy')->name('admin.page.delete');
    });


  // Campus
  Route::group(['prefix' => 'campus'], function(){
    Route::get('/', 'Backend\CampusController@index')->name('admin.campus.index');
    Route::get('/create', 'Backend\CampusController@create')->name('admin.campus.create');
    Route::post('/create', 'Backend\CampusController@store')->name('admin.campus.store');
    // Route::get('/delete', 'Backend\CampusController@delete')->name('admin.campus.delete');
  });


  // Governance Type
  Route::group(['prefix' => 'governance-type'], function(){
    Route::get('/', 'Backend\GovernanceTypesController@index')->name('admin.governanceType.index');
    Route::get('/{id}/show', 'Backend\GovernanceTypesController@show')->name('admin.governanceType.show');
    Route::post('/create', 'Backend\GovernanceTypesController@store')->name('admin.governanceType.store');
    Route::post('/edit/{id}', 'Backend\GovernanceTypesController@update')->name('admin.governanceType.update');
    Route::post('/delete/{id}', 'Backend\GovernanceTypesController@destroy')->name('admin.governanceType.delete');
  });


  // Form Category
  Route::group(['prefix' => 'form-categories'], function(){
    Route::get('/', 'Backend\FormCategoriesController@index')->name('admin.formCategories.index');
    Route::get('/{id}/show', 'Backend\FormCategoriesController@show')->name('admin.formCategories.show');
    Route::post('/create', 'Backend\FormCategoriesController@store')->name('admin.formCategories.store');
    Route::post('/edit/{id}', 'Backend\FormCategoriesController@update')->name('admin.formCategories.update');
    Route::post('/delete/{id}', 'Backend\FormCategoriesController@destroy')->name('admin.formCategories.delete');
  });


  // Form
  Route::group(['prefix' => 'forms'], function(){
    Route::get('/', 'Backend\FormsController@index')->name('admin.forms.index');
    Route::get('/{id}/show', 'Backend\FormsController@show')->name('admin.forms.show');
    Route::post('/create', 'Backend\FormsController@store')->name('admin.forms.store');
    Route::post('/edit/{id}', 'Backend\FormsController@update')->name('admin.forms.update');
    Route::post('/delete/{id}', 'Backend\FormsController@destroy')->name('admin.forms.delete');
  });

  // Cabinet/Meeting Reports Files Category
  Route::group(['prefix' => 'cabinet-files-categories'], function(){
    Route::get('/', 'Backend\CabinetCategoriesController@index')->name('admin.cabinetCategories.index');
    Route::get('/{id}/show', 'Backend\CabinetCategoriesController@show')->name('admin.cabinetCategories.show');
    Route::post('/create', 'Backend\CabinetCategoriesController@store')->name('admin.cabinetCategories.store');
    Route::post('/edit/{id}', 'Backend\CabinetCategoriesController@update')->name('admin.cabinetCategories.update');
    Route::post('/delete/{id}', 'Backend\CabinetCategoriesController@destroy')->name('admin.cabinetCategories.delete');
  });

  // Cabinet/Meeting Reports Files Sub Category
  Route::group(['prefix' => 'cabinet-files-sub-categories'], function(){
    Route::get('/', 'Backend\CabinetSubCategoriesController@index')->name('admin.cabinetSubCategories.index');
    Route::get('/{id}/show', 'Backend\CabinetSubCategoriesController@show')->name('admin.cabinetSubCategories.show');
    Route::post('/create', 'Backend\CabinetSubCategoriesController@store')->name('admin.cabinetSubCategories.store');
    Route::post('/edit/{id}', 'Backend\CabinetSubCategoriesController@update')->name('admin.cabinetSubCategories.update');
    Route::post('/delete/{id}', 'Backend\CabinetSubCategoriesController@destroy')->name('admin.cabinetSubCategories.delete');
  });

    // Cabinet/Meeting Reports Upload Files
    Route::group(['prefix' => 'cabinet-files'], function(){
      Route::get('/', 'Backend\CabinetFilesController@index')->name('admin.cabinetFiles.index');
      Route::get('/{id}/show', 'Backend\CabinetFilesController@show')->name('admin.cabinetFiles.show');
      Route::post('/create', 'Backend\CabinetFilesController@store')->name('admin.cabinetFiles.store');
      Route::post('/edit/{id}', 'Backend\CabinetFilesController@update')->name('admin.cabinetFiles.update');
      Route::post('/delete/{id}', 'Backend\CabinetFilesController@destroy')->name('admin.cabinetFiles.delete');
    });
 
  // Admission
  Route::group(['prefix' => 'admissions'], function(){
    Route::get('/', 'Backend\AdmissionsController@index')->name('admin.admissions.index');
    Route::get('/{id}/show', 'Backend\AdmissionsController@show')->name('admin.admissions.show');
    Route::get('/create', 'Backend\AdmissionsController@create')->name('admin.admissions.create');
    Route::post('/create', 'Backend\AdmissionsController@store')->name('admin.admissions.store');
    Route::get('/edit/{id}', 'Backend\AdmissionsController@edit')->name('admin.admissions.edit');
    Route::post('/edit/{id}', 'Backend\AdmissionsController@update')->name('admin.admissions.update');

    Route::group(['prefix' => 'notices'], function(){
      Route::get('/', 'Backend\AdmissionNoticeController@index')->name('admin.admissions.notices.index');
      Route::get('/{id}/show', 'Backend\AdmissionNoticeController@show')->name('admin.admissions.notices.show');
      Route::get('/create', 'Backend\AdmissionNoticeController@create')->name('admin.admissions.notices.create');
      Route::post('/create', 'Backend\AdmissionNoticeController@store')->name('admin.admissions.notices.store');
      Route::post('/delete/{id}', 'Backend\AdmissionNoticeController@destroy')->name('admin.admissions.notices.delete');
      Route::get('/delete-file/{id}', 'Backend\AdmissionNoticeController@deleteFile')->name('admin.admissions.notices.deleteFile');
      Route::post('/update/{id}', 'Backend\AdmissionNoticeController@update')->name('admin.admissions.notices.update');
      Route::get('/edit/{id}', 'Backend\AdmissionNoticeController@edit')->name('admin.admissions.notices.edit');
    });
    Route::post('/delete/{id}', 'Backend\AdmissionsController@destroy')->name('admin.admissions.delete');
  });


  // Gallery
  Route::group(['prefix' => 'galleries'], function(){
    Route::get('/', 'Backend\GalleriesController@index')->name('admin.galleries.index');
    Route::post('/create/{type}', 'Backend\GalleriesController@store')->name('admin.galleries.store');
    Route::post('/edit/{type}/{id}', 'Backend\GalleriesController@update')->name('admin.galleries.update');
    Route::post('/delete/{id}', 'Backend\GalleriesController@destroy')->name('admin.galleries.delete');
  });


  // Slider
  Route::group(['prefix' => 'sliders'], function(){
    Route::get('/', 'Backend\SlidersController@index')->name('admin.sliders.index');
    Route::post('/create', 'Backend\SlidersController@store')->name('admin.sliders.store');
    Route::post('/edit/{id}', 'Backend\SlidersController@update')->name('admin.sliders.update');
    Route::post('/delete/{id}', 'Backend\SlidersController@destroy')->name('admin.sliders.delete');
  });


  // Contact
  Route::group(['prefix' => 'contact'], function(){
    Route::get('/', 'Backend\ContactController@index')->name('admin.contact.index');
    Route::get('/message/{id}', 'Backend\ContactController@show')->name('admin.contact.show');
    Route::post('/delete/{id}', 'Backend\ContactController@destroy')->name('admin.contact.delete');
  });


 

  // Security Related
  Route::group(['prefix' => 'developers'], function(){
    Route::get('/login', 'Auth\Security\LoginController@showLoginForm')->name('security.login');
    Route::post('/login', 'Auth\Security\LoginController@login')->name('security.login.submit');
    Route::post('/logout', 'Auth\Security\LoginController@logout')->name('security.logout');

    // Security Related Reset Password
    Route::get('/password/reset', 'Auth\Security\ForgotPasswordController@showLinkRequestForm')->name('security.password.request');
    Route::post('/password/email', 'Auth\Security\ForgotPasswordController@sendResetLinkEmail')->name('security.password.email');
    Route::get('/password/reset/{token}', 'Auth\Security\ResetPasswordController@showResetForm')->name('security.password.reset');
    Route::post('/password/reset', 'Auth\Security\ResetPasswordController@reset');


    // Security Related Change Password
    Route::get('/change-password', 'Backend\DevelopersController@changePasswordForm')->name('admin.developer.changePasswordForm');
    Route::post('/change-password', 'Backend\DevelopersController@changePassword')->name('admin.developer.changePassword');

    Route::get('/', 'Backend\DevelopersController@index')->name('admin.developers.index');
    Route::get('/add-developer-info', 'Backend\DevelopersController@create')->name('admin.developers.create');
    Route::get('/edit-developer-info/{id}', 'Backend\DevelopersController@edit')->name('admin.developers.edit');
    Route::post('/store', 'Backend\DevelopersController@store')->name('admin.developers.store');
    Route::post('/update/{id}', 'Backend\DevelopersController@update')->name('admin.developers.update');
  });

});
