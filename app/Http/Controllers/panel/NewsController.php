<?php

namespace App\Http\Controllers\panel;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{

    public function index(){
        return view('panel.news.create');
    }
    //list
    public function list()
    {
        $news=News::all();
        return view('panel.news.list')->with('news',$news);
    }

    public function create(Request $request){
        //validates
        //

        News::create([
           'title'=>$request->title,
           'content'=>$request->content,
            'img_path'=>$request->file('img')->getClientOriginalName(),
        ]);

        return redirect()->route('panel.news.list');
    }

    public function edit(Request $request, $id){
        //
    }

    public function delete($id){
        $news = News::find($id);
        $news->delete();
        return view('panel.news.list');
    }

}
