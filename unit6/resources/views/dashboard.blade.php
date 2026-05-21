@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">Dashboard</h1>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-blue-500 text-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold">Total Users</h3>
            <p class="text-3xl font-bold">{{ $stats['total_users'] }}</p>
        </div>
        <div class="bg-green-500 text-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold">Total Courses</h3>
            <p class="text-3xl font-bold">{{ $stats['total_courses'] }}</p>
        </div>
        <div class="bg-purple-500 text-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold">Active Courses</h3>
            <p class="text-3xl font-bold">{{ $stats['active_courses'] }}</p>
        </div>
        <div class="bg-orange-500 text-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold">Total Enrollments</h3>
            <p class="text-3xl font-bold">{{ $stats['total_enrollments'] }}</p>
        </div>
    </div>

    <!-- Top Courses -->
    <div class="bg-white p-6 rounded-lg shadow mb-8">
        <h2 class="text-2xl font-bold mb-4">Top Courses</h2>
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border p-2 text-left">Course Title</th>
                    <th class="border p-2 text-left">Instructor</th>
                    <th class="border p-2 text-left">Level</th>
                    <th class="border p-2 text-left">Enrolled Users</th>
                    <th class="border p-2 text-left">Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stats['top_courses'] as $course)
                <tr class="hover:bg-gray-100">
                    <td class="border p-2">{{ $course->title }}</td>
                    <td class="border p-2">{{ $course->instructor ?? 'N/A' }}</td>
                    <td class="border p-2"><span class="bg-blue-200 px-2 py-1 rounded">{{ $course->level }}</span></td>
                    <td class="border p-2 text-center font-bold">{{ $course->users_count }}</td>
                    <td class="border p-2">${{ $course->price }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Active Users -->
    <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="text-2xl font-bold mb-4">Active Users (with Enrollments)</h2>
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border p-2 text-left">Name</th>
                    <th class="border p-2 text-left">Email</th>
                    <th class="border p-2 text-left">Enrolled Courses</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stats['active_users'] as $user)
                <tr class="hover:bg-gray-100">
                    <td class="border p-2">{{ $user->name }}</td>
                    <td class="border p-2">{{ $user->email }}</td>
                    <td class="border p-2">
                        @foreach($user->courses as $course)
                            <span class="bg-green-200 px-2 py-1 rounded text-sm mr-1">{{ $course->title }}</span>
                        @endforeach
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
