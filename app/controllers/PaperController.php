<?php

class PaperController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /paper
	 *
	 * @return Response
	 */
	public function index()
	{
		$paper = Paper::all();
		return Response::json($paper->toJson(), 200);
	}

}
