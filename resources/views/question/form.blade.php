@section('header')
<style>
.solution {
	margin-left: 20em;
}
</style>

<form method="POST" action="{{ route('teacher.question.store') }}">
    @csrf
    <div class="form-group">

		<label for="content">Nội dung câu hỏi:</label>
		<input type="hidden" name="id" value="{{ $question->id ?? ''}}">
        <textarea class="form-control" name="content" id="content"></textarea>
        <button type="button" class="add-choice btn btn-primary">Thêm lựa chọn <i class="fa fa-plus"></i></button>

        <div class="choices">
			<div class="choice">
	            <div class="d-inline-flex align-items-center">
					<label for="A" class="font-weight-bold">A. </label>
					<textarea name="choices[0][content]" id="A" class="form-control"></textarea>
				</div>
				<br>
				<label class="form-check-label solution">
					<input type="checkbox" class="form-check-input" name="choices[0][sol]" value="true">
					Đáp án
				</label>
			</div>
		</div>

		<button type="submit" class="btn btn-primary">Tạo câu hỏi</button>
    </div>
</form>

@section('end')
<script src="https://cdn.ckeditor.com/4.12.0/standard-all/ckeditor.js"></script>
<script>
    CKEDITOR.replace('content', {
        customConfig: '/js/ckeditor/config.js',
        extraPlugins: 'ckeditor_wiris'
    });
</script>
<script>
    CKEDITOR.replace('A', {
        customConfig: '/js/ckeditor/config_basic.js',
        extraPlugins: 'ckeditor_wiris',
    });

	var curChoice = 65;
    $(document).ready(function () {

        $('.add-choice').on('click', function () {
			let c = String.fromCharCode(++curChoice);
            $('.choices').append(`<div class="choice" name="choice">
	            <div class="d-inline-flex align-items-center">
					<label for="${c}" class="font-weight-bold">${c}. </label>
					<textarea name="choices[${c-65}][content]" id="${c}" class="form-control"></textarea>
				</div>
				<br>
				<label class="form-check-label solution">
					<input type="checkbox" class="form-check-input" name="choices[${c-65}][sol]" value="true">
					Đáp án
				</label>
			</div>`);

			CKEDITOR.replace(c, {
									customConfig: '/js/ckeditor/config_basic.js',
									extraPlugins: 'ckeditor_wiris',
								});
        });
    });
</script>
@endsection
