@extends('template')

@section('title')
	ConfSched | Committee Sourcing
@endsection

@section('content')

	<script>
		var get_papers_url = '{{ action("AuthorSourcingController@getPapers")}}';
		var get_author_papers_url = '{{ action("AuthorSourcingController@getPapers", array("id" => Auth::user()->id)) }}';
		var get_feedback_url = '{{ action("AuthorSourcingController@getAuthorFeedback", array("id" => "")) }}';
		var userid = '{{ Auth::user()->author_id }}';
		var put_feedback_url = '{{ action("AuthorSourcingController@putAuthorFeedback", array("id" => "")) }}';
		var post_feedback_url = '{{ action("AuthorSourcingController@postAuthorFeedback") }}';
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

    <h3>Author Sourcing</h3>
    <hr>

    <div class="row">
      <div class="col-xs-12">
        <p><a href="{{ action('ConferenceController@getIndex') }}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Go Back</a></p>

        <p>Welcome to the Author Sourcing phase. In this phase, authors will provide feedback on how other papers relate to their own papers. Authors also provide feedback on whether or not they would be interested in seeing the presentation of a paper. This data will assist us in generating better schedules.</p>
      </div>
    </div>

    @include('includes.authorsourcing')
@endsection
