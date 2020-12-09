<div id="myDropdown" class="dropdown-content show" style="max-height: 300px; overflow-y: auto;">
	<input type="text" wire:model="search" placeholder="Поиск манги" id="myInput" style="width: 297px;">
	@foreach($manga_table as $m)
   		<a href="/catalog/{{$m->id}}">{{$m->name}}</a>
    @endforeach

</div>
