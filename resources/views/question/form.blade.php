@section('header')

@endsection

<form method="POST" action="{{ route('teacher.question.store') }}">
    @csrf
    <div class="form-group">
        <label for="content">Nội dung câu hỏi:</label>
        <textarea class="form-control" name="content" id="content"></textarea>
    </div>
    <!-- <div class="form-group choices">
        <div class="choice" name="choice">
            <label for="A" class="font-weight-bold">A. </label>
	  	  <textarea name="A" id="A" class="form-control">
        </div>
	</div> -->
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<script src="https://cdn.ckeditor.com/4.12.0/standard-all/ckeditor.js"></script>
<script>
    CKEDITOR.replace('content', {
        customConfig: '/js/ckeditor/config.js',
        extraPlugins: 'ckeditor_wiris'
    });
</script>
