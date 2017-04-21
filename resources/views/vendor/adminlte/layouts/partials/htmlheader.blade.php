<head>
    <meta charset="UTF-8">
    <title> @yield('htmlheader_title', 'Your title here') </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('/css/all.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('modules/alertify/alertify.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('modules/alertify/default.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('modules/LoadImg-master/css/loadimg.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/css/pages/home.css') }}" rel="stylesheet" type="text/css" />

    <!-- CK Plugins Config -->
    <script src="{{ asset('/modules/ckplugins/ckeditor/ckeditor.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/modules/ckplugins/ckfinder/ckfinder.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        var baseURL = "{{ url('/') }}";
    </script>
    <script src="{{ asset('/modules/ckplugins/func_ckfinder.js') }}" type="text/javascript"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

    <script>
        //See https://laracasts.com/discuss/channels/vue/use-trans-in-vuejs
        window.trans = @php
            // copy all translations from /resources/lang/CURRENT_LOCALE/* to global JS variable
            $lang_files = File::files(resource_path() . '/lang/' . App::getLocale());
            $trans = [];
            foreach ($lang_files as $f) {
                $filename = pathinfo($f)['filename'];
                $trans[$filename] = trans($filename);
            }
            $trans['adminlte_lang_message'] = trans('adminlte_lang::message');
            echo json_encode($trans);
        @endphp
    </script>
</head>
