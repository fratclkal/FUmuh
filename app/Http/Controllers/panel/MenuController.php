<?php

namespace App\Http\Controllers\panel;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isNull;

class MenuController extends Controller
{
    public function menu(){
        $menu = Menu::all();
        return view('CMS.menu.menu',compact('menu'));
    }
    public function index()
    {

    }


    public function create()
    {
        return view('CMS.menu.menu');
    }


    public function menu_create()
    {
        $title = strip_tags(\request('title'));
        $content = strip_tags(\request('content'));

        if(!empty($title) && strlen($title) && !empty($content) && strlen($content)){
            $menu = new Menu();
            $title -> title = request('title');
            $content -> content = request('content');
            $menu -> save();
        }
        return redirect() -> route('CMS.menu.create');
    }


    public function delete($id)
    {
        $menu = Menu::find($id);
        $menu -> update(['is_deleted'=>1]);
        return redirect() -> route('CMS.menu.list');
    }


    public function edit($id)
    {
        $menu = Menu::find($id);
        $menu -> title = request('title');
        $menu -> content = request('content');
        $menu -> save();
        return view('CMS.menu.edit',compact('menu'));

    }


    public function update(Request $request, $id)
    {
        $fileName = null;
        if(isNull($fileName)){
            Menu::find($id) -> update([
                'title' => request('title'),
                'content' => request('content'),
            ]);
        }
        else{
            Menu::find($id) -> update([
                'title' => request('title'),
                'content' => request('content'),
            ]);
        }
    }


    public function destroy($id)
    {

    }
}
