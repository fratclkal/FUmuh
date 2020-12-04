<?php

namespace App\Http\Controllers\panel;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isNull;

class NewsController extends Controller
{
    public function news(){

        $news = News::all();
        return view('CMS.news.list',compact('news'));
    }

    public function index()
    {
        $news = News:: orderByDesc('creadet_at') ->get();
        return view('CMS.news.list',compact('news'));
    }


    public function create()
    {
        return view('CMS.news.create');
    }


    public function create_news()
    {
        $title = strip_tags(request('title'));
        $content = strip_tags(request('content'));
        if(!empty($title) && strlen($title) <= 255 && !empty($content) && strlen($content) <= 5000){
            $news = new News();
            $news -> title = request('title');
            $news -> content = request('content');
            $news -> save();
        }
        return redirect() -> route('CMS.news.create');
    }


    public function delete($id)
    {
        $news = News::find($id);
        $news -> update(['is_deleted' => 1]);
        return redirect() -> route('CMS.news.list');
    }


    public function edit($id)
    {
       $news = News::find($id);
       $news -> title = request('title');
       $news -> content = request('content');
       $news -> save();
       return view('CMS.news.edit',compact('news'));

    }


    public function update(Request $request, $id)
    {
        $fileName = null;
        if($request -> hasFile('announcements_img')){
            $fileName = $_FILES['announcements_img']['name'];
            move_uploaded_file($_FILES['announcements_img']['tmp_name'],public_path()."/announcements-images/".$fileName);
        }
        if(isNull($fileName)){
            News::find($id) -> update([
                'title' => request('title'),
                'content' => request('content'),
                'slug' => request('title')
            ]);
        }
        else{
            News::find($id) -> update([
                'title' => request('title'),
                'content' => request('content'),
                'slug' => request('title'),
                'img_path' => $fileName
            ]);
        }
    }

}
