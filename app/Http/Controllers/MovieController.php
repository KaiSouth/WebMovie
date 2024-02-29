<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Episode;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;

class MovieController extends Controller
{

    public function index()
    {
        $list = Movie::with('category','genre','country')->orderBy('id','DESC')->get();

        foreach ($list as $movie) {
            $total_episodes = Episode::where('movie_id', $movie->id)->count();
            $movie->total_episodes = $total_episodes;
        }

        $path = public_path()."/json_file/";
        if(!is_dir($path)){
            mkdir($path,0777,true);
        }

        File::put($path.'movies.json',json_encode($list));
        $category = Category::pluck('title','id');
        $genre = Genre::pluck('title','id');
        $country = Country::pluck('title','id');



        return view('admin.movie.index',compact('list','category','genre','country'));
    }

    public function category_choose(Request $request)
    {
        $data = $request->all();
        $movie = Movie::find($data['movie_id']);
        $movie->category_id = $data['category_id'];
        $movie->save();

    }

    public function genre_choose(Request $request)
    {
        $data = $request->all();
        $movie =   $movie = Movie::find($data['movie_id']);
        $movie->genre_id = $data['genre_id'];
        $movie->save();
    }

    public function country_choose(Request $request)
    {
        $data = $request->all();
        $movie =   $movie = Movie::find($data['movie_id']);
        $movie->country_id = $data['country_id'];
        $movie->save();
    }

    public function hot_choose(Request $request)
    {
        $data = $request->all();
        $movie =   $movie = Movie::find($data['movie_id']);
        $movie->phim_hot = $data['hot'];
        $movie->save();
    }

    public function update_year(Request $request)
    {
        $data = $request->all();
        $movie = Movie::find($data['id_phim']);
        $movie->year = $data['year'];
        $movie->save();

    }

    public function create()
    {
        $category = Category::pluck('title','id');
        $country = Country::pluck('title','id');
        $genre = Genre::pluck('title','id');

        return view('admin.movie.form',compact('category','country','genre'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $movie = new Movie();
        $movie->title = $data['title'];
        $movie->description = $data['description'];
        $movie->status = $data['status'];
        $movie->category_id = $data['category_id'];
        $movie->genre_id = $data['genre_id'];
        $movie->country_id = $data['country_id'];
        $movie->phim_hot = $data['phim_hot'];
        $movie->resolution = $data['resolution'];
        $movie->phude = $data['phude'];
        $movie->thoiluong = $data['thoiluong'];
        $movie->sotap = $data['sotap'];
        $movie->slug = $data['slug'];
        $movie->tags = $data['tags'];
        $movie->ngaycapnhat = Carbon::now('Asia/Ho_Chi_Minh');
        $movie->ngaytao = Carbon::now('Asia/Ho_Chi_Minh');

        $get_image = $request->file('image');

        //thêm hình ảnh
        if($get_image)
        {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,9999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/upload/movie/',$new_image);
            $data['image'] = $new_image;
            $movie->image = $data['image'];
        }
        $movie->save();
        return redirect()->back();
    }
    public function edit($id)
    {
        $category = Category::pluck('title','id');
        $country = Country::pluck('title','id');
        $genre = Genre::pluck('title','id');
        $list = Movie::with('category','genre','country')->orderBy('id','DESC')->get();

        $movie = Movie::find($id);


        return view('admin.movie.form',compact('list','category','country','genre','movie'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $movie = Movie::find($id);
        $movie->title = $data['title'];
        $movie->description = $data['description'];
        $movie->status = $data['status'];
        $movie->category_id = $data['category_id'];
        $movie->genre_id = $data['genre_id'];
        $movie->country_id = $data['country_id'];
        $movie->phim_hot = $data['phim_hot'];
        $movie->resolution = $data['resolution'];
        $movie->phude = $data['phude'];
        $movie->slug = $data['slug'];
        $movie->thoiluong = $data['thoiluong'];
        $movie->sotap = $data['sotap'];
        $movie->ngaycapnhat = Carbon::now('Asia/Ho_Chi_Minh');
        $movie->tags = $data['tags'];
        $movie->ngaycapnhat = Carbon::now('Asia/Ho_Chi_Minh');
        $get_image = $request->file('image');

        $path = 'public/upload/movie/';

        //thêm hình ảnh
        if($get_image)
        {
            if(!empty($movie->image))
            {
                unlink('public/upload/movie/'.$movie->image);
            }
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,9999).''.$get_image->getClientOriginalExtension();
            $get_image->move($path,$new_image);
            $data['image'] = $new_image;
            $movie->image = $data['image'];
        }

        $movie->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function destroy($id)
     {
         $movie = Movie::find($id);

         if ($movie) {
             if(!empty($movie->image) && file_exists('public/upload/movie/' . $movie->image))
             {
                 unlink('public/upload/movie/' . $movie->image);
             }

             Episode::whereIn('movie_id', [$movie->id])->delete();

             $movie->delete();
         }

         return redirect()->back();
     }


    public function show($id)
    {
        //
    }

      /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
      /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
}


