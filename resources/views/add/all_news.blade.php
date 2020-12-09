@extends('layouts.layout')

@section('title','Новости')

@section('content')
    <div class="d-flex justify-content-center projects-horizontal">
        <div class="container">
            <div class="intro">
                <h2 class="text-center">Новости</h2>
            </div>
            <div class="row projects">
                @foreach($news as $n)
                <div class="col-sm-6 item">
                    <div class="row">
                        <div class="col-md-12 col-lg-5 d-flex justify-content-center">
                            <a href="/news/{{$n->id}}">
                                <img class="img-fluid border rounded" src="../assets/img/{{ $n->img }}" style="height: 200px; width: 200px; object-fit: cover; object-position: 50 50;">
                            </a>
                        </div>
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
            @if ($news->lastPage() > 1)
                <ul class="pagination d-flex justify-content-center">
                    <li class="{{ ($news->currentPage() == 1) ? ' disabled' : '' }} page-item">
                        <a href="{{ $news->url(1) }}" class="page-link text-light bg-dark"><i class="far fa-caret-square-left"></i></a>
                    </li>
                    @for ($i = 1; $i <= $news->lastPage(); $i++)
                        <li class="{{ ($news->currentPage() == $i) ? ' active' : '' }} page-item">
                            <a href="{{ $news->url($i) }}" class="page-link text-light bg-dark">{{ $i }}</a>
                        </li>
                    @endfor
                    <li class="{{ ($news->currentPage() == $news->lastPage()) ? ' disabled' : '' }} page-item">
                        <a href="{{ $news->url($news->currentPage()+1) }}" class="page-link text-light bg-dark"><i class="far fa-caret-square-right"></i></a>
                    </li>
                </ul>
            @endif
        </div>
    </div>
@endsection