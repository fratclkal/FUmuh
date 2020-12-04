<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class AnnouncementsController extends Controller
{
    public function index()
    {
        $news=News::all();
        return view('Front.News.index')->with('news',$news);
    }

    public function view($id)
    {
        $news=News::find($id);

        return view('Front.News.view')->with('news',$news);
    }
}
