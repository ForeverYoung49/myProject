@extends('layouts.layout')

@section('title','{{ $name }}')

@section('content')
    <div class="container" style="margin: 20px 0 20px 0;max-width: 100%!important;">
        <h1 class="d-flex d-lg-flex justify-content-center justify-content-lg-center" style="margin: 0 0 15px 0;">Manga name</h1>
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6 col-lg-4">
                <div class="row">
                    <div class="col d-flex justify-content-center align-items-center"><img class="rounded" src="assets/img/poster1.jpg" style="width: 250px;"></div>
                </div>
                <div class="row">
                    <div class="col d-flex justify-content-center align-items-center" style="margin: 10px;">
                        <p class="star" style="font-size: 28px;"><i class="fa fa-star star" style="font-size: 28px;margin: 0 5px 0 5px;"></i>9.22</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="row">
                            <div class="col">
                                <p style="font-size: 20px;margin: 0 0 5px 0;"><strong>Genres:</strong></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 d-flex d-xl-flex justify-content-center justify-content-xl-center" style="padding: 0;"><a class="text-light bg-dark border rounded genre" href="#"><i class="fa fa-tag" style="margin: 0 5px 0 0;"></i>genre name</a></div>
                            <div class="col-6 d-flex d-xl-flex justify-content-center justify-content-xl-center" style="padding: 0;"><a class="text-light bg-dark border rounded genre" href="#"><i class="fa fa-tag" style="margin: 0 5px 0 0;"></i>genre name</a></div>
                        </div>
                        <div class="row">
                            <div class="col-6 d-flex d-xl-flex justify-content-center justify-content-xl-center" style="padding: 0;"><a class="text-light bg-dark border rounded genre" href="#"><i class="fa fa-tag" style="margin: 0 5px 0 0;"></i>genre name</a></div>
                            <div class="col-6 d-flex d-xl-flex justify-content-center justify-content-xl-center" style="padding: 0;"><a class="text-light bg-dark border rounded genre" href="#"><i class="fa fa-tag" style="margin: 0 5px 0 0;"></i>genre name</a></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <hr>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-8" style="padding: 0;">
                <div class="row">
                    <div class="col text-left d-lg-flex justify-content-lg-start align-items-lg-start">
                        <p><strong>Date:</strong> 2002</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col text-left d-lg-flex justify-content-lg-start align-items-lg-start">
                        <p><strong>status:</strong> end</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col text-left d-lg-flex justify-content-lg-start align-items-lg-start">
                        <p><strong>auth:&nbsp;</strong><a href="#">123</a></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col text-left d-lg-flex justify-content-lg-start align-items-lg-start">
                        <p><strong>painter:</strong>&nbsp;<a href="#">123</a></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col text-left d-lg-flex justify-content-lg-start align-items-lg-start">
                        <p><strong>Translators: </strong>123 123 123</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col text-left d-lg-flex justify-content-lg-start align-items-lg-start">
                        <p><strong>discription:</strong></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col text-left d-lg-flex justify-content-lg-start align-items-lg-start">
                        <p>discription manga</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection