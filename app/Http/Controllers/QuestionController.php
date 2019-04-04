<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = Question::findOrFail($id);
        return view('questions.create',compact('question'));
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question = Question::findOrFail($id);
        $question->delete();
        Session::flash('success','Question Successfully Deleted');
        return redirect()->back();
    }
}
