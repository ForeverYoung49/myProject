<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AddAuthor extends Component
{
	  public $name;
	  public $check = '';

    public function render()
    {
        return view('livewire.add-author', ['check'=>$this->check]);
    }

    public function add(){
    	$list = \App\Auth::select('name')->where('name', '=', $this->name)->first();
    	if ($list == null) {
    		\App\Auth::create([
	    		'name' => $this->name,
	   		]);
	   		$this->check = 'Автор добавлен';
   		}
   		else {
   			$this->check = 'Данный автор уже существует.';
   		}
    }

}
