<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CabinetCategory extends Model
{
    protected $fillable = ['name', 'priority'];
    public function cabinets(){
        return $this->hasMany(CabinetSubCategory::class, 'category_id');
    }
    public function files()
    {
      return $this->hasMany(CabinetFile::class);
    }
}
