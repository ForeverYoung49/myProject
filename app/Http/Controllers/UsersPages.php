<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersPages extends Controller
{
    public function index(){ 
        $manga = \App\Manga_table::all()->take(6);
        $news = \App\News::all()->take(4);
        return view('add.index',['manga_table'=>$manga],['news'=>$news]);
    }

    public function news(){
    	$news = \App\News::all();
    	return view('add.all_news',['news'=>$news]);
    }

    public function showNews($id){
    	$news = \App\News::find((int)$id);
    	return view('add.news',['news'=>$news]);
    }

    public function showManga($id){
    	$manga = \App\Manga_table::find((int)$id);
    	return view('add.manga',['manga_table'=>$manga]);
    }

    public function manga(){ 
        $manga = \App\Manga_table::all();
        return view('add.all_manga',['manga_table'=>$manga]);
    }
}
