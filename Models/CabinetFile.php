<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CabinetFile extends Model
{
  protected $fillable = ['category_id', 'sub_category_id', 'title', 'file'];

  public function subcategory()
  {
    return $this->belongsTo(CabinetSubCategory::class, "sub_category_id");
  }
}
