<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
    const ADMIN_EMAIL = "admin@mail.com";
    const NEW_TASK_SUBJECT = "New ToDo task";

    public function index()
    {
        $todos = Todo::all();

        return view('todos.index', compact('todos'));
    }

    public function store(Request $request)
    {
        $validatedData = unserialize($_POST['message']);

        Todo::create($validatedData);

        return redirect()->route('todos.index');
    }

    public function send(Request $request, int $todoId)
    {
        $todo = Todo::getById($todoId);
        mail(self::ADMIN_EMAIL, self::NEW_TASK_SUBJECT, $todo);
    }

    public function update(Request $request, int $todoId)
    {
        $todo = Todo::find($todoId);

        $todo->update([
            'completed' => $request->has('completed')
        ]);

        return redirect()->route('todos.index');
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();

        return redirect()->route('todos.index');
    }
}
