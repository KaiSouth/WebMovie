<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\LeechMovieController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;

Route::get('/', [IndexController::class, 'home'])->name('homepage');
Route::get('/danh-muc/{slug}', [IndexController::class, 'category'])->name('category');
Route::get('/the-loai/{slug}', [IndexController::class, 'genre'])->name('genre');
Route::get('/quoc-gia/{slug}', [IndexController::class, 'country'])->name('country');
Route::get('/phim/{slug}', [IndexController::class, 'movie'])->name('movie');
Route::get('/xem-phim/{slug}', [IndexController::class, 'watch'])->name('watch');
Route::get('/xem-phim/{slug}/{tap}', [IndexController::class, 'watch']);
Route::get('/sotap', [IndexController::class, 'episode'])->name('so-tap');
Route::get('/nam/{year}', [IndexController::class,'year']);
Route::get('/tag/{tag}', [IndexController::class,'tag']);
Route::get('tim-kiem', [IndexController::class,'timkiem'])->name('tim-kiem');


Auth::routes();
Route::get('/home',[HomeController::class,'index'])->name('home');


//route admin
Route::resource('category', CategoryController::class);
Route::resource('genre', GenreController::class);
Route::resource('country', CountryController::class);

Route::resource('episode', EpisodeController::class);

Route::get('add-episode/{id}', [EpisodeController::class,'add_episode'])->name('add-episode');

Route::get('select-movie',[EpisodeController::class,'select_movie'])->name('select-movie');

Route::resource('movie', MovieController::class);
Route::get('/update-year-phim', [MovieController::class,'update_year']);

//Thay đổi với ajax
Route::get('/category-choose',[MovieController::class,'category_choose'])->name('category-choose');
Route::get('/genre-choose',[MovieController::class,'genre_choose'])->name('genre-choose');
Route::get('/country-choose',[MovieController::class,'country_choose'])->name('country-choose');
Route::get('/hot-choose',[MovieController::class,'hot_choose'])->name('hot-choose');

// Tự động lấy phim từ API
Route::get('/leech-movie',[LeechMovieController::class,'leech_movie'])->name('leech');
Route::get('/leech-movieDetail/{slug}',[LeechMovieController::class,'leech_movieDetail'])->name('leech-Detail');
Route::get('/leech-store/{slug}',[LeechMovieController::class,'store'])->name('leech-store');
Route::get('/leech-episode/{slug}',[LeechMovieController::class,'episode'])->name('leech-episode');
Route::get('/leech-addEpisode/{slug}',[LeechMovieController::class,'addEpisode'])->name('leech-episodeAdd');
Route::get('/leech-sreachMovie',[LeechMovieController::class,'leech_sreach_movie'])->name('leechSreachMovie');

//route login với 3 phương thức
// Đăng nhập thông thường

//Hiển thị view
Route::get('/loginCus',[AuthController::class,'index']);
Route::get('/registerCus',[AuthController::class,'index1']);

//Chức năng đăng nhập
Route::post('/loginCustomer', [AuthController::class,'checkCustomer']);
Route::post('/register',[AuthController::class,'checkRegister']);


//Lougout
Route::post('/logoutCustomer',function(){
    Auth::guard('customer')->logout();
    return redirect('/');
});

Route::get('/login/google', [AuthController::class, 'redirectToGoogle']);
Route::get('/google/callback', [AuthController::class, 'handleGoogleCallback']);


// Đăng nhập với Facebook
Route::get('/login/facebook', [AuthController::class, 'redirectToFacebook']);
Route::get('/facebook/callback', [AuthController::class, 'handleFacebookCallback']);








