<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AddGenre extends Component
{
	public $name;
	public $check = '';

    public function render(){
        return view('livewire.add-genre');
    }

    public function add(){
    	$list = \App\Genre::select('name')->where('name', '=', $this->name)->first();
    	if ($list == null) {
    		\App\Genre::create([
	    		'name' => $this->name,
	   		]);
	   		$this->check = 'Жанр добавлен';
   		}
   		else {
   			$this->check = 'Данный жанр уже существует.';
   		}
    }

}
