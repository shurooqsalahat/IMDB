<?php

namespace App\Http\Controllers;

use App\Actors;
use App\ActorsFilms;
use App\Films;
use App\FilmsMedia;
use App\Http\Requests\StoreBlogPost;
use Illuminate\Http\Request;
use File;
use Auth;
use App\helper;
use Illuminate\Support\Facades\App;

class FilmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $films = Films::all();
        return view('film/films', ['films' => $films]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $allActors = Actors::all();
        $actors = new ActorsFilms();
        $film = new Films;
        return view('film/add_films', compact('film', 'allActors', 'actors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBlogPost $request)
    {
        $film = new Films;
        $film->admin_id = Auth::user()->id;
        $film->name = $request->name;
        $film->summary = $request->information;
        $film->save();
        $currentId = $film->id;
        //get actors and store it
        if ($request->actors) {
            $Af = new ActorsFilms;
            foreach ($request->actors as $actor) {
                $Af->film_id =$currentId;
                $Af->actor_id =$actor;
                $Af->admin_id =Auth::user()->id;
                $Af->save();
            }
        }
        //get image and store it
        $fm = new FilmsMedia;
        if ($request->file('images')) {

            foreach ($request->file('images') as $image) {
                $input['imageName'] = helper::storeImage($image, '/films_thumbnail', '/films_uploads');
                $fm->admin_id =Auth::user()->id;
                $fm->film_id = $currentId;
                $fm->path = $input['imageName'];
                $fm->save();
            }
        } else {
            $input['imageName'] = '1.png';
            $fm->admin_id =Auth::user()->id;
            $fm->film_id = $currentId;
            $fm->path = $input['imageName'];
            $fm->save();
        }


        //get trailers and store it
        if ($request->file('trailers')) {
            foreach ($request->file('trailers') as $trialer) {
                $input['trialName'] = helper::storeTrailers($trialer, '/films_trials');
                $fm->admin_id =Auth::user()->id;
                $fm->film_id = $currentId;
                $fm->path =$input['trialName'];
                $fm->save();

            }

        } else {
            //default image
            $input['trialName'] = '11.png';
            $fm->admin_id =Auth::user()->id;
            $fm->film_id = $currentId;
            $fm->path =$input['trialName'];
            $fm->save();
        }


        return redirect(route('films.index'))->with('successMsg', 'Student Successfully Added');
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

        if ($film = Films::find($id)) {
            $af = Films::find($id);//actors for this film
            $imageArray = array();
            $videoArray = array();
            $actorsArray=array();
            foreach ($af->Actors as $a) {
             array_push(  $actorsArray,$a->name);
            }
            foreach ($af->Media as $b) {
                $ext = pathinfo($b->path, PATHINFO_EXTENSION);
                if($ext=='jpg' ||$ext=='jpeg' ||$ext=='png'||$ext=='gif'){
                    array_push(  $imageArray,$b->path);
                }
                else{
                    array_push(  $videoArray,$b->path);
                }
            }
              $allActors = Actors::all();
            return view('film/edit_films', compact('film', 'imageArray', 'allActors' , 'actorsArray','videoArray'));
        } else {
            return redirect(route('films.index'))->with('errorMsg', 'This ID is not exist please try again');
        }
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
        $film = new Films;
        $film->admin_id = Auth::user()->id;
        $film->name = $request->name;
        $film->summary = $request->information;
        $film->save();
        $currentId = $film->id;
        //get actors and store it
        dd($request->actors);
        if ($request->actors) {
            $Af = new ActorsFilms;
            foreach ($request->actors as $actor) {

            $Af->store(Auth::user()->id, $currentId, $actor);
            }
        }
        //get image and store it
        $fm = new FilmsMedia;
        if ($request->file('images')) {
            foreach ($request->file('images') as $image) {
                $input['imageName'] = helper::storeImage($image, '/films_thumbnail', '/films_uploads');
                $fm->store(Auth::user()->id, $currentId, $input['imageName']);
            }
        } else {
            $input['imageName'] = '1.png';
            $fm->store(Auth::user()->id, $currentId, $input['imageName']);
        }
        //get trailers and store it
        if ($request->file('trailers')) {
            foreach ($request->file('trailers') as $trialer) {
                $input['trialName'] = helper::storeTrailers($trialer, '/films_trials');
                $fm->store(Auth::user()->id, $currentId, $input['trialName']);
            }

        } else {
            //default image
            $input['trialName'] = '11.png';
            $fm->store(Auth::user()->id, $currentId, $input['trialName']);
        }
        return redirect(route('films.index'))->with('successMsg', 'Films Successfully updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Films::find($id)->delete()) {
            return redirect(route('films.index'))->with('successMsg', 'Films Successfully Delete');
        } else {
            return redirect(route('films.index'))->with('errorMsg', 'Something Error please try again');
        }
    }


}
