@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="d-flex align-items-center">
                            <h3>Ask New Questions</h3>
                            <div class="ml-auto">
                                <a href="{{route('questions.index')}}" class="btn btn-default">Back to main page</a>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">

                            @foreach($errors->all() as $error)
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong>Oops</strong> {{$error}}
                        </div>
                            @endforeach

                        <form action="{{route('questions.store')}}" method="post" role="form">
                           {{csrf_field()}}

                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" name="title" id="title" placeholder="Questions Title">
                            </div>
                            <div class="form-group">
                                <label for="body">Body</label>
                                <textarea name="body" id="body" cols="30" rows="10" placeholder="Explain your question" class="form-control"></textarea>
                            </div>
                           <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
