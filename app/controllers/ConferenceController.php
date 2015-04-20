<?php

class ConferenceController extends \BaseController {

	/**
	 * Constructor
	 *
	 * Contains the filters for the Controller
	 */
	public function __construct() {
		$this->beforeFilter('auth', array('except' => ['getIndex', 'processInstall']));
		$this->beforeFilter('auth.admin', array('only' => 'showSchedulePage'));
	}

	/**
	 * shows the process page
	 *
	 * @return Response
	 */
	public function showProcessPage() {
		return View::make('process');
	}

	/**
	 * Marks OpenConf stage as complete
	 *
	 * @return Response
	 */
	public function completeOpenConf() {
		// $json = OCPaper::where('accepted', true)->get()->toJson();
		$json = Paper::with('authors')->get()->toJson();
		File::put('papers.json', $json);
		//return OCPaper::where('accepted', true)->get()->toJson();
		return Redirect::action('ConferenceController@showProcessPage');
	}

	/**
	 * Shows the committee sourcing page
	 *
	 * @return Response
	 */
	public function showCommitteeSourcingPage() {
		$topic_id = Input::get('topicid', 1);

		$topic = Topic::find($topic_id);
		$reviewer = Reviewer::where('email', Auth::user()->email)->first();
		if (count($reviewer) < 1) {
			return Redirect::action('ConferenceController@getIndex');
		}
		$topics = $reviewer->topics;
		//$topics = Topic::all();
		$topic = $topics->first();

		$categories = Category::where('topic_id', $topic->topicid)->where('user_id', Auth::user()->id)->get();
		return View::make('committeesourcing', compact('id', 'topic', 'topics', 'categories'));
	}

	/**
	 * Shows the Add Category Form
	 *
	 * @param  int $id the id of the topic that the category should be added to
	 * @return Response
	 */
	public function showAddCategoryForm($id) {
		return View::make('addcategory', compact('id'));
	}

	/**
	 * Adds a new category to the specified topic
	 *
	 * @param int $id the id of the topic that the category should be added to
	 * @return Response
	 */
	public function addCategory($id) {
		$validator = Validator::make(Input::all(), array('name' => 'required'));

		if ($validator->fails()){
			return Redirect::action('ConferenceController@showAddCategoryForm', array('topicid' => $id))->withInput()->withErrors($validator);
		}

		$category = new Category;
		$category->name = Input::get('name');
		$category->user_id = Auth::user()->id;
		$category->topic_id = $id;
		$category->save();

		return Redirect::action('ConferenceController@showCommitteeSourcingPage', array('topicid' => $id));
	}

	/**
	 * Removes a category
	 *
	 * @param  int $id the id of the category to remove
	 * @return Response
	 */
	public function removeCategory($id) {
		$category = Category::find($id);
		$topicid = $category->topic_id;
		$category->delete();

		return Redirect::action('ConferenceController@showCommitteeSourcingPage', array('topicid' => $topicid));
	}

	/**
	 * Shows the add to category form
	 * @param  int $id the id of the paper to add to category
	 * @return Response
	 */
	public function showAddToCategoryForm($id) {
		$paper = Paper::find($id);
		$topic_id = $paper->topic_id;
		$categories = Category::whereIn('topic_id', $paper->topics->lists('topicid'))->where('user_id', Auth::user()->id)->get();
		return View::make('addtocategory', compact('id', 'paper', 'categories'));
	}

	/**
	 * Adds a paper to a category
	 * @param int $id the id of the paper to add to the category
	 * @return Response
	 */
	public function addToCategory($id) {
		$validator = Validator::make(Input::all(), array('category_id' => 'required|integer'));

		if ($validator->fails()) {
			return Redirect::action('ConferenceController@showAddToCategoryForm', array('topicid' => $id))->withInput()->withErrors($validator);
		}

		$map = new CategoryPaperMap;
		$map->category_id = Input::get('category_id');
		$map->paper_id = $id;
		$map->save();

		$topicid = Category::find(Input::get('category_id'))->topic_id;

		return Redirect::action('ConferenceController@showCommitteeSourcingPage', array('topicid' => $topicid));
	}

