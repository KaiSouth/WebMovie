@extends('layouts.app') @section('content')
<div class="container" style="margin-left:-40px;width:-webkit-fill-available"
    <div class="row justify-content-center">
        <div class="col-md-12">
            <table class="table table-dark table-responsive" id="myTable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tên phim</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Tên chính thức</th>
                        <th scope="col">Image</th>
                        <th scope="col">Poster Image</th>
                        <th scope="col">Năm</th>
                        <th scope="col">Quản lý</th>



                        <!-- <th scope="col">Số tập</th>
                        <th scope="col">Loại phim</th>
                        <th scope="col">Thể loại</th>
                        <th scope="col">Quốc gia</th>
                        <th scope="col">Hot</th>
                        <th scope="col">Độ phân giải</th>
                        <th scope="col">Loại phụ đề</th>
                        <th scope="col">Ngày tạo</th>
                        <th scope="col">Ngày cập nhật</th>
                        <th scope="col">Thời lượng</th>
                        <th scope="col">Status</th>
                        <th scope="col">Manage</th> -->

                    </tr>
                </thead>

                <tbody >
                    @foreach($resp['items'] as $key => $res)
                    @php
                        $exists = \App\Models\Movie::where('slug', $res['slug'])->exists();
                    @endphp
                    @if(!$exists)
                        <tr>
                            <th scope="row">{{$key}}</th>
                            <td scope="row">{{$res['name']}}</td>
                            <td scope="row">{{$res['slug']}}</td>
                            <td scope="row">{{$res['origin_name']}}</td>
                            <td>
                                <img width="100" height="100" src="{{$resp['pathImage'].$res['thumb_url']}}">
                            </td>
                            <td>
                                <img width="100" height="100" src="{{$resp['pathImage'].$res['poster_url']}}">
                            </td>
                            <td scope="row">{{$res['year']}}</td>

                            <td>
                                <a href="{{route('leech-Detail',$res['slug'])}}" class="btn btn-primary" >Chi tiết phim </a>

                                @php
                                    $movie = \App\Models\Movie::where('slug',$res['slug'])->first();
                                @endphp
                                @if(!$movie)
                                    <a href="{{route('leech-store',$res['slug'])}}" class="btn btn-success" >Lưu phim </a>
                                @endif
                            </td>

                        </tr>
                    @endif

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
