@extends('layouts.layout')

@section('title','Редактирование профиля')

@section('content') 


    <div class="container" style="margin-top: 20px;margin-bottom: 20px;">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-10 col-md-11 d-flex align-items-center  text-light profile-name bg-dark">
                        <span>Редактирование вашего профиля, {{ $user->name }}</span>
                    </div>
                    <a href="/profile" class="col-2 col-md-1 d-flex align-items-center justify-content-center settings btn btn-dark text-light profile-name">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>
                <form method="post" action="/profile/edit" enctype="multipart/form-data">
                    @csrf
                <div class="row" id="edit-profile" style="margin: 10px -5px;">
                    
                        <div class="col-md-5 d-flex justify-content-center align-items-center">
                            <img src="../assets/img/{{ $user->img }}" style="height: 150px; object-fit: cover; object-position: 50 50; max-width: 150px;">
                        </div>
                    
                        <div class="col">
                            <div class="row edit-profile">
                                <div class="col-2">
                                    <label>Аватар:</label>
                                </div>
                                <div class="col">
                                    <input type="file" accept="image/*" name="img">
                                </div>
                            </div>
                            <div class="row edit-profile">
                                <div class="col-2">
                                    <label>Имя:</label>
                                </div>
                                <div class="col">
                                    <input class="form-control" type="text" name="username" id="username">
                                </div>
                            </div>
                            <div class="row edit-profile">
                                <div class="col-2">
                                    <label>Почта:</label>
                                </div>
                                <div class="col">
                                    <input class="form-control" type="text" name="email">
                                </div>                        
                            </div>
                            <div class="row edit-profile">
                                <div class="col-2">
                                    <label>Пароль:</label>
                                </div>
                                <div class="col">
                                    <input class="form-control" type="password" name="password" minlength="6">
                                </div>                        
                            </div>
                            <div class="row edit-profile">
                                <div class="col d-flex justify-content-end">
                                    <input type="submit" value="Подтвердить" class="btn btn-success">
                                </div> 
                                <div class="col d-flex justify-content-left">
                                    <a href="/profile" class="btn btn-danger">Вернуться</a>
                                </div>                        
                            </div>
                        </div>
                   
                </div>
                 </form>
            </div>
        </div>
    </div>

@endsection