@extends('layouts.user_res')
@section('content')
     <div class="container">
    @if(!empty($videoArray))
        @foreach($videoArray as $video)

            <div class="center">
            <video width="1000" height="400" controls>
                <source src="{{asset('films_trials').'//'.$video}}" type="video/mp4">
            </video>
        @endforeach
            </div>
    @endif
     </div>
    @endsection