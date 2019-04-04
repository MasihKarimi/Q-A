@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="d-flex align-items-center">
                        <h3>All Questions</h3>
                        <div class="ml-auto">
                            <a href="{{route('questions.create')}}" class="btn btn-default">Ask Question</a>
                        </div>
                    </div>


                </div>

                <div class="panel-body">
                    @foreach($questions as $question)

                        <div class="media">
                            <div class="d-flex flex-column counters ">
                                <div class="vote">
                                    <strong>{{$question->votes}}</strong> {{str_plural('vote',$question->votes)}}
                                </div>

                                @if($question->answers==0)
                                <div class="answer notanswered">
                                    <strong>{{$question->answers}}</strong> Not Answered Yet
                                </div>
                                    @else
                                    <div class="answer answered">
                                        <strong>{{$question->answers}}</strong> {{str_plural('answer',$question->answers)}}
                                    </div>
                                @endif
                                <div class="view">
                                   <strong> {{$question->views }}</strong>{{str_plural('view',$question->answers)}}
                                </div>
                            </div>
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
