<!doctype html>
<html lang="vi">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')</title>

        <link href="{{ asset("css/app.css") }}" rel="stylesheet">
        <link href="{{ asset("css/common.css") }}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Baloo+Tammudu+2&display=swap" rel="stylesheet">
        @yield('header')
    </head>

    <body class="pt-5">
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
            <div class="alert alert-success fade text-center fixed-top" role="alert" id="message">
            </div>
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="https://img.icons8.com/color/48/000000/multiple-choice.png" />
                    <span>
                        {{ config('app.name', 'Toán') }}
                    </span>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Đăng nhập</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Đăng ký</a>
                        </li>
                        @endif
                        @else
                        @can('be-admin')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="{{-- {{ route('admin.index') }} --}}"
                                data-toggle="dropdown">Quản Trị
                                Viên</a>

                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="{{  route('admin.user.list') }}">
                                    Danh sách thành viên
                                </a>
                            </div>

                        </li>
                        @yield('dropdown-admin')
                        @endcan
                        @can('be-teacher')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="{{-- {{ route('teacher.index') }} --}}"
                                data-toggle="dropdown">Giáo Viên</a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="{{ route('teacher.test.list') }}">Quản Lý Đề Thi</a>
                                <a class="dropdown-item" href="{{ route('teacher.question.list') }}">Quản Lý Câu Hỏi</a>
                                <a class="dropdown-item" href="{{ route('teacher.result.list') }}">
                                    Kết quả
                                </a>
                            </div>
                        </li>
                        @yield('dropdown-teacher')
                        @endcan

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                @isset(Auth::user()->avatar)
                                <image class="small-avatar" src="{{ Auth::user()->avatar }}">
                                </image>
                                @endisset
                                @empty(Auth::user()->avatar)
                                {{ Auth::user()->first_name }}
                                @endempty
                                <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                @can('be-student')

                                <a class="dropdown-item" href="{{ route('student.index') }}">Danh sách bài thi</a>
                                <a class="dropdown-item" href="{{ route('student.result.list',Auth::user()->id) }}">Bảng
                                    điểm</a>
                                <a class="dropdown-item" href="{{ route('student.about',Auth::user()->id) }}">Hồ sơ cá
                                    nhân</a>
                                @yield('dropdown-student')
                                @endcan

                                <a class="dropdown-item" href="{{ route('register') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Đăng xuất
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-5">
            @yield('content')
        </main>
        <footer>
            @yield('footer')
        </footer>
    </body>
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    @yield('end')

</html>
