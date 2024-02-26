@extends('layouts.app') @section('content')
<div class="container" style="width:-webkit-fill-available">
    <div class="row justify-content-center">

    <div class="col-md-12"
            <div class="card">
                <div class="card-header">Quản lý tập phim</div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    @if(!isset($episode))
                    {!! Form::open(['route' => 'episode.store','method'=>'POST','enctype'=>'multipart/form-data']) !!}
                    @else
                    {!! Form::open(['route' => ['episode.update',$movie->id],'method'=>'PUT','enctype'=>'multipart/form-data']) !!}
                    @endif

                    <div class="form-group">
                        {!! Form::label('movie_title','Phim',[]) !!}
                        {!! Form::text('movie_title' ,isset($movie)? $movie->title:'',['class'=>'form-control','readonly']) !!}
                        {!! Form::hidden('movie_id' ,isset($movie)? $movie->id:'') !!}

                    </div>
                    <div class="form-group">
                        {!! Form::label('linkphim','Nhập link phim',[]) !!}
                        {!! Form::text('linkphim' ,isset($episode)? $episode->linkphim:'',['class'=>'form-control']) !!}
                    </div>


                    <div class="form-group">
                        {!! Form::label('episode','Tập phim',[]) !!}
                        {!! Form::text('episode' ,isset($episode)? $episode->episode:'',['class'=>'form-control', 'id'=>'show_movie']) !!}

                        <!-- {!! Form::label('episode','Chọn tập phim',[]) !!}
                        <select name="episode" class="form-control" id="show_movie">

                        </select> -->
                    </div>



                    <div class="form-group">
                        @if(!isset($episode))
                            {!! Form::submit('Thêm tập phim!',['class'=>'btn btn-success']) !!}
                        @else
                        {!! Form::submit('Cập nhật tập phim!',['class'=>'btn btn-success']) !!}
                        @endif
                    </div>
                    {!! Form::close() !!}

                </div>

            </div>

        </div>

        ---------------Link phim-----------
        <div class="col-md-12">
            <table class="table table-dark" id="myTable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tên phim</th>
                        <th scope="col">Tập phim</th>
                        <th scope="col">Link phim</th>
                        <th scope="col">Trạng Thái</th>
                        <th scope="col">Manage</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($list_episode as $key => $ep)
                        <tr>
                            <th scope="row">{{$key}}</th>
                            <td>{{$ep->movie->title}}</td>
                            <td>{{$ep->episode}}</td>
                            <td>{{$ep->linkphim}}</td>

                            <td>
                                @if($ep->movie->status == 1)
                                    Hiển thị
                                @else
                                    Không hiển thị
                                @endif
                            </td>

                            <td>
                            {!! Form::open(['route' => ['episode.destroy',$ep->id],
                                            'method'=>'DELETE',
                                            'onsubmit'=>'return confirm("Ngon thì xóa đi?")'
                                            ]) !!}
                                        {!! Form::submit('Xóa!',['class'=>'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        <a href="{{route('episode.edit',$ep->id)}}" class="btn btn-warning">Sửa</a>

                        </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>

@endsection
