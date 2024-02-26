@extends('layouts.app')

@section('content')
<div class="container" style="margin-left:-40px;width:-webkit-fill-available">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <table class="table table-dark table-responsive" id="myTable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tập</th>
                        <th scope="col">Link phim</th>
                        <th scope="col">Thêm</th>
                    </tr>
                </thead>
                <tbody >
                    @foreach($resp['episodes'] as $key => $episode)
                        @foreach($episode['server_data'] as $data)
                            <tr>
                                <th scope="row">{{ $loop->parent->iteration }}</th>
                                <td scope="row">{{ $data['name'] }}</td>
                                <td scope="row">{{ $data['link_embed'] }}</td>
                                <td scope="row">
                                    <a href="{{ route('leech-episodeAdd', [
                                            'slug' => $resp['movie']['slug']
                                        ]) }}" class="btn btn-success">Thêm</a>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
