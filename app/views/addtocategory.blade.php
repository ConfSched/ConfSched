@extends('template')

@section('title')
	ConfSched | Committee Sourcing
@endsection

@section('content')

	<h1>Add to Category</h1>
	<hr>

	<div class="row">
		<div class="col-lg-12">
                <p><a href="{{ URL::previous() }}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Go Back</a></p>

			{{ Form::open(array('class' => 'form', 'method' => 'POST')) }}
				<div class="row">
					<div class="col-lg-12">
						<div class="form-group">
							{{ Form::label('title', 'Title: ')}}
							<p>{{ $paper->title }}</p>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="form-group">
							{{ Form::label('abstract', 'Abstract: ')}}
							<p>{{ $paper->abstract }}</p>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="form-group">
							{{ Form::label('category_id', 'Add to: ')}}
							{{ Form::select('category_id', ['' => 'Please select a category'] + $categories->lists('name', 'id'), Input::old('category_id', ''), array('class' => 'form-control')) }}
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="form-group">
							{{ Form::submit('Add to Category', array('class' => 'btn btn-lg btn-primary btn-block')) }}
						</div>
					</div>
				</div>
			{{ Form::close() }}


		</div>
	</div>
@endsection
