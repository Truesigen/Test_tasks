<x-mail::message>
    Hello, {{ $user->first_name }}!
    Task status «{{ $task->title }}» has been updated.


    <x-mail::panel>
        new status: {{ ucfirst($task->status) }}
        {{$user->id}} ......... {{$task->assigned_to}} ......... {{$task->created_by}}
    </x-mail::panel>

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>