<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\CabinetCategory;
use App\Models\CabinetSubCategory;
use App\Models\CabinetFile;

class MeetingReportsController extends Controller
{
    public function show($category_slug, $subcategory_slug){
        $reportCategory = CabinetCategory::where('slug', $category_slug)->first();
        $reportSubCategory = CabinetSubCategory::where('slug', $subcategory_slug)->first();

        $category_id = $reportCategory->id;
        $subcategory_id = $reportSubCategory->id;
        $reports = CabinetFile::where('sub_category_id', $subcategory_id)->get();
        return view('frontend.pages.reports.show')
        ->with('reportCategory', $reportCategory)
        ->with('reportSubCategory', $reportSubCategory)
        ->with('reports', $reports);  
    }
}
