<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\UploadHelper;
use App\Helpers\StringHelper;
use App\Models\CabinetFile;
use App\Models\CabinetCategory;
use App\Models\CabinetSubCategory;
use Session;
use DB;

class CabinetFilesController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
     }
    
      public function index()
      {
        $files = CabinetFile::all();
        $cabinetCategories = CabinetCategory::orderBy('priority', 'ASC')->get();
        $cabinetSubCategories = CabinetSubCategory::orderBy('priority', 'ASC')->get();

        //dd($files, $cabinetCategories, $cabinetSubCategories);

        return view('backend.pages.cabinetFiles.index', compact('files', 'cabinetCategories', 'cabinetSubCategories'));
      }

      // public function GetSubCatAgainstMainCatEdit($id){
      //   echo json_encode(DB::table('cabinet_sub_categories')->where('category_id', $id)->get());
      // }
    
      public function store(Request $request)
      {
        $this->validate($request, [
          'title' => 'required|unique:cabinet_files|max:255',
          'file' => 'required',
           'sub_category_id' => 'required|exists:cabinet_sub_categories,id'
        ]);
    
        $file = new CabinetFile();
        $fileName = time();
        $name = $request->input('title');
        if (preg_match('/^[A-Za-z\s]+$/', $name)) {
            $name = ucwords(strtolower($name));
            }
        $file->title = $name;
        //$file->category_id = $request->category_id;
        $file->sub_category_id = $request->sub_category_id;
        $file->file = UploadHelper::upload('file', $request->file('file'), $fileName, 'files/cabinets');
        $file->save();
    
        session()->flash('success', 'File information added successfully');
        return redirect()->route('admin.cabinetFiles.index');
      }
    
      public function update(Request $request, $id)
      {
        $this->validate($request, [
          'title' => 'required|max:255',
          'sub_category_id' => 'required|exists:cabinet_sub_categories,id'
        ]);
    
        $file = CabinetFile::find($id);
        $file->title = $request->title;
         $name = $request->input('title');
        if (preg_match('/^[A-Za-z\s]+$/', $name)) {
            $name = ucwords(strtolower($name));
            }
        $file->title = $name;
        //$file->category_id = $request->category_id;
        $file->sub_category_id = $request->sub_category_id;
    
        // check if image request
        if($request->file){
          // if this row has image then update it else upload image
          $fileName = time();
          if($file->file){
            $file->file = UploadHelper::update('file', $request->file('file'), $fileName, 'files/cabinets', $file->file);
          }
          // upload file
          else{
            $file->file = UploadHelper::upload('file', $request->file('file'), $fileName, 'files/cabinets');
          }
        }
    
        $file->save();
    
        session()->flash('success', 'File information updated successfully');
        return redirect()->route('admin.cabinetFiles.index');
      }
    
      public function destroy($id)
      {
        $file = CabinetFile::find($id);
        if(!is_null($file)){
            UploadHelper::deleteFile('files/cabinets/'.$file->file);
        }
        $file->delete();
        session()->flash('error', 'File information deleted successfully');
    
        return redirect()->route('admin.cabinetFiles.index');
      }
}
