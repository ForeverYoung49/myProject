@extends('layouts.layout')

@section('title',$news->name)

@section('content')
    <div class="container">
        <div class="row d-lg-flex justify-content-lg-center">
            <div class="col">
                <h1 class="d-flex d-lg-flex justify-content-center">{{ $news->name }}</h1>
                <blockquote class="blockquote d-flex d-lg-flex justify-content-center" style="font-size: 16px;">
                    <p class="mb-0">{{ $auth->name }}</p>
                    <footer class="blockquote-footer">{{ date('d-m-Y',strtotime($news->created_at)) }}</footer>
                </blockquote>
            </div>
        </div>
        <div class="row">
            <div class="col d-flex d-lg-flex justify-content-center">
                <figure class="figure">
                    <img class="img-fluid figure-img border rounded d-lg-flex justify-content-lg-center news_image" src="../assets/img/{{ $news->img }}">
                    <figcaption class="figure-caption">{{ $news->caption_img }}</figcaption>
                </figure>
            </div>
        </div>
        <div class="row">
            <div class="col d-flex justify-content-start" style="padding: 10px;">
                <p style="font-size: 20px;">{{ $news->txt }}</p>
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
                <form method="post" action="/news/createComNews">
                @csrf
                <input type="text" hidden name="news_id" value="{{ $news->id }}">
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
                                    <form method="post" action="/news/deleteComNews">
                                        @csrf
                                        <input type="text" hidden name="com_id" value="{{ $c->id }}">
                                        <input type="text" hidden name="news_id" value="{{ $news->id }}">
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
                            <form method="post" action="/news/editComNews">
                                @csrf
                                <input type="text" hidden name="com_id" value="{{ $c->id }}">
                                <input type="text" hidden name="news_id" value="{{ $news->id }}">
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
                document.getElementById("text_com_"+$mem).style.display = 'none';
                document.getElementById("edit_com_"+$mem).style.display = 'block';
            }
            function close_edit($mem){
                document.getElementById("text_com_"+$mem).style.display = 'block';
                document.getElementById("edit_com_"+$mem).style.display = 'none';
            }
        </script>
    </div>
@endsection
