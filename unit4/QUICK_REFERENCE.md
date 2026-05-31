# Unit 4 Quick Reference - Laravel Features

## 🔗 URL GENERATION

```php
url('/')                          // http://example.com/
url('/users')                     // http://example.com/users
route('home')                     // Generate route URL
route('users.show', ['id' => 1]) // Route with parameters
secure_url('/path')               // Force HTTPS
asset('css/app.css')              // Asset URL

// In Blade
{{ url('/') }}
{{ route('users.show', ['id' => $user->id]) }}
{{ asset('images/logo.png') }}
```

---

## 📝 REQUEST DATA

```php
// Get Input
$request->input('name')                    // Get single
$request->all()                            // Get all
$request->only('name', 'email')           // Get specific
$request->except('_token')                // Get all except

// Check Input
$request->has('name')              // Exists?
$request->filled('phone')          // Exists and not empty?

// Request Info
$request->method()                 // GET, POST, etc.
$request->path()                   // /users/1
$request->url()                    // Full URL
$request->ip()                     // User's IP
$request->userAgent()              // Browser info
$request->header('Accept')         // Get header
```

---

## 📑 OLD INPUT (Flash Data)

```php
// After validation redirect, old input is automatically available

// In Controller
$validated = $request->validate([...]);
return redirect('/form');  // Old input flashed automatically

// In Blade
<input value="{{ old('name') }}" name="name">
<textarea>{{ old('message') }}</textarea>

// Check if old value exists
@if(old('email'))
    Previously entered: {{ old('email') }}
@endif
```

---

## 📤 FILE UPLOAD

```php
// Validate
$request->validate([
    'photo' => 'required|image|mimes:jpeg,png|max:2048',
]);

// Get File Info
$file = $request->file('photo');
$file->getClientOriginalName()      // john.jpg
$file->getSize()                     // 2048
$file->getMimeType()                 // image/jpeg
$file->getClientOriginalExtension()  // jpg

// Store File
$path = $file->store('uploads', 'public');  // storage/app/public/uploads
$url = asset('storage/' . $path);           // http://example.com/storage/...

// Custom Name
$path = $file->storeAs('avatars', 'john-doe.jpg', 'public');

// Delete
Storage::disk('public')->delete($path);

// In Blade
<form method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="photo" accept="image/*">
</form>
```

---

## 🍪 COOKIES

```php
// Set Cookie
$cookie = cookie('theme', 'dark', 60);  // 60 minutes
return response('Success')->cookie($cookie);

// Get Cookie
$theme = $request->cookie('theme');
$theme = $request->cookie('theme', 'light');  // With default
$all = $request->cookies->all();               // All cookies

// Delete Cookie
return response()->cookie('theme', null, -1);

// Check Cookie
$exists = $request->hasCookie('remember_me');
```

---

## 📧 SENDING EMAILS

```php
// Simple Email
Mail::send('emails.template', [
    'name' => 'John',
    'message' => 'Hello!'
], function ($message) {
    $message->to('user@example.com')
            ->subject('Welcome');
});

// With Attachment
Mail::send(..., function ($message) {
    $message->to('user@example.com')
            ->attach(storage_path('app/file.pdf'));
});

// Bulk Email
$emails = ['user1@example.com', 'user2@example.com'];
foreach ($emails as $email) {
    Mail::to($email)->send(new WelcomeEmail());
}

// .env Configuration
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=465
MAIL_FROM_ADDRESS=no-reply@example.com
```

---

## 📦 SESSIONS - STORE

```php
// Store Single Value
session(['user_name' => 'John']);

// Store Multiple
session([
    'user_id' => 123,
    'role' => 'admin',
    'preferences' => ['theme' => 'dark']
]);

// Using put()
session()->put('theme', 'dark');

// Flash Data (1 request only)
session()->flash('success', 'Saved!');

// Increment/Decrement
session()->increment('page_views');
session()->decrement('credits', 5);

// In Controller
public function store(Request $request) {
    session(['user_id' => $user->id]);
    return redirect('/dashboard');
}
```

---

## 📖 SESSIONS - ACCESS

```php
// Get Value
$name = session('user_name');

// With Default
$role = session('role', 'guest');

// Get All
$all = session()->all();

// Check Exists
session()->has('user_id')
session()->exists('user_id')

// Get and Delete
$token = session()->pull('reset_token');

// In Blade
@if (session('user_name'))
    Welcome, {{ session('user_name') }}!
@endif

@if (session()->has('success'))
    <div class="alert">{{ session('success') }}</div>
@endif
```

---

## 🗑️ SESSIONS - DELETE

```php
// Delete Single Key
session()->forget('theme');

// Delete Multiple
session()->forget(['theme', 'language']);

// Delete All
session()->flush();

// Invalidate Session
session()->invalidate();

// Regenerate ID (after login - important!)
session()->regenerate();

// In Logout
public function logout() {
    Auth::logout();
    session()->flush();
    return redirect('/');
}
```

---

## 🌐 LOCALIZATION - SETUP

```php
// Language Files Structure
resources/lang/
    en/messages.php
    es/messages.php
    fr/messages.php

// Create files
// resources/lang/en/messages.php
return [
    'welcome' => 'Welcome!',
    'hello' => 'Hello',
];

// Use in Controller
$welcome = __('messages.welcome');
$hello = trans('messages.hello');

// Use in Blade
<h1>{{ __('messages.welcome') }}</h1>
<p>{{ trans('messages.hello') }}</p>
```

---

