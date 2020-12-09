<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Storage;
use File;
use Str;
use Carbon;

class AdminPanel extends Controller
{
    public function showAP(){
    	return view('admin_panel.layout');
    }

    public function showAddManga(){
    	$auth = \App\Auth::all();
    	$status = \App\Status::all();
    	$genre = \App\Genre::all();
        $check = '';
    	return view('admin_panel.addManga', compact('auth','status','genre','check'));
    }

    public function showLastComments(){
        $mytime = Carbon\Carbon::now();
        $comments_news = \App\Comments_news::
            join('users', 'comments_news.user_id', '=', 'users.id')
            ->select('comments_news.txt','comments_news.created_at','users.name','comments_news.id','comments_news.status','users.ban','comments_news.user_id','users.rank','users.role',)
            ->where('comments_news.created_at','like','%'.$mytime->format('Y-m-d').'%')
            ->get();
        $comments_manga = \App\Comments_manga::
            join('users', 'comments_manga.user_id', '=', 'users.id')
            ->select('comments_manga.txt','comments_manga.created_at','users.name','comments_manga.id','comments_manga.status','users.ban','comments_manga.user_id','users.rank','users.role')
            ->where('comments_manga.created_at','like','%'.$mytime->format('Y-m-d').'%')
            ->get();
        return view('admin_panel.lastComments',compact('comments_news','comments_manga'));
    }

    public function addManga(Request $request){
        $list = \App\Manga_table::select('name')->where('name', '=', $request->name)->first();
        if ($list == null) {
        	if ($request->hasFile('img')){
                $image = $request->file('img');
                $name = $request->name;
                $id = \App\Manga_table::select('id')->max('id');
                $id++;
                $name = (string)$id.'_poster.jpg';
                $image->move(public_path().'/assets/img/',$name);
                \App\Manga_table::create([
    	    		'name' => $request->name,
    	    		'description' => $request->description,
    	    		'img' => $name,
    	    		'author_id' => $request->author,
    	    		'status_id' => $request->status,
        		]);
        		$id = \App\Manga_table::select('id')->max('id');
        		foreach ($request->genre as $key) {
        			\App\Pack_genre::create([
        				'genre_id' => (int)$key,
        				'manga_id' => (int)$id,
        			]);
        		}
            }
            File::makeDirectory(public_path().'/assets/chapster/'.$request->name,0777,true);
        	return redirect()->action('AdminPanel@showAP');
            }
        else {
            $check = 'Манга с таким названием уже существует.';
            $auth = \App\Auth::all();
            $status = \App\Status::all();
            $genre = \App\Genre::all();
            return view('admin_panel.addManga', compact('auth','status','genre','check'));
        }
    }

    public function showAddChapster(){
        $manga = \App\Manga_table::all();
        $check = '';
        return view('admin_panel.addChapster', compact('manga','check'));
    }

    public function addChapster(Request $request){
        \App\manga_chapster::create([
                'name' => $request->name,
                'number' => $request->number,
                'tome' => $request->tome,
                'manga_id' => $request->manga,
        ]);
        if ($request->file('chapster')){
            $manga_name = \App\Manga_table::select('name')->where('id','=',$request->manga)->first();
            $path_for_page = '/assets/chapster/'.$manga_name->name.'/'.$request->tome.'_tome_'.$request->number.'_chapster_'.$request->name.'/';
            File::makeDirectory(public_path().$path_for_page,0777,true);
            $pages = count($request->chapster);
            $chapster_id = \App\manga_chapster::select('id')->max('id');
            for ($i=1; $i <= $pages; $i++) { 
                $page = $request->file('chapster')[$i-1];
                $page_name = 'page_'.$i.'.jpg';
                $page->move(public_path().$path_for_page,$page_name);
                \App\Chapster_pages::create([
                    'chapster_id' => $chapster_id,
                    'page' => $page_name,
                ]);
            }
        }
        return redirect()->action('AdminPanel@showAddChapster');
    }

    public function showAddNews(){
    	$check = '';
    	return view('admin_panel.addNews', compact('check'));
    }

    public function addNews(Request $request){
    	if ($request->hasFile('img')){
            $image = $request->file('img');
            $name = $request->name;
            $name = (string)$name.'_news.jpg';
            $image->move(public_path().'/assets/img/',$name);
            \App\News::create([
	    		'name' => $request->name,
	    		'txt' => $request->text,
	    		'caption_img' => $request->caption,
	    		'img' => $name,
	    		'user_id' => Auth::id(),
    		]);
        }
    	return redirect()->action('AdminPanel@showAP');
    }

	public function showAddGenre(){
    	return view('admin_panel.addGenre');
    }

    public function showAddAuthor(){
    	return view('admin_panel.addAuthor');
    }

    	
    public function showAddStatus(){
    	return view('admin_panel.addStatus');
    }

    public function showControlUsers(){
    	$users = \App\User::all();
        $bans = \App\Bans::join('users','bans.user_id','=','users.id')
            ->where('bans.application','<>','')
            ->select('bans.created_at','users.id','users.name','users.rank','bans.reason','bans.application')
            ->get();
    	$check = \App\User::where('id', '=', Auth::id())->first();
    	return view('admin_panel.controlUsers', compact('users','check','bans'));
    }

    public function controlUsers(Request $request){
    	
    	$check_role = \App\User::where('id', '=', $request->user_id)->first();
    	    	
    	\App\User::where('id', '=', $request->user_id)->update(['role' => $request->role]);
    	
    	return redirect()->action('AdminPanel@showControlUsers');
    }

    public function unbanUser(Request $request){
        \App\User::where('id','=',$request->id)->update(['ban'=>'unbanned']);
        \App\Bans::where('user_id','=',$request->id)->delete();
        return redirect()->action('AdminPanel@showControlUsers');
    }

}