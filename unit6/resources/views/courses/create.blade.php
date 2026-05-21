@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-2xl">
    <h1 class="text-3xl font-bold mb-8">Create New Course</h1>

    <form action="/courses" method="POST" class="bg-white p-8 rounded-lg shadow">
        @csrf

        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">Course Title *</label>
            <input type="text" name="title" class="w-full border border-gray-300 p-2 rounded" required value="{{ old('title') }}">
            @error('title') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">Description</label>
            <textarea name="description" rows="4" class="w-full border border-gray-300 p-2 rounded">{{ old('description') }}</textarea>
            @error('description') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-gray-700 font-bold mb-2">Instructor</label>
                <input type="text" name="instructor" class="w-full border border-gray-300 p-2 rounded" value="{{ old('instructor') }}">
                @error('instructor') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2">Duration (hours)</label>
                <input type="number" name="duration_hours" class="w-full border border-gray-300 p-2 rounded" value="{{ old('duration_hours') }}">
                @error('duration_hours') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="grid grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-gray-700 font-bold mb-2">Price</label>
                <input type="number" name="price" step="0.01" class="w-full border border-gray-300 p-2 rounded" value="{{ old('price') }}">
                @error('price') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2">Level *</label>
                <select name="level" class="w-full border border-gray-300 p-2 rounded" required>
                    <option value="">Select Level</option>
                    <option value="Beginner" {{ old('level') === 'Beginner' ? 'selected' : '' }}>Beginner</option>
                    <option value="Intermediate" {{ old('level') === 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
                    <option value="Advanced" {{ old('level') === 'Advanced' ? 'selected' : '' }}>Advanced</option>
                </select>
                @error('level') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">Status *</label>
            <select name="status" class="w-full border border-gray-300 p-2 rounded" required>
                <option value="">Select Status</option>
                <option value="Active" {{ old('status') === 'Active' ? 'selected' : '' }}>Active</option>
                <option value="Inactive" {{ old('status') === 'Inactive' ? 'selected' : '' }}>Inactive</option>
                <option value="Draft" {{ old('status') === 'Draft' ? 'selected' : '' }}>Draft</option>
            </select>
            @error('status') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="flex gap-4">
            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">Create Course</button>
            <a href="/courses" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">Cancel</a>
        </div>
    </form>
</div>
@endsection
