# Unit6 MySQL Setup Guide

## ✅ Files Created

### Models
- **app/Models/Course.php** - Course model with user relationship
- **app/Models/User.php** - Updated with courses relationship

### Migrations
- **database/migrations/2025_05_05_000001_create_courses_table.php** - Courses table
- **database/migrations/2025_05_05_000002_create_course_user_table.php** - Pivot table for user-course enrollment

### Factories
- **database/factories/CourseFactory.php** - Generates test course data

### Seeders
- **database/seeders/DatabaseSeeder.php** - Creates test data (6 users + 10 courses with relationships)

### Configuration
- **.env** - Updated to use MySQL (unit6_db)

---

## 🚀 Setup Steps

### Step 1: Create MySQL Database
Run this in your terminal:
```bash
"C:\xampp\mysql\bin\mysql" -u root -e "CREATE DATABASE unit6_db;"
```

### Step 2: Generate APP_KEY
```bash
php artisan key:generate
```

### Step 3: Run Migrations
```bash
php artisan migrate
```

### Step 4: Seed Database (Optional - adds test data)
```bash
php artisan db:seed
```

### Step 5: Start Development Server
```bash
php artisan serve
```

---

## 📊 Database Schema

### users table
- id, name, email, password, email_verified_at, remember_token, timestamps

### courses table
- id, title, description, instructor, duration_hours, price, level, status, timestamps

### course_user (Pivot)
- id, user_id, course_id, enrolled_at, completed_at, progress, timestamps

---

## 📝 Usage Examples

### Get user's courses
```php
$user = User::find(1);
$courses = $user->courses;  // All courses
$enrolled = $user->courses()->wherePivot('enrolled_at', '<', now())->get();
```

### Get course's users
```php
$course = Course::find(1);
$users = $course->users;  // All enrolled users
$progress = $course->users()->wherePivot('progress', '>', 50)->get();
```

### Attach user to course
```php
$user->courses()->attach($course_id, [
    'enrolled_at' => now(),
    'progress' => 0,
]);
```

### Update progress
```php
$user->courses()->updateExistingPivot($course_id, [
    'progress' => 75,
]);
```
