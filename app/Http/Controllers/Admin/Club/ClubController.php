<?php

namespace App\Http\Controllers\Admin\Club;

use Redirect;
use App\Http\Requests;
use App\Models\Club;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

class ClubController extends AdminController
{
	/**
	 * Display a listing of club_user.
	 *
	 * @return Response
	 */
	public function index()
	{ 
		save_resource_url();
                
                $user = \Auth::user();
               
                if($user->hasRole('admin')){
                    $club = Club::all();
                }else{                   
                    $club = Club::where('created_by',$user->id)->get();
                }

		return $this->view('clubs.club.index')->with('items', $club);
	}

	/**
	 * Show the form for creating a new club_user.
	 *
	 * @return Response
	 */
	public function create()
	{
		return $this->view('clubs.club.create_edit');
	}

	/**
	 * Store a newly created club_user in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$attributes = request()->validate(Club::$rules, Club::$messages);
              
        $subscriber = $this->createEntry(Club::class, $attributes);

        return redirect_to_resource();
	}

	/**
	 * Display the specified club_user.
	 *
	 * @param
	 * @return Response
	 */
//	public function show(Club $club)
//	{
//		return $this->view('clubs.club.show')->with('item', $club);
//	}

	/**
	 * Show the form for editing the specified club_user.
	 *
	 * @param 
     * @return Response
     */
    public function edit(Club $club)
	{
		return $this->view('clubs.club.create_edit')->with('item', $club);
	}

	/**
	 * Update the specified club_user in storage.
	 *
	 * @param 
     * @return Response
     */
    public function update(Club $club)
	{  
		$attributes = request()->validate(Club::$rules, Club::$messages);

        $subscriber = $this->updateEntry($club, $attributes);

        return redirect_to_resource();
	}

	/**
	 * Remove the specified club_user from storage.
	 *
	 * @param 
	 * @return Response
	 */
	public function destroy(Club $club)
	{
		$this->deleteEntry($club, request());

        return redirect_to_resource();
	}
}
