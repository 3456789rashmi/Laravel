<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display all users
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show single user with enrolled courses
     */
    public function show($id)
    {
        $user = User::with('courses')->findOrFail($id);
        return view('users.show', compact('user'));
    }

    /**
     * Enroll user in course
     */
    public function enrollCourse(Request $request, $userId)
    {
        $user = User::findOrFail($userId);

        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
        ]);

        // Attach course to user with enrollment date
        $user->courses()->attach($validated['course_id'], [
            'enrolled_at' => now(),
            'progress' => 0,
        ]);

        return back()->with('success', 'User enrolled in course successfully!');
    }

    /**
     * Update course progress for user
     */
    public function updateProgress(Request $request, $userId)
    {
        $user = User::findOrFail($userId);

        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'progress' => 'required|integer|between:0,100',
        ]);

        $user->courses()->updateExistingPivot($validated['course_id'], [
            'progress' => $validated['progress'],
            'completed_at' => $validated['progress'] == 100 ? now() : null,
        ]);

        return response()->json(['message' => 'Progress updated!']);
    }

    /**
     * Remove user from course
     */
    public function removeFromCourse($userId, $courseId)
    {
        $user = User::findOrFail($userId);
        $user->courses()->detach($courseId);

        return back()->with('success', 'User removed from course!');
    }

    /**
     * Get user enrollment stats
     */
    public function enrollmentStats()
    {
        $users = User::withCount('courses')->get();

        return response()->json($users);
    }
}
