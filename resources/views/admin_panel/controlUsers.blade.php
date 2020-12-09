@extends('layouts.layout')

@section('title','Панель администратора')

@section('content')
@if(Gate::check('isAdmin')||Gate::check('isModer'))
    <div class="container col-10" style="margin-top: 15px;">
        <div class="row">
            <div class="col text-light profile-name bg-dark"><span>Панель Администратора</span></div>
            <a href="/" class="col-2 col-md-1 d-flex align-items-center justify-content-center settings btn btn-dark text-light profile-name">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
        <div class="row">
            <div class="col-md-4">
                @if(Gate::check('isAdmin')||Gate::check('isModer'))
                <div class="row" style="margin: 10px -5px;">
                    <a href="/adminPanel/showAddNews" class="d-flex justify-content-left col btn btn-dark text-light your-titels your-titels">Добавить новость</a>
                </div>
                <div class="row" style="margin: 10px -5px;">
                    <a href="/adminPanel/showAddChapster" class="d-flex justify-content-left col btn btn-dark text-light your-titels your-titels">Добавить главы манги</a>
                </div>
                <div class="row" style="margin: 10px -5px;">
                    <a href="/adminPanel/showControlUsers" class="d-flex justify-content-start active col btn btn-dark text-light your-titels your-titels">Управление пользователями</a>
                </div>
                <div class="row" style="margin: 10px -5px;">
                    <a href="/adminPanel/showLastComments" class="d-flex justify-content-left col btn btn-dark text-light your-titels your-titels">Комментарии за день</a>
                </div>
                @endif
                @if(Gate::check('isAdmin'))
                <div class="row" style="margin: 10px -5px;">
                    <a href="/adminPanel/showAddManga" class="d-flex justify-content-left col btn btn-dark text-light your-titels your-titels">Добавить мангу</a>
                </div>
                <div class="row" style="margin: 10px -5px;">
                    <a href="/adminPanel/showAddGenre" class="d-flex justify-content-left col btn btn-dark text-light your-titels your-titels">Добавить жанры</a>
                </div>
                <div class="row" style="margin: 10px -5px;">
                    <a href="/adminPanel/showAddAuthor" class="d-flex justify-content-left col btn btn-dark text-light your-titels your-titels">Добавить авторов манги</a>
                </div>
                <div class="row" style="margin: 10px -5px;">
                    <a href="/adminPanel/showAddStatus" class="d-flex justify-content-left col btn btn-dark text-light your-titels your-titels">Добавить статус манги</a>
                </div>
                @endif
            </div>
            <div class="col-md-8" style="margin:20px 0px; padding: 0px; font-size: 18px;">
                <div style="margin-bottom: 20px; margin-top: -6px;">
                    <input type="button" class="btn btn-dark" onclick="show_banned()" id="unban" value="Заявки на разбан">
                    <input type="button" class="btn btn-dark" onclick="close_banned()" style="display: none;" id="all_users_show" value="Все пользователи">
                    <script type="text/javascript">
                        function show_banned(){
                            document.getElementById('all_users').style.display = "none";
                            document.getElementById('application').style.display = "block";
                            document.getElementById('unban').style.display = "none";
                            document.getElementById('all_users_show').style.display = "block";
                        }
                        function close_banned(){
                            document.getElementById('all_users').style.display = "block";
                            document.getElementById('application').style.display = "none";
                            document.getElementById('unban').style.display = "block";
                            document.getElementById('all_users_show').style.display = "none";
                        }
                    </script>
                </div>
                    <div id="all_users">
                        <div class="table-responsive">
                        <table class="table" style="padding:0px;margin: 0px;">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Имя пользователя</th>
                                    <th>Ранг</th>
                                    <th>Роль</th>
                                    <th>Статус</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $u)
                            <form method="post" action="/adminPanel/controlUsers">
                                @csrf  
                                <tr>
                                    <td>
                                        @if($u->id==Auth::id())
                                            <a href="/profile">{{ $u->id }}</a>
                                        @else
                                            <a href="/profile/{{ $u->id }}">{{ $u->id }}</a>
                                        @endif
                                    </td>
                                    <td>
                                        @if($u->id==Auth::id())
                                            <a href="/profile">{{ $u->name }}</a>
                                        @else
                                            <a href="/profile/{{ $u->id }}">{{ $u->name }}</a>
                                        @endif
                                    </td>
                                    <td>
                                        @if($u->id==Auth::id())
                                            <a href="/profile">{{ $u->rank }}</a>
                                        @else
                                            <a href="/profile/{{ $u->id }}">{{ $u->rank }}</a>
                                        @endif
                                    </td>
                                    @if(Gate::check('isAdmin'))
                                    <td name="edit_role">
                                        <select name="role">
                                            <option @if($u->role=='["user"]') selected @endif>
                                                ["user"]
                                            </option>
                                            <option @if($u->role=='["admin"]') selected @endif>
                                                ["admin"]
                                            </option>
                                            <option @if($u->role=='["moder"]') selected @endif>
                                                ["moder"]
                                            </option>
                                        </select>
                                    
                                        <input type="text" hidden name="user_id" value="{{$u->id}}">
                                        <input type="submit" class="btn btn-dark" value="Сохранить"> 
                                    </td>
                                    @else
                                    <td>
                                        {{$u->role}}
                                    </td>
                                    @endif
                                    <td>
                                        @if($u->id==Auth::id())
                                            <a href="/profile">
                                                @if($u->ban == 'banned')
                                                    Забанен
                                                @endif
                                            </a>
                                        @else
                                            <a href="/profile/{{ $u->id }}">
                                                @if($u->ban == 'banned')
                                                    Забанен
                                                @endif
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            </form>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    </div>       
                <div id="application" style="display: none;">
                    <h3>Заявки на разбан</h3>
                    <div class="table-responsive">
                        <table class="table" style="padding:0px;margin: 0px;">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Имя пользователя</th>
                                    <th>Ранг</th>
                                    <th>Причина бана</th>
                                    <th>Сообщение пользователя</th>
                                    <th>Когда был забанен</th>
                                    <th>Разбан</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($bans as $b)
                                <tr>
                                    <td>
                                        @if($b->id==Auth::id())
                                            <a href="/profile">{{ $b->id }}</a>
                                        @else
                                            <a href="/profile/{{ $b->id }}">{{ $b->id }}</a>
                                        @endif
                                    </td>
                                    <td>
                                        @if($b->id==Auth::id())
                                            <a href="/profile">{{ $b->name }}</a>
                                        @else
                                            <a href="/profile/{{ $b->id }}">{{ $b->name }}</a>
                                        @endif
                                    </td>
                                    <td>
                                        @if($b->id==Auth::id())
                                            <a href="/profile">{{ $b->rank }}</a>
                                        @else
                                            <a href="/profile/{{ $b->id }}">{{ $b->rank }}</a>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $b->reason }}
                                    </td>
                                    <td>
                                        {{ $b->application }}
                                    </td>
                                    <td>
                                        {{ date('d-m-Y',strtotime($b->created_at)) }}
                                    </td>
                                    <td>
                                        <form method="post" action="/adminPanel/controlUsers/unban">
                                            @csrf
                                            <input type="text" name="id" value="{{ $b->id }}" hidden>
                                            <input type="submit" class="btn btn-success" value="Разбанить">
                                        </form> 
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@else
    <h1 class="d-flex justify-content-center align-items-center" style="margin-top: 20px;">Данный раздел доступен только для администраторов.</h1>
@endif

@endsection