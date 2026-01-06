<x-mail::message>
    Hello, {{ $user->first_name }}!
    Project status «{{ $project->name }}» has been updated.


    <x-mail::panel>
        new status: {{ ucfirst($project->status) }}
    </x-mail::panel>

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>