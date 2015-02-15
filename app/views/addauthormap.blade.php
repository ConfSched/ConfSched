@extends('template')

@section('title')
	ConfSched | Constraints
@endsection

@section('navigation')
	@include('navigation')
@endsection

@section('content')

	<script>
		$(function() {
			$('.add-additional-link').on('click', function(e) {

				e.preventDefault();

				var newDiv = $('#div-author-input').clone();
				newDiv.attr('id', '');
				newDiv.show();

				$('.additional-container').append(newDiv);
			});
		})
	</script>	

	<h1>Add Author Mapping</h1>
	<hr>

	@if($errors->has())
		<ul>
			@foreach($errors->all() as $error)
				<li>{{$error}}</li>
			@endforeach
		</ul>
	@endif

	<div class="row">
		<div class="col-lg-12">
			<div class="alert alert-warning" role="alert">
				<h5>Warning</h5>
				<p>All changes are final. You may not go back and undo this.</p>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12">
			{{ Form::open(array('class' => 'form', 'method' => 'POST')) }}
				<div class="row">
					<div class="col-lg-12">
						<div class="form-group">
							{{ Form::label('author1', 'Author Account: ') }}
							{{ Form::select('author1', $authors->lists('display', 'id'), Input::old('author1', ''), array('class' => 'form-control')) }}
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="form-group">
							{{ Form::label('author[]', 'Additional Author Account: ') }}
							{{ Form::select('author[]', ['' => 'Please Select an Author'] + $authors->lists('display', 'id'), Input::old('author[]', ''), array('class' => 'form-control')) }}
						</div>
					</div>
				</div>
				<div class="additional-container"></div>
				<div class="row">
					<div class="col-lg-12">
						<a href="#" class="add-additional-link">Add additional</a> 
					</div>
				</div>
				<div class="row" id="div-author-input" style="display:none;">
					<div class="col-lg-12">
						<div class="form-group">
							{{ Form::label('author[]', 'Additional Author Account: ') }}
							{{ Form::select('author[]', ['' => 'Please Select an Author'] + $authors->lists('display', 'id'), Input::old('author[]', ''), array('class' => 'form-control')) }}
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="form-group">
							{{ Form::submit('Add Author Map', array('class' => 'btn btn-lg btn-primary btn-block')) }}
						</div>
					</div>
				</div>
			{{ Form::close() }}
		</div>
	</div>
@endsection