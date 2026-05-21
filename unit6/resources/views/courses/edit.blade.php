@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-2xl">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold">Edit Course</h1>
        <a href="/courses/{{ $course->id }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">← Back</a>
    </div>

    <form action="/courses/{{ $course->id }}" method="POST" class="bg-white p-8 rounded-lg shadow">
        @csrf
        @method('PUT')

        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">Course Title *</label>
            <input type="text" name="title" class="w-full border border-gray-300 p-2 rounded" required value="{{ old('title', $course->title) }}">
            @error('title') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">Description</label>
            <textarea name="description" rows="4" class="w-full border border-gray-300 p-2 rounded">{{ old('description', $course->description) }}</textarea>
            @error('description') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-gray-700 font-bold mb-2">Instructor</label>
                <input type="text" name="instructor" class="w-full border border-gray-300 p-2 rounded" value="{{ old('instructor', $course->instructor) }}">
                @error('instructor') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2">Duration (hours)</label>
                <input type="number" name="duration_hours" class="w-full border border-gray-300 p-2 rounded" value="{{ old('duration_hours', $course->duration_hours) }}">
                @error('duration_hours') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="grid grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-gray-700 font-bold mb-2">Price</label>
                <input type="number" name="price" step="0.01" class="w-full border border-gray-300 p-2 rounded" value="{{ old('price', $course->price) }}">
                @error('price') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2">Level *</label>
                <select name="level" class="w-full border border-gray-300 p-2 rounded" required>
                    <option value="Beginner" {{ old('level', $course->level) === 'Beginner' ? 'selected' : '' }}>Beginner</option>
                    <option value="Intermediate" {{ old('level', $course->level) === 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
                    <option value="Advanced" {{ old('level', $course->level) === 'Advanced' ? 'selected' : '' }}>Advanced</option>
                </select>
                @error('level') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">Status *</label>
            <select name="status" class="w-full border border-gray-300 p-2 rounded" required>
                <option value="Active" {{ old('status', $course->status) === 'Active' ? 'selected' : '' }}>Active</option>
                <option value="Inactive" {{ old('status', $course->status) === 'Inactive' ? 'selected' : '' }}>Inactive</option>
                <option value="Draft" {{ old('status', $course->status) === 'Draft' ? 'selected' : '' }}>Draft</option>
            </select>
            @error('status') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="flex gap-4">
            <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded hover:bg-green-600">Update Course</button>
            <a href="/courses/{{ $course->id }}" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">Cancel</a>
        </div>
    </form>
</div>
@endsection
