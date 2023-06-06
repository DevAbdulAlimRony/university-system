<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Teacher;
use App\Models\TeacherProfileLink;
use App\Helpers\UploadHelper;

use Auth;
use File;
use Session;

class TeacherProfileLinksController extends Controller
{
  public function __construct(){
    $this->middleware('auth:teacher', ['only' => ['manageProfiles', 'create', 'store', 'edit', 'delete']]);
  }
  public function manageProfiles()
  {
    $teacher = Auth::guard('teacher')->user();
    return view('frontend.pages.teachers.manageProfiles')->with('teacher', $teacher);
  }

  public function store(Request $request)
  {
    $this->validate($request, [
        'title'              => 'required|unique:teacher_profile_links|max:150',
        'link'               => 'required|unique:teacher_profile_links|url'
    ],
    [
      'title.required'  => 'Please provide the website name',
      'title.unique'  => 'Same name already taken',
      'link.required'  => 'Please provide your profile link',
      'link.unique'  => 'Same Link already taken',
    ]
  );
  $teacher = Auth::guard('teacher')->user();
  $profile = new TeacherProfileLink;
  $title = $request->input('title');
        if (preg_match('/^[A-Za-z\s]+$/', $title)) {
        // Convert the input string to camel case
        $title = ucwords(strtolower($title));
        }
        $profile->title = $title;
        // $profile->title = $request->title;
        $profile->link = $request->input('link');
        $profile->teacher_id = $teacher->id;
        $profile->save();
    
        Session::flash('success', 'Your profile link has added successfully.');
        return redirect()->route('teacher.profiles.manage');
}

public function update(Request $request, $id)
{

  $profile = TeacherProfileLink::find($id);
  $this->validate($request, [
    'title'              => 'required|max:150',
    'link'               => 'required|url'
  ],
  [
    'title.required'  => 'Please provide the website name',
    'link.required'  => 'Please provide your profile link',
  ]
);
$teacher = Auth::guard('teacher')->user();
        $profile->title = $request->title;
        $profile->link = $request->link;
        $profile->teacher_id = $teacher->id;
        $profile->save();
    
        Session::flash('success', 'Your profile link has updated successfully.');
        return redirect()->route('teacher.profiles.manage');
}


public function delete($id)
{
    $profile = TeacherProfileLink::find($id);
    $profile->delete();
    Session::flash('success', 'Link has deleted successfully !!');
    return back();
}

}
