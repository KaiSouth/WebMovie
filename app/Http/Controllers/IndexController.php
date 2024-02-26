<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Country;
use App\Models\Movie;
use App\Models\Episode;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class IndexController extends Controller
{

    private function getCategory()
    {
        if (Auth::guard('customer')->check()) {
            return Category::orderBy('id', 'DESC')->get();
        } else {
            return Category::orderBy('id', 'DESC')->where('status', 1)->get();
        }
    }

    private function getCategoryHome()
    {
        if (Auth::guard('customer')->check()) {
            return Category::with('movie')->orderBy('id', 'DESC')->get();
        } else {
            return Category::with('movie')->orderBy('id', 'DESC')->where('status', 1)->get();
        }
    }
    public function home()
    {
        $category = $this->getCategory();
        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','DESC')->get();
        $category_home = $this->getCategoryHome();
        $phimhot = Movie::where('phim_hot',1)->where('status', 1)->orderBy('ngaycapnhat','DESC')->get();
        $phimhot_sidebar = Movie::where('phim_hot',1)->where('status', 1)->orderBy('ngaycapnhat','DESC')->take(5)->get();
        $topview = Movie::where('status', 1)->orderBy('view', 'DESC')->take(10)->get();


        return view('pages.home', compact('category', 'genre', 'country', 'category_home', 'phimhot', 'phimhot_sidebar', 'topview'));
    }

    public function timkiem()
    {
        if(isset($_GET['search'])){
            $search = $_GET['search'];
            $category = $this->getCategory();
            $genre = Genre::orderBy('id','DESC')->get();
            $country = Country::orderBy('id','DESC')->get();
            $phimhot_sidebar = Movie::where('phim_hot',1)->where('status', 1)->orderBy('ngaycapnhat','DESC')->take(5)->get();
            $movie = Movie::where('title','LIKE','%'.$search.'%')->orderBy('ngaycapnhat','DESC')->paginate(12);
            return view('pages.timkiem',compact('category','genre','country','movie','phimhot_sidebar','search'));

        }
        else{
            return redirect()->to('/');
        }

    }
    public function category($slug)
    {
        $category = $this->getCategory();
        $cate_slug = Category::where('slug',$slug)->first();
        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','DESC')->get();
        $movie = Movie::where('category_id',$cate_slug->id)->paginate(12);
        $phimhot_sidebar = Movie::where('phim_hot',1)->where('status', 1)->orderBy('ngaycapnhat','DESC')->take(5)->get();

        return view('pages.category',compact('category','genre','country','cate_slug','movie','phimhot_sidebar'));
    }
    public function genre($slug){
        $category = $this->getCategory();
        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','DESC')->get();
        $genre_slug = Genre::where('slug',$slug)->first();
        $movie = Movie::where('genre_id',$genre_slug->id)->paginate(12);
        $phimhot_sidebar = Movie::where('phim_hot',1)->where('status', 1)->orderBy('ngaycapnhat','DESC')->take(5)->get();

        return view('pages.genre',compact('category','genre','country','genre_slug','movie','phimhot_sidebar'));
    }
    public function country($slug){
        $category = $this->getCategory();
        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','DESC')->get();
        $country_slug = Country::where('slug',$slug)->first();
        $movie = Movie::where('country_id',$country_slug->id)->paginate(12);
        $phimhot_sidebar = Movie::where('phim_hot',1)->where('status', 1)->orderBy('ngaycapnhat','DESC')->take(5)->get();

        return view('pages.country',compact('category','genre','country','country_slug','movie','phimhot_sidebar'));
    }
    public function movie($slug)
    {
        $category = $this->getCategory();
        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','DESC')->get();
        $movie = Movie::with('category','genre','country')->where('slug',$slug)->where('status',1)->first();
        $related = Movie::with('category','genre','country')->where('genre_id',$movie->genre->id)->orderBy(DB::raw('RAND()'))->whereNotIn('slug',[$slug])->get();
        return view('pages.movie',compact('category','genre','country','movie','related'));
    }

    public function year($year)
    {
            $category = $this->getCategory();
            $genre = Genre::orderBy('id','DESC')->get();
            $country = Country::orderBy('id','DESC')->get();
            $year = $year;
            $movie = Movie::where('year',$year)->paginate(12);
            $phimhot_sidebar = Movie::where('phim_hot',1)->where('status', 1)->orderBy('ngaycapnhat','DESC')->take(5)->get();

            return view('pages.year',compact('category','genre','country','movie','year','phimhot_sidebar'));
    }
    public function tag($tag)
    {
            $category = $this->getCategory();
            $genre = Genre::orderBy('id','DESC')->get();
            $country = Country::orderBy('id','DESC')->get();
            $tag = $tag;
            $phimhot_sidebar = Movie::where('phim_hot',1)->where('status', 1)->orderBy('ngaycapnhat','DESC')->take(5)->get();
            $movie = Movie::where('tags','LIKE','%'.$tag.'%')->orderBy('ngaycapnhat','DESC')->paginate(12);
            return view('pages.tag',compact('category','genre','country','movie','tag','phimhot_sidebar'));
    }

    public function watch($slug,$tap){

        $category = $this->getCategory();
        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','DESC')->get();
        $category_home = $this->getCategoryHome();
        $phimhot = Movie::where('phim_hot',1)->where('status', 1)->orderBy('ngaycapnhat','DESC')->take(5)->get();
        $phimhot_sidebar = Movie::where('phim_hot',1)->where('status', 1)->orderBy('ngaycapnhat','DESC')->take(5)->get();

        $movie = Movie::with('category','genre','country','episode')->where('slug',$slug)->where('status',1)->first();
        $related = Movie::with('category','genre','country')->where('genre_id',$movie->genre->id)->orderBy(DB::raw('RAND()'))->whereNotIn('slug',[$slug])->get();

        $tapphim = preg_replace('/[^0-9]/', '', $tap);
        $episode = Episode::where('movie_id', $movie->id)->where('episode', $tapphim)->first() ?? Episode::where('movie_id', $movie->id)->orderBy('episode', 'asc')->first();
        if ($episode) {
            $tapphim = $episode->episode;
        }


        // return response()->json($movie);
        return view('pages.watch',compact('category','genre','country','phimhot','phimhot_sidebar','movie','episode','tapphim','related'));
    }
    public function episode(){
        return view('pages.episode');
    }
}
