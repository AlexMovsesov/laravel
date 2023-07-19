<!DOCTYPE html>
<html>
<head>
    <title>Todo List</title>
</head>
<body>
<h1>Todo List</h1>

<form method="POST" action="{{ route('todos.store') }}">
    @csrf
    <input type="text" name="title" placeholder="Enter a task" required>
    <button type="submit">Add Task</button>
</form>

<ul>
    @foreach ($todos as $todo)
        <li>
            <form method="POST" action="{{ route('todos.update', $todo) }}">
                @csrf
                @method('PUT')
                <input type="checkbox" name="completed" onChange="this.form.submit()" {{ $todo->completed ? 'checked' : '' }}>
                {{ $todo->title }}
            </form>

            <form method="POST" action="{{ route('todos.destroy', $todo) }}">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        </li>
    @endforeach
</ul>
</body>
</html>
