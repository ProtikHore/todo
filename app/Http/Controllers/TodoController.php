<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Todo;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TodoController extends Controller
{
    public function index($id)
    {
        $title = 'Todo List';
        $todoData = Todo::with('user')->where('user_id', $id)->orderBy('id', 'desc')->get();
        return view('todo.index', compact('title', 'todoData'));
    }

    public function save(TodoRequest $request)
    {
        $todo = $request->get('id') === null ? new Todo() : Todo::find($request->get('id'));
        $todo->user_id =  session('id');
        $todo->todo = $request->get('todo');
        $todo->status = 'Active';
        $todo->created_by = session('id');
        $todo->save();
        $todoData = Todo::where('user_id', session('id'))->orderBy('id', 'desc')->get();
        return response()->json($todoData);
    }

    public function update(Request $request)
    {
        Todo::where('id', $request->get('id'))->update(['status'=> $request->get('status')]);
        $todoData = Todo::where('user_id', session('id'))->orderBy('id', 'desc')->get();
        return response()->json($todoData);
    }

    public function showData(Request  $request)
    {
        if($request->get('status') === 'all') {
            $data = Todo::where('user_id', session('id'))->orderBy('id', 'desc')->get();
        } else {
            $data = Todo::where('user_id', session('id'))->where('status', $request->get('status'))->orderBy('id', 'desc')->get();
        }
        return response()->json($data);
    }
}
