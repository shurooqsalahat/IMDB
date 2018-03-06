@extends('layouts.user_res')
@section('content')

    <div class="container" style="width: 50%; margin-left: 200px; margin-top: 50px;">
        @foreach ($lists as $list)
            <div class="col">
                <a href="{{route('showFilm', $list->id)}}"> {{$list->List->film_id}} </a>

            </div>
            <hr>
        @endforeach
    </div>
    @endsection