	/**
	 * Removes a Category Paper mapping
	 * @param  int $paperid the id of the paper
	 * @param  int $categoryid the id of the category
	 * @return Response
	 */
	public function removeCategoryPaperMap($paperid, $categoryid) {
		$categoryPaperMap = CategoryPaperMap::where('paper_id', $paperid)->where('category_id', $categoryid)->get();
		foreach($categoryPaperMap as $current) {
			$current->delete();
		}

		$topic_id = Category::find($categoryid)->topic_id;

		return Redirect::action('ConferenceController@showCommitteeSourcingPage', array('topicid' =>  $topic_id));
	}

	public function getAuthorPapers($id) {

		$user = User::find($id);

		$authors = Author::where('email', $user->email)->select('paperid')->get();
		$papers = Paper::whereIn('paperid', $authors->lists('paperid'))->get();

		return Response::json($papers->toJson(), 200);
	}

	public function getAuthorSourcingPapers($paperid='') {
		$papers = Paper::with('topics')->get();
		$all_papers = Paper::all();

		$first_paper_id = Author::where('email', Auth::user()->email)->first()->paperid;

		$paper_id = $first_paper_id;
		if ($paperid != '') {
			$paper_id = $paperid;
		}
		$paper = Paper::find($paper_id);

		$papers_array = array();

		foreach($papers as $current) {
			foreach($current->topics as $topic) {
				if (in_array($topic->topicid, $paper->topics->lists('topicid'))) {
					if (!in_array(Auth::user()->email, $current->authors->lists('email'))) {
						array_push($papers_array, $current);
					}
				}
			}
		}

		$papers = $papers_array;

		$user_papers = array();

		foreach($all_papers as $current) {
			foreach($current->authors as $author) {
				if ($author->email == Auth::user()->email) {
					array_push($user_papers, $current);
				}
			}
		}

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

	public function showAuthorSourcingPage(){
		$papers = Paper::with('topics')->get();
		// $all_papers = Paper::all();

		// $paper_topics_list = array();

		// foreach($paper->topics as $curr_topic) {
		// 	array_push($paper_topics_list, $curr_topic->topicid);
		// }

		// var_dump($paper_topics_list);

		//$first_paper_id = Author::where('authorid', Auth::user()->author_id)->first()->paperid;
		$first_paper_id = PaperAuthor::where('author_id', Auth::user()->author_id)->first()->paper_id;

		$paper_id = Input::get('paperid', $first_paper_id);
		$paper = Paper::find($paper_id);

		// $papers_array = array();

		// foreach($papers as $current) {
		// 	foreach($current->topics as $topic) {
		// 		if (in_array($topic->topicid, $paper->topics->lists('topicid'))) {
		// 			if (!in_array(Auth::user()->email, $current->authors->lists('email'))) {
		// 				array_push($papers_array, $current);
		// 			}
		// 		}
		// 	}
		// }

		// $papers = $papers_array;

		// $user_papers = array();

		// foreach($all_papers as $current) {
		// 	foreach($current->authors as $author) {
		// 		if ($author->email == Auth::user()->email) {
		// 			array_push($user_papers, $current);
		// 		}
		// 	}
		// }

		// foreach($papers as $key => $x) {
		// 	$feedback = AuthorFeedback::where('paper1_id', $x->paperid)->where('paper2_id', $paper_id)->where('user_id', Auth::user()->id)->get();
		// 	if (count($feedback) > 0) {
		// 		unset($papers[$key]);
		// 	}
		// }

		// foreach($papers_array as $x) {
		// 	var_dump($x->toArray());
		// 	echo '<hr>';
		// }

		// die();

		$user_papers = PaperAuthor::where('author_id', Auth::user()->author_id)->get();

		$user_papers = Paper::whereIn('paperid', $user_papers->lists('paper_id'))->where('accepted', 'Accept')->get();

		$paper_topics = PaperTopic::whereIn('paperid', $user_papers->lists('paperid'))->get();

		$papers = Paper::whereIn('paperid', $paper_topics->lists('paperid'))->where('accepted', 'Accept')->get();

		return View::make('authorsourcing', compact('paper', 'papers', 'user_papers', 'paper_id'));
	}

	public function showProvideFeedbackPage() {
		$paper1 = Paper::find(Input::get('paper1'));
		$paper2 = Paper::find(Input::get('paper2'));
		return View::make('paperfeedback', compact('paper1', 'paper2'));
	}

	public function authorfeedback($paper1, $paper2) {
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

	public function dismiss($paper1, $paper2) {
		$feedback = new AuthorFeedback;
		$feedback->paper1_id = $paper1;
		$feedback->paper2_id = $paper2;
		$feedback->relevant = 3; // no opinion feedback
		$feedback->interest = 3; // no opinion feedback
		$feedback->user_id = Auth::user()->id;
		$feedback->save();

		return Redirect::action('ConferenceController@showAuthorSourcingPage', array('paperid' =>$paper2));
	}

	// public function getAuthorFeedback($paper1, $paper2, $userid) {
	// 	$feedback = AuthorFeedback::where('paper1_id', $paper1)->where('paper2_id', $paper2)->where('user_id', $userid)->first();

	// 	if (count($feedback) < 1) {
	// 		return Response::make('None found.', 404);
	// 	}

	// 	return Response::json($feedback->toJson(), 200);
	// }

	// public function updateAuthorFeedback($id) {
	// 	$feedback = AuthorFeedback::find($id);

	// 	if (count($feedback) < 1) {
	// 		return Response::make('Feedback not found.', 404);
	// 	}

	// 	$feedback->paper1_id = Input::get('paper1');
	// 	$feedback->paper2_id = Input::get('paper2');
	// 	$feedback->user_id = Input::get('userid');
	// 	$feedback->relevant = Input::get('relevant');
	// 	$feedback->interest = Input::get('interest');
	// 	// $feedback->moved_to_bottom_at = Input::get('moved_to_bottom_at', null);
	// 	if (Input::has('moved_to_bottom_at')) {
	// 		$feedback->moved_to_bottom_at = Date::now();
	// 	}
	// 	$feedback->save();

	// 	return Response::json($feedback->toJson(), 200);
	// }

	// public function storeAuthorFeedback() {
	// 	$feedback = new AuthorFeedback;

	// 	$feedback->paper1_id = Input::get('paper1');
	// 	$feedback->paper2_id = Input::get('paper2');
	// 	$feedback->user_id = Input::get('userid');
	// 	$feedback->relevant = Input::get('relevant', null);
	// 	$feedback->interest = Input::get('interest', null);
	// 	//$feedback->moved_to_bottom_at = Input::get('moved_to_bottom_at', null);
	// 	if (Input::has('moved_to_bottom_at')) {
	// 		$feedback->moved_to_bottom_at = Date::now();
	// 	}
	// 	$feedback->save();

	// 	return Response::json($feedback->toJson(), 201);
	// }

	public function showSchedulePage() {
		$rooms = Room::all();
		$sessions = Sessions::with('papers')->get();
		return View::make('schedule', compact('rooms', 'sessions'));
	}

	public function showAddRoomsPage() {
		return View::make('addrooms');
	}

	public function addRooms() {

		$results = Excel::load(Input::file('file')->getRealPath(), function($reader) {
		})->get();

		//var_dump($results->toArray());

		Room::truncate();

		foreach($results as $result) {
			var_dump($result->equipment);
			var_dump($result->equipment == 'true');
			$room = new Room;
			$room->room = $result->room;
			$room->capacity = $result->capacity;
			$room->equipment = ($result->equipment == 'true');

			$room->save();
		}

		$rooms = Room::all();
		//var_dump($rooms->toArray());

		return Redirect::action('ConferenceController@showSchedulePage');

	}

	public function swap($paper1, $paper2) {
		$sessionpaper1 = SessionPaper::where('paper_id', $paper1)->first();
		$sessionpaper2 = SessionPaper::where('paper_id', $paper2)->first();

		$sessionpaper1->paper_id = $paper2;
		$sessionpaper1->save();

		$sessionpaper2->paper_id = $paper1;
		$sessionpaper2->save();

		return Redirect::action('ConferenceController@showSchedulePage');
	}

	public function showaddConstraintsPage() {

	}

	public function populateAuthorsTable() {
		Authors::truncate();

		$accepted_papers = Paper::where('accepted', 'Accept')->get();
		$authors = Author::whereIn('paperid', $accepted_papers->lists('paperid'))->groupBy('email')->get();
		foreach($authors as $author) {
			$x = new Authors;
			$x->first_name = $author->name_first;
			$x->last_name = $author->name_last;
			$x->organization = $author->organization;
			$x->email = $author->email;
			$x->save();
		}

	}

	public function showSessionsPage() {
		//$sessions = Sessions::orderBy('start')->get();

		$dates = Sessions::distinct()->select(DB::raw('CAST(start AS DATE) as date'))->get();

		//$sessions = Sessions::groupBy(DB::raw('CAST(start AS DATE)'))->get();
		//$debug = App::make('DBug');
		//var_dump($debug);
		//DBug::DBug($sessions->toArray());
		//var_dump($sessions->toArray());
		//die();


		return View::make('sessions', compact('dates'));
	}

	public function showAddSessionsPage() {
		$rooms = Room::all();

		return View::make('addsession', compact('rooms'));
	}

	public function addSesssion() {
		$validator = Validator::make(Input::all(), ['date' => 'required', 'start' => 'required', 'end' => 'required', 'room' => 'required|overbook_room', 'num_papers' => 'required'], ['overbook_room' => 'Room is already booked during time period']);

		if ($validator->fails()) {
			return Redirect::action('ConferenceController@showAddSessionsPage')->withInput()->withErrors($validator);
		}

		$session = new Sessions;

		$session->start = Date::parse(Input::get('date') . ' ' . Input::get('start'));
		$session->end = Date::parse(Input::get('date') . ' ' . Input::get('end'));
		$session->room_id = Input::get('room');
		$session->num_papers = Input::get('num_papers');

		$session->save();

		return Redirect::action('ConferenceController@showSessionsPage');
	}

	public function showEditSessionPage($id) {
		$session = Sessions::find($id);
		$rooms = Room::all();

		return View::make('editsession', compact('session', 'rooms'));
	}

	public function editSession($id) {

		$validator = Validator::make(Input::all(), ['date' => 'required', 'start' => 'required', 'end' => 'required', 'room' => 'required|overbook_room:' . $id, 'num_papers' => 'required'], ['overbook_room' => 'Room is already booked during time period']);

		if ($validator->fails()) {
			return Redirect::action('ConferenceController@showEditSessionPage', ['id' => $id])->withInput()->withErrors($validator);
		}

		$session = Sessions::find($id);

		$session->start = Date::parse(Input::get('date') . ' ' . Input::get('start'));
		$session->end = Date::parse(Input::get('date') . ' ' . Input::get('end'));
		$session->room_id = Input::get('room');
		$session->num_papers = Input::get('num_papers');

		$session->save();

		return Redirect::action('ConferenceController@showSessionsPage');
	}

	public function removeSession($id) {
		$session = Sessions::find($id);

		$session->delete();

		return Redirect::action('ConferenceController@showSessionsPage');
	}

	public function populatePapersAuthorsTable() {

		PaperAuthor::truncate();


		$accepted_papers = Paper::where('accepted', 'Accept')->get();

		foreach($accepted_papers as $paper) {
			foreach($paper->authors as $author) {
				$author2 = Authors::where('email', $author->email)->first();

				$a = PaperAuthor::where('paper_id', $paper->paperid)->where('author_id', $author2->id)->get();
				if (count($a) < 1) {
					$paperauthor = new PaperAuthor;
					$paperauthor->paper_id = $paper->paperid;
					//$author2 = Authors::where('email', $author->email)->first();
					$paperauthor->author_id = $author2->id;
					$paperauthor->save();
				}


			}
		}
	}

	public function showConstraintsPage() {
		return View::make('constraints');
	}

	public function showAddAuthorSessionConstraintPage() {

		$authors = Authors::orderBy('last_name')->get();
		$sessions = Sessions::orderBy('start')->get();

		return View::make('addauthorsessionconstraint', compact('authors', 'sessions'));
	}

	public function addAuthorSessionConstraint() {
		DBug::DBug(Input::all());

		$validator = Validator::make(Input::all(), ['author' => 'required', 'session' => 'required']);

		if ($validator->fails()) {
			return Redirect::action('ConferenceController@showEditSessionPage');
		}

		$authorSessionConstraint = new AuthorSessionConstraint;
		$authorSessionConstraint->session_id = Input::get('session');
		$authorSessionConstraint->author_id = Input::get('author');
		$authorSessionConstraint->save();

		return Redirect::action('ConferenceController@showConstraintsPage');
	}

	public function showAddAuthorMapPage() {
		$authors = Authors::all();

		return View::make('addauthormap', compact('authors'));
	}

	public function addAuthorMap() {
		$validator = Validator::make(Input::all(), ['author1' => 'required', 'author' => 'required']);

		if ($validator->fails()) {
			return Redirect::action('ConferenceController@showAddAuthorMapPage')->withInput()->withErrors($validator);
		}

		//AuthorMap::truncate();

		foreach(Input::get('author') as $author) {
			if ($author != Input::get('author1') && $author != '') {
				$map = new AuthorMap;
				$map->author1_id = Input::get('author1');
				$map->author2_id = $author;
				$map->save();

				foreach(PaperAuthor::where('author_id', $author)->get() as $paperauthor) {
					$paperauthor->author_id = Input::get('author1');
					$paperauthor->save();
				}

				// foreach(AuthorFeedback::where('user_id', $author)->get() as $authorfeedback) {
				// 	$authorfeedback->user_id = Input::get('author1');
				// 	$authorfeedback->save();
				// }

				foreach(AuthorSessionConstraint::where('author_id', $author)->get() as $authorsession) {
					$authorsession->author_id = Input::get('author1');
					$authorsession->save();
				}

				foreach(User::where('author_id', $author)->get() as $user) {
					$user->author_id = Input::get('author1');
					$authorsession->save();
				}

				Authors::find($author)->delete(); // soft delete author
			}
		}

		return Redirect::action('ConferenceController@showConstraintsPage');
	}

	public function alertUsersToCreateAccounts() {

		//User::truncate();
		AuthorMap::truncate();

		//$authors = Authors::all();
		$committeemembers = Reviewer::all();
		$author_committee_members = Authors::whereIn('email', $committeemembers->lists('email'))->get();
		//DBug::DBug($author_committee_members); die();
		//$committeemembers = Reviewer::whereIn('email', $authors->lists('email'))->get();

		//DBug::DBug($author_committee_members->toArray(), true);

		// $conference = DB::connection('openconf')->select("SELECT value FROM config WHERE setting =  'OC_confNameFull'");
  //           	$conference = $conference[0]->value;
  		$conference = Config::get('site.conference_name');

		foreach($author_committee_members as $author) {
			$member = Reviewer::where('email', $author->email)->first();
			Mail::send('emails.registration.both', compact('author', 'member', 'conference'), function($message) use ($author)
			{
				$message->to($author->email, $author->name)->subject('ConfSched Registration');
				$message->from('noreply@cs-sr.academic.roanoke.edu', 'ConfSched');
			});
		}

					if ($author_committee_members->lists('email') != array()) {
						$authors = Authors::whereNotIn('email', $author_committee_members->lists('email'))->get();
					}
					else {
						$authors = Authors::all();
					}
            	//$authors = Authors::whereNotIn('email', $author_committee_members->lists('email'))->get();

            	foreach($authors as $author) {
            		//DBug::DBug($author->email);

            		Mail::send('emails.registration.author', compact('author', 'conference'), function($message) use ($author)
			{
				$message->to($author->email, $author->name)->subject('ConfSched Registration');
				$message->from('noreply@cs-sr.academic.roanoke.edu', 'ConfSched');
			});
            	}

            	$committeemembers = Reviewer::where('onprogramcommittee', 'T');

            	if ($author_committee_members->lists('email') != array()) {
            		$committeemembers = $committeemembers->whereNotIn('email', $author_committee_members->lists('email'));
            	}

            	$committeemembers = $committeemembers->get();

            	//$committeemembers = Reviewer::where('onprogramcommittee', 'T')->whereNotIn('email', $author_committee_members->lists('email'))->get();

            	foreach($committeemembers as $member) {
            		Mail::send('emails.registration.committee', compact('member', 'conference'), function($message) use ($member)
            		{
            			$message->to($member->email, $member->name_first . ' ' . $member->name_last)->subject('ConfSched Registration');
            			$message->from('noreply@cs-sr.academic.roanoke.edu', 'ConfSched');
            		});
            	}
	}

	public function getEditDetails() {
		$details = DB::table('details')->first();
		$name = $details->name;
		$image = $details->image;
		$about = $details->about;
		return View::make('details', compact('name', 'image', 'about'));
	}

	public function postEditDetails() {

		if (Input::has('conference_name')) {
			DB::table('details')->update(array('name' => Input::get('conference_name')));
			//Config::set('site.conference_name', Input::get('conference_name'));
		}
		if (Input::has('conference_about')) {
			DB::table('details')->update(array('about' => Input::get('conference_about')));
			//Config::set('site.conference_about', Input::get('conference_about'));
		}

		return Redirect::action('ConferenceController@getIndex');
	}

	public function getDetails() {
		$details = DB::table('details')->first();
		$name = $details->name;
		$image = $details->image;
		$about = $details->about;
		return View::make('about', compact('name', 'image', 'about'));
	}

	public function getIndex() {
		$name = '';
		$image = '';
		$about = '';

		$details = DB::table('details')->first();
		// $name = $details->name;
		// $image = $details->image;
		// $about = $details->about;
		$progress = DB::table('progress')->get();
		$current_step = DB::table('progress')->where('in_progress', true)->first();
		//DBug::DBug($progress);
		//DBug::DBug($current_step);
		$preplanning = DB::table('progress')->where('stage', 'preplanning')->first();
		$committeesourcing = DB::table('progress')->where('stage', 'committee sourcing')->first();
		$authorsourcing = DB::table('progress')->where('stage', 'author sourcing')->first();
		$scheduling = DB::table('progress')->where('stage', 'scheduling')->first();
		return View::make('index', compact('name', 'image', 'about', 'current_step', 'preplanning', 'committeesourcing', 'authorsourcing', 'scheduling'));
	}

	public function finalizePreplanning() {
		DB::table('progress')->where('stage', 'preplanning')->update(array('completed' => true, 'in_progress' => false));

		$this->populateAuthorsTable();

		// send emails to users
		$this->alertUsersToCreateAccounts();

		return Redirect::action('ConferenceController@getIndex');
	}

	public function startCommitteeSourcing() {
		DB::table('progress')->where('stage', 'committee sourcing')->update(array('in_progress' => true));

		$this->alertUsersCommitteeSourcing();

		return Redirect::action('ConferenceController@getIndex');
	}

	public function startAuthorSourcing() {
		DB::table('progress')->where('stage', 'author sourcing')->update(array('in_progress' => true));

		$this->alertUsersAuthorSourcing();

		return Redirect::action('ConferenceController@getIndex');
	}

	public function alertUsersCommitteeSourcing() {
		$users = User::where('committee', true)->get();

		foreach($users as $user) {
			Mail::send('emails.committeesourcing', compact('user'), function($message) use ($user) {
				$message->to($user->email);
				$message->subject('Committee Sourcing');
				$message->from('noreply@cs-sr.academic.roanoke.edu');
			});
		}
	}

	public function alertUsersAuthorSourcing() {
		$users = User::where('author', true)->get();

		foreach($users as $user) {
			Mail::send('emails.authorsourcing', compact('user'), function($message) use ($user) {
				$message->to($user->email);
				$message->subject('Author Sourcing');
				$message->from('noreply@cs-sr.academic.roanoke.edu');
			});
		}
	}

	public function finalizeCommitteeSourcing() {
		DB::table('progress')->where('stage', 'committee sourcing')->update(array('completed' => true, 'in_progress' => false));

		return Redirect::action('ConferenceController@getIndex');
	}

	public function finalizeAuthorSourcing() {
		DB::table('progress')->where('stage', 'author sourcing')->update(array('completed' => true, 'in_progress' => false));

		return Redirect::action('ConferenceController@getIndex');
	}

	public function startSchedule() {
		DB::table('progress')->where('stage', 'scheduling')->update(array('in_progress' => true));

		return Redirect::action('ConferenceController@getIndex');
	}

	public function startPreplanning() {
		DB::table('progress')->where('stage', 'preplanning')->update(array('in_progress' => true));

		return Redirect::action('ConferenceController@getIndex');
	}

	public function processInstall() {
		$user = new User;
		$user->first_name = Input::get('first_name');
		$user->last_name = Input::get('last_name');
		$user->email = Input::get('email');
		$user->username = Input::get('username');
		$user->password = Hash::make(Input::get('password'));
		$user->author = false;
		$user->committee = false;
		$user->admin = true;
		$user->save();

		Auth::login($user);

		DB::table('details')->insert(['name' => Input::get('conference_name')]);

		DB::table('progress')->insert(
			[
				['stage' => 'installation', 'completed' => true, 'in_progress' => false],
				['stage' => 'preplanning', 'completed' => false, 'in_progress' => false],
				['stage' => 'committee sourcing', 'completed' => false, 'in_progress' => false],
				['stage' => 'author sourcing', 'completed' => false, 'in_progress' => false],
				['stage' => 'scheduling', 'completed' => false, 'in_progress' => false]
			]);

		return Redirect::action('ConferenceController@getIndex');
	}

}
