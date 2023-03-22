@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Department'])
    <style>
        #drag {
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -khtml-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        /* width */
        ::-webkit-scrollbar {
            height: 5px;
            width: 10px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            /* background: #f1f1f1; */
            background: transparent;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #888;
        }

        #child1,
        #child1_first,
        #child1_last,
        #child2,
        #child2_last {
            position: relative;
        }

        #child1::after {
            display: inline-block;
            content: "";
            position: absolute;
            background-color: gray;
            height: 17.6px;
            width: 2px;
            left: 50%;
            top: 0;
            transform: translateY(-90%);
        }

        #child1_first::after {
            display: inline-block;
            content: "";
            position: absolute;
            background-color: gray;
            height: 3px;
            width: 54%;
            right: 0;
            top: 0;
        }

        #child1_last::after {
            display: inline-block;
            content: "";
            position: absolute;
            background-color: gray;
            height: 3px;
            width: 46%;
            left: 0;
            top: 0;
        }

        #child2::after {
            display: inline-block;
            content: "";
            position: absolute;
            background-color: gray;
            height: 3px;
            width: 8%;
            left: -7%;
            top: 50%;
        }

        #child2_last::after {
            display: inline-block;
            content: "";
            position: absolute;
            background-color: gray;
            height: 50%;
            width: 3px;
            left: 0;
            top: 0;
        }
    </style>
    <div class="container-fluid py-4">
        @yield('department')
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    @foreach ($departments as $department)
                        <div class="col-md-12">
                            <div class="row justify-content-center">
                                <div class="col-md-3">
                                    <div class="card">
                                        <div
                                            class="card-header p-0 px-3 py-2 position-relative z-index-1 d-flex justify-content-between">
                                            <a href="{{ route('department.user', ['id' => $department->id]) }}"
                                                class="d-block">
                                                <span class="text-bolder text-xs">{{ $department->name }}</span>
                                            </a>

                                            @if ($department->status)
                                                <span class="bg-success"
                                                    style="width: 20px; height: 20px; border-radius: 50%"></span>
                                            @else
                                                <span class="bg-danger"
                                                    style="width: 20px; height: 20px; border-radius: 50%"></span>
                                            @endif
                                        </div>

                                        <div class="card-body py-2 px-3 border-top">
                                            <div class="author align-items-center">
                                                <img src="{{ $department->users[0]->img_url ?? 'https://media.istockphoto.com/id/1300845620/vector/user-icon-flat-isolated-on-white-background-user-symbol-vector-illustration.jpg?s=612x612&w=0&k=20&c=yBeyba0hUkh14_jgv1OKqIH0CCSWU_4ckRkAoy2p73o=' }}"
                                                    alt="..." class="avatar shadow rounded-circle">
                                                <div class="name ps-3">
                                                    <span class="text-xs">{{ $department->users[0]->fullname ?? '' }}</span>
                                                    <div class="stats text-xs">
                                                        <small
                                                            class="text-xxs">{{ $department->users[0]->nominee ?? 'Trống' }}</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-footer p-0 px-3 pb-3">
                                            <div
                                                class="text-xxs text-bolder text-danger pb-2 {{ $department->users->count() > 1 ? 'd-block' : 'd-none' }}">
                                                <span>Nhân Viên</span>
                                            </div>
                                            <div class="d-flex">
                                                @foreach ($department->users as $user)
                                                    @if (!$loop->first && $loop->index < 6)
                                                        <img src="{{ $user->img_url }}" class="rounded-circle me-2"
                                                            style="width: 15%">
                                                    @endif
                                                @endforeach
                                            </div>

                                            <div class="text-center mt-2">
                                                <div class="dropdown">
                                                    <a class="dropdown-toggle text-xs text-info"
                                                        data-bs-auto-close="outside" type="button" id="dropdownMenuButton"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        Nhân Viên
                                                    </a>
                                                    <ul class="dropdown-menu" style="max-height: 280px; overflow-y: auto"
                                                        aria-labelledby="navbarDropdownMenuLink2">
                                                        @foreach ($department->users as $user)
                                                            <li style="width: 250px">
                                                                <div class="d-flex p-2 align-items-center">
                                                                    <img src="{{ $user->img_url ?? '' }}"
                                                                        class="rounded-circle me-3" style="width: 25%"
                                                                        class="me-2">
                                                                    <div>
                                                                        <span
                                                                            class="text-xs text-bolder">{{ $user->fullname ?? '' }}</span><br>
                                                                        <span
                                                                            class="text-xs">{{ $user->nominee ?? '' }}</span>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex overflow-scroll px-4" style="overflow-y: hidden !important;" id="drag">
                                @foreach ($department->children as $child1)
                                    <div class="col-md-3 mt-3"
                                        id="{{ $loop->first ? 'child1_first' : '' }}{{ $loop->last ? 'child1_last' : '' }}"
                                        style="{{ $loop->first || $loop->last ? '' : 'border-top: 3px solid' }}">
                                        <div class="pe-4 py-3">
                                            <div id="child1">
                                                <div class="card">
                                                    <div
                                                        class="card-header p-0 px-3 py-2 position-relative z-index-1 d-flex justify-content-between">
                                                        <a href="{{ route('department.user', ['id' => $child1->id]) }}"
                                                            class="d-block">
                                                            <span class="text-bolder text-xs">{{ $child1->name }}</span>
                                                        </a>
                                                        @if ($child1->status)
                                                            <span class="bg-success"
                                                                style="width: 20px; height: 20px; border-radius: 50%"></span>
                                                        @else
                                                            <span class="bg-danger"
                                                                style="width: 20px; height: 20px; border-radius: 50%"></span>
                                                        @endif
                                                    </div>

                                                    <div class="card-body py-2 px-3 border-top">
                                                        <div class="author align-items-center">
                                                            <img src="{{ $child1->users[0]->img_url ?? 'https://media.istockphoto.com/id/1300845620/vector/user-icon-flat-isolated-on-white-background-user-symbol-vector-illustration.jpg?s=612x612&w=0&k=20&c=yBeyba0hUkh14_jgv1OKqIH0CCSWU_4ckRkAoy2p73o=' }}"
                                                                alt="..." class="avatar shadow rounded-circle">
                                                            <div class="name ps-3">
                                                                <span
                                                                    class="text-xs">{{ $child1->users[0]->fullname ?? '' }}</span>
                                                                <div class="stats text-xs">
                                                                    <small
                                                                        class="text-xxs">{{ $child1->users[0]->nominee ?? 'Trống' }}</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="card-footer p-0 px-3 pb-3">
                                                        <div
                                                            class="text-xxs text-bolder text-danger pb-2 {{ $child1->users->count() > 1 ? 'd-block' : 'd-none' }}">
                                                            <span>Nhân Viên</span>
                                                        </div>
                                                        <div class="d-flex">
                                                            @foreach ($child1->users as $user)
                                                                @if (!$loop->first)
                                                                    <img src="{{ $user->img_url }}"
                                                                        class="rounded-circle me-2" style="width: 15%"
                                                                        class="me-2">
                                                                @endif
                                                            @endforeach
                                                        </div>

                                                        <div
                                                            class="text-center mt-2 {{ $child1->users->count() > 1 ? 'd-block' : 'd-none' }}">
                                                            <div class="dropdown">
                                                                <a class="dropdown-toggle text-xs text-info"
                                                                    data-bs-auto-close="outside" type="button"
                                                                    id="dropdownMenuButton" data-bs-toggle="dropdown"
                                                                    aria-expanded="false">
                                                                    Nhân Viên
                                                                </a>
                                                                <ul class="dropdown-menu"
                                                                    style="max-height: 280px; overflow-y: auto"
                                                                    aria-labelledby="navbarDropdownMenuLink2">
                                                                    @foreach ($child1->users as $user)
                                                                        <li style="width: 250px">
                                                                            <div class="d-flex p-2 align-items-center">
                                                                                <img src="{{ $user->img_url }}"
                                                                                    class="rounded-circle me-3"
                                                                                    style="width: 15%" class="me-2">
                                                                                <div>
                                                                                    <span
                                                                                        class="text-xs text-bolder">{{ $user->fullname }}</span><br>
                                                                                    <span
                                                                                        class="text-xs">{{ $user->nominee }}</span>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @foreach ($child1->children as $child2)
                                                <div class="ps-3 py-3" id="{{ $loop->last ? 'child2_last' : '' }}"
                                                    style="{{ $loop->last ? '' : 'border-left: 3px solid' }}">
                                                    <div class="card" id="child2">
                                                        <div class="card-header p-0 px-3 py-2 position-relative z-index-1 d-flex justify-content-between">
                                                            <a href="{{ route('department.user', ['id' => $child2->id]) }}"
                                                                class="d-block">
                                                                <span
                                                                    class="text-bolder text-xs">{{ $child2->name }}</span>
                                                            </a>
                                                            @if ($child2->status)
                                                                <span class="bg-success"
                                                                    style="width: 20px; height: 20px; border-radius: 50%"></span>
                                                            @else
                                                                <span class="bg-danger"
                                                                    style="width: 20px; height: 20px; border-radius: 50%"></span>
                                                            @endif
                                                        </div>

                                                        <div class="card-body py-2 px-3 border-top">
                                                            <div class="author align-items-center">
                                                                <img src="{{ $child2->users[0]->img_url ?? 'https://media.istockphoto.com/id/1300845620/vector/user-icon-flat-isolated-on-white-background-user-symbol-vector-illustration.jpg?s=612x612&w=0&k=20&c=yBeyba0hUkh14_jgv1OKqIH0CCSWU_4ckRkAoy2p73o=' }}"
                                                                    alt="..." class="avatar shadow rounded-circle">
                                                                <div class="name ps-3">
                                                                    <span
                                                                        class="text-xs">{{ $child2->users[0]->fullname ?? '' }}</span>
                                                                    <div class="stats text-xs">
                                                                        <small
                                                                            class="text-xxs">{{ $child2->users[0]->nominee ?? 'Trống' }}</small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="card-footer p-0 px-3 pb-3">
                                                            <div
                                                                class="text-xxs text-bolder text-danger pb-2 {{ $child2->users->count() > 1 ? 'd-block' : 'd-none' }}">
                                                                <span>Nhân Viên</span>
                                                            </div>
                                                            <div class="d-flex">
                                                                @foreach ($child2->users as $user)
                                                                    @if (!$loop->first)
                                                                        <img src="{{ $user->img_url }}"
                                                                            class="rounded-circle me-2" style="width: 15%"
                                                                            class="me-2">
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                            <div
                                                                class="text-center mt-2 {{ $child2->users->count() > 1 ? 'd-block' : 'd-none' }}">
                                                                <div class="dropdown">
                                                                    <a class="dropdown-toggle text-xs text-info"
                                                                        data-bs-auto-close="outside" type="button"
                                                                        id="dropdownMenuButton" data-bs-toggle="dropdown"
                                                                        aria-expanded="false">
                                                                        Nhân Viên
                                                                    </a>
                                                                    <ul class="dropdown-menu"
                                                                        style="max-height: 280px; overflow-y: auto"
                                                                        aria-labelledby="navbarDropdownMenuLink2">
                                                                        @foreach ($child2->users as $user)
                                                                            <li style="width: 250px">
                                                                                <div class="d-flex p-2 align-items-center">
                                                                                    <img src="{{ $user->img_url }}"
                                                                                        class="rounded-circle me-3"
                                                                                        style="width: 25%" class="me-2">
                                                                                    <div>
                                                                                        <span
                                                                                            class="text-xs text-bolder">{{ $user->fullname }}</span><br>
                                                                                        <span
                                                                                            class="text-xs">{{ $user->nominee }}</span>
                                                                                    </div>
                                                                                </div>
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="btn-group dropup {{ $child2->children->count() > 0 ? 'd-block' : 'd-none' }}">
                                                                <span type="button" class="text-xxs dropdown-toggle"
                                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                                    {{ $child2->children->count() }} phòng ban nữa
                                                                </span>
                                                                <ul class="dropdown-menu px-2 py-3"
                                                                    aria-labelledby="dropdownMenuButton">
                                                                    @foreach ($child2->children as $child3)
                                                                        <li><a class="dropdown-item border-radius-md"
                                                                                href="{{ route('department.user', ['id' => $child3->id]) }}">{{ $child3->name }}</a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@push('overview')
    <script>
        $(document).ready(function() {
            var clicked = false,
                clickX;
            $("#drag").on({
                'mousemove': function(e) {
                    clicked && updateScrollPos(e);
                },
                'mousedown': function(e) {
                    $(this).css('cursor', 'grab');
                    clicked = true;
                    clickX = e.pageX;
                },
                'mouseup': function() {
                    clicked = false;
                    $(this).css('cursor', 'grab');
                }
            }, );

            var updateScrollPos = function(e) {
                $('#drag').css('cursor', 'grabbing');
                $('#drag').scrollLeft($('#drag').scrollLeft() + (clickX - e.pageX) / 9);
            }
        })
    </script>
@endpush
