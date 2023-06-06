<?php

namespace App\Helpers;

use Image;
use Request;
use File;

use App\Models\Teacher;
use App\Models\Faculty;
use App\Models\Hall;
use App\Models\Office;
use App\Models\Employee;
use App\Models\Administrator;
use App\Models\CabinetCategory;

class ReturnPathHelper
{
  /**
  * getTeacherImage
  *
  * Returns the associated image of any teacher.
  *   First tries to get the URL from email If fails, then
  *   Try from database
  *     if success then check if the file exists there, if not then returns the default image URL
  *     else return the default image URL
  *
  * @param  [type] $teacher_id [description]
  * @return [type]             [description]
  */
  public static function getTeacherImage($teacher_id)
  {
    $teacher = Teacher::find($teacher_id);

    if (is_null($teacher->image) || $teacher->image == "") {
      $image_url = 'images/defaults/default.png';
    }else{
      if (File::exists('images/teachers/'.$teacher->image)) {
        $image_url = 'images/teachers/'.$teacher->image;
      }else{
        //Find Gravator image from Gravaton
        $image_url = 'images/defaults/default.png';
      }
    }
    return $image_url;
  }


  public static function getEmployeeImage($employee_id)
  {
    $employee = Employee::find($employee_id);

    if (is_null($employee->image) || $employee->image == "") {
      $image_url = 'images/defaults/default.png';
    }else{
      if (File::exists('images/employees/'.$employee->image)) {
        $image_url = 'images/employees/'.$employee->image;
      }else{
        //Find Gravator image from Gravaton
        $image_url = 'images/defaults/default.png';
      }
    }
    return $image_url;
  }

  public static function getAdministratorImage($administrator_id)
  {
    $administrator = Administrator::find($administrator_id);

    if (is_null($administrator->image) || $administrator->image == "") {
      //Check administrator is a teacher -> match email or not
      $teacher = Teacher::orWhere('email', $administrator->email)->orWhere('phone_no', $administrator->phone_no)->first();
      if (!is_null($teacher)) {
        $image_url = 'images/teachers/'.$teacher->image;
      }else{
        $image_url = 'images/defaults/default.png';
      }

    }else{
      if (File::exists('images/administrators/'.$administrator->image)) {
        $image_url = 'images/administrators/'.$administrator->image;
      }else{
        //Check administrator is a teacher -> match email or not
        $teacher = Teacher::orWhere('email', $administrator->email)->orWhere('phone_no', $administrator->phone_no)->first();
        if (!is_null($teacher)) {
          $image_url = 'images/teachers/'.$teacher->image;
        }else{
          $image_url = 'images/defaults/default.png';
        }
      }
    }
    return $image_url;
  }

  public static function getFacultyImage($faculty_id)
  {
    $faculty = Faculty::find($faculty_id);

    if (is_null($faculty->image) || $faculty->image == "") {
      $image_url = 'images/defaults/faculty.jpg';
    }else{
      if (File::exists('images/faculties/'.$faculty->image)) {
        $image_url = 'images/faculties/'.$faculty->image;
      }else{
        $image_url = 'images/defaults/faculty.jpg';
      }
    }
    return $image_url;
  }

  public static function getHallImage($hall_id)
  {
    $hall = Hall::find($hall_id);
    if (!is_null($hall->image) || $hall->image != "") {
      if (File::exists('images/halls/'.$hall->image)) {
        $image_url = 'images/halls/'. $hall->image;
      }else if($hall->galleries->count() > 0){
        $image_url = 'images/galleries/'.$hall->galleries->first()->image;
      }else{
        $image_url = 'images/defaults/hall.jpg';
      }
    }else if($hall->galleries->count() > 0){
      $image_url = 'images/galleries/'.$hall->galleries->first()->image;
    }else{
      $image_url = 'images/defaults/hall.jpg';
    }
    return $image_url;
  }
  
  public static function getOfficeImage($office_id)
  {
    $office = Office::find($office_id);
    if (!is_null($office->image) || $office->image != "") {
      if (File::exists('images/offices/'.$office->image)) {
        $image_url = 'images/offices/'. $office->image;
      }else if($office->galleries->count() > 0){
        $image_url = 'images/galleries/'.$office->galleries->first()->image;
      }else{
        $image_url = 'images/defaults/office.jpg';
      }
    }else if($office->galleries->count() > 0){
    //   $image_url = 'images/defaults/office.jpg';
      $image_url = 'images/galleries/'.$office->galleries->first()->image;
    }else{
      $image_url = 'images/defaults/office.jpg';
    }
    return $image_url;
  }

  public static function getCabinetCategoryImage($id)
  {
    $cabinetCategory = CabinetCategory::find($id);

    // if (is_null($cabinetCategory->image) || $cabinetCategory->image == "") {
    //     $image_url = 'defaults/cabinet.png';
    // } else {
        //if (File::exists('cabinets/' . $cabinetCategory->image)) {
            $image_url = 'cabinets/' . $cabinetCategory->image;
        //} else {
           // $image_url = 'defaults/cabinet.png';
        //}
    //}
    return $image_url;
  }

}
