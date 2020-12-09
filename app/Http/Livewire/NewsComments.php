<?php

namespace App\Http\Livewire;

use Auth;
use Livewire\Component;

class NewsComments extends Component
{
    public $news_id;
	public $comment_text;
    public $edited_com_text;
	protected $comments;

    public function render(){
    	echo $this->news_id.' text-'.$this->comment_text.'-text '.Auth::id();
    	$this->comments = \App\Comments_news::
        	join('users', 'comments_news.user_id', '=', 'users.id')
            ->join('news', 'comments_news.news_id', '=', 'news.id')
            ->select('comments_news.txt','comments_news.created_at','users.name','users.img','comments_news.id','comments_news.user_id')
            ->where('comments_news.news_id','=',$this->news_id)
            ->orderByDesc('comments_news.id')
            ->paginate(5);
        return view('livewire.news-comments',['comments' => $this->comments]);
    }
    public function mount($news){
    	$this->news_id = $news->id;
        $this->comment_text = '123';
        $this->edited_com_text = '321';
    }
    public function addComment(){
    	\App\Comments_news::create([
    		'txt' => $this->comment_text,
	        'user_id' => Auth::id(),
	        'news_id' => $this->news_id,
    	]);
        $this->comment_text = '';
        $rank = \App\User::select('rank')->where('id', '=', Auth::id())->first();
        $rank->rank += 1;
        \App\User::where('id', '=', Auth::id())->update(['users.rank' => $rank->rank]);
    }

    public function deleteCom($id_com){
        \App\Comments_news::where('id', '=', $id_com)->delete();
    }

    public function editCom($id_com){
        \App\Comments_news::where('id', '=', $id_com)->update(['txt'=>$this->edited_com_text]);
    }

}
