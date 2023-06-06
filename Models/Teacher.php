<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\TeacherResetPasswordNotification;
class Teacher extends Authenticatable
{
  use Notifiable;

  protected $guard = "teacher";


  /**
  * The attributes that are mass assignable.
  *
  * @var array
  */
  protected $fillable = [
    'first_name', 
    'last_name', 
    'username', 
    'email', 
    'phone_no', 
    'fax_no', 
    'password', 
    'university_address', 
    'home_address', 
    'image', 
    'education', 
    'awards', 
    'cv_description', 
    'cv_file', 
    'status',
    'priority',
    'website_link',
    'facebook_link',
    'linkedin_link',
    'twitter_link'
  ];

  /**
  * The attributes that should be hidden for arrays.
  *
  * @var array
  */
  protected $hidden = [
    'password', 'remember_token',
  ];

  /**
  * Send the password reset notification.
  *
  * @param  string  $token
  * @return void
  */
  public function sendPasswordResetNotification($token)
  {
    $this->notify(new TeacherResetPasswordNotification($token));
  }


  public function department(){
    return $this->belongsTo(Department::class);
  }

  public function faculty(){
    return $this->belongsTo(Faculty::class);
  }

  public function designation(){
    return $this->belongsTo(Designation::class);
  }

  public function educations(){
    return $this->hasMany(TeacherEducation::class)->orderBy('id', 'desc');
  }
  public function researches(){
    return $this->hasMany(Research::class)->orderBy('id', 'desc');
  }

  public function publications(){
    return $this->hasMany(Publication::class)->orderBy('id', 'desc');
  }
  
  public function projects(){
    return $this->hasMany(Project::class)->orderBy('id', 'desc');
  }
  public function profiles(){
    return $this->hasMany(TeacherProfileLink::class)->orderBy('id', 'desc');
  }
  
  public function messages(){
    return $this->hasMany(Message::class, 'receiver_teacher_id')->orderBy('id', 'desc');
  }

  public function materials(){
    return $this->hasMany(TeacherMaterial::class)->orderBy('id', 'desc');
  }
}
