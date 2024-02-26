<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Movie;
use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Episode;

class LeechMovieController extends Controller
{
    //
    public function leech_movie()
    {
        $page = session('current_page', 1);

        $resp = Http::get("https://ophim1.com/danh-sach/phim-moi-cap-nhat?page=".$page)->json();

        if(empty($resp['items'])) {
            $page = 1;
        } else {
            $page++;
        }

        session(['current_page' => $page]);

        return view('admin.leech.index',compact('resp'));
    }

    public function leech_movieDetail($slug)
    {
        $resp = Http::get("https://ophim1.com/phim/".$slug)->json();
        $resp_movie[] = $resp['movie'];
        return view('admin.leech.detail',compact('resp_movie'));
    }
    public function index()
    {

        return view('admin.leech.index');
    }
    public function create()
    {
        return view('admin.leech.index');
    }


    public function store($slug)
    {
        function getCategoryID($type) {
            return $type === 'series' ? 3 : 4;
        }

        $resp = Http::get("https://ophim1.com/phim/".$slug)->json();
        $resp_movie[] = $resp['movie'];

        $movie = new Movie();

        foreach ($resp_movie as $key => $res) {

            $movie->title = $res['name'];
            $movie->description = $res['content'];
            $movie->status = 1;
            // $movie->image = $res['thumb_url'];
            // Lấy URL của hình ảnh từ response API
            $imageUrl = $res['thumb_url'];

            // Tải nội dung hình ảnh từ URL
            $imageContent = file_get_contents($imageUrl);

            // Tạo một tên file duy nhất để lưu ảnh
            $imageName = Str::random(40) . '.jpg'; // Đổi '.jpg' nếu cần định dạng khác

            // Định nghĩa đường dẫn nơi bạn muốn lưu hình ảnh
            $path = 'public/upload/movie/';

            // Kiểm tra và tạo thư mục nếu không tồn tại
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            // Lưu hình ảnh vào đường dẫn
            file_put_contents($path . $imageName, $imageContent);

            // Cập nhật đường dẫn hình ảnh vào đối tượng Movie
            $movie->image = $imageName; // Lưu tên file mới, không phải URL


            $movie->slug = $res['slug'];
            $movie->view = $res['view'];

            $movie->category_id = getCategoryID($res['type']);

            foreach ($res['category'] as $gen)
            {
                $Genre = Genre::firstOrCreate(
                    ['title' => $gen['name']],
                    [
                        'description' => 'Form API',
                        'status' => 1,
                        'slug' => $gen['slug']
                    ]
                );
                $movie->genre_id = $Genre->id;
            }

            foreach ($res['country'] as $Country)
            {
                $Country = Country::firstOrCreate(
                    ['title' => $Country['name']],
                    [
                        'description' => 'Form API',
                        'status' => 1,
                        'slug' => $Country['slug']
                    ]
                );
                $movie->country_id = $Country->id;
            }

        }

        $quality = $res['quality'];
        $resolution = 0;
        switch ($quality) {
            case 'HD':
                $resolution = 0;
                break;
            case 'SD':
                $resolution = 1;
                break;
            case 'HDCam':
                $resolution = 2;
                break;
            case 'FullHD':
                $resolution = 3;
                break;
            default:
                break;
        }
        $movie->resolution = $resolution;

        $movie->phim_hot = 0;

        $movie->phude = $res['lang'];
        $lang = $res['lang'];
        $movie->phude = ($lang === 'Vietsub') ? 0 : 1;

        $movie->thoiluong = $res['time'];
        $movie->sotap = $res['episode_total'];
        $movie->year =  $res['year'];
        $movie->tags = 'Form API';

        $movie->ngaycapnhat = Carbon::now('Asia/Ho_Chi_Minh');
        $movie->ngaytao = Carbon::now('Asia/Ho_Chi_Minh');

        $movie->save();

        return back()->with('success', 'Phim đã được thêm thành công.');

    }
    public function episode($slug)
    {
        $resp = Http::get("https://ophim1.com/phim/".$slug)->json();
        // $resp_movie[] = $resp['episodes'];
        return view('admin.leech.episode',compact('resp'));
    }
    public function addEpisode($slug)
    {
        $response = Http::get("https://ophim1.com/phim/".$slug);

        if ($response->successful()) {
            $movieData = $response->json();

            $movie = Movie::where('slug', $slug)->first(['id']);

            if ($movie) {
                $movieId = $movie->id;

                // Xoá toàn bộ episodes cũ của phim
                Episode::where('movie_id', $movieId)->delete();

                // Thêm các tập phim mới
                foreach ($movieData['episodes'] as $episodeData) {
                    foreach ($episodeData['server_data'] as $data) {
                        $ep = new Episode();
                        $ep->movie_id = $movieId;
                        $ep->episode = $data['name'];
                        $ep->linkphim = $data['link_embed'];
                        $ep->save();
                    }
                }

                return back()->with('success', 'Các tập phim đã được thêm thành công.');
            } else {
                // Nếu không tìm thấy phim
                return back()->with('error', 'Không tìm thấy phim với slug cung cấp.');
            }
        } else {
            // Nếu không lấy được thông tin từ API
            return back()->with('error', 'Không thể lấy thông tin từ API.');
        }
    }

    public function leech_sreach_movie()
    {
        return view('admin.leech.sreachMovie');
    }
}
