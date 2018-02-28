@extends('layouts.res')
@section('content')
    <div class="container">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger " role="alert">
                    <strong>Oh snap!</strong> {{ $error }}
                </div>
            @endforeach
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="">
                    {{Form::open(array('route' => 'actors.store' ,  'files' => true),['class'=>'form-horizontal'] )}}
                    @include('layouts.actors_form')
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection