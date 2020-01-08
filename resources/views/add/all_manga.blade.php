@extends('layouts.layout')

@section('title','Каталог манги')

@section('content')

    <div class="d-lg-flex justify-content-lg-center align-items-lg-center projects-horizontal">
        <div class="container">
            <div class="intro">
                <h2 class="text-center">Каталог манги</h2>
            </div>
            <div class="row projects">
                @foreach($manga_table as $m)
                <div class="col-sm-6 col-md-4 col-lg-3" style="margin: 15px 0 0 0;">
                    <div class="row">
                        <div class="col d-flex d-xl-flex justify-content-center">
                            <h4><a href="/catalog/{{ $m->id }}">{{ $m->name }}</a></h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col d-flex d-xl-flex justify-content-center">
                            <img src="assets/img/{{ $m->img }}" style="height: 250px;">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col d-flex d-xl-flex justify-content-center"><i class="fa fa-star d-flex d-xl-flex align-items-center star" style="margin: 5px 0 0 0;"></i>
                            <p class="star-all-manga"><strong>{{ $m->rating }}</strong></p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection