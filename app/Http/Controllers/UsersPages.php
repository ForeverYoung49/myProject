<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use Hash;
use DB;
use Imagick;
use Redirect;

class UsersPages extends Controller
{
    public function index(){ 
        $manga = \App\Manga_table::orderByDesc('id')->get()->take(5);
        $news = \App\News::orderByDesc('id')->get()->take(2);
        return view('add.index',['manga_table'=>$manga],['news'=>$news]);
    }

    public function news(){
    	$news = \App\News::paginate(10);
    	return view('add.all_news',['news'=>$news]);
    }

    public function deleteComNews(Request $request){
        \App\Comments_news::where('id','=',$request->com_id)->update(['status'=>'deleted']);
        return Redirect::back();
    }
    
    public function editComNews(Request $request){
        \App\Comments_news::where('id','=',$request->com_id)->update(['txt'=>$request->txt,'status'=>'edited']);
        return Redirect::back();
    }

    protected function createComNews(Request $request) {
        \App\Comments_news::create([
            'txt' => $request->txt,
            'user_id' => Auth::id(),
            'news_id' => $request->news_id,
            'status' => '',
        ]);
        $rank = \App\User::select('rank')->where('id', '=', Auth::id())->first();
        $rank->rank += 1;
        \App\User::where('id', '=', Auth::id())->update(['users.rank' => $rank->rank]);
        return redirect()->action('UsersPages@showNews', ['id' => $request->news_id]);
    }

    public function showNews($id){
        $news = \App\News::find((int)$id);
        $auth = \App\User::
            join('news', 'users.id', '=', 'news.user_id')
            ->select('users.name')
            ->first();
        $user = \App\User::find((int)Auth::id());
        $comments = \App\Comments_news::
            join('users', 'comments_news.user_id', '=', 'users.id')
            ->join('news', 'comments_news.news_id', '=', 'news.id')
            ->select('comments_news.txt','comments_news.created_at','users.name','users.img','comments_news.id','comments_news.user_id','comments_news.status','users.ban')
            ->where('comments_news.news_id','=',$id)
            ->orderByDesc('comments_news.id')
            ->paginate(10);
        return view('add.news',compact('news','user','auth','comments'));
    }

    public function showManga($id){
        $rating_check = \App\Rating_manga::where('manga_id', '=', $id)->avg('mark');
        if ($rating_check == null) {
            $rating = 0;
        }
        else {
            $rating = $rating_check;
        }
        \App\Manga_table::where('id', '=', $id)
            ->update(['rating' => $rating]);
    	$manga = \App\Manga_table::find((int)$id);
        $pack_genre = \App\Pack_genre::
            join('manga_table','pack_genre.manga_id','=','manga_table.id')
            ->join('genre','pack_genre.genre_id','=','genre.id')
            ->select('genre.name')
            ->where('pack_genre.manga_id','=',$id)
            ->get();
        $user = \App\User::find((int)Auth::id());
        $auth = \App\Auth::
            join('manga_table', 'author_manga.id', '=', 'manga_table.author_id')
            ->select('author_manga.name')
            ->first();
        $status = \App\Status::
            join('manga_table', 'status_manga.id', '=', 'manga_table.status_id')
            ->select('status_manga.name')
            ->first();
        $comments = \App\Comments_manga::
            join('users', 'comments_manga.user_id', '=', 'users.id')
            ->join('manga_table', 'comments_manga.manga_id', '=', 'manga_table.id')
            ->select('comments_manga.txt','comments_manga.created_at','users.name','users.img','comments_manga.user_id','comments_manga.id','comments_manga.status','users.ban')
            ->where('comments_manga.manga_id','=',$id)
            ->orderByDesc('comments_manga.id')
            ->paginate(10);

        $last_chapter = \App\Last_chapter_for_user::where('manga_id','=',$id)->where('user_id','=',Auth::id())->get();
        $page = \App\manga_chapster::where('manga_id','=',$id)->orderByDesc('id')->paginate(10);
    
        $check = \App\Rating_manga::where('user_id', '=', Auth::id())->where('manga_id', '=', $id)->select('mark')->first();
        $listFavorite = \App\Users_list::where('user_id', '=', Auth::id())->where('manga_id', '=', $id)->where('status', '=', 4)->first();
        $list = \App\Users_list::where('user_id', '=', Auth::id())->where('manga_id', '=', $id)->where('status', '<>', 4)->first();
        $first_chapter = \App\manga_chapster::where('manga_id','=',$id)->first();
    	return view('add.manga',compact('manga','auth','status','comments','pack_genre','check','listFavorite','list','page','user','first_chapter','last_chapter'));
    }

