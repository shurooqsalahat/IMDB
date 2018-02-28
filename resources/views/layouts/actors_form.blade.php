{{ csrf_field() }}
<fieldset>
    <div class="col-md-5">
        <h3 style="margin-bottom: 25px; text-align: center;">Add Actors</h3>
        <div class="form-group">
            {{ Form::label('firstname', ' Name')}}
            {{ Form::text('name', $actor->name, ['class' => 'form-control'])}}


        </div>
        <div class="form-group">
            {{ Form::label('image', ' Image')}}
            {{ Form::file('image',['class' => 'form-control'])}}
        </div>
        @if($actor->image_path!=null)
            <div class="form-group">
                <img src="{{  asset('uploads').'//'.$actor->image_path }}" style="width:100%">
            </div>
        @endif
        <div class="form-group">
            {{ Form::label('Information', ' Information')}}
            {{ Form::textarea('information', $actor->information, ['class' => 'form-control'])}}
        </div>

        {{Form::submit('Submit' ,['class' => 'btn btn-success', ' pull-right'])}}
    </div>
    </div>
    </div>

    </div>
</fieldset>