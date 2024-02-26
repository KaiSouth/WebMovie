<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Movie;
use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Episode;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('layouts.app', function ($view) {
            $today = Carbon::today();


            $todayVisitsCount = DB::table('visits')
                                    ->whereDate('visited_at', $today)
                                    ->distinct('session_id')
                                    ->count('session_id');

            $view->with([
                'totalMovies' => Movie::count(),
                'totalCategories' => Category::count(),
                'totalCountries' => Country::count(),
                'totalGenres' => Genre::count(),
                'todayVisitsCount' => $todayVisitsCount,
            ]);
        });

        View::composer('pages.include.sidebar', function ($view) {
            $view->with('topview', Movie::where('status', 1)->orderBy('view', 'DESC')->take(10)->get());
        });

    }
}

