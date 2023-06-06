<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CabinetCategory;
use App\Models\CabinetSubCategory;
use App\Models\CabinetFile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Helpers\ImageUploadHelper;
use App\Helpers\UploadHelper;
use App\Helpers\StringHelper;
//use App\Models\DownloadForm;
use Session;
use File;

class CabinetCategoriesController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }


    /**
     * [return to cabinetcategories show page with all cabinetCategories]
     * @return [view] [backend.pages.cabinetCategories.index]
     */
    public function index()
    {
        $cabinetCategories = CabinetCategory::all();
        return view('backend.pages.cabinetCategories.index', compact('cabinetCategories'));
    }


    /**
     * [store cabinet category information to cabinet-categories table]
     * @param  Request $request [form data]
     * @return [type]           [description]
     */
    public function store(Request $request)
    {
        $cabinetCategory = new CabinetCategory();

        $this->validate($request, [
            'name' => 'required|unique:cabinet_categories',
            'image' => 'image|required|mimes:jpg,jpeg,png,bmp,gif,svg|max:2048',
            'priority' => 'nullable|numeric'
        ]);

        // Handle category image upload (if provided)
            $imageName = time();
            $cabinetCategory->image = ImageUploadHelper::upload('image', $request->file('image'), $imageName, 'images/cabinets');
        // Check if the input string is an English language sentence
        $name = $request->input('name');
        if (preg_match('/^[A-Za-z\s]+$/', $name)) {
        // Convert the input string to camel case
        $name = ucwords(strtolower($name));
        }
       $cabinetCategory->name = $name;
       $cabinetCategory->slug = StringHelper::createSlug($request->name, 'CabinetCategory', 'slug');
        if($request->priority != null && $request->priority != ''){
          $cabinetCategory->priority = $request->priority;
        }
        $cabinetCategory->save();
        session()->flash('success', 'Cabinet Files Category added successfully');
        return redirect()->route('admin.cabinetCategories.index');
    }

    public function update(Request $request, $id)
    {
        $cabinetCategory = CabinetCategory::find($id);

        $this->validate($request, [
            'name' => 'required|unique:cabinet_categories,name,'.$cabinetCategory->id,
        ]);
        $name = $request->input('name');
        if (preg_match('/^[A-Za-z\s]+$/', $name)) {
        // Convert the input string to camel case
        $name = ucwords(strtolower($name));
        }
       $cabinetCategory->name = $name;
       
       // check if image request
       if($request->image){
        // if this row has image then update it else upload image
        $imageName = time();
        if($cabinetCategory->image){
            $old_location = $cabinetCategory->image;
            $cabinetCategory->image = ImageUploadHelper::updateImage('image', $request->file('image'), $imageName, 'images/cabinets', $old_location);
        }
        // upload image
        else{
            $cabinetCategory->image = ImageUploadHelper::upload('image', $request->file('image'), $imageName, 'images/cabinets');
        }
    }
    
        if($request->priority != null && $request->priority != ''){
          $cabinetCategory->priority = $request->priority;
        }

        $cabinetCategory->save();
        $cabinetCategory->slug = StringHelper::createSlug($request->name, 'CabinetCategory', 'slug');
        session()->flash('success', 'Cabinet Files Category updated successfully');
        return redirect()->route('admin.cabinetCategories.index');
    }



    public function destroy($id)
    {
        $cabinetCategory = CabinetCategory::find($id);

        $subs = CabinetSubCategory::where('category_id', $cabinetCategory->id)->get();
    if(!is_null($subs)){
    foreach($subs as $sub){
        $forms = CabinetFile::where('sub_category_id', $sub->id)->get();
        if(!is_null($forms)){
            foreach($forms as $form){
              if (File::exists('files/cabinets/'.$form->file)) {
                File::delete('files/cabinets/'.$form->file);
              }
              $form->delete();
            }
        }
        $sub->delete();
    }
}
        $cabinetCategory->delete();
        session()->flash('success', 'Report Category deleted successfully');
        return redirect()->route('admin.cabinetCategories.index');
    }
}
