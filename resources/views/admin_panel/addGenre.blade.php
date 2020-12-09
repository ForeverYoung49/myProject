@extends('layouts.layout')

@section('title','Панель администратора')

@section('content')
@if(Gate::check('isAdmin'))
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
                    <a href="/adminPanel/showLastComments" class="d-flex justify-content-left col btn btn-dark text-light your-titels your-titels">Комментарии за день</a>
                </div>
                @endif
                @if(Gate::check('isAdmin'))
                <div class="row" style="margin: 10px -5px;">
                    <a href="/adminPanel/showAddManga" class="d-flex justify-content-left col btn btn-dark text-light your-titels your-titels">Добавить мангу</a>
                </div>
                <div class="row" style="margin: 10px -5px;">
                    <a href="/adminPanel/showAddGenre" class="d-flex justify-content-start active col btn btn-dark text-light your-titels your-titels">Добавить жанры</a>
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
                @livewire('add-genre')
            </div>
        </div>
    </div>
@else
    <h1 class="d-flex justify-content-center align-items-center" style="margin-top: 20px;">Данный раздел доступен только для администраторов.</h1>
@endif
@endsection