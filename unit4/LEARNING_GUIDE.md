# 📚 Laravel Unit 4 - Complete Learning Guide

## Topics Covered

This comprehensive guide covers the following Laravel topics:

1. **URL Generation, Request Data and Emails**
   - URL Generation
   - Request Data Retrieval
   - Old Input (Flash Data)
   - Uploaded Files
   - Cookies Management
   - Sending Emails

2. **Laravel Localization and Sessions**
   - Laravel Localization (Multi-language support)
   - Laravel Sessions (Accessing, Storing, Deleting)

---

## Part 1: URL Generation, Request Data and Emails

### 1.1 URL Generation

**What is URL Generation?**
- Generating URLs dynamically in your Laravel application
- Essential for routing and maintaining URLs when application structure changes

**Key Helpers:**

```php
// Basic URL
url('/path')                           // Full URL: http://example.com/path
url('/path', ['key' => 'value'])       // With query parameters

// Route URLs
route('home')                          // Generate route URL
route('users.show', ['id' => 1])      // Route with parameters
route('users.show', ['id' => 1], true) // Secure HTTPS URL

// Secure URLs
secure_url('/path')                    // Force HTTPS

// Asset URLs
asset('css/app.css')                   // /css/app.css
asset('js/app.js')                     // /js/app.js

// Current Request Info
request()->url()                       // Full URL with query string
request()->path()                      // Path only
request()->fullUrl()                   // Complete URL
url()->previous()                      // Previous page URL
```

**Example:**
```php
// In Controller
public function example() {
    return [
        'home' => url('/'),
        'users' => route('users.index'),
        'user_profile' => route('users.show', ['id' => 5]),
        'asset' => asset('images/logo.png')
    ];
}
```

---

### 1.2 Request Data Retrieval

**What is Request Data?**
- Data sent from user (form submissions, query parameters, JSON, etc.)
- Accessed via the `$request` object

**Methods to Retrieve Data:**

```php
// Get specific input
$name = $request->input('name');
$email = $request->input('email');
$message = $request->input('message', 'default value');

// Get multiple inputs
$all_data = $request->all();           // All input data
$specific = $request->only('name', 'email');    // Only these fields
$except = $request->except('_token');  // All except _token

// Check if field exists
$has_name = $request->has('name');     // Field exists?
$filled = $request->filled('phone');   // Field exists and not empty?

// Get input as array
$request->query()                      // Query string data
$request->post()                       // POST data
```

**Example:**
```php
public function store(Request $request) {
    // Retrieve data
    $name = $request->input('name');
    $email = $request->input('email');
    
    // Get all data
    $data = $request->all();
    
    // Check existence
    if ($request->has('phone')) {
        // Process phone number
    }
    
    // Store in database
    User::create($data);
}
```

---

### 1.3 Old Input (Flash Data)

**What is Old Input?**
- Automatically flashed input data after form submission
- Used to repopulate forms after validation errors
- Persists only for one request

**How to Use:**

```php
// Controller - Redirect with old input
public function store(Request $request) {
    $validated = $request->validate([
        'name' => 'required|string',
        'email' => 'required|email',
    ]);
    
    // Data is automatically flashed
    return redirect('/form')->with('success', 'Data saved!');
}

// In Blade View - Repopulate form
<input type="text" value="{{ old('name') }}" name="name">
<input type="email" value="{{ old('email') }}" name="email">
<textarea name="message">{{ old('message') }}</textarea>

// Check if old value exists
@if(old('name'))
    <p>Previous name: {{ old('name') }}</p>
@endif
```

**Common Flow:**
1. User submits form with data
2. Server validates data
3. If invalid, redirect back
4. Laravel automatically flashes old input
5. View uses `old()` helper to repopulate fields

---

### 1.4 Uploaded Files

**What are File Uploads?**
- Users uploading files (images, documents, etc.)
- Important to validate and store securely

**Basic File Upload:**

