@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="d-flex align-items-center">
                                <h2>{{$question->title}}</h2>
                                <div class="ml-auto">
                                    <a href="{{route('questions.index')}}" class="btn btn-default">Back to main page</a>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            {!! $question->body !!}
                        </div>
                    </div>
                </div>


        </div>
    </div>
@endsection
