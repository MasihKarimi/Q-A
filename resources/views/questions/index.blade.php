@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-primary">
                <div class="panel-heading">Questions List</div>

                <div class="panel-body">
                    @foreach($questions as $question)
                        <div class="media">
                            <div class="media-body">
                                <h3 class="mt-0">{{$question->title}}</h3>
                                <p>{{str_limit($question->body,200)}}</p>
                            </div>
                        </div>
                        <hr>
                 @endforeach
                    <center>
                    {{$questions->links()}}
                    </center>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
