<?php

namespace App\Http\Controllers;

use App\Actors;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBlogPost;
use File;
use Auth;
use Image;

class ActorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $actors = Actors::all();
        return view('actors', ['actors' => $actors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $actor = new actors;
        return view('add_actors', compact('actor'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBlogPost $request)
    {
        $actor = new Actors;

        if ($image = $request->file('image')) {
            $image = $request->file('image');
            $input['imageName'] = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/thumbnail');
            $thumb_img = Image::make($image->getRealPath())->resize(300, 200);
            $thumb_img->save($destinationPath.'/'. $input['imageName']);
            $destinationPath = public_path('/uploads');
            $image->move($destinationPath, $input['imageName']);
            $actor->image_path = $input['imageName'];

        } else {
            $actor->image_path = '1.png';
        }


        $actor->admin_id = Auth::user()->id;
        $actor->name = $request->name;
        $actor->information = $request->information;
        $actor->save();
        return redirect(route('actors.index'))->with('successMsg', 'Student Successfully Added');
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
        if ($actor = Actors::find($id)) {
            return view('edit_actors', compact('actor'));
        } else {
            return redirect(route('actors.index'))->with('errorMsg', 'This ID is not exist please try again');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreBlogPost $request, $id)
    {
        $actor = Actors::find($id);
        if ($image = $request->file('image')) {
            $image = $request->file('image');
            $input['imageName'] = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/thumbnail');
            $thumb_img = Image::make($image->getRealPath())->resize(300,200);
            $thumb_img->save($destinationPath . '/' . $input['imageName']);
            $destinationPath = public_path('/uploads');
            $image->move($destinationPath, $input['imageName']);
            $actor->image_path = $input['imageName'];
        }


        $actor->admin_id = Auth::user()->id;
        $actor->name = $request->name;
        $actor->information = $request->information;
        $actor->save();
        return redirect(route('actors.index'))->with('successMsg', 'Student Successfully Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Actors::find($id)->delete()) {
            return redirect(route('actors.index'))->with('successMsg', 'Student Successfully Delete');
        } else {
            return redirect(route('actors.index'))->with('errorMsg', 'Something Error please try again');
        }
    }
}
