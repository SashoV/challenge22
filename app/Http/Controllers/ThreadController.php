<?php

namespace App\Http\Controllers;

use App\Thread;
use App\Category;
use App\Comment;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateThreadRequest;
use Illuminate\Http\Request;

class ThreadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $approvedThreads = Thread::where('is_approved', 1)->get();
        $categories = Category::all();
        return view('home', ['threads' => $approvedThreads, 'categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateThreadRequest $request)
    {
        $input = $request->all();

        $thread = new Thread();
        $thread->title = $input['title'];
        $thread->image = $input['image'];
        $thread->description = $input['description'];
        $thread->user_id = Auth::user()->id;
        $thread->category_id = $input['category'];
        $thread->save();

        return redirect(route('home'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $thread = Thread::with('comments')->findOrFail($id);
        return view('thread', ['thread' => $thread]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $thread = Thread::findOrFail($id);
        $categories = Category::all();
        return view('edit', ['thread' => $thread, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateThreadRequest $request, $id)
    {
        $input = $request->all();

        $thread = Thread::findOrFail($id);
        $thread->title = $input['title'];
        $thread->image = $input['image'];
        $thread->description = $input['description'];
        $thread->category_id = $input['category'];
        $thread->save();

        return redirect(route('home'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $thread = Thread::findOrFail($id);
        $thread->delete();

        return redirect(route('home'));
    }
}
