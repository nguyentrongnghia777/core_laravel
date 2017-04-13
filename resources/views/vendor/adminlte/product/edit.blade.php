@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Sửa sản phẩm
@endsection

@section('contentheader_title')
    Quản lý sản phẩm
@endsection
@section('contentheader_description')
@endsection

@section('contentheader_levels')
    <li><a href="{{ url('/admincp') }}"><i class="fa fa-dashboard"></i>Trang chủ</a></li>
    <li><a href="{{ url('/admincp/category') }}">Quản lý sản phẩm</a></li>
    <li class="active">Sửa sản phẩm</li>
@endsection

@section('main-content')
<div class="container-fluid spark-screen">

    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))
                <h4 class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}  <button class="close" data-dismiss="alert" aria-label="close">&times;</button></h4>
            @endif
        @endforeach
    </div> <!-- end .flash-message -->

    <div class="row">
        <div class="col-md-12">
            <!-- Default box -->
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Sửa sản phẩm</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form role="form" method="POST" action="{{ url('/admincp/product/store') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <!-- text input -->
                        <div class="form-group">
                            <label>Tên sản phẩm</label>
                            <input type="text" class="form-control" placeholder="Tên sản phẩm ..." name="product-name" value="{{ $product->name }}">
                        </div>
                        <div class="form-group">
                            <label>Mô tả sản phẩm</label>
                            <input type="text" class="form-control" placeholder="Mô tả sản phẩm ..." name="product-description" value="{{ $product->description }}">
                        </div>
                        <div class="form-group">
                            <label>Slug dùng cho SEO</label>
                            <input type="text" class="form-control" placeholder="Slug dùng cho SEO ..." name="product-slug" value="{{ $product->slug }}">
                        </div>
                        <div class="form-group">
                            <label>Số lượng</label>
                            <input type="text" class="form-control" placeholder="Số lượng sản phẩm ..." name="product-quantity" value="{{ $product->quantity }}">
                        </div>
                        <div class="form-group">
                            <label>Hình ảnh</label>
                            <input type="file" class="form-control" placeholder="" name="product-images"><br />
                            <img class="custom-image" src="{{asset('uploads/'.$product->images)}}">
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Lưu</button>
                        </div>
                    </form>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
</div>
@endsection
