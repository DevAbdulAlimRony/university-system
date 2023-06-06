<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Research extends Model
{
    public $table = 'researches';
    public function teacher()
    {
      return $this->belongsTo(Teacher::class);
    }
}
