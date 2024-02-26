@extends('layouts.app') @section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
<div class="container" style="margin-left:-40px;width:-webkit-fill-available"
    <div class="row justify-content-center">
        <div class="col-md-12">
            <table class="table table-dark table-responsive" id="myTable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tên phim</th>
                        <th scope="col">Tên chính thức</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Loại phim</th>
                        <th scope="col">Image</th>
                        <th scope="col">Số tập</th>
                        <th scope="col">Độ phân giải</th>
                        <th scope="col">Loại phụ đề</th>
                        <th scope="col">Thể loại</th>
                        <!-- <th scope="col">Quốc gia</th> -->
                        <th scope="col">Thời lượng</th>
                        <th scope="col">Năm</th>
                        <th scope="col">Quản lý</th>


                    </tr>
                </thead>
                <tbody >
                    @foreach($resp_movie as $key => $res)
                    <tr>
                        <th scope="row">{{$key}}</th>
                        <td scope="row">{{$res['name']}}</td>
                        <td scope="row">{{$res['origin_name']}}</td>
                        <td scope="row">{{$res['slug']}}</td>
                        <td scope="row">
                            @if ($res['type'] === 'series')
                                Phim bộ
                            @else
                                Phim lẻ
                            @endif
                        </td>

                        <td>
                            <img width="100" height="100" src="{{$res['thumb_url']}}">
                        </td>
                        <td scope="row">{{$res['episode_total']}}</td>
                        <td scope="row">{{$res['quality']}}</td>
                        <td scope="row">{{$res['lang']}}</td>
                        <td>
                            @foreach ($res['category'] as $cate )
                                <span class="badge badge-info">{{$cate['name']}}</span>
                            @endforeach
                        </td>

                        <td scope="row">{{$res['time']}}</td>
                        <td scope="row">{{$res['year']}}</td>
                        <td scope="row">
                            <a href="{{route('leech-store',$res['slug'])}}" class="btn btn-success btn-xs" >Lưu phim </a>
                            <a href="{{route('leech-episodeAdd',$res['slug'])}}" class="btn btn-success btn-xs" >Thêm phim API </a>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
