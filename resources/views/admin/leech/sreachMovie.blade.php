@extends('layouts.app')

@section('content')


<form id="detailForm" action="" method="GET">
    <div class="form-group">
        <label for="slug">Title:</label>
        <input type="text" id="slug" name="title" class="form-control" placeholder="Nhập vào tên phim" onkeyup="ChangeToSlug()" />
    </div>
    <div class="form-group">
        <label for="convert_slug">Slug:</label>
        <input type="text" id="convert_slug" name="slug" class="form-control" placeholder="Slug sẽ được tạo ở đây" readonly />
    </div>
    <button type="submit" class="btn btn-primary">Gửi thông tin</button>
</form>


@endsection
