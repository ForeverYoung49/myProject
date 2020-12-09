
        <div class="">
            <div class="intro">
                <h2 class="text-center">Каталог манги</h2>
            </div>
            <div class="row">
            	<div class="col-md-8 offset-md-2">
					<div class="row projects">
						<div class="col-12 d-flex justify-content-center">
							<span class="filter_error">{{ $error }}</span>
						</div>
					    @foreach($manga_table as $m)
					    <div class="col-sm-6 col-md-4 col-lg-3" style="margin: 15px 0 0 0;">
					        <div class="row">
					            <div class="col d-flex d-xl-flex justify-content-center">
					                <h4><a href="/catalog/{{ $m->id }}">{{ mb_substr($m->name,0,18) }}</a></h4>
					            </div>
					        </div>
					        <div class="row">
					            <a href="catalog/{{ $m->id }}" class="col d-flex d-xl-flex justify-content-center size-poster">
					                <img src="../assets/img/{{ $m->img }}"  style="width: 100%; object-fit: cover; object-position: 50 50;">
					            </a>
					        </div>
					        <div class="row">
					            <div class="col d-flex d-xl-flex justify-content-center"><i class="fa fa-star d-flex d-xl-flex align-items-center star" style="margin: 5px 0 0 0;"></i>
					                <p class="star-all-manga"><strong>{{ $m->rating }}</strong></p>
					            </div>
					        </div>
					    </div>
					    @endforeach
					</div>
					<div class="d-flex justify-content-center">
						{{ $manga_table->links() }}
					</div>

				</div>
            	<div class="col">
					<h3 class="d-flex justify-content-center">Фильтры</h3>
					<hr>
					<h5>Сортировка</h5>
					<div class="row">
						<div class="col">
							<label class="container-check" style="font-size: 20px;">По рейтингу
					            <input type="radio" wire:model="sort" value="rating">
					            <span class="checkmark"></span>
				        	</label>
						</div>
						<div class="col">
							<label class="container-check" style="font-size: 20px;">По названию А-Я
					            <input type="radio" wire:model="sort" value="nameLeft">
					            <span class="checkmark"></span>
				        	</label>
						</div>
						<div class="col">
							<label class="container-check" style="font-size: 20px;">По названию Я-А
					            <input type="radio" wire:model="sort" value="nameRight">
					            <span class="checkmark"></span>
				        	</label>
						</div>
					</div>
					<h5>По жанру</h5>
					<div class="row">
					@foreach($genre as $g)
					<div class="col">
				        <label class="container-check" style="font-size: 20px;">{{$g->name}}
				            <input type="checkbox" id="{{$g->id}}" wire:model="selectedGenre" value="{{$g->id}}">
				            <span class="checkmark"></span>
				        </label>
				    </div>
				    @endforeach
				    </div>
				    <h5>По автору</h5>
				    <div class="row">
					@foreach($auth as $a)
					<div class="col">
				        <label class="container-check" style="font-size: 20px;">{{$a->name}}
				            <input type="radio" id="{{$a->id}}" wire:model="selectedAuth" value="{{$a->id}}">
				            <span class="checkmark"></span>
				        </label>
				    </div>
				    @endforeach
					</div>
				    <h5>По статусу</h5>
				    <div class="row">
					@foreach($status as $s)
					<div class="col">
				        <label class="container-check" style="font-size: 20px;">{{$s->name}}
				            <input type="radio" id="{{$s->id}}" wire:model="selectedStatus" value="{{$s->id}}">
				            <span class="checkmark"></span>
				        </label>
				    </div>
				    @endforeach
					</div>
					<div class="row">
						<div class="col d-flex justify-content-center">
							<a class="btn btn-dark" href="/catalog">Сбросить фильтры</a>
						</div>
					</div>
				</div>
            </div>
        </div>
