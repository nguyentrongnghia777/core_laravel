<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        @yield('contentheader_title', 'Page Header here')
        <br /><small>@yield('contentheader_description')</small>
    </h1>
    <ol class="breadcrumb">
        @yield('contentheader_levels')
    </ol>
</section>