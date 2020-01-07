@extends('layouts.layout')

@section('title','Новости')

@section('content')
    <div class="d-lg-flex justify-content-lg-center align-items-lg-center projects-horizontal">
        <div class="container">
            <div class="intro">
                <h2 class="text-center">Новости</h2>
            </div>
            <div class="row projects">
                <div class="col-sm-6 item">
                    <div class="row">
                        <div class="col-md-12 col-lg-5"><a href="/"><img class="img-fluid border rounded" src="assets/img/building.jpg"></a></div>
                        <div class="col">
                            <h3 class="name text-center"><a href="/"><strong>news name</strong><br></a></h3>
                            <blockquote class="blockquote">
                                <p class="mb-0 description">text news (max 80 symbols)</p>
                                <footer class="blockquote-footer d-flex d-xl-flex justify-content-end description-date">date</footer>
                            </blockquote>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection