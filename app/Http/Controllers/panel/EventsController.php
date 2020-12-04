<?php

namespace App\Http\Controllers\panel;

use Illuminate\Http\Request;
use App\Models\Event;
use Symfony\Component\Console\Input\Input;
use function PHPUnit\Framework\isNull;

class EventsController extends Controller
{

    public function events(){
        $events = Event::all();
        return view('CMS.events.events',compact('events'));
    }

    public function index()
    {
        $events = Event :: orderByDesc('created_at') ->get();
        return view('CMS.events.list',compact('events'));
    }


    public function create()
    {
        return view('CMS.events.create');
    }


    public function create_events(){

        $title = strip_tags(request('title'));
        $content = strip_tags(request('content'));

        if(!empty($title) && strlen($title) <= 255 && !empty($content) && strlen($content) <= 5000){
            $events = new Event();
            $events -> title = $title;
            $events -> content = request('content');
            $events -> save();
        }
        return redirect()->route('CMS.events.create');
    }

    public function delete($id){

        $events = Event::find($id);
        $events -> uptade(['is_deleted'=>1]);
        return redirect() -> route('CMS.events.list');

    }

    public function edit($id){

        $events = Event::find($id);
        $events -> title = request('title');
        $events -> content = request('content');
        $events -> save();
        return view('CMS.events.edit',compact('events'));

    }

    public function update(Request $request, $id)
    {
        $fileName = null;
        if($request -> hasFile('events_img')){
            $fileName = $_FILES['events_img']['name'];
            move_uploaded_file($_FILES['events_img']['tmp_name'],public_path()."/events-images/".$fileName);
        }
        if(isNull($fileName)){
            Event::find($id) -> update([
                'title' => request('title'),
                'content' => request('content'),
                'slug' => request('title')
            ]);
        }
        else{
            Event::find($id) -> update([
                'title' => request('title'),
                'content' => request('content'),
                'slug' => request('title'),
                'img_path' => $fileName
            ]);
        }
    }


}
