@extends('layouts.layout')

@section('title','Главная')

@section('content')

        <div class="container">
            <div class="row" style="margin-top: 20px;">
                <div class="col-md-8 col-lg-7">
                    <h2>Последние релизы</h2>
                    <hr>
                    @foreach($manga_table as $m)
                    <div class="row text-light bg-dark style-last-manga">
                        <div class="col-3 col-sm-2 col-lg-2 col-xl-2 d-flex d-sm-flex justify-content-xl-end justify-content-sm-center align-items-sm-center" style="padding: 0px;">
                            <img class="rounded d-flex justify-content-end" src="../assets/img/{{ $m->img }}" style="width: 70px; height: 100px;  object-fit: cover; object-position: 50 50;">
                        </div>
                        <div class="col-2 col-sm-2 col-lg-2 col-xl-1 d-flex d-xl-flex align-items-center justify-content-sm-start justify-content-xl-center"
                            style="padding: 0px 0px 0px 5px;">
                            <p class="d-xl-flex align-items-xl-center star"><i class="fa fa-star"></i>&nbsp;{{ $m->rating }}</p>
                        </div>
                        <div class="col-7 col-sm-8 col-lg-6 col-xl-8 d-flex d-xl-flex justify-content-center align-items-center justify-content-sm-start align-items-xl-center">
                            <h4 style="margin: 0px;"><a class="text-light" href="/catalog/{{ $m->id }}">{{ $m->name }}</a></h4>
                        </div>
                     <!--   <div class="col-lg-2 col-xl-2 d-flex d-xl-flex justify-content-end align-items-center">
                            <blockquote class="blockquote" style="font-size: 16px;margin: 0px;">
                                <p class="mb-0">Chapster</p>
                                <footer class="blockquote-footer text-light d-xl-flex justify-content-xl-end">date</footer>
                            </blockquote>
                        </div> -->
                    </div>
                    @endforeach
                </div>
                <div class="col-md-4 col-lg-5">
                    <h2>Последние новости</h2>
                    <hr>
                    <div class="row">
                        @foreach($news as $n)
                        <div class="col-sm-6 col-md-12 col-lg-12 item  d-flex justify-content-center">
                            <div class="row">
                                <div class="col-md-12 col-lg-12 d-flex d-lg-flex justify-content-center align-items-center align-items-lg-center"><a href="/news/{{$n->id}}"><img class="img-fluid border rounded d-flex" src="../assets/img/{{ $n->img }}" style="width: 200px; height: 200px;  object-fit: cover; object-position: 50 50;"></a></div>
                                <div class="col last-news">
                                    <h3 class="name text-center"><a href="/news/{{$n->id}}"><strong>{{ $n->name }}</strong><br></a></h3>
                                    <blockquote class="blockquote">
                                        
                                        <footer class="blockquote-footer d-flex d-xl-flex justify-content-end description-date">{{ date('d-m-Y',strtotime($n->created_at)) }}</footer>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

@endsection
