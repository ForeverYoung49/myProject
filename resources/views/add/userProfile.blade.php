@extends('layouts.layout')

@section('title', 'Профиль '.$user->name)

@section('content')
    <div class="container" style="margin-top: 20px;margin-bottom: 20px;">
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-12 d-flex align-items-center  text-light profile-name bg-dark">
                        <span>Профиль пользователя {{ $user->name }}</span>
                    </div>
                </div>
                <div class="row" id="profile" style="margin: 10px -5px;">
                    <div class="col-md-5 d-flex justify-content-center align-items-center">
                        <img src="../assets/img/{{ $user->img }}" style="height: 150px; object-fit: cover; object-position: 50 50; max-width: 150px;">
                    </div>
                    <div class="col">
                        <div class="row">
                            <div class="col">
                                <p>Ранг: {{ $user->rank }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p>Дата регистрации: {{ date('d-m-Y',strtotime($user->created_at)) }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p>Роль: {{ $user->role }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @if($user->role == '["user"]')
                @if(Gate::check('isAdmin') || Gate::check('isModer'))
                        <div class="row">
                            <div class="col-12">
                                <form action="/profile/{{$user->id}}/banUser" method="post">
                                    @csrf
                                    <input type="text" hidden name="ban" @if($user->ban=='banned') value="unbanned" @else value="banned" @endif>
                                    <input type="text" hidden name="id" value="{{$user->id}}">
                                    <input id="ban-button" class="btn btn-danger" @if($user->ban=='banned') type="submit" value="Разбанить" @else type="button" onclick="banned()" value="Забанить" @endif>
                                    <div id="reason" style="display: none;">
                                        <span>Укажите причину бана: </span>
                                        <textarea name="reason" style="width: 100%;"></textarea>
                                        <input type="submit" class="btn btn-danger" value="Забанить">
                                    </div>
                                </form>
                            </div>
                            <script type="text/javascript">
                                function banned(){
                                    document.getElementById('reason').style.display = 'block';
                                    document.getElementById('ban-button').style.display = 'none';
                                }
                            </script>
                        </div>
                @endif
                @endif
            </div>
            <div class="col-md-4">
                <div class="row text-light profile-name bg-dark">
                    <div class="col"><span>Списки</span></div>
                </div>
                <form method="post">
                    @csrf
                    
                    <div class="row" style="margin: 10px -5px;">
                        <button class="col bg-dark your-titels text-light your-titels d-flex justify-content-left align-items-center" type="submit" name="status" id="status" value="1">
                            <i class="fas fa-eye" style="margin: 0 5px 0 0 ;"></i> Читаю
                        </button>
                    </div>
                    <div class="row" style="margin: 10px -5px;">
                        <button class="col bg-dark your-titels text-light your-titels d-flex justify-content-left align-items-center" type="submit" name="status" value="2">
                            <i class="far fa-calendar" style="margin: 0 5px 0 0 ;"></i> Буду читать
                        </button>
                    </div>
                    <div class="row" style="margin: 10px -5px;">
                        <button class="col bg-dark your-titels text-light your-titels d-flex justify-content-left align-items-center" type="submit" name="status" value="3">
                            <i class="fas fa-check-square" style="margin: 0 5px 0 0 ;"></i> Прочитано
                        </button>
                    </div>
                    <div class="row" style="margin: 10px -5px;">
                        <button class="col bg-dark your-titels text-light your-titels d-flex justify-content-left align-items-center" type="submit" name="status" value="4">
                            <i class="fas fa-heart" style="margin: 0 5px 0 0 ;"></i> Любимое
                        </button>
                    </div>
                    <div class="row" style="margin: 10px -5px;">
                        <button class="col bg-dark your-titels text-light your-titels d-flex justify-content-left align-items-center" type="submit" name="status" value="5">
                            <i class="fas fa-eye-slash" style="margin: 0 5px 0 0 ;"></i> Брошено
                         </button>
                    </div>
                </form>
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
                    <div class="col d-flex d-xl-flex justify-content-center"><img src="../assets/img/{{ $l->img }}" style="height: 200px;max-width: 150px;"></div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    
@endsection