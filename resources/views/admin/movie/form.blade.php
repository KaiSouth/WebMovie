@extends('layouts.app') @section('content')
<div class="container" style="width:-webkit-fill-available">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <a href="{{route('movie.index')}}" class="btn btn-family">Liệt kê phim</a>
                <div class="card-header">Quản lý phim</div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    @if(!isset($movie))
                    {!! Form::open(['route' => 'movie.store','method'=>'POST','enctype'=>'multipart/form-data']) !!}
                    @else
                    {!! Form::open(['route' => ['movie.update',$movie->id],'method'=>'PUT','enctype'=>'multipart/form-data']) !!}
                    @endif

                    <div class="form-group">
                        {!! Form::label('title','Title',[]) !!}
                        {!! Form::text('title',isset($movie)? $movie->title:'',['class'=>'form-control','placeholder'=>'Nhập vào dữ liệu','id'=>'slug','onkeyup'=>'ChangeToSlug()']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('slug','Slug',[]) !!}
                        {!! Form::text('slug',isset($movie)? $movie->slug:'',['class'=>'form-control','placeholder'=>'Nhập vào dữ liệu','id'=>'convert_slug']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('description','Description',[]) !!}
                        {!! Form::textarea('description',isset($movie)? $movie->description:'',['style'=>'resize:none !important','class'=>'form-control','placeholder'=>'Nhập mô tả','id'=>'description']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('tags','Tag phim',[]) !!}
                        {!! Form::textarea('tags',isset($movie)? $movie->tags:'',['style'=>'resize:none !important','class'=>'form-control','placeholder'=>'Nhập tag']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('status','Status',[]) !!}
                        {!! Form::select('status', ['1'=>'Hiển thị','0'=>'Không'],isset($movie)? $movie->status:'',['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('category','Category',[]) !!}
                        {!! Form::select('category_id', $category ,isset($movie)? $movie->category:'',['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('country','Country',[]) !!}
                        {!! Form::select('country_id', $country,isset($movie)? $movie->country:'',['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('genre','Genre',[]) !!}
                        {!! Form::select('genre_id', $genre ,isset($movie)? $movie->genre:'',['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('phim_hot','Phim hot',[]) !!}
                        {!! Form::select('phim_hot', ['1'=>'Phim hot','0'=>'Không hot'] ,isset($movie)? $movie->phim_hot:'',['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('resolution','Resolution',[]) !!}
                        {!! Form::select('resolution', ['0'=>'HD','1'=>'SD','2'=>'HDCam','3'=>'FullHD'] ,isset($movie)? $movie->resolution:'',['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('phude','Phụ đề',[]) !!}
                        {!! Form::select('phude', ['0'=>'Phụ đề','1'=>'Thuyết minh'] ,isset($movie)? $movie->phude:'',['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('thoiluong','Thời lượng',[]) !!}
                        {!! Form::text('thoiluong',isset($movie)? $movie->thoiluong:'',['class'=>'form-control','placeholder'=>'Nhập vào thời lượng phim']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('sotap','Số tập',[]) !!}
                        {!! Form::text('sotap',isset($movie)? $movie->sotap:'',['class'=>'form-control','placeholder'=>'Nhập vào số tập phim']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('image','Image',[]) !!}
                        {!! Form::file('image',['class'=>'form-control']) !!}
                        @if(isset($movie))
                            <img width="20%" src="{{asset('public/upload/movie/'.$movie->image)}}">
                        @endif
                    </div>

                    <div class="form-group">
                        @if(!isset($movie))
                            {!! Form::submit('Thêm dữ liệu!',['class'=>'btn btn-success']) !!}
                        @else
                        {!! Form::submit('Cập nhật!',['class'=>'btn btn-success']) !!}
                        @endif
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
