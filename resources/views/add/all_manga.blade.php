@extends('layouts.layout')

@section('title','Каталог манги')

@section('content')
	<div class="projects-horizontal">
    	@livewire('sorting')
   	</div>
@endsection