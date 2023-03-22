@if ($users->count() > 0)
    @foreach ($users as $user)
        <tr>
            <td class="w-10">
                <input class="form-control w-50" type="text" name="level" value="{{ $user -> level_department }}">
            </td>
            <td>
                <span class="text-secondary text-xs font-weight-bold">{{ $user->fullname }}</span>
            </td>
            <td>
                <span class="text-secondary text-xs font-weight-bold">
                    <img src="{{ $user->img_url ?? 'https://cdn-icons-png.flaticon.com/512/147/147144.png' }}"
                        class="rounded-circle" style="width: 50px; height: 50px;" alt="">
                </span>
            </td>
            <td>
                <select class="form-control text-secondary text-xs font-weight-bold" name="position_id"
                    id="position_id">
                    @foreach ($positions as $position)
                        <option {{ $position->id == $user->position_id ? 'selected' : '' }} value="{{ $position->id }}">
                            {{ $position->position }}</option>
                    @endforeach
                </select>
            </td>
            <td>
                <select class="form-control text-secondary text-xs font-weight-bold" name="nominee_id">
                    @foreach ($positions as $position)
                        @foreach ($position->nominees as $nominee)
                            <option data-id="{{ $nominee->position_id }}" value="{{ $nominee->id }}"
                                {{ $nominee->id == $user->nominee_id ? 'selected' : '' }}
                                {{ $position->id == $user->position_id ? '' : 'hidden' }}>
                                {{ $nominee->nominees }}</option>
                        @endforeach
                    @endforeach
                </select>
            </td>
            <td>
                <span class="text-secondary text-xs font-weight-bold ps-2">{{ $user->phone ?? 'Chưa Có' }}</span>
            </td>
            <td>
                <span class="text-secondary text-xs font-weight-bold ps-2">{{ $user->gender ? 'Nam' : 'Nữ' }}</span>
            </td>
            @if ($user_max == true)
                <td>
                    <button class="btn btn-danger staff m-0 update_user" data-id="{{ $user->id }}">Sửa</button>
                    <button class="btn btn-danger staff m-0 delete_user" data-id="{{ $user->id }}">Xóa</button>
                </td>
            @else
                <td>
                    <button class="btn btn-danger m-0" data-id="{{ $user->id }}">Xem</button>
                </td>
            @endif
        </tr>
    @endforeach
@else
    <tr class="mt-2">
        <td class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center pt-5"
            colspan="7">
            Chưa Có Nhân Viên
        </td>
    </tr>
@endif
