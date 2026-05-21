<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Show database dashboard with stats
     */
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'total_courses' => Course::count(),
            'active_courses' => Course::where('status', 'Active')->count(),
            'total_enrollments' => \DB::table('course_user')->count(),
            'top_courses' => Course::withCount('users')
                ->orderByDesc('users_count')
                ->limit(5)
                ->get(),
            'active_users' => User::with('courses')
                ->whereHas('courses')
                ->limit(5)
                ->get(),
        ];

        return view('dashboard', compact('stats'));
    }

    /**
     * Get database data as JSON API
     */
    public function getData(Request $request)
    {
        $type = $request->query('type', 'all');

        return match($type) {
            'users' => response()->json(User::with('courses')->get()),
            'courses' => response()->json(Course::with('users')->get()),
            'enrollments' => response()->json(\DB::table('course_user')
                ->join('users', 'course_user.user_id', '=', 'users.id')
                ->join('courses', 'course_user.course_id', '=', 'courses.id')
                ->select('users.name', 'courses.title', 'course_user.enrolled_at', 'course_user.progress')
                ->get()),
            default => response()->json(['error' => 'Invalid type'], 400),
        };
    }
}
