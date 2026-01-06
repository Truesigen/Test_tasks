<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Task assigned</title>
</head>

<body>
    <p>Hello, {{ $user->first_name }}!</p>

    <h2>You are assigned to a task 📝</h2>

    <p><strong>Task:</strong> {{ $task->title }}</p>

    @if($task->description)
    <p><strong>description:</strong> {{ $task->description }}</p>
    @endif

    @if($task->due_date)
    <p><strong>due date:</strong> {{ $task->due_date }}</p>
    @endif

    <p>
        <a href="{{ $url }}">to the task</a>
    </p>

    <p>— {{ config('app.name') }}</p>
</body>

</html>