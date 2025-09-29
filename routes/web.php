<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('employees',EmployeeController::class);

Route::get('/about', function(){
    return view('about', ['name' => 'Muhammad Farid', 'title' => 'about']);
});

Route::get('/posts', function() {
    return view('posts', ['title' => 'Blog', 'posts' => [[
        'id' => 1,
        'slug' => 'judul artikel',
        'title' => 'Judul artikel 1',
        'author' => 'Farid',
        'isi' => 'lorem ipsum namaewa farid desu'
    ],
    [
        'id' => 2,
        'slug' => 'judul artikel 2',
        'title' => 'Judul artikel 2',
        'author' => 'Hasan',
        'isi' => 'lorem ipsum namaewa farid desu naniii'
    ]
    ]]
);
});

Route::get('/source', function(){
    return view('source', ['title' => 'source blogs', 'posts' => [
        'title' => 'source channel',
        'source' => 'https//:gpt.com'
    ]]);
});