<!-- header -->
<header>
    <section class="container">
        <h1>header</h1>
        <p class="language">
            <a href="">Vietnamese</a>
            <a href="">English</a>
        </p>
        <p>
            @if (Auth::guest())
                <a href="{{ url('/login') }}">Đăng Nhập</a>
            @else
                <a href="">Xin Chào {{ Auth::user()->name }}</a>
                @if ($can_mange)
                 | <a href="{{ url('/admincp') }}">Trang Quản Trị Admin</a>
                @endif
                 | <a href="{{ url('/logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">Đăng Xuất</a>
                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                    <input type="submit" value="logout" style="display: none;">
                </form>
            @endif
        </p>
        <hr>
    </section>
</header>
<!-- end header