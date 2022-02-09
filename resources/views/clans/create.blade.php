@extends('vgplay::clans.layout')

@section('content')
    <div class="container-fluid">
        <form action="{{ route('clans.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Tên tộc/hệ</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                    value="{{ old('name') }}" required autocomplete="name">

                @error('name')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="slug">Slug</label>
                <input id="slug" type="text" class="form-control @error('slug') is-invalid @enderror" name="slug"
                    value="{{ old('slug') }}" placeholder="Bỏ trống để tự động tạo theo tên">

                @error('slug')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="icon">Icon</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="ckfinder-icon" name="icon" value="{{ old('icon') }}">
                    <span class="input-group-append">
                        <button type="button" class="btn btn-info"
                            onclick="selectFileWithCKFinder('icon')">Browse</button>
                    </span>
                </div>
                <img class="mw-100 mt-2 rounded" src="{{ old('icon') }}" id="preview-icon">
            </div>
            <div class="form-group">
                <label for="order">Thứ tự hiển thị</label>
                <input id="order" type="number" min="0" class="form-control @error('order') is-invalid @enderror"
                    name="order" value="{{ old('order') }}">

                @error('order')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mt-4">
                <button class="btn btn-success">Lưu lại</button>
            </div>
        </form>
    </div>
@endsection
