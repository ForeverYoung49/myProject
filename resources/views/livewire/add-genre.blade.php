<div class="col">
	<div class="row edit-profile">
		<div class="col-10 d-flex justify-content-center">
			<span>{{ $check }}</span>
		</div>
	</div>
	<div class="row edit-profile d-flex justify-content-center">
		<div class="col-12 col-md-3">
			<label>Наименование жанра:</label>
		</div>
		<div class="col-12 col-md-6">
			<input class="form-control" required type="text" name="name" id="name" wire:model="name">
		</div>
	</div>
	<div class="row edit-profile d-flex justify-content-center">
		<div class="col-6 d-flex justify-content-end">
			<button class="btn btn-success" type="submit" wire:click="add">Добавить</button>
		</div> 
		<div class="col-6 d-flex justify-content-left">
			<a href="/adminPanel" class="btn btn-danger">Вернуться</a>
		</div>                
    </div>
</div>