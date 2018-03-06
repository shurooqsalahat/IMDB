<?php

namespace App\Http\Controllers;

use App\Films;
use App\ListsUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /*Add film to user list
     *
     * */
    public function addToList($id)
    {

        $film = Films::find($id);
       // $listfilm = ListsUser::find
        if ($film) {
            $list = new ListsUser;
            $list->user_id = Auth::user()->id;
            $list->film_id = $id;
            $list->save();
            $films = Films::all();
            return redirect(route('allFilms'))->with('successMsg', 'films Successfully Added To Your list');
        } else {
            $films = Films::all();
            return view('user/all_films', compact('films'))->with('errorMsg', 'films Not found ');
        }
    }

    public function showFilm($id)
    {
        if ($film = Films::find($id)) {

            return view('user/film_details', compact('film'));
        } else {
            $films = Films::all();

            return view('user/all_films', compact('films'));
        }
    }



    public function getFilms()
    {
        $imageArray = array();
        $films = Films::all();
        foreach ($films as $f) {
            foreach ($f->Media as $fm) {
                $ext = pathinfo($fm->path, PATHINFO_EXTENSION);
                if ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'gif') {
                    array_push($imageArray, $fm->path);
                }

            }

        }

        return view('user/all_films', compact('films', 'imageArray'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $lists = ListsUser::all();
        return view('user/list',compact('lists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