```php
public function upload(Request $request) {
    // Validate file
    $request->validate([
        'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'document' => 'nullable|mimes:pdf,doc,docx|max:5120',
    ]);
    
    // Check if file exists
    if ($request->hasFile('profile_photo')) {
        $file = $request->file('profile_photo');
        
        // Get file information
        $originalName = $file->getClientOriginalName();  // john_photo.jpg
        $size = $file->getSize();                        // 1024000 bytes
        $mimeType = $file->getMimeType();                // image/jpeg
        $extension = $file->getClientOriginalExtension(); // jpg
        
        // Store file
        $path = $file->store('uploads/profiles', 'public');
        // File stored at: storage/app/public/uploads/profiles/{filename}
        
        // Get public URL
        $url = asset('storage/' . $path);
    }
}
```

**File Storage:**

```php
// Store file with custom name
$path = $request->file('photo')->storeAs('avatars', 'john-doe.jpg', 'public');

// Store with original name
$path = $file->store('uploads', 'public');

// Delete file
Storage::disk('public')->delete($path);
```

**In Blade View:**

```html
<form method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="profile_photo" required>
    <input type="file" name="document">
    <button type="submit">Upload</button>
</form>
```

---

### 1.5 Cookies

**What are Cookies?**
- Small files stored on client's browser
- Sent with every HTTP request
- Max 4KB size
- Good for preferences, tracking, etc.

**Setting Cookies:**

```php
public function setCookie(Request $request) {
    $value = 'some-value';
    $minutes = 60;
    
    // Method 1: Create cookie and attach to response
    $cookie = cookie('cookie_name', $value, $minutes);
    return response('Cookie set!')->cookie($cookie);
    
    // Method 2: Multiple cookies
    return response('Cookies set!')
        ->cookie('theme', 'dark', 60)
        ->cookie('language', 'en', 60);
}

// Permanent cookie (5 years)
return response()->cookie('remember_me', $token, 525600);

// Delete cookie (set expiry to -1)
return response()->cookie('user_token', null, -1);
```

**Retrieving Cookies:**

```php
public function getCookie(Request $request) {
    // Get single cookie
    $userPreference = $request->cookie('user_preference');
    
    // Get with default value
    $theme = $request->cookie('theme', 'light');
    
    // Get all cookies
    $allCookies = $request->cookies->all();
    
    // Check if cookie exists
    $exists = $request->hasCookie('remember_me');
}
```

