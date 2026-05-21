<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class ApiController extends Controller
{
    /**
     * Get all courses with optional filters
     */
    public function getCourses(Request $request)
    {
        $query = Course::query();

        if ($request->has('level')) {
            $query->where('level', $request->level);
        }

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        if ($request->has('sort')) {
            $query->orderBy($request->sort, $request->input('order', 'asc'));
        }

        return response()->json($query->with('users')->get());
    }

    /**
     * Get course by ID
     */
    public function getCourse($id)
    {
        $course = Course::with('users')->findOrFail($id);
        return response()->json($course);
    }

    /**
     * Get all users with optional filters
     */
    public function getUsers(Request $request)
    {
        $query = User::query();

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%');
        }

        if ($request->has('sort')) {
            $query->orderBy($request->sort, $request->input('order', 'asc'));
        }

        return response()->json($query->with('courses')->get());
    }

    /**
     * Get user by ID with courses
     */
    public function getUser($id)
    {
        $user = User::with('courses')->findOrFail($id);
        return response()->json($user);
    }

    /**
     * Get enrollments with filters
     */
    public function getEnrollments(Request $request)
    {
        $query = \DB::table('course_user')
            ->join('users', 'course_user.user_id', '=', 'users.id')
            ->join('courses', 'course_user.course_id', '=', 'courses.id')
            ->select(
                'users.id as user_id',
                'users.name',
                'users.email',
                'courses.id as course_id',
                'courses.title',
                'course_user.enrolled_at',
                'course_user.completed_at',
                'course_user.progress'
            );

        if ($request->has('user_id')) {
            $query->where('course_user.user_id', $request->user_id);
        }

        if ($request->has('course_id')) {
            $query->where('course_user.course_id', $request->course_id);
        }

        if ($request->has('min_progress')) {
            $query->where('course_user.progress', '>=', $request->min_progress);
        }

        return response()->json($query->get());
    }

    /**
     * Database statistics
     */
    public function getStats()
    {
        return response()->json([
            'total_users' => User::count(),
            'total_courses' => Course::count(),
            'active_courses' => Course::where('status', 'Active')->count(),
            'draft_courses' => Course::where('status', 'Draft')->count(),
            'inactive_courses' => Course::where('status', 'Inactive')->count(),
            'total_enrollments' => \DB::table('course_user')->count(),
            'completed_enrollments' => \DB::table('course_user')->whereNotNull('completed_at')->count(),
            'avg_progress' => \DB::table('course_user')->avg('progress'),
            'users_with_courses' => User::whereHas('courses')->count(),
            'courses_by_level' => Course::selectRaw('level, count(*) as count')->groupBy('level')->get(),
            'course_enrollment_count' => Course::withCount('users')->orderByDesc('users_count')->limit(5)->get(),
        ]);
    }
}
