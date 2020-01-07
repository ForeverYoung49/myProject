@extends('layouts.layout')

@section('title','{{ $name }}')

@section('content')
    <div class="container">
        <div class="row d-lg-flex justify-content-lg-center">
            <div class="col">
                <h1 class="d-flex d-lg-flex justify-content-center">news name</h1>
                <blockquote class="blockquote d-flex d-lg-flex justify-content-center" style="font-size: 16px;">
                    <p class="mb-0">auth name</p>
                    <footer class="blockquote-footer">date</footer>
                </blockquote>
            </div>
        </div>
        <div class="row">
            <div class="col d-flex d-lg-flex justify-content-center">
                <figure class="figure"><img class="img-fluid figure-img border rounded d-lg-flex justify-content-lg-center" src="assets/img/desk.jpg" style="width: 500px;">
                    <figcaption class="figure-caption">Caption</figcaption>
                </figure>
            </div>
        </div>
        <div class="row">
            <div class="col d-flex justify-content-start" style="padding: 10px;">
                <p style="font-size: 20px;">news text</p>
            </div>
        </div>
    </div>
@endsection