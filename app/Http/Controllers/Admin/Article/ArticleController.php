<?php

namespace App\Http\Controllers\Admin\Article;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\Library;
use App\Articles;
use App\ArticlesCategory;
use Validator;
use Auth;
use Str;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->moduleLink = 'administrator/master-article';
    }

    public function index()
    {
        // Validate Access
        Library::validateAccess('view',$this->moduleLink);

        return view('admin.article.index')->with('recArticles',Articles::getAll()->get());
    }

    public function create()
    {
        // Validate Access
        Library::validateAccess('create',$this->moduleLink);

        return view('admin.article.create')->with('recArticlesCategory',ArticlesCategory::where('is_active',1)->get());
    }

    public function store(Request $request)
    {       
        // dd($request->all());
        $rules=[
            'slug'=>'required',
            'article_title_id'=>'required|min:5|max:100',
            'article_brief_id'=>'required|max:150',
            'article_category_id'=>'required',
            'is_active'=>'required',
            'is_active'=>'required'
        ];

        $validation = Validator::make($request->input(),$rules);
        if($validation->fails()) {  
          return redirect(route('master-article.create'))->withErrors($validation)->withInput();
        }
    
        $rec = new Articles;
        $rec->slug = trim($request->input('slug'));
        $rec->article_title_en = trim($request->input('article_title_en'));
        $rec->article_title_id = trim($request->input('article_title_id'));
        $rec->article_brief_en = trim($request->input('article_brief_en'));
        $rec->article_brief_id = trim($request->input('article_brief_id'));
        $rec->article_desc_en = trim($request->input('article_desc_en'));
        $rec->article_desc_id = trim($request->input('article_desc_id'));
        $rec->created_by = $request->input('created_by');
        
        //Banner
        if( $request->has('banner') ) {
            $file = $request->file('banner');
            $fileName = time().Str::slug($request->input('article_title_en')).'.'.$file->getClientOriginalExtension();

            $destinationPath = public_path('uploads/article/banner');
            $file->move($destinationPath,$fileName);
            $rec->banner = $fileName;
        }

        //Thumbnail
        if( $request->has('thumb') ) {
            $file = $request->file('thumb');
            $fileName = time().Str::slug($request->input('article_title_en')).'.'.$file->getClientOriginalExtension();

            $destinationPath = public_path('uploads/article/thumb');
            $file->move($destinationPath,$fileName);
            $rec->thumb = $fileName;
        }

        //File Attachement
        if( $request->has('files') ) {
            $file = $request->file('files');
            $fileName = time().Str::slug($request->input('article_title_en')).'.'.$file->getClientOriginalExtension();

            $destinationPath = public_path('uploads/article/file_attachement');
            $file->move($destinationPath,$fileName);
            $rec->file_attachement = $fileName;
        }

        $rec->article_category_id = $request->input('article_category_id');
        $rec->is_active = $request->input('is_active');
        $rec->is_hot = $request->input('is_hot');

        // SEO
        $rec->seo_title = trim($request->input('seo_title'));
        $rec->seo_keyword = trim($request->input('seo_keyword'));
        $rec->seo_description = trim($request->input('seo_description'));

        $rec->save();

        return redirect(route('master-article.index'))->with('success-update','Your work has been saved!');
    }

    public function edit($id)
    {
        // Validate Access
        Library::validateAccess('update',$this->moduleLink);

        return view('admin.article.edit')->with('recArticleByID',Articles::find($id))->with('recArticlesCategory',ArticlesCategory::where('is_active',1)->get());
    }

    public function update($id, Request $request)
    {
        // dd($request->all());
        $rules=[
            'slug'=>'required',
            'article_title_id'=>'required|min:5|max:100',
            'article_brief_id'=>'required|max:150',
            'article_category_id'=>'required',
            'is_active'=>'required',
            'is_hot'=>'required'
        ];

        $validation = Validator::make($request->input(),$rules);
        if($validation->fails()) {  
            return redirect(route('master-article.edit',['id'=>$id]))->withErrors($validation)->withInput();
        }

        $rec = Articles::find($id);
        $rec->slug = trim($request->input('slug'));
        $rec->article_title_id = trim($request->input('article_title_id'));
        $rec->article_brief_id = trim($request->input('article_brief_id'));
        $rec->article_desc_id = trim($request->input('article_desc_id'));
        $rec->updated_by = $request->input('updated_by');
        
        //Banner
        if( $request->has('banner') ) {
            $file = $request->file('banner');
            $fileName = time().Str::slug($request->input('article_title_en')).'.'.$file->getClientOriginalExtension();

            $destinationPath = public_path('uploads/article/banner');
            $file->move($destinationPath,$fileName);
            $rec->banner = $fileName;
        }

        //Thumbnail
        if( $request->has('thumb') ) {
            $file = $request->file('thumb');
            $fileName = time().Str::slug($request->input('article_title_en')).'.'.$file->getClientOriginalExtension();

            $destinationPath = public_path('uploads/article/thumb');
            $file->move($destinationPath,$fileName);
            $rec->thumb = $fileName;
        }

        //File Attachement
        if( $request->has('files') ) {
            $file = $request->file('files');
            $fileName = time().Str::slug($request->input('article_title_en')).'.'.$file->getClientOriginalExtension();

            $destinationPath = public_path('uploads/article/file_attachement');
            $file->move($destinationPath,$fileName);
            $rec->file_attachement = $fileName;
        }

        $rec->article_category_id = $request->input('article_category_id');
        $rec->is_active = $request->input('is_active');
        $rec->is_hot = $request->input('is_hot');

        $rec->save();

        return redirect(route('master-article.index'))->with('success-update','Your work has been saved!');
    }

    public function update_optional(Request $request)
    {
        $id = $request->input('article_id');
        $rec = Articles::find($id);
        $rec->article_title_en = trim($request->input('article_title_en'));
        $rec->article_brief_en = trim($request->input('article_brief_en'));
        $rec->article_desc_en = trim($request->input('article_desc_en'));
        $rec->updated_by = $request->input('updated_by');
        $rec->save();

        // return redirect(route('master-article.index'))->with('success-update','Your work has been saved!')->with('article-tab','optional');
        return redirect(route('master-article.edit',['id'=>$id]))->with('success-update','Your work has been saved!')->with('article-tab','optional');
    }

    public function update_seo(Request $request)
    {
        $id = $request->input('article_id');
        $rec = Articles::find($id);
        $rec->seo_title = trim($request->input('seo_title'));
        $rec->seo_keyword = trim($request->input('seo_keyword'));
        $rec->seo_description = trim($request->input('seo_description'));
        $rec->updated_by = $request->input('updated_by');
        $rec->save();

        return redirect(route('master-article.edit',['id'=>$id]))->with('success-update','Your work has been saved!')->with('seo-tab','seo');
    }

    public function destroy($id)
    {
        // Validate Access
        Library::validateAccess('delete',$this->moduleLink);

        try
        {
            $rec = Articles::find($id);
            $rec->delete();

            return response()->json(['status'=>1,'msg'=>'Your work has been saved!'], 200);
        } 
        catch (\Exection $e) 
        {
            return response()->json(['status'=>0,'error'=>$e->getMessage()], 200);
        }
    }

    // ADDITIONAL FUNCTIONS
    public function deleteFile($id)
    {
        try
        {
            $rec = Articles::find($id);
            $rec->file_attachement = NULL;
            $rec->save();

            return redirect(route('master-article.edit',['id'=>$id]))->with('success-update','Your file has been removed!');
        } 
        catch (\Exection $e) 
        {
            return response()->json(['status'=>0,'error'=>$e->getMessage()], 200);
        }
    }

}
