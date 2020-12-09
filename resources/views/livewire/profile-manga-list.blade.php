                    <div class="row" style="margin: 10px -5px;">
                        <button class="col bg-dark your-titels text-light your-titels d-flex justify-content-left align-items-center" wire:click="status1">
                            <i class="fas fa-eye" style="margin: 0 5px 0 0 ;"></i> Читаю
                        </button>
                    </div>
                    <div class="row" style="margin: 10px -5px;">
                        <button class="col bg-dark your-titels text-light your-titels d-flex justify-content-left align-items-center" wire:click="status2">
                            <i class="far fa-calendar" style="margin: 0 5px 0 0 ;"></i> Буду читать
                        </button>
                    </div>
                    <div class="row" style="margin: 10px -5px;">
                        <button class="col bg-dark your-titels text-light your-titels d-flex justify-content-left align-items-center" wire:click="status3">
                            <i class="fas fa-check-square" style="margin: 0 5px 0 0 ;"></i> Прочитано
                        </button>
                    </div>
                    <div class="row" style="margin: 10px -5px;">
                        <button class="col bg-dark your-titels text-light your-titels d-flex justify-content-left align-items-center" wire:click="status4">
                            <i class="fas fa-heart" style="margin: 0 5px 0 0 ;"></i> Любимое
                        </button>
                    </div>
                    <div class="row" style="margin: 10px -5px;">
                        <button class="col bg-dark your-titels text-light your-titels d-flex justify-content-left align-items-center" wire:click="status5">
                            <i class="fas fa-eye-slash" style="margin: 0 5px 0 0 ;"></i> Брошено
                         </button>
                    </div>
            </div>
        </div>
        <div class="row projects">
            @foreach($list as $l)
            <div class="col-sm-6 col-md-4 col-lg-3" style="margin: 15px 0 0 0;">
                <div class="row">
                    <div class="col d-flex d-xl-flex justify-content-center">
                        <a href="/catalog/{{ $l->id }}"><h4>{{ $l->name }}</h4></a>
                    </div>
                </div>
                <div class="row">
                    <div class="col d-flex d-xl-flex justify-content-center"><img src="assets/img/{{ $l->img }}" style="height: 200px;max-width: 150px;"></div>
                </div>
            </div>
            @endforeach
        </div>