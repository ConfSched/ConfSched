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

	public function getPaper($id) {
		$paper = Paper::find($id);
		$topic_id = $paper->topic_id;
		$categories = Category::whereIn('topic_id', $paper->topics->lists('topicid'))->where('user_id', Auth::user()->id)->get();
		return View::make('addtocategory', compact('id', 'paper', 'categories'));
	}

	public function postPaper($id) {
		$validator = Validator::make(Input::all(), array('category_id' => 'required|integer'));

		if ($validator->fails()) {
			return Redirect::action('CommitteeSourcingController@getPaper', array('id' => $id))->withInput()->withErrors($validator);
		}

		$map = new CategoryPaperMap;
		$map->category_id = Input::get('category_id');
		$map->paper_id = $id;
		$map->save();

		$topicid = Category::find(Input::get('category_id'))->topic_id;

		return Redirect::action('CommitteeSourcingController@getCommitteeSourcing', array('topicid' => $topicid));
	}

	public function getRemoveCategory() {

	}

	public function deleteCategory($id) {
		$category = Category::find($id);
		$topicid = $category->topic_id;
		$category->delete();

		return Redirect::action('CommitteeSourcingController@getCommitteeSourcing', array('topicid' => $topicid));
	}

	/**
	 * Removes a Category Paper mapping
	 * @param  int $paperid the id of the paper
	 * @param  int $categoryid the id of the category
	 * @return Response
	 */
	public function deleteCategoryPaperMap($paperid, $categoryid) {
		$categoryPaperMap = CategoryPaperMap::where('paper_id', $paperid)->where('category_id', $categoryid)->get();
		foreach($categoryPaperMap as $current) {
			$current->delete();
		}

		$topic_id = Category::find($categoryid)->topic_id;

		return Redirect::action('CommitteeSourcingController@getCommitteeSourcing', array('topicid' =>  $topic_id));
	}

}
