{{ csrf_field() }}

<fieldset>
    <div class="col-md-5">

        <div class="form-group">
            {{ Form::label('firstname', ' Name')}}
            {{ Form::text('name', $film->name, ['class' => 'form-control'])}}


        </div>
        <div class="form-group">
            <select id="actors" name="actors[]" multiple class="form-control">
                @foreach ($allActors as $actor)
                    <option value="{{$actor->id}}"> {{$actor->name}} </option>
                @endforeach   
            </select>
        </div>
        <div class="form-group">

        </div>
        @if($actors)
            <div class="form-group">
                @foreach ($actors as $actor)
                    <p>{{$actor->name}}</p>
                @endforeach   
            </div>
        @endif
        <div class="form-group">
            {{ Form::label('image', ' Image')}}
            {{ Form::file('images[]', array('class'=>'file', 'multiple'),['class' => 'form-control'])}}
        </div>
        <div class="form-group">
            {{ Form::label('trial', ' Trials')}}
            {{ Form::file('trailers[]', array('class'=>'file', 'multiple'),['class' => 'form-control'])}}
        </div>

        <div class="form-group">
            {{ Form::label('Summary', ' Summary')}}
            {{ Form::textarea('information', $film->summary, ['class' => 'form-control'])}}
        </div>

        {{Form::submit('Submit' ,['class' => 'btn btn-success', ' pull-right'])}}
    </div>
    </div>
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