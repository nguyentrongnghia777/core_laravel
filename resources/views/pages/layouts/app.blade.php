<!DOCTYPE html>
<html>
@section('header')
    @include('pages.layouts.partials.header')
@show
<body>
<div>
    <div>
        @include('adminlte::layouts.partials.contentheader')
        <section class="content">
            @yield('main-content')
        </section>
    </div>
    @include('pages.layouts.partials.footer')
</body>
</html>
