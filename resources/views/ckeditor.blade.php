@extends('layouts.app')

@section('content')
<script src="https://cdn.ckeditor.com/4.12.0/standard-all/ckeditor.js"></script>
<div class="container">
	<body>
		<textarea name="editor1"></textarea>
	</body>
</div>
@endsection
@section('end')
<script>
	CKEDITOR.replace( 'editor1', {
		customConfig: '/js/ckeditor/config.js',
		extraPlugins: 'ckeditor_wiris'
	});
</script>
@endsection
