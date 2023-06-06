<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CabinetSubCategory extends Model
{
    protected $fillable = ['category_id', 'subcategory_title', 'priority'];
    public function cabinet()
{
    return $this->belongsTo(CabinetCategory::class, 'category_id');
}
public function files()
{
      return $this->hasMany(CabinetFile::class, 'sub_category_id');
}

}