**Important Notes:**
- Cookies are visible to users (don't store sensitive data)
- Always encrypt sensitive data
- Use HttpOnly flag for security (Laravel does this by default)
- Set SameSite attribute to prevent CSRF

---

### 1.6 Sending Emails

**What is Email Sending?**
- Sending automated emails from your application
- Requires mail driver configuration in `.env`

**Configuration:**

In `.env` file:
```
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=465
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_FROM_ADDRESS=no-reply@example.com
MAIL_FROM_NAME="App Name"
```

**Simple Email:**

```php
public function sendSimpleEmail(Request $request) {
    $request->validate([
        'recipient_email' => 'required|email',
        'subject' => 'required|string',
        'message' => 'required|string',
    ]);
    
    Mail::send('emails.simple-email-template', [
        'email' => $request->input('recipient_email'),
        'subject' => $request->input('subject'),
        'message_body' => $request->input('message'),
    ], function ($message) use ($request) {
        $message->to($request->input('recipient_email'))
                ->subject($request->input('subject'));
    });
}
```

**Email Template (`resources/views/emails/simple-email.blade.php`):**

```blade
<h2>Hello!</h2>
<p>{{ $message_body }}</p>
<p>Best regards,<br>
Your Application Team</p>
```

**Email with Attachments:**

```php
Mail::send('emails.template', [], function ($message) {
    $message->to('user@example.com')
            ->subject('Important Document')
            ->attach(storage_path('app/documents/file.pdf'));
});
```

**Send Bulk Emails:**

```php
$recipients = ['user1@example.com', 'user2@example.com', 'user3@example.com'];

foreach ($recipients as $email) {
    Mail::to($email)
        ->send(new WelcomeEmail());
}
```

**Email Validation:**
```php
// Laravel validates email format automatically
$request->validate([
    'email' => 'required|email',
    'cc_email' => 'nullable|email',
]);
```

---

## Part 2: Laravel Localization and Sessions

### 2.1 Laravel Localization

**What is Localization?**
- Supporting multiple languages in your application
- Dynamically switching between languages
- Locale-specific content and formatting

**Configuration:**

1. Set default locale in `config/app.php`:
```php
'locale' => 'en',  // Default: English
```

2. Create language files in `resources/lang/{locale}/`:
```
resources/lang/
    en/
        messages.php
        validation.php
    es/
        messages.php
    fr/
        messages.php
```

3. Language file (`resources/lang/en/messages.php`):
```php
return [
    'welcome' => 'Welcome to our application!',
    'greeting' => 'Hello, :name!',
    'goodbye' => 'Goodbye, see you soon!',
];
```

**Using Translations:**

```php
// Helper function (recommended)
__('messages.welcome')              // Get translation
__('messages.greeting', ['name' => 'John'])  // With parameters

// Or use trans() alias
trans('messages.welcome')
trans_choice('messages.apples', $count)  // Pluralization

// Check if translation exists
if (__('messages.key') !== 'messages.key') {
    // Translation exists
}
```

**In Blade Templates:**

```blade
<h1>{{ __('messages.welcome') }}</h1>
<p>{{ __('messages.greeting', ['name' => Auth::user()->name]) }}</p>
```

**Setting Locale:**

```php
// Set application locale
app()->setLocale('es');  // Switch to Spanish

// Get current locale
$current = app()->getLocale();  // Returns 'es'

// Set in controller
public function setLanguage(Request $request) {
    app()->setLocale($request->input('locale'));
    return redirect()->back();
}

// Store preference in session
session(['locale' => 'es']);

// Middleware to set locale from session
public function handle(Request $request, Closure $next) {
    if (session()->has('locale')) {
        app()->setLocale(session('locale'));
    }
    return $next($request);
}
```

**Pluralization:**

Language file:
```php
return [
    'apples' => '{0} No apples|{1} One apple|[2,*] :count apples',
    // {0} - for 0 items
    // {1} - for 1 item
    // [2,*] - for 2 or more items
];
```

Usage:
```php
trans_choice('messages.apples', 0);  // No apples
trans_choice('messages.apples', 1);  // One apple
trans_choice('messages.apples', 5);  // 5 apples
```

**Spanish Pluralization:**
```php
return [
    'apples' => '{0} Sin manzanas|{1} Una manzana|[2,*] :count manzanas',
];
```

**Date/Time Localization:**

```php
// Format date based on locale
$date = now();

switch(app()->getLocale()) {
    case 'es':
        $formatted = $date->format('d/m/Y');  // Spanish: 25/05/2026
        break;
    case 'fr':
        $formatted = $date->format('d/m/Y');  // French: 25/05/2026
        break;
    default:
        $formatted = $date->format('m/d/Y');  // English: 05/25/2026
}
```

---

### 2.2 Laravel Sessions

**What are Sessions?**
- Server-side storage of user-specific data
- Persists across multiple page visits
- Expires when session ends or explicitly deleted

**Session Configuration:**

In `config/session.php`:
```php
'driver' => 'file',  // or 'cookie', 'database', 'memcached', 'redis'
'lifetime' => 120,   // Minutes until session expires
```

#### 2.2.1 Storing Session Data

**Method 1: Using session() Helper**

```php
// Store single value
session(['user_name' => 'John Doe']);
session(['user_id' => 123]);

// Store multiple values
session([
    'user_name' => 'John Doe',
    'user_id' => 123,
    'role' => 'admin'
]);

// Using put() method
session()->put('theme', 'dark');

// Store with key
session(['preferences' => ['theme' => 'dark', 'language' => 'en']]);
```

**Method 2: Direct Session Facade**

```php
use Illuminate\Support\Facades\Session;

Session::put('key', 'value');
Session::put(['key1' => 'value1', 'key2' => 'value2']);
```

**Flash Data (Temporary):**

```php
// Store for only next request
session()->flash('success', 'Profile updated!');

// Access in view
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
```

**Increment/Decrement:**

```php
// Increment session value
session()->increment('page_views');  // Increment by 1
session()->increment('visits', 5);   // Increment by 5

// Decrement
session()->decrement('credits');     // Decrement by 1
```

**Example: Shopping Cart**

```php
public function addToCart(Request $request) {
    $items = session('cart', []);
    $items[] = $request->input('product_id');
    session(['cart' => $items]);
    
    return redirect('/cart');
}
```

#### 2.2.2 Accessing Session Data

**Retrieve Session Data:**

```php
// Get value
$name = session('user_name');

// Get with default
$role = session('role', 'guest');

// Get all session data
$all = session()->all();

// Check if key exists
if (session()->has('user_id')) {
    // User is logged in
}

// Check if multiple keys exist
if (session()->has(['user_id', 'user_name'])) {
    // Both exist
}

// Check if key exists and is not empty
if (session()->exists('user_id')) {
    // Key exists (even if empty)
}
```

**In Blade Templates:**

```blade
@if (session('user_name'))
    <p>Welcome back, {{ session('user_name') }}!</p>
@endif

<p>Your role: {{ session('role', 'guest') }}</p>

@if (session()->has('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
```

**Get and Forget (Retrieve Once):**

```php
// Get value and delete it
$token = session()->pull('reset_token');

// Only works once - next request will be null
$token = session()->pull('reset_token', 'default');
```

#### 2.2.3 Deleting Session Data

**Delete Single Key:**

```php
session()->forget('user_preference');

// With array
session()->forget(['theme', 'language']);
```

**Delete All Session Data:**

```php
// Delete all data but keep session alive
session()->flush();

// Invalidate session completely
session()->invalidate();
```

**Regenerate Session ID:**

```php
// Create new session ID (important after login)
session()->regenerate();

// Used in login:
public function login(Request $request) {
    // Authenticate user
    session()->regenerate();
    return redirect('/dashboard');
}
```

**Full Example:**

```php
public function storeUser(Request $request) {
    $user = Auth::user();
    
    // Store user data in session
    session([
        'user_id' => $user->id,
        'user_name' => $user->name,
        'user_email' => $user->email,
        'user_role' => $user->role,
    ]);
    
    // Flash success message
    session()->flash('success', 'Profile saved!');
    
    return redirect('/dashboard');
}

public function viewDashboard() {
    $userName = session('user_name', 'Guest');
    return view('dashboard', compact('userName'));
}

public function logout() {
    // Delete session data
    session()->flush();
    
    return redirect('/');
}
```

---

## Quick Reference

### Controllers Created:
- `RequestDataController` - URL generation, request data, files, cookies
- `EmailController` - Email sending
- `SessionController` - Session management
- `LocalizationController` - Multi-language support

### Routes Created:
- `/request-data/*` - Request data examples
- `/email/*` - Email sending
- `/session/*` - Session management
- `/localization/*` - Localization examples

### Views Created:
- `request-data/` - Request examples
- `emails/` - Email templates
- `sessions/` - Session examples
- `localization/` - Localization examples

---

## Common Patterns

### Pattern 1: Form with Validation & Old Input
```php
public function store(Request $request) {
    $validated = $request->validate([
        'name' => 'required|string',
        'email' => 'required|email',
    ]);
    
    // Process data
    return redirect('/')->with('success', 'Saved!');
}

// In Blade:
<input value="{{ old('name') }}" name="name">
```

### Pattern 2: File Upload & Storage
```php
public function upload(Request $request) {
    $request->validate([
        'file' => 'required|image|max:2048',
    ]);
    
    $path = $request->file('file')->store('uploads', 'public');
    return asset('storage/' . $path);
}
```

### Pattern 3: Session-Based Cart
```php
$items = session('cart', []);
$items[] = $product_id;
session(['cart' => $items]);
```

### Pattern 4: Multi-Language App
```php
app()->setLocale($request->input('locale'));
$text = __('messages.welcome');
```

---

## Testing Your Knowledge

### Exercises:

1. **Request Data**: Create a form that validates and displays all input data
2. **File Upload**: Build a profile photo uploader with validation
3. **Cookies**: Create user preference storage using cookies
4. **Emails**: Send a welcome email when user registers
5. **Sessions**: Build a shopping cart system
6. **Localization**: Create a language switcher for 3+ languages

---

## Next Steps

- Review the controller implementations
- Test each feature in the application
- Modify the examples for your use case
- Combine these features for real projects
- Learn about middleware for sessions and localization

Happy Learning! 🚀
