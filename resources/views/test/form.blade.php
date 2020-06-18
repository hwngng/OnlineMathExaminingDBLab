@section('header')
	<script type="text/x-mathjax-config">
		MathJax.Hub.Config({
			extensions: ["tex2jax.js"],
			tex2jax: {inlineMath: [["$","$"], ["\\(","\\)"]]},
		});
	</script>
	<script type="text/javascript" src="{{ asset('js/mathjax/tex-chtml.js') }}"></script>
	{{-- <script type="text/javascript" async
		src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.7/MathJax.js?config=TeX-AMS_CHTML"></script> --}}
	<style>
		div.scrollable {
			height: 8em;
			margin: 0;
			padding: 0;
			overflow: auto;
		}
	</style>
@endsection

<form method="post" action="{{ $action == 'create' ? route('teacher.test.store', [], false) : route('teacher.test.update', [], false) }}" >
	@csrf
	<div class="form-group">
	  <label for="name" class="font-weight-bold required">Tên đề thi:</label>
	  <input type="text" name="name" id="name" class="form-control" placeholder="Đề thi THPT Quốc gia">
	</div>
	<div class="d-flex justify-content-between">
		<div class="form-group">
			<label for="grade_id" class="font-weight-bold">Lớp: </label>
			<select name="grade_id" id="grade">
				@foreach ($grades as $grade)
					<option value="{{ $grade->id }}" {{ isset($test) && $test->grade_id == $grade->id ? 'selected' : '' }}>{{ $grade->id }}</option>
				@endforeach
			</select>
		</div>
		<div class="form-group">
			<label for="duration" class="font-weight-bold">Thời gian: </label>
			<select name="duration" id="duration">
				@foreach ($durations as $duration)
					<option value="{{ $duration }}" {{ isset($test) && $test->duration == $duration ? 'selected' : '' }}>{{ $duration }}</option>
				@endforeach
			</select>
			<label for="duration" class="font-weight-bold"> phút</label>
		</div>
		<div class="form-group">
			<label for="quantity" class="font-weight-bold">Số câu hỏi: </label>
			<select name="no_of_questions" id="quantity">
				@foreach ($quantity as $amount)
					<option value="{{ $amount }}" {{ isset($test) && $test->no_of_questions == $amount ? 'selected' : '' }}>{{ $amount }}</option>
				@endforeach
			</select>
		</div>
	</div>
	
	<div class="form-group">
		<label for="questions" class="font-weight-bold">Danh sách câu hỏi:</label>
		<table class="table table-hover" id="questions">
			<thead>
				<tr>
					<th class="w-em-6">Thao tác</th>
					<th>Nội dung</th>
					<th>Lớp</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						<a class="text-success" href="#" data-toggle="tooltip" title="Chọn câu hỏi"><i class="fas fa-crosshairs"></i></a>
						<a class="text-primary" href="#" data-toggle="tooltip" title="Xem chi tiết câu hỏi"><i class="fas fa-info-circle"></i></a>
						<a class="text-danger" href="#" data-toggle="tooltip" title="Loại câu hỏi khỏi danh sách"><i class="fas fa-times-circle ml-1"></i></a>
					</td>
					<td>
						<div class="scrollable">
						Integer auctor, felis et sagittis rhoncus, ligula ante varius nisl, eget posuere turpis enim sodales dolor. Praesent blandit mi sed est posuere, eget pellentesque quam iaculis. Ut facilisis interdum purus, sed mattis metus imperdiet ut. Pellentesque aliquet dolor risus, sed vehicula enim porttitor at. In non posuere tortor, at sagittis felis. Etiam vel hendrerit elit. Cras vulputate posuere tortor sed faucibus. Nullam volutpat pretium ultricies. Nam efficitur at nisi eu auctor. Sed nec mollis nulla. Cras ut pharetra erat. Praesent sollicitudin laoreet malesuada. Aenean volutpat tempus ipsum vel dapibus.

Sed at dolor lacus. Donec tempus enim sed nisi molestie accumsan. Cras sagittis dignissim placerat. Aliquam finibus tellus tincidunt elit fringilla scelerisque. Etiam eu lobortis ante, vitae semper lectus. Phasellus convallis nunc ex, non ultrices nunc imperdiet nec. Nam in massa non ipsum ultricies feugiat. Suspendisse lacinia est arcu, a dapibus ligula porttitor interdum. Praesent nec fermentum justo.
						</div>
					</td>
					<td>
						11
					</td>
				</tr>
				<tr>
					<td>
						<a class="text-success" href="#" data-toggle="tooltip" title="Chọn câu hỏi"><i class="fas fa-crosshairs"></i></a>
						<a class="text-primary" href="#" data-toggle="tooltip" title="Xem chi tiết câu hỏi"><i class="fas fa-info-circle"></i></a>
						<a class="text-danger" href="#" data-toggle="tooltip" title="Loại câu hỏi khỏi danh sách"><i class="fas fa-times-circle ml-1"></i></a>
					</td>
					<td>
						Aenean maximus pellentesque magna a tristique. Donec vel semper enim. Nulla et feugiat lacus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Morbi sagittis faucibus metus, quis rutrum nisi iaculis nec. Nunc facilisis laoreet lacus, et congue nibh faucibus in. Nulla pharetra ligula urna, eget pulvinar sapien ullamcorper eget.

Sed bibendum in massa non gravida. Suspendisse vel ante ornare, tempor diam ac, egestas dui. Praesent blandit quam in pretium vehicula. Mauris ut erat non tortor volutpat fermentum. Nullam et augue nec ligula ornare porta. Suspendisse commodo ex eu libero vulputate hendrerit. Mauris nec maximus tellus. Morbi nisl dui, vestibulum vel volutpat a, aliquam in eros. Pellentesque varius mauris imperdiet, convallis mi vitae, commodo tellus.
					</td>
					<td>
						12
					</td>
				</tr>
			</tbody>
		</table>
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-primary">
			@if ($action == 'create')
				Tạo đề thi
			@else
				Cập nhật đề thi
			@endif
		</button>
	</div>
</form>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
	  <div class="modal-content">
		<div class="modal-header">
		  <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
		</div>
		<div class="modal-body">
		  ...
		</div>
		<div class="modal-footer">
		  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		  <button type="button" class="btn btn-primary">Save changes</button>
		</div>
	  </div>
	</div>
</div>

@section('end')
<script>
	let quantity = $('#quantity option:selected');

	quantity.on("change", function (e) {
		let qty = parseInt($(this).val());
		
		let questions = '';
		for (let i = 0; i < qty; ++i) {
			questions += ''	
		}

	});
	
</script>
@endsection