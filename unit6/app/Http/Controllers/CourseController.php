<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display all courses
     */
    public function index()
    {
        $courses = Course::all();
        return view('courses.index', compact('courses'));
    }

    /**
     * Show single course with enrolled users
     */
    public function show($id)
    {
        $course = Course::with('users')->findOrFail($id);
        return view('courses.show', compact('course'));
    }

    /**
     * Show create course form
     */
    public function create()
    {
        return view('courses.create');
    }

    /**
     * Store course in database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'instructor' => 'nullable|string|max:255',
            'duration_hours' => 'nullable|integer',
            'price' => 'nullable|numeric',
            'level' => 'required|in:Beginner,Intermediate,Advanced',
            'status' => 'required|in:Active,Inactive,Draft',
        ]);

        Course::create($validated);

        return redirect()->route('courses.index')->with('success', 'Course created successfully!');
    }

    /**
     * Show edit course form
     */
    public function edit($id)
    {
        $course = Course::findOrFail($id);
        return view('courses.edit', compact('course'));
    }

    /**
     * Update course
     */
    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'instructor' => 'nullable|string|max:255',
            'duration_hours' => 'nullable|integer',
            'price' => 'nullable|numeric',
            'level' => 'required|in:Beginner,Intermediate,Advanced',
            'status' => 'required|in:Active,Inactive,Draft',
        ]);

        $course->update($validated);

        return redirect()->route('courses.show', $course)->with('success', 'Course updated successfully!');
    }

    /**
     * Delete course
     */
    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return redirect()->route('courses.index')->with('success', 'Course deleted successfully!');
    }

    /**
     * Get course stats
     */
    public function stats()
    {
        $totalCourses = Course::count();
        $activeCourses = Course::where('status', 'Active')->count();
        $totalEnrollments = \DB::table('course_user')->count();

        return response()->json([
            'total_courses' => $totalCourses,
            'active_courses' => $activeCourses,
            'total_enrollments' => $totalEnrollments,
        ]);
    }
}
