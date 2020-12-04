<?php

namespace App\Http\Controllers\panel;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;
use function PHPUnit\Framework\isNull;

class AnnouncementsController extends Controller
{

    public function announcements(){
        $announcements= Announcement::all();
        return view('CMS.announcements.announcements',compact('announcements'));
    }


    public function index()
    {
        $announcements = Announcement :: orderByDesc('created_at') ->get();
        return view('CMS.announcements.list',compact('announcements'));

    }


    public function create()
    {
        return view('CMS.announcements.create');
    }


    public function create_announcements()
    {
        $title = strip_tags(request('title'));
        $content = strip_tags(request('content'));

        if(!empty($title) && strlen($title) <= 255 && !empty($content) && strlen($content) <= 5000){
            $announcements = new Announcement();
            $announcements -> title = $title;
            $announcements -> content = request('content');
            $announcements -> save();
        }
        return redirect()->route('CMS.announcements.create');

    }


    public function delete($id)
    {

        $announcements = Announcement::find($id);
        $announcements -> uptade(['is_deleted'=>1]);
        return redirect() -> route('CMS.announcements.list');

    }


    public function edit($id)
    {
        $announcements = Announcement::find($id);
        $announcements -> title = request('title');
        $announcements -> content = request('content');
        $announcements -> save();
        return view('CMS.announcements.edit',compact('announcements'));
    }


    public function update(Request $request, $id)
    {
        $fileName = null;
        if($request -> hasFile('announcements_img')){
            $fileName = $_FILES['announcements_img']['name'];
            move_uploaded_file($_FILES['announcements_img']['tmp_name'],public_path()."/announcements-images/".$fileName);
        }
        if(isNull($fileName)){
            Announcement::find($id) -> update([
               'title' => request('title'),
                'content' => request('content'),
                'slug' => request('title')
            ]);
        }
        else{
            Announcement::find($id) -> update([
               'title' => request('title'),
               'content' => request('content'),
               'slug' => request('title'),
               'img_path' => $fileName
            ]);
        }
    }


}
