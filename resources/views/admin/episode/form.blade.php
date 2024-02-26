@extends('layouts.app') @section('content')
<div class="container" style="width:-webkit-fill-available">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <a href="{{route('episode.index')}}" class="btn btn-family">Liệt kê danh sách tập phim</a>
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
                    {!! Form::open(['route' => ['episode.update',$episode->id],'method'=>'PUT','enctype'=>'multipart/form-data']) !!}
                    @endif

                    <div class="form-group">
                        {!! Form::label('movie_id','Chọn phim',[]) !!}
                        {!! Form::select('movie_id',$list_movie ,isset($episode)? $episode->movie_id:'',['class'=>'form-control select-movie']) !!}
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

    </div>
</div>

@endsection
