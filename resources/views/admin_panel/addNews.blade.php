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
                    <a href="/adminPanel/showAddNews" class="d-flex justify-content-start active col btn btn-dark text-light your-titels your-titels">Добавить новость</a>
                </div>
                <div class="row" style="margin: 10px -5px;">
                    <a href="/adminPanel/showAddChapster" class="d-flex justify-content-left col btn btn-dark text-light your-titels your-titels">Добавить главы манги</a>
                </div>
                <div class="row" style="margin: 10px -5px;">
                    <a href="/adminPanel/showControlUsers" class="d-flex justify-content-left col btn btn-dark text-light your-titels your-titels">Управление пользователями</a>
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
                <form method="post" action="/adminPanel/addNews" enctype="multipart/form-data">
                    @csrf
                    <div class="col" style="margin:20px 0px; padding: 0px;">
                        <div class="row edit-profile d-flex justify-content-center">
                            <div class="col-md-2">
                                <label>Название:</label>
                            </div>
                            <div class="col-md-6">
                                <input class="form-control" required type="text" name="name" id="name">
                            </div>
                        </div>
                        <div class="row edit-profile d-flex justify-content-center">
                            <div class="col col-md-2">
                                <label>Изображение:</label>
                            </div>
                            <div class="col-md-6 d-flex justify-content-left">
                                <input type="file" required accept="image/*" name="img" id="img">
                            </div>
                        </div>
                        <div class="row edit-profile d-flex justify-content-center">
                            <div class="col-md-2">
                                <label>Подпись к изображению:</label>
                            </div>
                            <div class="col-md-6">
                                <input class="form-control" required type="text" name="caption" id="caption">
                            </div>
                        </div>
                        <div class="row edit-profile d-flex justify-content-center">
                            <div class="col-md-2">
                                <label>Текст:</label>
                            </div>
                            <div class="col-md-6">
                                <textarea style="width: 100%; border: 1px solid grey;" required name="text" id="text"></textarea>
                            </div>                        
                        </div>
                        <div class="row edit-profile d-flex justify-content-center">
                            <div class="col-6 d-flex justify-content-end">
                                <input type="submit" value="Добавить" class="btn btn-success">
                            </div> 
                            <div class="col-6 d-flex justify-content-left">
                                <a href="/adminPanel" class="btn btn-danger">Вернуться</a>
                            </div>                        
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@else
    <h1 class="d-flex justify-content-center align-items-center" style="margin-top: 20px;">Данный раздел доступен только для администраторов.</h1>
@endif
@endsection