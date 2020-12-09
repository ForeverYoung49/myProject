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
                    <a href="/adminPanel/showControlUsers" class="d-flex justify-content-left col btn btn-dark text-light your-titels your-titels">Управление пользователями</a>
                </div>
                <div class="row" style="margin: 10px -5px;">
                    <a href="/adminPanel/showLastComments" class="d-flex justify-content-start active col btn btn-dark text-light your-titels your-titels">Комментарии за день</a>
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
                    <div id="all_users">
                        <div class="table-responsive">
                        <table class="table" style="padding:0px;margin: 0px;">
                            <thead>
                                <tr>
                                    <th>Имя пользователя</th>
                                    <th>Ранг</th>
                                    <th>Роль</th>
                                    <th>Текст комментария</th>
                                    <th>Статус</th>
                                    <th>Дата</th>
                                    <th>Удалить комментарий</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($comments_manga as $cm)
                            <form method="post" action="/catalog/deleteComManga">
                                @csrf
                                <tr>
                                    <td>
                                        @if($cm->user_id==Auth::id())
                                            <a href="/profile">{{ $cm->name }}</a>
                                        @else
                                            <a href="/profile/{{ $cm->user_id }}">{{ $cm->name }}</a>
                                        @endif
                                    </td>
                                    <td>
                                        @if($cm->user_id==Auth::id())
                                            <a href="/profile">{{ $cm->rank }}</a>
                                        @else
                                            <a href="/profile/{{ $cm->user_id }}">{{ $cm->rank }}</a>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $cm->role }}
                                    </td>
                                    <td>
                                        {{ $cm->txt }}
                                    </td>
                                    <td>
                                        @if($cm->status=='deleted')
                                        Удален
                                        @else
                                            @if($cm->status=='edited')
                                            Изменен
                                            @endif
                                        @endif    
                                    </td>
                                    <td>
                                        {{ $cm->created_at }}
                                    </td>
                                    <td class="d-flex justify-content-center">
                                        <input type="text" hidden name="com_id" value="{{ $cm->id }}">
                                        <input type="submit" class="btn btn-dark" value="Удалить" @if($cm->status=='deleted') disabled @endif>
                                    </td>
                                </tr>
                            </form>
                            @endforeach
                            @foreach($comments_news as $cn)
                            <form method="post" action="/news/deleteComNews">
                                @csrf  
                                <tr>
                                    <td>
                                        @if($cn->user_id==Auth::id())
                                            <a href="/profile">{{ $cn->name }}</a>
                                        @else
                                            <a href="/profile/{{ $cn->user_id }}">{{ $cn->name }}</a>
                                        @endif
                                    </td>
                                    <td>
                                        @if($cn->user_id==Auth::id())
                                            <a href="/profile">{{ $cn->rank }}</a>
                                        @else
                                            <a href="/profile/{{ $cn->user_id }}">{{ $cn->rank }}</a>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $cn->role }}
                                    </td>
                                    <td>
                                        {{ $cn->txt }}
                                    </td>
                                    <td>
                                        @if($cn->status=='deleted')
                                        Удален
                                        @else
                                            @if($cn->status=='edited')
                                            Изменен
                                            @endif
                                        @endif    
                                    </td>
                                    <td>
                                        {{ $cn->created_at }}
                                    </td>
                                    <td class="d-flex justify-content-center">
                                        <input type="text" hidden name="com_id" value="{{ $cn->id }}">
                                        <input type="submit" class="btn btn-dark" value="Удалить" @if($cn->status=='deleted') disabled @endif>
                                    </td>
                                </tr>
                            </form>
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