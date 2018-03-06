

@extends('layouts.user_res')
@section('content')

    <div class="container" >
        <div class="col-md-5">
            <div class="form-group">

             Name :  {{ $film->name}}
            </div>

            <div class="form-group" >
                @if(!empty($actorsArray))
                    @foreach($actorsArray as $act)
                       Actors : <p class="">{{$act}} </p>
                    @endforeach
                @endif
            </div>
            <div class="form-group">
                @if(!empty($imageArray))
                    @foreach($imageArray as $image)
                    <img src="{{asset('films_uploads').'//'.$image}}">
                    @endforeach
                @endif
                @if(!empty($videoArray))
                        @foreach($videoArray as $video)

                        <video width="400" height="400" controls>
                        <source src="{{asset('films_trials').'//'.$video}}" type="video/mp4">
                    </video>
                       @endforeach

                @endif
            </div>


            <div class="form-group">

              Summary:  {{$film->summary}}
            </div>




    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#actors').multiselect({
                nonSelectedText: 'Select Language'
            });
        });
    </script>


    </fieldset>
    </div>
@endsection

