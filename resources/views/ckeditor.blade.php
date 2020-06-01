@extends('layouts.app')

@section('content')
<div class="container">
	<body>
		<textarea name="editor1"></textarea>
	</body>
</div>
@endsection
@section('end')
<script src="https://cdn.ckeditor.com/4.12.0/standard-all/ckeditor.js"></script>
<script>
	CKEDITOR.replace( 'editor1', {
		customConfig: '/js/ckeditor/config.js',
		extraPlugins: 'ckeditor_wiris'
	});
</script>
@endsection