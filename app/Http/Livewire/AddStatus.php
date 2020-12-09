<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AddStatus extends Component
{
	public $name;
	public $check;

    public function render(){
        return view('livewire.add-status',['check'=>$this->check]);
    }

    public function add(){
    	$list = \App\Status::select('name')->where('name', '=', $this->name)->first();
    	if ($list == null) {
    		\App\Status::create([
	    		'name' => $this->name,
	   		]);
	   		$this->check = 'Статус добавлен';
   		}
   		else {
   			$this->check = 'Данный статус уже существует.';
   		}
    }

}
