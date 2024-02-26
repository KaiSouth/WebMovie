@extends('layouts.app') @section('content')
<div class="container" style="width:-webkit-fill-available">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <table class="table table-dark" id="myTable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Status</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Manage</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($list as $key => $cate)
                    <tr>
                        <th scope="row">{{$key}}</th>
                        <td>{{$cate->title}}</td>
                        <td>{{$cate->description}}</td>
                        <td>
                            @if($cate->status == 1)
                                'Hiển thị'
                            @else
                                'Không hiển thị'
                            @endif
                        </td>
                        <td>{{$cate->slug}}</td>
                        <td>
                        {!! Form::open(['route' => ['genre.destroy',$cate->id],
                                        'method'=>'DELETE',
                                        'onsubmit'=>'return confirm("Ngon thì xóa đi?")'
                                        ]) !!}
                                    {!! Form::submit('Xóa!',['class'=>'btn btn-danger']) !!}
                        {!! Form::close() !!}
                        <a href="{{route('genre.edit',$cate->id)}}" class="btn btn-warning">Sửa</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
