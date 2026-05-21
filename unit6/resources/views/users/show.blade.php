@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold">{{ $user->name }}</h1>
        <a href="/users" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">← Back</a>
    </div>

    <div class="bg-white p-8 rounded-lg shadow mb-8">
        <div class="mb-6">
            <p class="text-gray-600">Email</p>
            <p class="text-xl font-semibold">{{ $user->email }}</p>
        </div>
        <div class="mb-6">
            <p class="text-gray-600">Member Since</p>
            <p class="text-xl font-semibold">{{ $user->created_at->format('M d, Y') }}</p>
        </div>
    </div>

    <div class="bg-white p-8 rounded-lg shadow">
        <h2 class="text-2xl font-bold mb-4">Enrolled Courses ({{ $user->courses->count() }})</h2>
        
        @if($user->courses->isEmpty())
            <p class="text-gray-500">This user is not enrolled in any courses.</p>
        @else
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border p-3 text-left">Course Title</th>
                        <th class="border p-3 text-left">Enrolled At</th>
                        <th class="border p-3 text-left">Progress</th>
                        <th class="border p-3 text-left">Completed</th>
                        <th class="border p-3 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($user->courses as $course)
                    <tr class="hover:bg-gray-100">
                        <td class="border p-3">
                            <a href="/courses/{{ $course->id }}" class="text-blue-500 hover:underline">{{ $course->title }}</a>
                        </td>
                        <td class="border p-3">{{ $course->pivot->enrolled_at->format('M d, Y') }}</td>
                        <td class="border p-3">
                            <div class="w-32 bg-gray-200 rounded-full h-2">
                                <div class="bg-blue-500 h-2 rounded-full" style="width: {{ $course->pivot->progress }}%"></div>
                            </div>
                            <span class="text-sm">{{ $course->pivot->progress }}%</span>
                        </td>
                        <td class="border p-3">
                            @if($course->pivot->completed_at)
                                <span class="bg-green-200 px-2 py-1 rounded text-sm">✓ Completed</span>
                            @else
                                <span class="text-gray-500">In Progress</span>
                            @endif
                        </td>
                        <td class="border p-3">
                            <form action="/users/{{ $user->id }}/courses/{{ $course->id }}" method="POST" class="inline" onsubmit="return confirm('Remove from course?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded text-sm hover:bg-red-600">Remove</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection
