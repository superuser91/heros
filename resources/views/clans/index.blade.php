@extends('vgplay::clans.layout')
@section('content')
    <div class="container-fluid">
        <table class="table table-hover" id="datatable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên tộc/hệ</th>
                    <th>Icon</th>
                    <th>Ngày tạo</th>
                    <th>Chức năng</th>
                </tr>
            </thead>
            <tbody>
                @if (count($clans) > 0)
                    @foreach ($clans as $clan)
                        <tr>
                            <td>{{ $clan->id ?? '' }}</td>
                            <td>{{ $clan->name ?? '' }}</td>
                            <td><img style="max-width: 60px;max-height:60px;" src="{{ $clan->icon }}" alt=""></td>
                            <td>{{ is_null($clan->created_at) ? '' : $clan->created_at->format('d/m/Y') }}
                            </td>
                            <td>
                                @can('update', $clan)
                                    <a href="{{ route('clans.edit', $clan->id) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-edit"></i>
                                        Sửa
                                    </a>
                                @endcan

                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
@endsection


@push('scripts')
    <script>
        $('#datatable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "autoWidth": false,
            "responsive": true,
            "language": {
                "processing": "Đang xử lý...",
                "infoFiltered": "(được lọc từ _MAX_ mục)",
                "emptyTable": "Không có dữ liệu",
                "info": "Hiển thị _START_ tới _END_ của _TOTAL_ bản ghi",
                "infoEmpty": "Hiển thị 0 tới 0 của 0 bản ghi",
                "lengthMenu": "Hiển thị _MENU_ bản ghi",
                "loadingRecords": "Đang tải...",
                "paginate": {
                    "first": "Đầu tiên",
                    "last": "Cuối cùng",
                    "next": "Sau",
                    "previous": "Trước"
                },
                "search": "Tìm kiếm:",
                "zeroRecords": "Không tìm thấy kết quả"
            }
        });
    </script>
    <script>
        function copyToClipboard(text) {
            var inp = document.createElement('input');
            document.body.appendChild(inp)
            inp.value = text
            inp.select();
            document.execCommand('copy', false);
            inp.remove();
            Swal.fire("Đã copy đường dẫn vào clipboard");
        }
    </script>
@endpush
