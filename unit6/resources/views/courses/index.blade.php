@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold">Courses</h1>
        <a href="/courses/create" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">+ Create Course</a>
    </div>

    @if($courses->isEmpty())
        <p class="text-gray-500">No courses found.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($courses as $course)
                <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
                    <h3 class="text-xl font-bold mb-2">{{ $course->title }}</h3>
                    <p class="text-gray-600 mb-3">{{ Str::limit($course->description, 100) }}</p>
                    
                    <div class="mb-4">
                        <p><strong>Instructor:</strong> {{ $course->instructor ?? 'N/A' }}</p>
                        <p><strong>Level:</strong> <span class="bg-blue-200 px-2 py-1 rounded text-sm">{{ $course->level }}</span></p>
                        <p><strong>Duration:</strong> {{ $course->duration_hours }} hours</p>
                        <p><strong>Price:</strong> ${{ $course->price }}</p>
                        <p><strong>Status:</strong> 
                            @if($course->status === 'Active')
                                <span class="bg-green-200 px-2 py-1 rounded text-sm">Active</span>
                            @elseif($course->status === 'Inactive')
                                <span class="bg-red-200 px-2 py-1 rounded text-sm">Inactive</span>
                            @else
                                <span class="bg-yellow-200 px-2 py-1 rounded text-sm">Draft</span>
                            @endif
                        </p>
                    </div>

                    <div class="flex gap-2">
                        <a href="/courses/{{ $course->id }}" class="bg-blue-500 text-white px-3 py-1 rounded text-sm hover:bg-blue-600">View</a>
                        <a href="/courses/{{ $course->id }}/edit" class="bg-yellow-500 text-white px-3 py-1 rounded text-sm hover:bg-yellow-600">Edit</a>
                        <form action="/courses/{{ $course->id }}" method="POST" class="inline" onsubmit="return confirm('Delete this course?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded text-sm hover:bg-red-600">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
