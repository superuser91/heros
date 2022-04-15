@extends('vgplay::heros.layout')

@section('content')
    <div class="container-fluid">
        <form action="{{ route('heros.update', $hero->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Tên tướng</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                    value="{{ old('name', $hero->name) }}" required autocomplete="name">

                @error('name')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="clan_id">Thuộc tộc/hệ</label>
                <select name="clan_id" id="clan_id" class="form-control">
                    <option value="">Trống</option>
                    @foreach ($clans as $clan)
                        <option value="{{ $clan->id }}" @if (old('clan_id', $hero->clan_id) == $clan->id) selected @endif>
                            {{ $clan->name }}</option>
                    @endforeach
                </select>

                @error('clan_id')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="slug">Slug</label>
                <input id="slug" type="text" class="form-control @error('slug') is-invalid @enderror" name="slug"
                    value="{{ old('slug', $hero->slug) }}" placeholder="Bỏ trống để tự động tạo theo tên">

                @error('slug')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="desc">Mô tả tướng</label>
                <textarea class="form-control @error('desc') is-invalid @enderror"
                    name="desc">{{ old('desc', $hero->desc) }}</textarea>

                @error('desc')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label> Chỉ số</label>
                @foreach (config('vgplay.heros.stats', []) as $key => $display)
                    <input type="text" class="form-control my-1" name="stats[{{ $key }}]"
                        value="{{ old('stats.' . $key, $hero->stats[$key]) }}" placeholder="{{ $display }}">
                @endforeach

                @error('stats')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="image">Ảnh</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="ckfinder-image" name="image"
                        value="{{ old('image', $hero->image) }}">
                    <span class="input-group-append">
                        <button type="button" class="btn btn-info"
                            onclick="selectFileWithCKFinder('image')">Browse</button>
                    </span>
                </div>
                <img class="mw-100 mt-2 rounded" src="{{ old('image', $hero->image) }}" id="preview-image">
            </div>

            <div class="form-group">
                <label for="icon">Icon</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="ckfinder-icon" name="icon"
                        value="{{ old('icon', $hero->icon) }}">
                    <span class="input-group-append">
                        <button type="button" class="btn btn-info"
                            onclick="selectFileWithCKFinder('icon')">Browse</button>
                    </span>
                </div>
                <img class="mw-100 mt-2 rounded" src="{{ old('icon', $hero->icon) }}" id="preview-icon">
            </div>

            <div class="form-group">
                <label for="video">Link nhúng video</label>
                <input id="video" type="text" class="form-control @error('video') is-invalid @enderror" name="order"
                    value="{{ old('video', $hero->video) }}">

                @error('video')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="skills">Kỹ năng</label>
                <div id="skills">
                    @foreach ($hero->skills as $skill)
                        <div class="skill form-group border p-3">
                            @foreach (config('vgplay.heros.skills') as $key => $display)
                                <input type="text" class="form-control my-1" name="skills[{{ $key }}][]"
                                    placeholder="{{ $display }}" value="{{ $skill[$key] }}">
                            @endforeach
                            <a class="float-right btn btn-danger mt-2 btn-delete-skill">Xóa kỹ năng</a>
                            <div class="clearfix"></div>
                        </div>
                    @endforeach

                </div>

                <a class="btn btn-sm btn-success mt-3" id="btn-add-skill"><i class="fas fa-plus"></i>Thêm kỹ năng</a>

                @error('skills')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="order">Thứ tự hiển thị</label>
                <input id="order" type="number" min="0" class="form-control @error('order') is-invalid @enderror"
                    name="order" value="{{ old('order', $hero->order) }}">

                @error('order')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>


            <div class="form-group mt-4">
                <button class="btn btn-success">Lưu lại</button>
                <a data-action="{{ route('heros.destroy', $hero->id) }}" class="btn btn-danger btn-delete float-right">
                    <i class="fas fa-trash"></i>
                    Xoá</a>
            </div>
        </form>
    </div>
    <form method="POST" id="form-delete">
        @csrf
        @method('DELETE')
    </form>
    <p class="d-none" id="skill-template" value="{{ $skillTemplate }}"></p>
@endsection

@push('scripts')
    <script>
        $('#btn-add-skill').click(function(e) {
            let skill = $('#skill-template').attr('value');
            $('#skills').append(`<div class="skill form-group border p-3">${skill}
                <a class="float-right btn btn-danger mt-2 btn-delete-skill">Xóa kỹ năng</a>
                <div class="clearfix"></div></div>`);
        })

        $(document).on('click', '.btn-remove-stat', function() {
            $(this).closest('.stat').remove();
        })
        $(document).on('click', '.btn-delete-skill', function() {
            $(this).closest('.skill').remove();
        })

        $(document).on('click', '.btn-delete', function(e) {
            e.preventDefault();
            let action = $(this).data('action');
            Swal.fire({
                title: 'Bạn có chắc chắn muốn xoá?',
                text: "Sau khi xoá sẽ không thể phục hồi lại!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Xoá!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#form-delete').attr('action', action);
                    $('#form-delete').submit();
                }
            })
        });
    </script>
@endpush
