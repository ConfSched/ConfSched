@extends('template')

@section('title')
	ConfSched | Committee Sourcing
@endsection

@section('navigation')
	@include('navigation')
@endsection

@section('content')

	<script>
		var get_papers_url = '{{ action("ConferenceController@getAuthorSourcingPapers")}}';
		var get_author_papers_url = '{{ action("ConferenceController@getAuthorPapers", array("id" => Auth::user()->id)) }}';
		var get_feedback_url = '{{ action("ConferenceController@getAuthorFeedback", array("id" => "")) }}';
		var userid = '{{ Auth::user()->id }}';
		var put_feedback_url = '{{ action("ConferenceController@updateAuthorFeedback", array("id" => "")) }}';
		var post_feedback_url = '{{ action("ConferenceController@storeAuthorFeedback") }}';
	</script>

	{{ HTML::script('assets/js/authorsourcing.js')}}

	<script>
		// $(function() {
		// 	$('#paper_filter').on('change', function() {
  //               $(this).parents('form:first').submit();
		// 	});
		// });
			//$scope.papers = 
	</script>

	<style>
		.animate-show {
		  -webkit-transition:all linear 0.5s;
		  transition:all linear 0.5s;
		  line-height:20px;
		  opacity:1;
		  padding:10px;
		  border:1px solid black;
		  background:white;
		}
		 
		.animate-show.ng-hide-add,
		.animate-show.ng-hide-remove {
		  display:block!important;
		}
		 
		.animate-show.ng-hide {
		  line-height:0;
		  opacity:0;
		  padding:0 10px;
		}
	</style>

	@include('includes.authorsourcing')
@endsection