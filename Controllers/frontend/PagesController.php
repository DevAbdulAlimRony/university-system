<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Faculty;
use App\Models\About;
use App\Models\Noc;
use App\Models\Setting;
use App\Models\Notice;
use App\Models\Collaboration;
use App\Models\GalleryCategory;
use App\Models\Gallery;
use App\Models\Video;
use App\Models\AdmissionNotice;
use App\Models\CabinetCategory;
use App\Models\CabinetSubCategory;

class PagesController extends Controller
{

  public function index()
  {
    $faculties = Faculty::orderBy('faculty_fixed_id', 'asc')->get();
    $news = Notice::orderBy('updated_at', 'desc')->where('notice_or_news', 0)->where('status', 1)->limit(10)->get();
    $notices = Notice::orderBy('updated_at', 'desc')->where('notice_or_news', 1)->where('top_show', '!=', 1)->where('status', 1)->limit(10)->get();

    $top_notices = Notice::orderBy('updated_at', 'desc')->where('notice_or_news', 1)->where('status', 1)->where('top_show', 1)->limit(10)->get();

    $admission_notices = AdmissionNotice::orderBy('updated_at', 'desc')->limit(10)->get();
    $cabinetCategory = CabinetCategory::orderBy('priority', 'asc')->get();
    $cabinetSubCategory = CabinetSubCategory::orderBy('priority', 'asc')->get();

    $collaborations = Collaboration::orderBy('id', 'asc')->get();
    $galleries = Gallery::where('display_front', 1)->limit(6)->get();
    $galleryCategories = GalleryCategory::where('visible_front', 1)->get();
    $videos = Video::orderBy('id', 'desc')->get();

    $nocs = Noc::orderBy('id', 'desc')->limit(6)->get();

    $about = About::first();
    $settings = Setting::first();
    return view('frontend.pages.index')
    ->with('faculties', $faculties)
    ->with('notices', $notices)
    ->with('newss', $news)
    ->with('about', $about)
    ->with('admission_notices', $admission_notices)
    ->with('top_notices', $top_notices)
    ->with('collaborations', $collaborations)
    ->with('galleries', $galleries)
    ->with('galleryCategories', $galleryCategories)
    ->with('nocs', $nocs)
    ->with('videos', $videos)
    ->with('settings', $settings)
    ->with('cabinetCategory', $cabinetCategory)
    ->with(' cabinetSubCategory',  $cabinetSubCategory);
  }

  public function about()
  {
    return view('frontend.pages.about');
  }

  public function contact()
  {
    return view('frontend.pages.contact');
  }
  
}
