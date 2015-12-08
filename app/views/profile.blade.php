@extends('layouts.master')

@section('content')
    <div clas="container">
        <h1>{{$profile["email"]}}</h1><span><a href='profile/logout'>Log Out</a></span>
        {{Form::open(['route'=>'profile.store', 'files' => true])}}
        <div class="row">
            <div class="col-md-4">
                {{Form::label('noteText', 'Notes')}}
                <br />
                {{Form::textarea('notes',$profile["notes"])}}
            </div>

            <div class="col-md-2">
                {{Form::label('linkText', 'Links')}}
                @for ($i = 0, $max = count($profile["links"]), $minusOne = $max - 1, $plusOne = $max + 1; $i < $max; $i++)
                    @if($profile["links"][$i] != "")
                        <a href="{{$profile["links"][$i]}}">
                            {{Form::text("link$i",$profile["links"][$i])}}
                        </a>
                    @endif
                    @if($i == $minusOne)
                        {{Form::text("link$max")}}
                        {{Form::text("link$plusOne")}}
                    @endif
                @endfor
            </div>

            <div class="col-md-3">
                {{Form::label('imageUpload', 'Image')}}
                 <br />
                {{Form::file('photo')}}
                <?php
                    $imageArray = $profile["image"];
                    for($i = 1,$temp = 0; $i < count($imageArray); $i++,$temp++){
                        if($imageArray[$i] != ""){
                            echo '<img src="data:image/jpeg;base64,' . base64_encode( $imageArray[$i] ).'"/>';
                            echo "<input type='checkbox' name=\"delete$temp\">delete<br>";
                        }
                    }
                ?>
            </div>

            <div class="col-md-3">
                {{Form::label('tbdText', 'TBD')}}
                <br />
                {{Form::textarea('tbd',$profile["tbd"])}}
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                {{Form::submit('Submit')}}
            </div>
        </div>
        {{Form::close()}}
    </div>
@endsection