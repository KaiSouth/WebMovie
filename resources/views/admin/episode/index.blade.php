@extends('layouts.app') @section('content')
<div class="container" style="width:-webkit-fill-available">
    <div class="row justify-content-center">
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
