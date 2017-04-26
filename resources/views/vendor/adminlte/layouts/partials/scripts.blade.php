<!-- REQUIRED JS SCRIPTS -->

<!-- JQuery and bootstrap are required by Laravel 5.3 in resources/assets/js/bootstrap.js-->
<!-- Laravel App -->
<script src="{{ mix('/js/app.js') }}" type="text/javascript"></script>
<script src="{{ asset('/modules/alertify/alertify.js') }}" type="text/javascript"></script>
<script src="{{ asset('/modules/LoadImg-master/js/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/modules/LoadImg-master/js/loadimg.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/js/admin/home.js') }}" type="text/javascript"></script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
      Both of these plugins are recommended to enhance the
      user experience. Slimscroll is required when using the
      fixed layout. -->
<script>
    window.Laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
    ]) !!};
</script>
<script type="text/javascript">
	$('#upload').loadImg({
		"text"			: "Chọn hình đại diện ...",
		"fileExt"		: ["png","jpg"],
		"fileSize_min"	: 0,
		"fileSize_max"	: 2
	});
	$('#upload_product_image').loadImg({
		"text"			: "Chọn hình sản phẩm...",
		"fileExt"		: ["png","jpg"],
		"fileSize_min"	: 0,
		"fileSize_max"	: 2
	});
</script>
