<?php

namespace App\Http\Controllers;

use App\Films;
use App\Actors;
use App\ListsUser;
use App\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /*Add film to user list
     * args : film id
     * */
    public function addToList($id)
    {
        $film = Films::find($id);
        if ($film) {
            $film->lists()->attach( Auth::user()->id);
            $films = Films::all();
            return redirect(route('allFilms'))->with('successMsg', 'films Successfully Added To Your list');
        } else {

            return redirect(route('allFilms'))->with('errorMsg', 'Something error !');
        }
    }

    /*show film deatials
     * args : film id
     * */
    public function showFilm($id)
    {
        if ($film = Films::find($id)) {
            $af = Films::find($id);//actors for this film
            $imageArray = array();
            $videoArray = array();
            $actorsArray = array();
            foreach ($af->Actors as $a) {
                array_push($actorsArray, $a->name);
            }
            foreach ($af->Media as $b) {
                $ext = pathinfo($b->path, PATHINFO_EXTENSION);
                if ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'gif') {
                    array_push($imageArray, $b->path);
                } else {
                    array_push($videoArray, $b->path);
                }

            }
            $allActors = Actors::all();
            return view('user/film_details', compact('film', 'imageArray', 'allActors', 'actorsArray', 'videoArray'));
        }
    }


    /*get all films
    *
    * */
    public function getFilms()
    {
        $imageArray = array();
        $films = Films::all();
       return view('user/all_films', compact('films'));
    }

    /*show user lists
     * args : user id
     * */
    public function showlist($user_id)
    {   $user = Users::find($user_id);
        $list = array();
        $idArray = array();
        foreach ($user->Lists as $b) {
            $film = Films::find($b->film_id);
            array_push($idArray, $b->film_id);
            array_push($list, $film->name);
        }
        return view('user/list', compact('list','idArray'));
    }
    /*
     * show film trailer
     * args : film id
     * */
    public function showTrailer($film_id)
    {
        $videoArray = array();
        $film = Films::find($film_id);
        if ($film) {
            foreach ($film->Media as $fm) {
                $ext = pathinfo($fm->path, PATHINFO_EXTENSION);

                if ($ext == 'mp4') {
                    array_push($videoArray, $fm->path);
                }
            }
            return view('user/Trailer', compact('videoArray'));
        }
        else{
            return redirect(route('allFilms'))->with('errorMsg', 'Something error !');

        }
    }

    public function deleteList($list_id){

    }
}
