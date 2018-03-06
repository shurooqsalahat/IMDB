@extends('layouts.user_res')
@section('content')
    @if (session('successMsg'))
        <div class=" alert-success" role="alert">
            <strong>Well done!</strong> {{ session('successMsg') }}
        </div>
    @endif
    @if (session('errorMsg'))
        <div class=" alert-danger" role="alert">
            <strong>Error !</strong> {{ session('errorMsg') }}
        </div>
    @endif
    <div class="container" style="width: 50%; margin-left: 200px; margin-top: 50px;">
        @foreach ($films as $film)
       <div class="col">
         <a href="{{route('showFilm', $film->id)}}"> {{$film->name}} </a>
           <div>  <a href="{{route('add',$film->id)}}" class="btn btn-info"style="font-size: 10px;"> add To list</a>  <a href="{{route('showTrailer',$film->id)}}" class="btn btn-default" style="font-size: 10px;">show Trailer</a>   </div>
       </div>
            <hr>
        @endforeach
    </div>
    @endsection