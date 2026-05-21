@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">All Users</h1>

    @if($users->isEmpty())
        <p class="text-gray-500">No users found.</p>
    @else
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border p-4 text-left">ID</th>
                        <th class="border p-4 text-left">Name</th>
                        <th class="border p-4 text-left">Email</th>
                        <th class="border p-4 text-left">Enrolled Courses</th>
                        <th class="border p-4 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr class="hover:bg-gray-100">
                        <td class="border p-4">{{ $user->id }}</td>
                        <td class="border p-4">{{ $user->name }}</td>
                        <td class="border p-4">{{ $user->email }}</td>
                        <td class="border p-4">
                            @if($user->courses->count() > 0)
                                <span class="bg-blue-200 px-2 py-1 rounded">{{ $user->courses->count() }} courses</span>
                            @else
                                <span class="text-gray-500">No courses</span>
                            @endif
                        </td>
                        <td class="border p-4">
                            <a href="/users/{{ $user->id }}" class="bg-blue-500 text-white px-3 py-1 rounded text-sm hover:bg-blue-600">View</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
