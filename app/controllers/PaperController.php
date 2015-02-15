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

	/**
	 * Show the form for creating a new resource.
	 * GET /paper/create
	 *
	 * @return Response
	 */
	public function create()
	{
		if (! Input::has('') || ! Input::has() || ! Input::has() || ! Input::has()) {
			
		}

		$paper = new Paper;
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /paper
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /paper/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /paper/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /paper/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /paper/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}