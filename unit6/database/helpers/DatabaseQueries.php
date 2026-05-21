<?php

/**
 * DATABASE QUERY HELPER
 * 
 * Common queries for working with Courses and Users MySQL tables
 */

namespace Database\Helpers;

use App\Models\Course;
use App\Models\User;

class DatabaseQueries
{
    /**
     * Get all courses
     */
    public static function getAllCourses()
    {
        return Course::all();
    }

    /**
     * Get courses by level
     */
    public static function getCoursesByLevel($level)
    {
        return Course::where('level', $level)->get();
    }

    /**
     * Get active courses
     */
    public static function getActiveCourses()
    {
        return Course::where('status', 'Active')->get();
    }

    /**
     * Get course with users
     */
    public static function getCourseWithUsers($courseId)
    {
        return Course::with('users')->findOrFail($courseId);
    }

    /**
     * Get all users
     */
    public static function getAllUsers()
    {
        return User::all();
    }

    /**
     * Get user with courses
     */
    public static function getUserWithCourses($userId)
    {
        return User::with('courses')->findOrFail($userId);
    }

    /**
     * Get user's course progress
     */
    public static function getUserCourseProgress($userId, $courseId)
    {
        $user = User::findOrFail($userId);
        return $user->courses()
            ->where('course_id', $courseId)
            ->first()?->pivot;
    }

    /**
     * Enroll user in course
     */
    public static function enrollUserInCourse($userId, $courseId, $progress = 0)
    {
        $user = User::findOrFail($userId);
        $user->courses()->attach($courseId, [
            'enrolled_at' => now(),
            'progress' => $progress,
        ]);
        return true;
    }

    /**
     * Update user course progress
     */
    public static function updateUserProgress($userId, $courseId, $progress)
    {
        $user = User::findOrFail($userId);
        $user->courses()->updateExistingPivot($courseId, [
            'progress' => $progress,
            'completed_at' => $progress == 100 ? now() : null,
        ]);
        return true;
    }

    /**
     * Get courses with enrollment count
     */
    public static function getCoursesWithEnrollmentCount()
    {
        return Course::withCount('users')->get();
    }

    /**
     * Get users enrolled in specific course
     */
    public static function getUsersInCourse($courseId)
    {
        $course = Course::findOrFail($courseId);
        return $course->users()->get();
    }

    /**
     * Count total enrollments
     */
    public static function getTotalEnrollments()
    {
        return \DB::table('course_user')->count();
    }

    /**
     * Get enrollment stats
     */
    public static function getEnrollmentStats()
    {
        return [
            'total_enrollments' => \DB::table('course_user')->count(),
            'completed_courses' => \DB::table('course_user')
                ->whereNotNull('completed_at')
                ->count(),
            'avg_progress' => \DB::table('course_user')->avg('progress'),
            'most_popular_course' => Course::withCount('users')
                ->orderByDesc('users_count')
                ->first(),
        ];
    }

    /**
     * Create new course
     */
    public static function createCourse($data)
    {
        return Course::create($data);
    }

    /**
     * Delete course
     */
    public static function deleteCourse($courseId)
    {
        return Course::destroy($courseId);
    }

    /**
     * Search courses
     */
    public static function searchCourses($keyword)
    {
        return Course::where('title', 'like', "%{$keyword}%")
            ->orWhere('description', 'like', "%{$keyword}%")
            ->get();
    }
}
