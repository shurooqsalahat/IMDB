@extends('layouts.user_res')
@section('content')

    <div class="container" style="width: 50%; margin-left: 200px; margin-top: 50px;">
        @if($list)
            @foreach($list as $li)
                <div class="col"> {{$li}} <a class="btn" style="margin-left: 400px;"> delete</a></div>
                <hr>
                @endforeach

            @endif
    </div>
    @endsection