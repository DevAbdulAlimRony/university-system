<?php

namespace App\Http\Controllers\BackEnd;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\CabinetSubCategory;
use App\Models\CabinetCategory;
use App\Models\CabinetFile;
use App\Helpers\StringHelper;
use Session;


class CabinetSubCategoriesController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $cabinetSubCategories = CabinetSubCategory::all();
        $cabinetData = CabinetCategory::all();
        return view('backend.pages.cabinetSubCategories.index', compact('cabinetSubCategories', 'cabinetData'));
    }

    public function store(Request $request)
    {
        $cabinetSubCategory = new CabinetSubCategory();
        $this->validate($request, [
            'subcategory_title' => 'required|unique:cabinet_sub_categories',
            'category_id' => 'required|exists:cabinet_categories,id',
            'priority' => 'nullable|numeric',
        ]);
        $name = $request->input('subcategory_title');
        if (preg_match('/^[A-Za-z\s]+$/', $name)) {
        // Convert the input string to camel case
        $name = ucwords(strtolower($name));
        }
        $cabinetSubCategory->subcategory_title = $name;
        $cabinetSubCategory->slug = StringHelper::createSlug($request->subcategory_title, 'CabinetSubCategory', 'slug');
        if($request->priority != null && $request->priority != ''){
          $cabinetSubCategory->priority = $request->priority;
        }
        $cabinetSubCategory->category_id = $request->category_id;
        $cabinetSubCategory->save();
        session()->flash('success', 'Cabinet Files Sub Category added successfully');
        return redirect()->route('admin.cabinetSubCategories.index');
    }

    public function update(Request $request, $id)
    {
        $cabinetSubCategory = CabinetSubCategory::find($id);

        $request->validate([
            'subcategory_title' => 'required',
            'category_id' => 'required',
            'priority' => 'nullable|numeric',
        ]);

        $name = $request->input('subcategory_title');
        if (preg_match('/^[A-Za-z\s]+$/', $name)) {
        // Convert the input string to camel case
        $name = ucwords(strtolower($name));
        }
       $cabinetSubCategory->subcategory_title = $name;
        if($request->priority != null && $request->priority != ''){
          $cabinetSubCategory->priority = $request->priority;
        }
        $cabinetSubCategory->category_id = $request->category_id;
        $cabinetSubCategory->slug = StringHelper::createSlug($request->subcategory_title, 'CabinetSubCategory', 'slug');
        $cabinetSubCategory->save();

        session()->flash('success', 'Cabinet Files Sub Category updated successfully');
        return redirect()->route('admin.cabinetSubCategories.index');
    }



    public function destroy($id)
    {
        $cabinetCategory = CabinetSubCategory::find($id);
        $forms = CabinetFile::where('sub_category_id', $cabinetCategory->id)->get();
        if(!is_null($forms)){
            foreach($forms as $form){
              if (File::exists('files/cabinets/'.$form->file)) {
                File::delete('files/cabinets/'.$form->file);
              }
              $form->delete();
            }
        }
        $cabinetCategory->delete();
        session()->flash('success', 'Report Sub Category deleted successfully');
        return redirect()->route('admin.cabinetCategories.index');
    }
}
