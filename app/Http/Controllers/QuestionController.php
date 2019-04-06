<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['expect'=> ['index','show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::with('user')->latest()->paginate(5);
        return view('questions.index',compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('questions.create');
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:questions|max:255',
            'body' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Store the blog post...

        $question = new Question();
        $question->title = $request->input('title');
        $question->body = $request->input('body');
        $question->user_id = Auth::id();
        $question->save();
        return redirect('questions');


    }


    public function show($slug)
    {
        $question = Question::where('slug',$slug)->first();
        return view('questions.show',compact('question'));
    }


    public function edit($id)
    {
        //policies
        $question = Question::findOrFail($id);
        $this->authorize('update',$question);
        return view('questions.create',compact('question'));


        //Gates

//        $question = Question::findOrFail($id);
//        if (Gate::allows('update-question',$question)){
//        return view('questions.create',compact('question'));
//        }
//        Session::flash('access','Sorry you can not edit this question');
//        return redirect()->back();


    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:questions|max:255',
            'body' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect('questions/create')
                ->withErrors($validator)
                ->withInput();
        }
       $question = Question::findOrFail($id);
        $question->title = $request->input('title');
        $question->body = $request->input('body');
        $question->user_id = Auth::id();
        $question->save();
        return redirect('questions');
    }


    public function destroy($id)
    {
        // policies
        $question = Question::findOrFail($id);
        $this->authorize('delete',$question);
        $question->delete();
        Session::flash('success','Question Successfully Deleted');
        return redirect()->back();
        //Gates
//        if (Gate::allows('delete-question',$question)){
//            $question->delete();
//            Session::flash('success','Question Successfully Deleted');
//            return redirect()->back();
//        }
//        Session::flash('access','Sorry you can not edit this question');
//        return redirect()->back();


    }
}
