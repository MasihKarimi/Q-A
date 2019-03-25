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

                                <h2 class="mt-0"><a href="{{$question->url}}">{{$question->title}}</a></h2>
                                <p class="lead">
                                    Asked By:
                                    <a href="{{$question->user->url}}"><i class="glyphicon glyphicon-user"></i> {{$question->user->name}}</a>
                                    <small class="text-muted"><i class="glyphicon glyphicon-time"></i> {{$question->created_at->diffForHumans()}}</small>
                                </p>
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
