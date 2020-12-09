<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manga_table extends Model
{
    protected $table = 'manga_table';
    protected $fillable = ['name','description','rating','img','author_id','status_id','updated_at','created_at'];

    public function scopeFilterAuth($query, $author_id){	
    	if ($author_id<>null){
        	return $query->where('author_id', $author_id);
    	}
    	else{
    		return $query->where('author_id','<>',null);
    	}
    }

    public function scopeFilterStatus($query, $status_id){	
    	if ($status_id<>null){
        	return $query = $query->where('status_id', $status_id);
    	}
    	else{
    		return $query->where('status_id','<>',null);
    	}
    }

    public function scopeFilterGenre($query, $genre_id){	
    	if ($genre_id<>null){
        	return $query->where('pack_genre.genre_id','=', $genre_id);
    	}
    	else{
    		return $query->where('status_id','<>',null);
    	}
    }

}
