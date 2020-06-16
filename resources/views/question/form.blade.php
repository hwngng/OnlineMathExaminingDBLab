@section('header')
<style>
.solution {
	margin-left: 20em;
}
</style>
@endsection

<form method="POST" action="{{ $action == 'create' ? route('teacher.question.store', [], false) : route('teacher.question.update', [], false) }}" id="form">
    @csrf
    <div class="form-group">
		<input type="hidden" name="id" value="{{ $question->id ?? ''}}">
		<label for="grade_id" class="font-weight-bold">Lớp: </label>
		<select name="grade_id" id="grade">
			@foreach ($grades as $grade)
				<option value="{{ $grade->id }}" {{ isset($question) && $question->grade_id == $grade->id ? 'selected' : '' }}>{{ $grade->id }}</option>
			@endforeach
		</select>
		<br>
		<label for="content" class="font-weight-bold">Nội dung câu hỏi:</label>
		<textarea class="form-control" name="content" id="content">{{ isset($question->content) ? htmlspecialchars_decode($question->content) : '' }}</textarea>
		<br>
		<label for="solution" class="font-weight-bold">Lời giải:</label>
        <textarea class="form-control" name="solution" id="solution">{{ isset($question->solution) ? htmlspecialchars_decode($question->solution) : '' }}</textarea>
		<br>
		<button type="button" class="add-choice btn btn-primary">Thêm lựa chọn <i class="fa fa-plus"></i></button>

		<div class="choices">
		@php
			$noOfChoices = $action == 'create' ? 1 : count($question->choices);
		@endphp
		@if ($action == 'create' || isset($question->choices) && count($question->choices) > 0)
			@for ($i = 0; $i < $noOfChoices; $i++)
				<div class="choice">
					@php
						if ($action != 'create')
						{
							$choice = $question->choices->find($i);
						}
					@endphp
					<div class="d-inline-flex align-items-center">
						<label for="A" class="font-weight-bold">{{ chr(ord('A')+$i) . '.' }} </label>
						<textarea name="choices[{{ $i }}][content]" id="{{ chr(ord('A')+$i) }}" class="form-control">{{ isset($choice) ? htmlspecialchars_decode($choice->content) : '' }}</textarea>
					</div>
					<br>
					<label class="form-check-label solution">
						<input type="checkbox" class="form-check-input" name="choices[{{ $i }}][sol]" value="1" {{ isset($choice) && $choice->is_solution == 1 ? 'checked' : ''}}>
						Đáp án
					</label>
				</div>	
			@endfor
		@endif
		</div>
		<br>
		<button type="submit" class="btn btn-primary">
			@if ($action == 'create')
				Tạo câu hỏi
			@else
				Cập nhật câu hỏi
			@endif
		</button>
    </div>
</form>

@section('end')
<script src="https://cdn.ckeditor.com/4.12.0/standard-all/ckeditor.js"></script>
<script>
    CKEDITOR.replace('content', {
        customConfig: '/js/ckeditor/config.js',
        extraPlugins: 'ckeditor_wiris'
	});

	CKEDITOR.replace('solution', {
        customConfig: '/js/ckeditor/config.js',
        extraPlugins: 'ckeditor_wiris'
	});
	
	var curChoice = 65;
	var noOfChoice = {{ $noOfChoices }}
	for (let i = 0; i < noOfChoice; ++i) {
		CKEDITOR.replace(String.fromCharCode(curChoice + i), {
			customConfig: '/js/ckeditor/config_basic.js',
			extraPlugins: 'ckeditor_wiris',
		});
	}
	curChoice += noOfChoice-1;
    $(document).ready(function () {

        $('.add-choice').on('click', function () {
			let c = String.fromCharCode(++curChoice);
            $('.choices').append(`<div class="choice" name="choice">
	            <div class="d-inline-flex align-items-center">
					<label for="${c}" class="font-weight-bold">${c}. </label>
					<textarea name="choices[${curChoice-65}][content]" id="${c}" class="form-control"></textarea>
				</div>
				<br>
				<label class="form-check-label solution">
					<input type="checkbox" class="form-check-input" name="choices[${curChoice-65}][sol]" value="1">
					Đáp án
				</label>
			</div>`);

			CKEDITOR.replace(c, {
				customConfig: '/js/ckeditor/config_basic.js',
				extraPlugins: 'ckeditor_wiris',
			});
        });

		$('#form').submit(function (e) {
			e.preventDefault();

			let form_url = $(this).attr("action");
			let form_method = $(this).attr("method");

			for (var i in CKEDITOR.instances) {
				CKEDITOR.instances[i].updateElement();
			};
			var form_data = $(this).serialize();
			$.ajax({
				type: form_method,
				url: form_url,
				data: form_data,
				success: function (response) {
					if (response['return_code'] == '0') {
						@if ($action == 'create')
						if (!confirm("Thêm câu hỏi thành công!\nBạn có muốn tiếp tục tạo câu hỏi?")) {
							close();
						} else {
							window.location.reload();
						}
						@else
							close();
						@endif
					} else {
						alert("Thêm câu hỏi thất bại.\nVui lòng thử lại hoặc ấn Ctrl + F5 rồi tạo lại câu hỏi.")
					}
				}
			});
		})
    });
</script>
@endsection