    public function showChapster($id,$id_chapster){
        $check = \App\Last_chapter_for_user::where('user_id','=',Auth::id())
            ->where('chapter_id','=',$id_chapster)
            ->first();
        if (Auth::id()<>null) {
            if ($check==null) {
                \App\Last_chapter_for_user::create([
                    'manga_id' => $id,
                    'user_id' => Auth::id(),
                    'chapter_id' => $id_chapster,
                ]);
            }
        }
        $pages = \App\Chapster_pages::
            where('chapster_id','=',$id_chapster)
            ->paginate(1);
        $page = \App\manga_chapster::find((int)$id_chapster);
        $all_chapster = \App\manga_chapster::where('manga_id','=',$id)->get();
        $next_chapster = \App\manga_chapster::where('manga_id','=',$id)->where('id','>',$id_chapster)->first();
        $previous_chapster = \App\manga_chapster::where('manga_id','=',$id)->where('id','<',$id_chapster)->max('id');
        $manga = \App\Manga_table::find((int)$id);
        return view('add.chapster',compact('pages','page','manga','next_chapster','previous_chapster','all_chapster'));
    }

    protected function createComManga(Request $request) {
        \App\Comments_manga::create([
            'txt' => $request->txt,
            'user_id' => Auth::id(),
            'manga_id' => $request->manga_id,
            'status' => '',
        ]);
        $rank = \App\User::select('rank')->where('id', '=', Auth::id())->first();
        $rank->rank += 3;
        \App\User::where('id', '=', Auth::id())->update(['users.rank' => $rank->rank]);
        return redirect()->action('UsersPages@showManga', ['id' => $request->manga_id]);
    }

    public function deleteComManga(Request $request){
        \App\Comments_manga::where('id','=',$request->com_id)->update(['status'=>'deleted']);
        return Redirect::back();
    }
    
    public function editComManga(Request $request){
        \App\Comments_manga::where('id','=',$request->com_id)->update(['txt'=>$request->txt,'status'=>'edited']);
        return Redirect::back();
    }

    public function ratingManga(Request $request) {
        $check = \App\Rating_manga::where('user_id', '=', Auth::id())->where('manga_id','=',$request->manga_id)->select('mark')->first();      
        if ($check == null) {
            \App\Rating_manga::create([
                'mark' => $request->mark,
                'user_id' => Auth::id(),
                'manga_id' => $request->manga_id,
            ]);
            $rank = \App\User::select('rank')->where('id', '=', Auth::id())->first();
            $rank->rank += 1;
            \App\User::where('id', '=', Auth::id())->update(['users.rank' => $rank->rank]);
        }
        else {
            if ($check->mark == $request->mark) {
                \App\Rating_manga::where('user_id', '=', Auth::id())->where('manga_id', '=', $request->manga_id)->delete();
            }
            else {
                $update = \App\Rating_manga::where('user_id', '=', Auth::id())->where('manga_id','=',$request->manga_id)->update(['mark' => $request->mark]);
            }
        }
        $rating = \App\Rating_manga::where('manga_id', '=', $request->manga_id)->avg('mark');
        \App\Manga_table::join('rating_manga', 'rating_manga.manga_id', '=', 'manga_table.id')
            ->where('manga_id', '=', $request->manga_id)
            ->update(['manga_table.rating' => $rating]);
        return redirect()->action('UsersPages@showManga', ['id' => $request->manga_id]);
    }

   public function manga(Request $request){
        $manga_table = \App\Manga_table::select('id','name','rating','img');
        $error = '';
        $manga_table = $manga_table->orderByDesc('rating');
        $manga_table = $manga_table->paginate(16);
        $status = \App\Status::orderBy('name')->get();
        $genre = \App\Genre::orderBy('name')->get();
        $auth = \App\Auth::orderBy('name')->get();
        return view('add.all_manga',compact('genre','manga_table','auth','status','error','request'));
    }

