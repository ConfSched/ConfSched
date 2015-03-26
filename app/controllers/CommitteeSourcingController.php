<?php

class CommitteeSourcingController extends \BaseController {

	public function __construct() {
		$this->beforeFilter('auth');
	}

	public function getCommitteeSourcing() {

		$reviewer = Reviewer::where('reviewerid', Auth::user()->committee_id)->first();
		if (count($reviewer) < 1) {
			return Redirect::to('/');
		}

		$topics = $reviewer->topics;
		$topic_id = Input::get('topicid', $topics->first()->topicid);

		$topic = Topic::find($topic_id);

		$papers = PaperTopic::where('topicid', $topic_id)->get();
		$papers = Paper::whereIn('paperid', $papers->lists('paperid'))->where('accepted', 'Accept')->get();
		$categories = Category::where('topic_id', $topic_id)->where('user_id', Auth::user()->id)->get();

		return View::make('committeesourcing.default', compact('id', 'topic', 'topics', 'categories', 'papers'));
	}

	public function getCreateCategory() {
		$id = Input::get('id');
		return View::make('addcategory', compact('id'));
	}

	public function postCategory($id) {
		$validator = Validator::make(Input::all(), array('name' => 'required'));

		if ($validator->fails()){
			return Redirect::action('CommitteeSourcingController@getCreateCategory', array('topicid' => $id))->withInput()->withErrors($validator);
		}

		$category = new Category;
		$category->name = Input::get('name');
		$category->user_id = Auth::user()->id;
		$category->topic_id = $id;
		$category->save();

		return Redirect::action('CommitteeSourcingController@getCommitteeSourcing', array('topicid' => $id));
	}

	public function getPaper() {

	}

	public function postPaper() {

	}

	public function getRemoveCategory() {

	}

	public function deleteCategory() {
		$category = Category::find($id);
		$topicid = $category->topic_id;
		$category->delete();

		return Redirect::action('ConferenceController@showCommitteeSourcingPage', array('topicid' => $topicid));
	}

}
