<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use DB;
use Session;
use App\Articles;
use App\User;
use App\Library\Library;

class NewsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function langNews($lang){        
        return view('public.list-news')
        ->with('lang',$lang)
        ->with('recArticle',Articles::getAllIsActive()->get())
        ->with('recArticleHot',Articles::getAllIsActiveHot()->get());
    }

    public function langNewsDetail($lang,$slug){        
        return view('public.detail-news')
        ->with('lang',$lang)
        ->with('recArticleBySlug',Articles::getBySlug($slug)->first())
        ->with('recArticleLatest',Articles::getAllIsActiveLatest()->get());
        
    }

}