## 🌐 LOCALIZATION - ADVANCED

```php
// With Parameters
return [
    'greeting' => 'Hello, :name!',
    'count' => 'You have :count items',
];

// Usage
__('messages.greeting', ['name' => 'John'])      // Hello, John!
__('messages.count', ['count' => 5])             // You have 5 items

// Set Locale
app()->setLocale('es');              // Switch to Spanish
$current = app()->getLocale();       // Get current: 'es'

// In Session
session(['locale' => 'es']);

// Pluralization
return [
    'apples' => '{0} No apples|{1} One apple|[2,*] :count apples',
];

// Usage
trans_choice('messages.apples', 0)  // No apples
trans_choice('messages.apples', 1)  // One apple
trans_choice('messages.apples', 5)  // 5 apples

// Middleware to Set Locale
public function handle(Request $request, Closure $next) {
    if (session('locale')) {
        app()->setLocale(session('locale'));
    }
    return $next($request);
}
```

---

## 🔍 VALIDATION RULES (Quick Reference)

```php
// Common Rules
'name' => 'required|string|max:255',
'email' => 'required|email',
'age' => 'required|integer|min:18|max:100',
'password' => 'required|min:8|confirmed',
'phone' => 'required|regex:/^\d{10}$/',

// File Rules
'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
'document' => 'required|mimes:pdf,doc,docx|max:5120',

// Conditional
'phone' => 'required_if:contact_type,phone',
'address' => 'required_unless:has_address,false',

// In Blade - Show Errors
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@error('email')
    <span>{{ $message }}</span>
@enderror
```

---

## 🚀 COMMON PATTERNS

### Pattern 1: Form with Validation
```php
public function store(Request $request) {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
    ]);
    
    // Data validated, process it
    User::create($validated);
    
    return redirect('/')->with('success', 'User created!');
}
```

### Pattern 2: Shopping Cart (Sessions)
```php
// Add to cart
$cart = session('cart', []);
$cart[$product_id] = $quantity;
session(['cart' => $cart]);

// View cart
$items = session('cart', []);

// Clear cart
session()->forget('cart');
```

### Pattern 3: User Preferences (Cookies)
```php
// Save preference
$cookie = cookie('theme', 'dark', 43200);  // 30 days
return response()->cookie($cookie);

// Load preference
$theme = $request->cookie('theme', 'light');
```

### Pattern 4: Multi-Language App
```php
// Controller
app()->setLocale($request->input('locale'));
session(['locale' => $request->input('locale')]);

// Blade
<a href="?locale=en">English</a>
<a href="?locale=es">Español</a>
<p>{{ __('messages.welcome') }}</p>
```

---

## 📊 DIRECTORY STRUCTURE

```
unit4/
├── app/
│   └── Http/
│       └── Controllers/
│           ├── RequestDataController.php
│           ├── EmailController.php
│           ├── SessionController.php
│           └── LocalizationController.php
├── resources/
│   ├── lang/
│   │   ├── en/messages.php
│   │   ├── es/messages.php
│   │   ├── fr/messages.php
│   │   └── de/messages.php
│   └── views/
│       ├── request-data/
│       ├── emails/
│       ├── sessions/
│       └── localization/
├── routes/
│   └── web.php
├── LEARNING_GUIDE.md
├── STEP_BY_STEP_GUIDE.md
└── QUICK_REFERENCE.md
```

---

## 🔗 AVAILABLE ROUTES

```
GET  /request-data                    Form submission page
GET  /request-data/url-generation    URL generation examples
GET  /request-data/old-input-form    Form with old input
GET  /request-data/upload-form       File upload form
GET  /request-data/cookie-form       Cookie management
GET  /request-data/cookie/retrieve   View cookies
GET  /request-data/info              Request information

GET  /email/form                      Email form
POST /email/send-simple               Send simple email

GET  /session                         Session form
GET  /session/form                    Store data form
GET  /session/access                  Access session data
GET  /session/show-all                View all session data

GET  /localization                    Localization index
GET  /localization/demo               Localization demo
GET  /localization/form               Change language
GET  /localization/set/:locale        Set locale
GET  /localization/pluralization      Pluralization demo
```

---

## 💡 PRO TIPS

1. **Sessions** - Always regenerate ID after login for security
2. **Cookies** - Never store sensitive data (passwords, tokens)
3. **Files** - Always validate file uploads thoroughly
4. **Emails** - Use Mailtrap.io for development/testing
5. **Localization** - Store language preference in session
6. **Old Input** - Always use `old()` helper in forms
7. **Cache** - Clear cache if translations not updating

---

## 🐛 DEBUGGING

```php
// Session Debug
dd(session()->all());                // Dump all session data
Log::info('Session:', session()->all());

// Request Debug
dd($request->all());                 // Dump all request data
Log::info('Request:', $request->all());

// View Current Locale
Log::info('Current Locale: ' . app()->getLocale());

// Check if file exists
dd($request->hasFile('photo'));
```

---

## ✅ CHECKLIST FOR MASTERY

- [ ] I can generate URLs dynamically
- [ ] I can retrieve form data from requests
- [ ] I understand old input and how to use it
- [ ] I can handle file uploads securely
- [ ] I can set and manage cookies
- [ ] I can send emails with Laravel
- [ ] I can store and retrieve session data
- [ ] I can delete session data properly
- [ ] I can set up multi-language support
- [ ] I can handle pluralization in different languages
- [ ] I can combine all features in a project

---

Happy Learning! 🎓
