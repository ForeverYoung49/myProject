@extends('layouts.layout')

@section('title','Новости')

@section('content')
    <div class="d-lg-flex justify-content-lg-center align-items-lg-center projects-horizontal">
        <div class="container">
            <div class="intro">
                <h2 class="text-center">Новости</h2>
            </div>
            <div class="row projects">
                @foreach($news as $n)
                <div class="col-sm-6 item">
                    <div class="row">
                        <div class="col-md-12 col-lg-5"><a href="/news/{{$n->id}}"><img class="img-fluid border rounded" src="assets/img/{{ $n->img }}"></a></div>
                        <div class="col">
                            <h3 class="name text-center"><a href="/news/{{$n->id}}"><strong>{{ $n->name }}</strong><br></a></h3>
                            <blockquote class="blockquote">
                                <p class="mb-0 description">{{ substr($n->txt,0,80) }}</p>
                                <footer class="blockquote-footer d-flex d-xl-flex justify-content-end description-date">{{ $n->created_at }}</footer>
                            </blockquote>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection