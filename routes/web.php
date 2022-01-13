<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\{
    ShowTweets
};
use App\Http\Livewire\User\UploadPhoto;
//verficação do arquivo Tweet 
Route::get('storage/users/{filename}', function($filename){
   // $path = storage_path('users/'. $filename);
    $path = (Storage::path('users/' . $filename));

    if (!File::exists($path)){
        abort(404);

    }
    $file = File::get($path);
    $type = File::mimeType($path);
    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);
    
    return $response; 
});

// fim da verificação 

Route::get('/upload', UploadPhoto::class)
             ->name('upload.photo.user')
             ->middleware('auth');
Route::get('tweets', ShowTweets::class)
              ->name('tweets.index')
              ->middleware('auth');

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
