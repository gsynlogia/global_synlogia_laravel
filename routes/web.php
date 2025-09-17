<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
});

Route::get('/o-firmie', function () {
    return view('pages.about');
});

Route::get('/uslugi', function () {
    return view('pages.services');
});

Route::get('/kontakt', function () {
    return view('pages.contact');
});
