@extends('layouts.user_res')
@section('content')

    <div class="container" style="width: 50%; margin-left: 200px; margin-top: 50px;">
        @if($list)
            @foreach($list as $li)
                <div class="col-lg-4"> {{$li}}</div>
                <div class="col-lg-4"> <a href="#">delete</a>   </div>

                <hr>
                @endforeach

            @endif
    </div>
    @endsection