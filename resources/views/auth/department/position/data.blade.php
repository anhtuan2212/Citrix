@if ($positions->count() > 0)
    @foreach ($positions as $position)
        <tr>
            <td class="text-center w-10">
                <span class="text-secondary text-xs font-weight-bold">{{ $loop -> index }}</span>
            </td>
            <td class="text-center w-25">
                <input class="form-control text-secondary text-xs font-weight-bold text-center no-border" data-id="{{ $position -> id }}" id="position_name_edit" disabled value="{{ $position -> position }}"></input>
            </td>
            <td class="align-middle text-center text-sm p-0">
                <table class="table table-bordred m-0 text-start">
                    <tbody>
                        @foreach ($position -> nominees as $nominee)
                            <tr>
                                <td class="ps-3 w-75">
                                    <input type="text" class="form-control text-secondary text-xs font-weight-bold text-center no-border" id="nominee_name_edit" value="{{ $nominee -> nominees }}" disabled data-id="{{ $nominee -> id }}"></input>

                                </td>
                                <td class="text-center">
                                    <a href="" id="delete_nominee" class="tex-danger" data-id="{{ $nominee -> id }}">Xóa</a>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="2">
                                <input type="text" class="form-control" id="add-nominee-2" data-id="{{ $position -> id }}">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    @endforeach
    <tr>
        <td class="pt-4 border-0">
            {{ $positions->links('pagination::bootstrap-4') }}
        </td>
    </tr>
@else
    <tr>
        <td class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center" colspan="7">
            Không có dữ liệu
        </td>
    </tr>
@endif
