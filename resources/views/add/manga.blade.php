@extends('layouts.layout')

@section('title',$manga->name)

@section('content')
<div class="container-fluid">
<div class="row d-flex justify-content-center">
    <div class="col-xl-10 col-12" style="margin: 20px 0 20px 0;max-width: 100%!important;">
        
        <h1 class="d-flex d-lg-flex justify-content-center justify-content-lg-center" style="margin: 0 0 40px 0;">{{ $manga->name }}</h1>
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6 col-lg-4">
                <div class="row">
                    <div class="col d-flex d-xl-flex justify-content-center">
                        <img src="../assets/img/{{ $manga->img }}" class="show-poster-manga">
                    </div>
                </div>
                @if(Gate::check('isUser') || Gate::check('isAdmin'))
                <form method="post" action="/catalog/addUserList">
                @csrf
                    <div class="row ">
                        <div class="col d-flex justify-content-center">
                            <div class="btn-group" role="group">
                                <input type="text" name="manga_id" id="manga_id" hidden value="{{ $manga->id }}">
                                <button class="btn btn-success btn-sm list_button @if($list<>null&&$list->status=='1') {{'active'}}@endif" type="submit" name="list" value="1">
                                    <i class="fas fa-eye"></i>&nbsp;Читаю
                                </button>
                                <button class="btn btn-success btn-sm list_button @if($list<>null&&$list->status=='2') {{'active'}}@endif" type="submit" name="list" value="2">
                                    <i class="far fa-calendar"></i>&nbsp;Буду читать
                                </button>
                                <div class="dropdown btn-group" role="group">
                                    <button class="btn btn-success dropdown-toggle list_button" data-toggle="dropdown" aria-expanded="true" type="button"></button>
                                    <div class="dropdown-menu" role="menu">
                                        <button class="btn btn-success list_button @if($list<>null&&$list->status=='3') {{'active'}}@endif" type="submit" name="list" value="3">
                                            <i class="fas fa-check-square"></i>&nbsp;Прочитано
                                        </button>
                                        <button class="btn btn-success list_button @if($listFavorite<>null) {{'active'}}@endif" type="submit" name="list" value="4">
                                            <i class="fas fa-heart"></i>&nbsp;Любимое
                                        </button>
                                        <button class="btn btn-success list_button @if($list<>null&&$list->status=='5') {{'active'}}@endif" type="submit" name="list" value="5">
                                            <i class="fas fa-eye-slash"></i>&nbsp;Брошено
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                @endif
                <div class="row">
                    <div class="col d-flex justify-content-center align-items-center" style="margin: 10px;">
                        <p class="star" style="font-size: 28px;"><i class="fa fa-star star" style="font-size: 28px;margin: 0 5px 0 5px;"></i>{{ $manga->rating }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="row">
                            <div class="col">
                                <p style="font-size: 20px;margin: 0 0 5px 0;"><strong>Жанры:</strong></p>
                            </div>
                        </div>
                        <div class="row">
                            @foreach($pack_genre as $p)
                                <div class="col-6 d-flex d-xl-flex justify-content-center justify-content-xl-center" style="padding: 0;">
                                    <span class="text-light bg-dark border rounded genre">
                                        <i class="fa fa-tag" style="margin: 0 5px 0 0;"></i>{{ $p->name }}
                                    </span>
                                </div>
                             @endforeach
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <hr>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-8" style="padding: 0;">
                <div class="row">
                    <div class="col-xl-5">
                        <div class="row">
                            <div class="col text-left d-lg-flex justify-content-lg-start align-items-lg-start">
                                <p><strong>Статус:</strong> {{ $status->name }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col text-left d-lg-flex justify-content-lg-start align-items-lg-start">
                                <p><strong>Автор:&nbsp;</strong><a href="#"> {{ $auth->name }}</a></p>
                            </div>
                        </div>
                    </div>

                    @if(Gate::check('isUser') || Gate::check('isAdmin'))
                    <div class="col">
                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-center">
                                        <p class="mark-manga"><strong>Поставьте свою оценку:</strong></p>
                                    </div> 
                                </div> 
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-center">
                                        <div class="btn-group" role="group">
                                            <form method="post" action="/catalog/ratingManga">
                                                @csrf
                                                <input type="text" name="manga_id" id="manga_id" hidden value="{{ $manga->id }}">
                                                <div class="">
                                                    <input class="btn btn-success @if($check<>null&&$check->mark=='1') {{'active'}}@endif" type="submit" value="1" name="mark">
                                                    <input class="btn btn-success @if($check<>null&&$check->mark=='2') {{'active'}}@endif" type="submit" value="2" name="mark">
                                                    <input class="btn btn-success @if($check<>null&&$check->mark=='3') {{'active'}}@endif" type="submit" value="3" name="mark">
                                                    <input class="btn btn-success @if($check<>null&&$check->mark=='4') {{'active'}}@endif" type="submit" value="4" name="mark">
                                                    <input class="btn btn-success @if($check<>null&&$check->mark=='5') {{'active'}}@endif" type="submit" value="5" name="mark">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col">
                        <div class="row">
                            <div class="col text-left d-lg-flex justify-content-lg-start align-items-lg-start">
                                <p><strong>Описание:</strong></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col text-left d-lg-flex justify-content-lg-start align-items-lg-start">
                                <p>{{ $manga->description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @if($first_chapter <> null)
                <div class="row">
                    <div class="col-xl-9 col-lg-9 d-flex justify-content-center col-12" style="text-align: center;">
                        <strong class="chapters-text-size">Читайте последние главы манги {{$manga->name}}</strong>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-12 d-xl-flex justify-content-xl-end align-items-center d-flex justify-content-center">
                        <a href="/catalog/{{ $manga->id }}/{{ $first_chapter->id }}" class="btn btn-dark quick-buttons-chapters" style="margin: 0 10px 0 0;">Первая глава</a>
                    </div>
                </div>
                <hr style="height: 1px; margin-left: 20px; margin-right: 20px;" class="bg-dark">
                @else
                <div class="row">
                    <div class="d-flex justify-content-center col-12" style="text-align: center;">
                        <strong class="chapters-text-size">Главы еще не были добавлены на сайт</strong>
                    </div>
                </div>
                @endif
                @foreach($page as $p)

                    <a href="/catalog/{{$manga->id}}/{{$p->id}}" class="row d-flex justify-content-center chapters" style="font-family: 'Comfortaa', cursive;">
                    <div class="col-5 col-lg-7 chapters-names">
                        Том {{$p->tome}} - Глава {{$p->number}} - {{$p->name}}
                    </div>
                    <div class="col-2 col-lg-2">
                        @foreach($last_chapter as $lp)
                            @if($lp->chapter_id == $p->id)
                                <span style="font-size: 12px; font-style: italic;">Прочитано</span>
                            @endif
                        @endforeach
                    </div>
                    <div class="col-5 col-lg-3 d-flex justify-content-end chapters-names">
                       {{date('d-m-Y',strtotime($p->created_at))}}
                    </div>
                    </a>
                
                @endforeach
                <div class="d-flex justify-content-center">
                    {{ $page->links() }}
                </div>
            </div>
        </div>
    </div>
        
    <div class="container">
        <div class="row">
            <div class="col bg-dark" style="margin: 0 0 10px 0;">
                <h3 class="text-light comments-header" style="margin: 8px;">Комментарии</h3>
            </div>
        </div>
            @if(Gate::check('isUser') || Gate::check('isAdmin') || Gate::check('isModer'))
                @if($user->ban=='banned')
                <div class="row">
                    <div class="col-12 d-flex justify-content-center">
                        <span class="chapters-text-size" style="margin-bottom: 20px; font-weight: 600;">Вы не имеете возможность писать комментарии, поскольку были заблокированны администрацией.</span>
                    </div>
                </div>
                @else
                <form method="post" action="/catalog/createComManga">
                @csrf
                <input type="text" hidden name="manga_id" value="{{ $manga->id }}">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-8 col-lg-8 col-12">
                        <textarea type="text" style="width: 100%;" name="txt"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col d-flex d-sm-flex d-xl-flex justify-content-end" style="margin: 10px 0 15px 0;">
                        <button class="btn btn-dark text-white d-xl-flex quick-buttons-chapters" type="submit">Добавить комментарий</button>
                    </div>
                </div>
                </form>
                @endif
            @endif   
            @foreach($comments as $c)
            <div class="row">
                <div class="col-3 col-sm-2 col-lg-2 col-xl-1 d-flex justify-content-end" style="padding: 0; margin-right: 10px;">
                    @if($c->id<>Auth::id())
                    <a href="/profile/{{ $c->id }}">
                        <img class="rounded" style="width: 80px;height: 80px;" src="../assets/img/{{ $c->img }}">
                    </a>
                    @else
                    <a href="/profile">
                        <img class="rounded" style="width: 80px;height: 80px;" src="../assets/img/{{ $c->img }}">
                    </a>
                    @endif
                </div>
                <div class="col"  style="padding: 0;">
                    <div class="row">
                        <div class="col"  style="padding: 0;">
                            <div class="row">
                                <div class="col">
                                    <blockquote class="blockquote" style="margin: 0;">
                                        @if($c->user_id<>Auth::id())
                                            <a href="/profile/{{ $c->user_id }}" class="mb-0 comments-name">{{ $c->name }}
                                                @if($c->ban=='banned')
                                                    <sup style="font-size: 12px; font-style: italic;">- Забанен</sup>
                                                @endif
                                            </a>
                                        @else
                                            <a href="/profile" class="mb-0 comments-name">{{ $c->name }}
                                                @if($c->ban=='banned')
                                                    <sup style="font-size: 12px; font-style: italic; color: gray;">- Забанен</sup>
                                                @endif
                                            </a>
                                        @endif
                                        <footer class="blockquote-footer" style="font-size: 12px;">    {{ date('d-m-Y',strtotime($c->created_at)) }}
                                            @if($c->status=='edited')<span style="margin-left: 2px;font-size: 12px; color: gray; font-style: italic;">Изменено</span>
                                            @endif
                                        </footer>
                                    </blockquote>
                                </div>
                                
                            </div>
                        </div>
                        @if($c->user_id==Auth::id() || Gate::check('isAdmin') || Gate::check('isModer'))
                            @if($c->status<>'deleted' && $user->ban<>'banned')
                                @if($c->user_id==Auth::id())
                                    <div class="col-1 d-lg-flex justify-content-lg-end align-items-lg-start">
                                        <button type="submit" class="buttons_com" onclick="edit({{$c->id}})" title="Редактировать комментарий"><i class="fas fa-pencil-alt"></i></button>
                                    </div>
                                @endif
                                <div class="col-1">
                                    <form method="post" action="/catalog/deleteComManga">
                                        @csrf
                                        <input type="text" hidden name="com_id" value="{{ $c->id }}">
                                        <input type="text" hidden name="manga_id" value="{{ $manga->id }}">
                                        <button type="submit" class="buttons_com" title="Удалить комментарий"><i class="fas fa-times"></i></button>
                                    </form>
                                </div>
                            @endif
                        @endif
                    </div>
                    <div class="row">
                        <div class="col" id="text_com_{{$c->id}}">
                            @if($c->status=='deleted')
                                <p class="deleted_com">Комментарий был удален пользователем или администрацией.</p>
                            @else
                                <p class="text_com">{{ $c->txt }}</p>
                            @endif
                        </div>
                        <div class="col" id="edit_com_{{$c->id}}" style="padding: 10px 15px; display: none;">
                            <form method="post" action="/catalog/editComManga">
                                @csrf
                                <input type="text" hidden name="com_id" value="{{ $c->id }}">
                                <input type="text" hidden name="manga_id" value="{{ $manga->id }}">
                                <textarea type="text" style="width: 100%;" name="txt">{{ $c->txt }}</textarea>
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-dark text-white" type="button" onclick="close_edit({{$c->id}})" style="margin-right: 10px;">Отменить</button>
                                    <button class="btn btn-dark text-white" type="submit">Сохранить</button>   
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="d-flex justify-content-center">
            {{ $comments->links() }}
        </div>
            <script type="text/javascript">
                function edit($mem){
                    string = "text_com_";
                    string += $mem;
                    string1 = "edit_com_";
                    string1 += $mem;
                    document.getElementById(string).style.display = 'none';
                    document.getElementById(string1).style.display = 'block';
                }
                function close_edit($mem){
                    string = "text_com_";
                    string += $mem;
                    string1 = "edit_com_";
                    string1 += $mem;
                    document.getElementById(string).style.display = 'block';
                    document.getElementById(string1).style.display = 'none';
                }
            </script>
        </div>
    </div>
</div>
</div>
@endsection