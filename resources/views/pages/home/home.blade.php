@extends('pages.layouts.app')

@section('header_title')
    Page Home
@endsection

@section('main-content')
	<link rel="stylesheet" href="{{ asset('/css/pages/home.css') }}">
    <div class="page-home">
        <div class="container">
            welcome page home
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('/js/pages/home.js') }}"></script>
@endsection