@extends('layouts.layout')

@section('title','Регистрация')

@section('content')
    <div class="d-flex d-lg-flex justify-content-center align-items-center login-dark">
        <form method="post">
            @csrf
            <h2 class="sr-only">Register Form</h2>
            <div class="illustration"><i class="icon ion-ios-locked-outline"></i></div>
            <div class="form-group">
                <input class="form-control" type="text" name="name" id="name" placeholder="Имя пользователя">
            </div>
            <div class="form-group">
                <input class="form-control" type="email" name="email" id="email" placeholder="Email">
            </div>
            <div class="form-group">
                <input class="form-control" type="password" name="password" id="password" placeholder="Пароль">
            </div>
            <div class="form-group">
                <input class="form-control" type="password" name="password_confirmation" id="password-confirm" placeholder="Пароль">
            </div>
            <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit">Регистрация</button>
            </div>
            <a class="forgot" href="#">Правила пользования</a>
        </form>
    </div>
@endsection