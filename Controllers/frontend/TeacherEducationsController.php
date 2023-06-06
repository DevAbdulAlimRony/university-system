<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use App\Models\Teacher;
use App\Models\TeacherEducation;
use App\Helpers\UploadHelper;

use Auth;
use File;
use Session;

class TeacherEducationsController extends Controller
{
    public function __construct(){
        $this->middleware('auth:teacher', ['only' => ['manageEducations', 'create', 'store', 'edit', 'delete']]);
      }
      public function manageEducations()
      {
        $teacher = Auth::guard('teacher')->user();
        return view('frontend.pages.teachers.manageEducations')->with('teacher', $teacher);
      }
    
      public function store(Request $request)
      {
        $this->validate($request, [
            'degree'              => 'required|unique:teacher_educations|max:150',
            'institute'              => 'required',
            'major'              => 'required',
            'country'              => 'required',
            'passing_year'               => 'unique:teacher_educations',
        ],
        [
          'degree.required'  => 'Please Provide the Degree Name',
          'institute.required'  => 'Please Provide the institute Name',
          'major.required'  => 'Please Provide the major subject/department/faculty/group Name',
          'country.required'  => 'Please Provide the country Name',
          'degree.unique'  => 'Same degree already taken',
          'passing_year.unique'  => 'Same passing year already taken for another degree',
        ]
        
      );
      $teacher = Auth::guard('teacher')->user();
      $education = new TeacherEducation;
      $education->degree = $request->degree;
      $education->institute = $request->institute;
      $education->major = $request->major;
      $education->country = $request->country;
      $education->passing_year = $request->passing_year;
      $education->teacher_id = $teacher->id;
      $education->save();
      Session::flash('success', 'Information has added successfully.');
      return redirect()->route('teacher.educations.manage');
    }
    
    public function update(Request $request, $id)
    {
    
      $education = TeacherEducation::find($id);
      $this->validate($request, [
            'degree'              => 'required|max:150',
            'institute'              => 'required',
            'major'              => 'required',
            'country'              => 'required',
      ],
      [
        'degree.required'  => 'Please Provide the Degree Name',
        'institute.required'  => 'Please Provide the institute Name',
        'major.required'  => 'Please Provide the major subject/department/faculty/group Name',
        'country.required'  => 'Please Provide the country Name',
      ]
    );
    $teacher = Auth::guard('teacher')->user();
    $education->degree = $request->degree;
    $education->institute = $request->institute;
    $education->major = $request->major;
    $education->country = $request->country;
    $education->passing_year = $request->passing_year;
    $education->teacher_id = $teacher->id;       
    $education->save();
        
            Session::flash('success', 'Information has updated successfully.');
            return redirect()->route('teacher.educations.manage');
    }
    
    
    public function delete($id)
    {
        $education = TeacherEducation::find($id);
        $education->delete();
        Session::flash('success', 'Information has deleted successfully !!');
        return back();
    }
    
}
