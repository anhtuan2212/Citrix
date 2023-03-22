@if ($departments->count() > 0)
    @foreach ($departments as $department)
        <tr>
            <td>
                <input class="form-control text-xs font-weight-bold mb-0 no-border edit-table" id="code" data-id="{{ $department->id }}"
                    disabled="true" value="{{ $department->code }}"></input>
            </td>
            <td>
                <input class="form-control text-xs font-weight-bold mb-0 no-border edit-table" id="name"
                    data-id="{{ $department->id }}" disabled="true" value="{{ $department->name }}">
            </td>
            <td class="align-middle text-center text-sm">
                <span class="text-secondary text-xs font-weight-bold">{{ $department->created_at }}</span>
            </td>
            <td class="align-middle text-center">
                <span class="text-secondary text-xs font-weight-bold">{{ $department->updated_at }}</span>
            </td>
            <td class="align-middle text-center">
                <span class="badge badge-pill bg-gradient-{{ $department -> status ? 'success' : 'danger' }}">{{ $department -> status ? 'Đang Hoạt Động' : 'Không Hoạt Động' }}</span>
            </td>
            <td class="align-middle text-center">
                <div class="mt-2">
                    <a class="btn btn-warning btn-sm me-2 view" href="{{ route('department.user', ['id' => $department -> id]) }}">Xem</a>
                    <button class="btn btn-warning btn-sm me-2 edit" data-id="{{ $department->id }}">Sửa</button>
                    <button class="btn btn-danger btn-sm delete" data-id="{{ $department->id }}">Xóa</button>
                </div>
            </td>
        </tr>
    @endforeach
    <tr>
        <td class="pt-4 border-0">
            {{ $departments->links('pagination::bootstrap-4') }}
        </td>
    </tr>
@else
    <tr>
        <td class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center" colspan="7">
            Không có dữ liệu
        </td>
    </tr>
@endif