    public function profile(Request $request){
        $user = \App\User::find((int)Auth::id());
        $ban = \App\Bans::where('user_id','=',Auth::id())->first();
        $list = \App\Users_list::
            join('manga_table', 'manga_table.id', '=', 'users_list.manga_id')
            ->where('users_list.user_id', '=', Auth::id())
            ->where('users_list.status', '=', $request->status)
            ->select('manga_table.name','manga_table.img','manga_table.id')
            ->get();
        return view('add.profile',compact('user','list','ban'));
    }

    public function userProfile(Request $request, $id){
        $user = \App\User::find((int)$id);
        $list = \App\Users_list::
            join('manga_table', 'manga_table.id', '=', 'users_list.manga_id')
            ->where('users_list.user_id', '=', (int)$id)
            ->where('users_list.status', '=', $request->status)
            ->select('manga_table.name','manga_table.img','manga_table.id')
            ->get();
        return view('add.userProfile',compact('user','list'));
    }

    public function unbanApplication(Request $request){
        \App\Bans::where('id','=',$request->id)->update(['application'=>$request->application]);
        return redirect()->action('UsersPages@profile');
    }

    public function banUser(Request $request, $id){
        \App\User::where('id','=',$id)->update(['ban'=>$request->ban]);
        if ($request->reason <> null) {
            \App\Bans::create([
                'user_id' => $id,
                'reason' => $request->reason,
                'application' => '',
            ]);
        }
        return redirect()->action('UsersPages@userProfile', ['id' => $id]);
    }

    public function showEditProfile(){
        $user = \App\User::find((int)Auth::id());
        return view('add.edit_profile',compact('user'));
    }

    public function editProfile(Request $request){
        if ($request->username<>null) {
            \App\User::where('id', '=', Auth::id())->update(['users.name' => $request->username]); 
        }
        if ($request->img<>null){
            
            if ($request->hasFile('img')){
                
                $image = $request->file('img');
                $name = Auth::id();
                $name = (string)$name.'avatar.jpg';
                $image->move(public_path().'/assets/img/',$name);
                \App\User::where('id', '=', Auth::id())->update(['users.img' => $name]);
            }
        }
        if ($request->email<>null){
            \App\User::where('id', '=', Auth::id())->update(['users.email' => $request->email]);
        }
        if ($request->password<>null){
            \App\User::where('id', '=', Auth::id())->update(['users.password' => Hash::make($request->password)]);
        }
        return redirect()->action('UsersPages@profile', ['id' => Auth::id()]);
    }

