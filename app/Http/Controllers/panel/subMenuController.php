<?php

namespace App\Http\Controllers\panel;

use App\Models\Submenu;
use Illuminate\Http\Request;

class subMenuController extends Controller
{
    public function menu(){
        $subMenu = Submenu::all();
        return view('CMS.submenus.submenus',compact('subMenu'));
    }
    public function index()
    {
        return view('CMS.submenus.list',compact('submenus'));
    }


    public function create()
    {
        return view('CMS.submenus.create');
    }


    public function menu_create()
    {
        $title = strip_tags(\request('title'));
        $content = strip_tags(\request('content'));

        if(!empty($title) && strlen($title) && !empty($content) && strlen($content)){
            $subMenu = new Submenu();
            $title -> title = request('title');
            $content -> content = request('content');
            $subMenu -> save();
        }
        return redirect() -> route('CMS.submenus.create');
    }


    public function delete($id)
    {
        $subMenu = Submenu::find($id);
        $subMenu -> update(['is_deleted'=>1]);
        return redirect() -> route('CMS.submenus.list');
    }


    public function edit($id)
    {
        $subMenu = Submenu::find($id);
        $subMenu -> title = request('title');
        $subMenu -> content = request('content');
        $subMenu-> save();
        return view('CMS.submenus.edit',compact('subMenu'));

    }


    public function update(Request $request, $id)
    {
        $fileName = null;
        if(isNull($fileName)){
            Submenu::find($id) -> update([
                'title' => request('title'),
                'content' => request('content'),
            ]);
        }
        else{
            Submenu::find($id) -> update([
                'title' => request('title'),
                'content' => request('content'),
            ]);
        }
    }



}
