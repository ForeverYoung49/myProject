<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Auth;

class ProfileMangaList extends Component
{
	public $status = '';
	protected $list;

    public function render()
    {	
    	echo $this->status;
    	$this->list = \App\Users_list::
            join('manga_table', 'manga_table.id', '=', 'users_list.manga_id')
            ->where('users_list.user_id', '=', Auth::id())
            ->where('users_list.status', '=', $this->status)
            ->select('manga_table.name','manga_table.img','manga_table.id')
            ->get();
        return view('livewire.profile-manga-list', ['list'=>$this->list]);
    }
    public function status1(){
    	$this->status = '1';
    }
    public function status2(){
    	$this->status = '2';
    }
    public function status3(){
    	$this->status = '3';
    }
    public function status4(){
    	$this->status = '4';
    }
    public function status5(){
    	$this->status = '5';
    }
}