    public function addUserList(Request $request){
        $check = \App\Users_list::where('user_id', '=', Auth::id())->where('manga_id', '=', $request->manga_id)->get();
        $nullable = \App\Users_list::where('user_id', '=', Auth::id())->where('manga_id', '=', $request->manga_id)->where('status', '<>', 4)->value('status');
        $fix = true;
        if ($nullable == null) {
            \App\Users_list::create([
                'manga_id' => $request->manga_id,
                'user_id' => Auth::id(),
                'status' => $request->list,
            ]);
        }
        else {
        foreach ($check as $key) {
            
            switch ($key->status) {
                case 1:
                    switch ($request->list) {
                        case 1:
                            \App\Users_list::where('user_id', '=', Auth::id())->where('manga_id', '=', $request->manga_id)->where('status', '=', $request->list)->delete();
                            $fix = false;
                            break;
                        case 2:
                        case 3:
                        case 5:
                         $dublicate = \App\Users_list::where('user_id', '=', Auth::id())->where('manga_id', '=', $request->manga_id)->where('status', '=', $request->list)->first();
                            if ($dublicate==null && $fix == true) {
                                \App\Users_list::where('user_id', '=', Auth::id())->where('manga_id', '=', $request->manga_id)->where('status', '=', 1)->delete();
                                \App\Users_list::create([
                                    'manga_id' => $request->manga_id,
                                    'user_id' => Auth::id(),
                                    'status' => $request->list,
                                ]);
                                $fix = false;
                            }
                            break;
                        case 4:
                            $dublicate = \App\Users_list::where('user_id', '=', Auth::id())->where('manga_id', '=', $request->manga_id)->where('status', '=', $request->list)->first();
                            if ($dublicate==null && $fix == true) {
                                \App\Users_list::create([
                                    'manga_id' => $request->manga_id,
                                    'user_id' => Auth::id(),
                                    'status' => $request->list,
                                ]);
                                $fix = false;
                            }
                            break;
                    }
                        
                    break;
                
                case 2:
                    switch ($request->list) {
                        case 2:
                            \App\Users_list::where('user_id', '=', Auth::id())->where('manga_id', '=', $request->manga_id)->where('status', '=', $request->list)->delete();
                            $fix = false;
                            break;
                        case 1:
                        case 3:
                        case 5:
                            $dublicate = \App\Users_list::where('user_id', '=', Auth::id())->where('manga_id', '=', $request->manga_id)->where('status', '=', $request->list)->first();
                            if ($dublicate==null && $fix == true) {
                                \App\Users_list::where('user_id', '=', Auth::id())->where('manga_id', '=', $request->manga_id)->where('status', '=', 2)->delete();
                                \App\Users_list::create([
                                    'manga_id' => $request->manga_id,
                                    'user_id' => Auth::id(),
                                    'status' => $request->list,
                                ]);
                                $fix = false;
                            } 
                            break;
                        case 4:
                            $dublicate = \App\Users_list::where('user_id', '=', Auth::id())->where('manga_id', '=', $request->manga_id)->where('status', '=', $request->list)->first();
                            if ($dublicate==null && $fix == true) {
                                \App\Users_list::create([
                                    'manga_id' => $request->manga_id,
                                    'user_id' => Auth::id(),
                                    'status' => $request->list,
                                ]);
                                $fix = false;                            
                            }
                            break;
                    }
                        
                    break;

                case 3:
                    switch ($request->list) {
                        case 3:
                            \App\Users_list::where('user_id', '=', Auth::id())->where('manga_id', '=', $request->manga_id)->where('status', '=', $request->list)->delete();
                            $fix = false;
                            break;
                        case 1:
                        case 2:
                        case 5:
                            $dublicate = \App\Users_list::where('user_id', '=', Auth::id())->where('manga_id', '=', $request->manga_id)->where('status', '=', $request->list)->first();
                            if ($dublicate==null && $fix == true) {
                                \App\Users_list::where('user_id', '=', Auth::id())->where('manga_id', '=', $request->manga_id)->where('status', '=', 3)->delete();
                                \App\Users_list::create([
                                    'manga_id' => $request->manga_id,
                                    'user_id' => Auth::id(),
                                    'status' => $request->list,
                                ]);
                            }
                            break;
                        case 4:
                            $dublicate = \App\Users_list::where('user_id', '=', Auth::id())->where('manga_id', '=', $request->manga_id)->where('status', '=', $request->list)->first();
                            if ($dublicate==null && $fix == true) {
                                \App\Users_list::create([
                                    'manga_id' => $request->manga_id,
                                    'user_id' => Auth::id(),
                                    'status' => $request->list,
                                ]);
                                $fix = false;
                            }
                            break;
                    }
                        
                    break;

                case 4:
                    switch ($request->list) {
                        case 4:
                            \App\Users_list::where('user_id', '=', Auth::id())->where('manga_id', '=', $request->manga_id)->where('status', '=', $request->list)->delete();
                            $fix = false;
                            break;
                        default:
                            $dublicate = \App\Users_list::where('user_id', '=', Auth::id())->where('manga_id', '=', $request->manga_id)->where('status', '=', $request->list)->first();
                            if ($dublicate<>null && $fix == true) {
                                \App\Users_list::create([
                                    'manga_id' => $request->manga_id,
                                    'user_id' => Auth::id(),
                                    'status' => $request->list,
                                ]);
                                
                            }
                            break;
                    }
                        
                    break;

                case 5:
                    switch ($request->list) {
                        case 5:
                            \App\Users_list::where('user_id', '=', Auth::id())->where('manga_id', '=', $request->manga_id)->where('status', '=', $request->list)->delete();
                            $fix = false;
                            break;
                        case 1:
                        case 2:
                        case 3:
                            $dublicate = \App\Users_list::where('user_id', '=', Auth::id())->where('manga_id', '=', $request->manga_id)->where('status', '=', $request->list)->first();
                            if ($dublicate==null && $fix = true) {
                                \App\Users_list::where('user_id', '=', Auth::id())->where('manga_id', '=', $request->manga_id)->where('status', '=', 5)->delete();
                                \App\Users_list::create([
                                    'manga_id' => $request->manga_id,
                                    'user_id' => Auth::id(),
                                    'status' => $request->list,
                                ]);
                                $fix = false;
                            }
                            break;

                    }
                        
                    break;
            }
        }
    }
        return redirect()->action('UsersPages@showManga', ['id' => $request->manga_id]);
    }

}
