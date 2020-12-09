<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Pagination\Paginator;

class Counter extends Component
{
    use WithPagination;

	public $search;
	protected $manga_table;

    public function render(){
    	$check = $this->search;
    	if ($check=='') {
    		$this->manga_table = \App\Manga_table::
	    	where('manga_table.name','=', null)
	    	->select('manga_table.name','manga_table.id')
	    	->get();
    	}
    	else {
    	$this->manga_table = \App\Manga_table::
	    	where('manga_table.name','like','%'.$this->search.'%')
	    	->select('manga_table.name','manga_table.id')
	    	->get();
	    }
        return view('livewire.counter', ['manga_table'=>$this->manga_table]);
    }
}