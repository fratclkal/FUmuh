<?php

namespace App\Http\Controllers\panel;

use Illuminate\Http\Request;
use App\Models\Fastaccess;

class FastAccessController extends Controller
{
    public function fastAccesses(){
        $fastAccesses = Fastaccess::all();
        return view('CMS.fastAccesses.fastAccesses',compact('fastAccesses'));
    }

    public function index(){
        return view('CMS.fastAccesses.list',compact('fastAccesses'));
    }

    public function create(){
        return view('CMS.fastAccesses.create');
    }

    public function create_fastAccesses(){

        if(!empty($url)){
            $fastAccesses = new Fastaccess();
            $fastAccesses -> url = request ('url');
            $fastAccesses -> save();
        }
        return redirect()->route('CMS.fastAccesses.create');

    }

    public function delete($id)
    {

        $fastAccesses = Fastaccess::find($id);
        $fastAccesses -> uptade(['is_deleted'=>1]);
        return redirect() -> route('CMS.fastAccesses.list');

    }

    public function edit($id)
    {
        $fastAccesses = Fastaccess::find($id);
        $fastAccesses -> url = request('url');
        $fastAccesses -> save();
        return view('CMS.fastAccesses.edit',compact('fastAccesses'));
    }

    public function update(Request $request, $id)
    {
        $fileName = null;
        if($request -> hasFile('fastAccesses_img')){
            $fileName = $_FILES['fastAccesses_img']['name'];
            move_uploaded_file($_FILES['fastAccesses_img']['tmp_name'],public_path()."/fastAccesses-images/".$fileName);
        }
        if(isNull($fileName)){
            Fastaccess::find($id) -> update([
                'url' => request('url'),

            ]);
        }
        else{
            Fastaccess::find($id) -> update([
                'url' => request('url'),
                'img_path' => $fileName
            ]);
        }
    }
}
