@extends('layouts.layout')

@section('title','Личный кабинет')

@section('content')
@foreach($user as $u)
    <div class="container" style="margin: 20px 0 20px 0;">
        <div class="row">
            <div class="col-md-8" style="font-size: 18px;">
                <div class="row">
                    <div class="col text-light profile-name bg-dark"><span>Your profile, {{ $u->name }}</span></div>
                </div>
                <div class="row" style="margin: 10px -5px;">
                    <div class="col-md-5 d-flex justify-content-center align-items-center">
                        <img src="assets/img/{{ $u->img }}" style="height: 150px;max-width: 150px;">
                    </div>
                    <div class="col">
                        <div class="row">
                            <div class="col">
                                <p>Rank: {{ $u->rank }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p>date: {{ $u->created_at }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p>role: {{ $u->role }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="row">
                    <div class="col text-light profile-name bg-dark"><span>Your titels</span></div>
                </div>
                <div class="row" style="margin: 10px -5px;">
                    <div class="col bg-dark your-titels"><a class="text-light your-titels" href="#"><i class="fa fa-check-square-o" style="margin: 0 5px 0 0 ;"></i>Прочитано</a></div>
                </div>
                <div class="row" style="margin: 10px -5px;">
                    <div class="col bg-dark your-titels"><a class="text-light your-titels" href="#"><i class="fa fa-heart" style="margin: 0 5px 0 0 ;"></i>Любимое</a></div>
                </div>
                <div class="row" style="margin: 10px -5px;">
                    <div class="col bg-dark your-titels"><a class="text-light your-titels" href="#"><i class="fa fa-calendar-o" style="margin: 0 5px 0 0 ;"></i>Буду читать</a></div>
                </div>
            </div>
        </div>
        <div class="row projects">
            <div class="col-sm-6 col-md-4 col-lg-3" style="margin: 15px 0 0 0;">
                <div class="row">
                    <div class="col d-flex d-xl-flex justify-content-center">
                        <h4>Manga name</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col d-flex d-xl-flex justify-content-center"><img src="assets/img/poster1.jpg" style="height: 200px;max-width: 150px;"></div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3" style="margin: 15px 0 0 0;">
                <div class="row">
                    <div class="col d-flex d-xl-flex justify-content-center">
                        <h4>Manga name</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col d-flex d-xl-flex justify-content-center"><img src="assets/img/poster1.jpg" style="height: 200px;max-width: 150px;"></div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3" style="margin: 15px 0 0 0;">
                <div class="row">
                    <div class="col d-flex d-xl-flex justify-content-center">
                        <h4>Manga name</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col d-flex d-xl-flex justify-content-center"><img src="assets/img/poster1.jpg" style="height: 200px;max-width: 150px;"></div>
                </div>
            </div>
        </div>
    </div>
@endforeach
@endsection