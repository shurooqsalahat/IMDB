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
        if (Auth::check() && Auth::user()->is_admin == 1) {
            $films = Films::all();
            return view('film/index', ['films' => $films]);
        } else {
            return redirect(route('out'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::check() && $this->authorize('create', Films::class)) {
            $allActors = Actors::all();
            $actors = new ActorsFilms();
            $film = new Films;
            return view('film/create', compact('film', 'allActors', 'actors'));
        } else {
            return redirect(route('out'));
        }
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
            foreach ($request->actors as $actor) {
                $fi = Films::find($currentId);
                $fi->actors()->attach($actor, ['admin_id' => Auth::user()->id]);
            }
        }
        //get image and store it

        if ($request->file('images')) {
            foreach ($request->file('images') as $image) {
                $fi = Films::find($currentId);
                $input['imageName'] = helper::storeImage($image, '/films_thumbnail', '/films_uploads');
                $fm = new FilmsMedia(['admin_id' => Auth::user()->id, 'path' => $input['imageName']]);
                $fi->media()->save($fm);
            }
        } else {

            $input['imageName'] = 'default.png';
            $fm = new FilmsMedia(['admin_id' => Auth::user()->id, 'path' => $input['imageName']]);
            $fm->media()->save($fm);

        }


        //get trailers and store it
        if ($request->file('trailers')) {
            foreach ($request->file('trailers') as $trialer) {

                $input['trialName'] = helper::storeTrailers($trialer, '/films_trials');
                $fi = Films::find($currentId);
                $fm = new FilmsMedia(['admin_id' => Auth::user()->id, 'path' => $input['trialName']]);
                $fi->media()->save($fm);

            }

        } else {
            //default image
            $input['trialName'] = 'default.png';
            $fi = Films::find($currentId);
            $fm = new FilmsMedia(['admin_id' => Auth::user()->id, 'path' => $input['trialName']]);
            $fi->media()->save($fm);
        }


        return redirect(route('films.index'))->with('successMsg', 'Student Successfully Added');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::check() && $this->authorize('update', Films::find($id))) {
            if ($film = Films::find($id)) {
                $af = Films::find($id);//actors for this film
                $imageArray = array();
                $videoArray = array();
                $actorsArray = array();
                foreach ($af->actors as $a) {
                    array_push($actorsArray, $a->name);
                }
                foreach ($af->media as $b) {
                    $ext = pathinfo($b->path, PATHINFO_EXTENSION);
                    if ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'gif') {
                        array_push($imageArray, $b->path);
                    } else {
                        array_push($videoArray, $b->path);
                    }
                }
                $allActors = Actors::all();
                return view('film/edit', compact('film', 'imageArray', 'allActors', 'actorsArray', 'videoArray'));
            } else {
                return redirect(route('films.index'))->with('errorMsg', 'This ID is not exist please try again');
            }
        } else {
            return redirect(route('out'));
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
        $film = Films::find($id);
        if (Auth::check() && $this->authorize('update', Films::find($id))) {

            if ($film) {
                $film->admin_id = Auth::user()->id;
                $film->name = $request->name;
                $film->summary = $request->information;
                $film->save();
                $currentId = $film->id;
                //get actors and store it
                if ($request->actors) {
                    foreach ($request->actors as $actor) {

                    }
                }
                //get image and store it
                $fm = new FilmsMedia;
                if ($request->file('images')) {
                    foreach ($request->file('images') as $image) {
                        $fi = Films::find($currentId);
                        $input['imageName'] = helper::storeImage($image, '/films_thumbnail', '/films_uploads');
                        $fm = new FilmsMedia(['admin_id' => Auth::user()->id, 'path' => $input['imageName']]);
                        $fi->media()->save($fm);
                    }
                }
                //get trailers and store it
                if ($request->file('trailers')) {
                    foreach ($request->file('trailers') as $trialer) {
                        $input['trialName'] = helper::storeTrailers($trialer, '/films_trials');
                        $fi = Films::find($currentId);
                        $fm = new FilmsMedia(['admin_id' => Auth::user()->id, 'path' => $input['trialName']]);
                        $fi->media()->save($fm);

                    }

                }
                return redirect(route('films.index'))->with('successMsg', 'Films Successfully updated');

            } else {
                return redirect(route('films.index'))->with('errorMsg', 'This Film iss not exist ');
            }
        }else{
            redirect(route('out'));
        }

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::check() && $this->authorize('delete', Films::find($id))) {
            if (Films::find($id)->delete()) {
                return redirect(route('films.index'))->with('successMsg', 'Films Successfully Delete');
            } else {
                return redirect(route('films.index'))->with('errorMsg', 'Something Error please try again');
            }
        } else {
            return redirect(route('out'));
        }
    }


}
