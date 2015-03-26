<?php

class AuthorSourcingController extends \BaseController {

	public function __construct() {
		$this->beforeFilter('auth');
		$this->beforeFilter('auth.author');
	}

	public function getAuthorSourcing() {
		$papers = Paper::with('topics')->get();
		$first_paper_id = PaperAuthor::where('author_id', Auth::user()->author_id)->first()->paper_id;

		$paper_id = Input::get('paperid', $first_paper_id);
		$paper = Paper::find($paper_id);

		$user_papers = PaperAuthor::where('author_id', Auth::user()->author_id)->get();

		$user_papers = Paper::whereIn('paperid', $user_papers->lists('paper_id'))->where('accepted', 'Accept')->get();

		$paper_topics = PaperTopic::whereIn('paperid', $user_papers->lists('paperid'))->get();

		$papers = Paper::whereIn('paperid', $paper_topics->lists('paperid'))->where('accepted', 'Accept')->get();

		return View::make('authorsourcing', compact('paper', 'papers', 'user_papers', 'paper_id'));
	}

	public function getProvideFeedback() {
		$paper1 = Paper::find(Input::get('paper1'));
		$paper2 = Paper::find(Input::get('paper2'));
		return View::make('paperfeedback', compact('paper1', 'paper2'));
	}

	public function postProvideFeedback() {
		$validator = Validator::make(Input::all(), array('relevant' => 'required|integer', 'interest' => 'required|integer'));

		if ($validator->fails()) {
			return Redirect::action('ConferenceController@showProvideFeedbackPage', array('paper1' => $paper1, 'paper2' => $paper2))->withInput()->withErrors($validator);
		}

		$feedback = AuthorFeedback::where('paper1', $paper1)->where('paper2', $paper2)->where('user_id', Auth::user()->id)->first();

		if ($feedback == '') {
			$feedback = new AuthorFeedback;
		}

		$feedback->paper1_id = $paper1;
		$feedback->paper2_id = $paper2;
		$feedback->relevant = Input::get('relevant');
		$feedback->interest = Input::get('interest');
		$feedback->user_id = Auth::user()->id;
		$feedback->save();

		return Redirect::action('ConferenceController@showAuthorSourcingPage', array('paperid' =>$paper2));
	}

	public function getDismiss() {
		$feedback = new AuthorFeedback;
		$feedback->paper1_id = $paper1;
		$feedback->paper2_id = $paper2;
		$feedback->relevant = 3; // no opinion feedback
		$feedback->interest = 3; // no opinion feedback
		$feedback->user_id = Auth::user()->id;
		$feedback->save();

		return Redirect::action('ConferenceController@showAuthorSourcingPage', array('paperid' =>$paper2));
	}

	public function getPapers($paperid='') {

		$first_paper_id = Author::where('email', Auth::user()->email)->first()->paperid;

		$paper_id = PaperAuthor::where('author_id', Auth::user()->author_id)->first()->paper_id;

		if ($paperid != '') {
			$paper_id = $paperid;
		}

		//$paper_id = Input::get('paperid', $paper_id);
		$paper = Paper::find($paper_id);

		$user_papers = PaperAuthor::where('author_id', Auth::user()->author_id)->get();

		$user_papers = Paper::whereIn('paperid', $user_papers->lists('paper_id'))->where('accepted', 'Accept')->get();

		$paper_topics = PaperTopic::whereIn('paperid', $user_papers->lists('paperid'))->get();

		$papers = Paper::whereIn('paperid', $paper_topics->lists('paperid'))->where('accepted', 'Accept')->get();

		return Response::json($papers, 200);
	}

	public function getAuthorFeedback($paper1, $paper2, $userid) {
		$feedback = AuthorFeedback::where('paper1_id', $paper1)->where('paper2_id', $paper2)->where('user_id', $userid)->first();

		if (count($feedback) < 1) {
			return Response::make('None found.', 404);
		}

		return Response::json($feedback->toJson(), 200);
	}

	public function putAuthorFeedback($id) {
		$feedback = AuthorFeedback::find($id);

		if (count($feedback) < 1) {
			return Response::make('Feedback not found.', 404);
		}

		$feedback->paper1_id = Input::get('paper1');
		$feedback->paper2_id = Input::get('paper2');
		$feedback->user_id = Input::get('userid');
		$feedback->relevant = Input::get('relevant');
		$feedback->interest = Input::get('interest');
		// $feedback->moved_to_bottom_at = Input::get('moved_to_bottom_at', null);
		if (Input::has('moved_to_bottom_at')) {
			$feedback->moved_to_bottom_at = Date::now();
		}
		$feedback->save();

		return Response::json($feedback->toJson(), 200);
	}

	public function postAuthorFeedback() {
		$feedback = new AuthorFeedback;

		$feedback->paper1_id = Input::get('paper1');
		$feedback->paper2_id = Input::get('paper2');
		$feedback->user_id = Input::get('userid');
		$feedback->relevant = Input::get('relevant', null);
		$feedback->interest = Input::get('interest', null);
		//$feedback->moved_to_bottom_at = Input::get('moved_to_bottom_at', null);
		if (Input::has('moved_to_bottom_at')) {
			$feedback->moved_to_bottom_at = Date::now();
		}
		$feedback->save();

		return Response::json($feedback->toJson(), 201);
	}

}
