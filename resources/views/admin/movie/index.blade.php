@extends('layouts.app') @section('content')
<div class="container" style="margin-left:-40px;width:-webkit-fill-available"
    <div class="row justify-content-center">
        <div class="col-md-12" style="overflow: auto;">
            <table class="table table-dark table-responsive" id="myTable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tên phim</th>
                        <th scope="col">Số tập</th>
                        <th scope="col">Image</th>

                        <!-- <th scope="col">Slug</th> -->

                        <th scope="col">Loại phim</th>
                        <th scope="col">Thể loại</th>
                        <th scope="col">Quốc gia</th>
                        <th scope="col">Hot</th>
                        <th scope="col">Độ phân giải</th>
                        <th scope="col">Loại phụ đề</th>
<!--
                        <th scope="col">Ngày tạo</th>
                        <th scope="col">Ngày cập nhật</th> -->

                        <th scope="col">Năm</th>

                        <th scope="col">Thời lượng</th>

                        <th scope="col">Status</th>

                        <th scope="col">Manage</th>

                    </tr>
                </thead>
                <tbody >
                    @foreach($list as $key => $cate)
                    <tr>
                        <th scope="row">{{$key}}</th>
                        <!-- <?php echo($cate->id) ?> -->


                        <td>{{$cate->title}}</td>

                        <td>
                            <a href="{{route('add-episode',[$cate->id])}}" class="btn btn-primary btn-xs">Thêm tập phim</a>
                            <a href="{{route('leech-episode',[$cate->slug])}}" class="btn btn-success btn-xs" >Thêm phim API </a>
                            {{$cate->total_episodes}} tập
                        </td>

                        <!-- <td>
                            <img width="100%" height="80%" src="{{asset('public/upload/movie/'.$cate->image)}}">
                        </td> -->

                        <td>
                            @if(isset($cate->image) && !empty($cate->image))
                                @if(preg_match("/^http/", $cate->image))

                                    <img width="100%" height="80%" src="{{ $cate->image }}">
                                @else

                                    <img width="100%" height="80%" src="{{ asset('public/upload/movie/' . $cate->image) }}">
                                @endif
                            @else
                                <img width="100%" height="80%" src="{{ asset('path_to_default_image.png') }}">
                            @endif
                        </td>



                        <!-- <td>{{$cate->slug}}</td> -->

                        <td>

                            {!! Form::select('category_id', $category ,isset($cate) ? $cate->category->id:'',['class'=>'form-control category_choose','id'=>$cate->id]) !!}
                            {{$cate->category->title}}
                        </td>
                        <td>
                            {!! Form::select('genre_id', $genre ,isset($cate)? $cate->genre->id:'',['class'=>'form-control genre_choose','id'=>$cate->id]) !!}
                            {{$cate->genre->title}}
                        </td>
                        <td>
                            {!! Form::select('country_id', $country,isset($movie)? $cate->country->id:'',['class'=>'form-control country_choose','id'=>$cate->id]) !!}
                            {{$cate->country->title}}
                        </td>
                        <td>
                            {!! Form::select('phim_hot', ['1'=>'Phim hot','0'=>'Không hot'] ,isset($cate)? $cate->phim_hot:'',['class'=>'form-control hot_choose','id'=>$cate->id]) !!}

                            @if($cate->phim_hot == 1)
                                'Phim hót hòn họt'
                            @else
                                'Phim không hot'
                            @endif
                        </td>
                        <td>
                            @if($cate->resolution == 0)
                                'HD'
                            @elseif($cate->resolution == 1)
                                'SD'
                            @elseif($cate->resolution == 2)
                                'HDCam'
                            @elseif($cate->resolution == 3)
                                'FullHD'
                            @endif
                        </td>
                        <td>
                            @if($cate->phude == 0)
                                'Phụ đề'
                            @elseif($cate->phude == 1)
                                'Thuyết minh'
                            @endif
                        </td>

                        <!-- <td>
                            {{$cate->ngaytao}}
                        </td>
                        <td>
                            {{$cate->ngaycapnhat}}
                        </td> -->

                        <td>
                            {!! Form::selectYear('year',2000,2023,$cate->year,['class'=>'select-year','id'=>$cate->id]) !!}
                        </td>

                        <td>
                            {{$cate->thoiluong}}
                        </td>

                        <td>

                            @if($cate->status == 1)
                                'Hiển thị'
                            @else
                                'Không hiển thị'
                            @endif
                        </td>

                        <td>
                        {!! Form::open(['route' => ['movie.destroy',$cate->id],
                                        'method'=>'DELETE',
                                        'onsubmit'=>'return confirm("Ngon thì xóa đi?")'
                                        ]) !!}
                                    {!! Form::submit('Xóa!',['class'=>'btn btn-danger']) !!}
                        {!! Form::close() !!}
                        <a href="{{route('movie.edit',$cate->id)}}" class="btn btn-warning">Sửa</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
