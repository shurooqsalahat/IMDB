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
use Image;
use DB;

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

        return view('films', ['films' => $films]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $allActors = Actors::all();
        $film = new Films;
        return view('add_films', compact('film', 'allActors'));
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
                $Af->store(Auth::user()->id, $currentId, $actor);
            }
        }
        //get image and store it
        $fm = new FilmsMedia;
        if ($request->file('images')) {
            foreach ($request->file('images') as $image) {
                $input['imageName'] = rand(10, 100000) . time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/films_thumbnail');
                $thumb_img = Image::make($image->getRealPath())->resize(300, 200);
                $thumb_img->save($destinationPath . '/' . $input['imageName']);//move resizable image
                $destinationPath = public_path('/films_uploads');//move original image
                $image->move($destinationPath, $input['imageName']);
                $fm->store(Auth::user()->id, $currentId, $input['imageName']);

            }
        } else {
            $input['imageName'] = '1.png';
            $fm->store(Auth::user()->id, $currentId, $input['imageName']);
        }


        //get trailers and store it
        if ($request->file('trailers')) {
            foreach ($request->file('trailers') as $trial) {
                $input['trialName'] = rand(10, 100000) . time() . '.' . $trial->getClientOriginalExtension();
                $destinationPath = public_path('/films_trials');
                $trial->move($destinationPath, $input['trialName']);
                $fm->store(Auth::user()->id, $currentId, $input['trialName']);
            }

        } else {
            //default image
            $input['trialName'] = '11.png';
            $fm->store(Auth::user()->id, $currentId, $input['trialName']);
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
            $actors = ActorsFilms::where('film_id', $id)->get();//actors for this film
            $media =FilmsMedia::where('film_id',$id)->get();
            $allActors = Actors::all();
            return view('edit_films',  compact('film', 'allActors' , 'actors'));
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
                $input['imageName'] = rand(10, 100000) . time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/films_thumbnail');
                $thumb_img = Image::make($image->getRealPath())->resize(300, 200);
                $thumb_img->save($destinationPath . '/' . $input['imageName']);//move resizable image
                $destinationPath = public_path('/films_uploads');//move original image
                $image->move($destinationPath, $input['imageName']);
                $fm->store(Auth::user()->id, $currentId, $input['imageName']);

            }
        } else {
            $input['imageName'] = '1.png';
            $fm->store(Auth::user()->id, $currentId, $input['imageName']);
        }


        //get trailers and store it
        if ($request->file('trailers')) {
            foreach ($request->file('trailers') as $trial) {
                $input['trialName'] = rand(10, 100000) . time() . '.' . $trial->getClientOriginalExtension();
                $destinationPath = public_path('/films_trials');
                $trial->move($destinationPath, $input['trialName']);
                $fm->store(Auth::user()->id, $currentId, $input['trialName']);
            }

        } else {
            //default image
            $input['trialName'] = '11.png';
            $fm->store(Auth::user()->id, $currentId, $input['trialName']);
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
        if (Films::find($id)->delete()) {
            return redirect(route('films.index'))->with('successMsg', 'Films Successfully Delete');
        } else {
            return redirect(route('films.index'))->with('errorMsg', 'Something Error please try again');
        }
    }


}
