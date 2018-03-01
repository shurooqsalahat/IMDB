@extends('layouts.res')
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


    <a style="margin-top: 30px;" href="{{route('films.create')}}" class="btn btn-success"> + Add New</a>
    <div class="header">
        <div class="row">

            @foreach ($films as $film)
                <div class="column">

                    <a class="btn btn-raised btn-primary btn-sm" href="{{ route('films.edit', $film->id) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> ||
                    <form method="POST" id="delete-form-{{ $film->id }}" action="{{ route('films.destroy',$film->id) }}" style="display: none;">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                    </form>
                    <button onclick="if(confirm('Are you Sure, You went to delete this?')){
                            event.preventDefault();
                            document.getElementById('delete-form-{{ $film->id }}').submit();
                            }else{
                            event.preventDefault();
                            }" class="btn btn-raised btn-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                </div>
                <div style="margin-top: 380px; " class="">

                </div>

            @endforeach

        </div>
    </div>
@endsection