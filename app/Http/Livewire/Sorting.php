<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Sorting extends Component
{

	public $selectedGenre = [];
	public $selectedAuth;
	public $selectedStatus;
	public $sort;

    public function render(){
        $manga_table = \App\Manga_table::
                select('id','name','rating','img');
        $error = '';
        
        $all_manga = \App\Manga_table::count('id');
        $l = 0;
        if($this->selectedGenre<>null){
            for($i=1; $i<=$all_manga; $i++) {
                $genre = \App\Pack_genre::select('*');
                $genre = $genre->whereIn('genre_id',$this->selectedGenre);
                $genre = $genre->where('manga_id','=',$i);
                $genre = $genre->get();
                if (count($this->selectedGenre)==$genre->count()) {
                    $manga_table = $manga_table->orWhere('id','=',$i);
                }
                else {
                    $l++;
                }
            }
            if ($i-1 == $l) {
                $manga_table = $manga_table->where('name','=',null);
                $error = 'Манга по вашим фильтрам не найдена.';
            }
        }
      
        if ($this->selectedAuth<>null) {
            $manga_table = $manga_table->FilterAuth($this->selectedAuth);
        }
        if ($this->selectedStatus<>null) {
            $manga_table = $manga_table->FilterStatus($this->selectedStatus);
        }
        if ($manga_table->first()==null) {
            $error = 'Манга по вашим фильтрам не найдена.';
        }
        switch ($this->sort) {
        	case 'rating':
        		$manga_table = $manga_table->orderByDesc('rating');
        		break;
        	case 'nameLeft':
        		$manga_table = $manga_table->orderBy('name');
        		break;
        	case 'nameRight':
        		$manga_table = $manga_table->orderByDesc('name');
        		break;
        	default:
        		$manga_table = $manga_table->orderByDesc('rating');
        		break;
        }
        $manga_table = $manga_table->paginate(12);
        $status = \App\Status::orderBy('name')->get();
        $genre = \App\Genre::orderBy('name')->get();
        $auth = \App\Auth::orderBy('name')->get();
        return view('livewire.sorting',compact('genre','manga_table','auth','status','error'));
    }
}
