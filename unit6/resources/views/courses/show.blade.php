@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold">{{ $course->title }}</h1>
        <a href="/courses" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">← Back</a>
    </div>

    <div class="bg-white p-8 rounded-lg shadow mb-8">
        <div class="grid grid-cols-2 gap-6 mb-6">
            <div>
                <p class="text-gray-600">Instructor</p>
                <p class="text-xl font-semibold">{{ $course->instructor ?? 'N/A' }}</p>
            </div>
            <div>
                <p class="text-gray-600">Level</p>
                <p class="text-xl font-semibold"><span class="bg-blue-200 px-2 py-1 rounded">{{ $course->level }}</span></p>
            </div>
            <div>
                <p class="text-gray-600">Duration</p>
                <p class="text-xl font-semibold">{{ $course->duration_hours }} hours</p>
            </div>
            <div>
                <p class="text-gray-600">Price</p>
                <p class="text-xl font-semibold">${{ $course->price }}</p>
            </div>
            <div>
                <p class="text-gray-600">Status</p>
                <p class="text-xl font-semibold">
                    @if($course->status === 'Active')
                        <span class="bg-green-200 px-2 py-1 rounded">Active</span>
                    @elseif($course->status === 'Inactive')
                        <span class="bg-red-200 px-2 py-1 rounded">Inactive</span>
                    @else
                        <span class="bg-yellow-200 px-2 py-1 rounded">Draft</span>
                    @endif
                </p>
            </div>
            <div>
                <p class="text-gray-600">Enrolled Users</p>
                <p class="text-xl font-semibold">{{ $course->users->count() }}</p>
            </div>
        </div>

        <div class="mb-6">
            <h3 class="text-lg font-bold mb-2">Description</h3>
            <p class="text-gray-700">{{ $course->description ?? 'No description available.' }}</p>
        </div>

        <a href="/courses/{{ $course->id }}/edit" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Edit Course</a>
    </div>

    <div class="bg-white p-8 rounded-lg shadow">
        <h2 class="text-2xl font-bold mb-4">Enrolled Users</h2>
        @if($course->users->isEmpty())
            <p class="text-gray-500">No users enrolled in this course yet.</p>
        @else
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border p-2 text-left">Name</th>
                        <th class="border p-2 text-left">Email</th>
                        <th class="border p-2 text-left">Enrolled At</th>
                        <th class="border p-2 text-left">Progress</th>
                        <th class="border p-2 text-left">Completed</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($course->users as $user)
                    <tr class="hover:bg-gray-100">
                        <td class="border p-2">{{ $user->name }}</td>
                        <td class="border p-2">{{ $user->email }}</td>
                        <td class="border p-2">{{ $user->pivot->enrolled_at->format('M d, Y') }}</td>
                        <td class="border p-2">
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-blue-500 h-2 rounded-full" style="width: {{ $user->pivot->progress }}%"></div>
                            </div>
                            <span class="text-sm">{{ $user->pivot->progress }}%</span>
                        </td>
                        <td class="border p-2">
                            @if($user->pivot->completed_at)
                                <span class="bg-green-200 px-2 py-1 rounded text-sm">✓ Completed</span>
                            @else
                                <span class="text-gray-500">In Progress</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection
