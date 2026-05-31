# 📖 Unit 4 Step-by-Step Tutorial

## Getting Started with Unit 4

Follow this guide step-by-step to understand each topic.

---

## STEP 1: Setup & Installation

### 1.1 Install Dependencies
```bash
cd unit4
composer install
npm install
```

### 1.2 Create Environment File
```bash
cp .env.example .env
php artisan key:generate
```

### 1.3 Configure Mail (for Email feature)
Update `.env`:
```
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=465
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_FROM_ADDRESS=no-reply@example.com
```

### 1.4 Run the Application
```bash
php artisan serve
```

Visit: http://localhost:8000

---

## STEP 2: URL Generation

### What You'll Learn:
- How to generate URLs dynamically
- How to use named routes
- How to pass parameters to routes

### Tutorial:

1. **Open the Application**
   - Go to http://localhost:8000/request-data/url-generation

2. **View Examples**
   - Study the different URL generation methods
   - Notice how URLs update when parameters change

3. **Try It Yourself:**
   ```php
   // In your controller
   public function example() {
       return [
           'home_url' => url('/'),
           'users_url' => route('users.index'),
           'specific_user' => route('users.show', ['id' => 5]),
       ];
   }
   ```

### Key Takeaways:
- ✅ Use `url()` for absolute URLs
- ✅ Use `route()` for named routes
- ✅ Always pass parameters as arrays
- ✅ Use `asset()` for CSS/JS/images

---

## STEP 3: Request Data Retrieval

### What You'll Learn:
- How to access form data
- How to validate input
- How to handle different input types

### Tutorial:

1. **Visit the Form**
   - Go to http://localhost:8000/request-data/form

2. **Submit the Form**
   - Fill in all fields
   - Click "Submit Form"

3. **See the Results**
   - View how Laravel retrieves different types of data
   - Understand `all()`, `only()`, `except()` methods

4. **Try Different Inputs:**
   ```php
   // Get specific field
   $name = $request->input('name');
   
   // Get all data
   $all = $request->all();
   
   // Get specific fields only
   $data = $request->only('name', 'email');
   
   // Get all except some
   $data = $request->except('_token');
   ```

### Exercise:
1. Create a new form with 5 different fields
2. Submit the form
3. Display all the data in a table
4. Try using `only()` and `except()`

---

## STEP 4: Old Input (Flash Data)

### What You'll Learn:
- How to repopulate forms after validation
- How to preserve user data
- How to use the `old()` helper

### Tutorial:

1. **Visit the Form**
   - Go to http://localhost:8000/request-data/old-input-form

2. **Notice the Magic**
   - Form fields are repopulated with previous input
   - This happens automatically after redirect

3. **How It Works:**
   ```php
   // Controller
   public function store(Request $request) {
       $validated = $request->validate([
           'name' => 'required|string',
       ]);
       // Data automatically flashed!
       return redirect('/form');
   }
   
   // Blade Template
   <input value="{{ old('name') }}" name="name">
   ```

### Exercise:
1. Create a form with validation
2. Add validation rules (required, email, min:3)
3. On validation error, redirect back
4. Use `old()` to repopulate fields
5. Display validation error messages

---

## STEP 5: File Upload

### What You'll Learn:
- How to handle file uploads
- How to validate files
- How to store files securely

### Tutorial:

1. **Visit Upload Form**
   - Go to http://localhost:8000/request-data/upload-form

2. **Upload a File**
   - Select an image
   - Upload it
   - See the file information

3. **File Upload Process:**
   ```php
   public function upload(Request $request) {
       // Validate
       $request->validate([
           'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048'
       ]);
       
       // Get file info
       $file = $request->file('photo');
       $name = $file->getClientOriginalName();
       $size = $file->getSize();
       
       // Store file
       $path = $file->store('uploads', 'public');
       
       // Get public URL
       $url = asset('storage/' . $path);
   }
   ```

### File Validation Rules:
```
file               - Valid file
image              - Valid image file
mimes:jpeg,png     - Specific formats
max:2048           - Max 2MB
extensions:jpg,png - File extensions
```

### Exercise:
1. Create a multi-file upload form
2. Validate each file type
3. Store files with custom names
4. Display uploaded file previews
5. Add delete functionality

---

## STEP 6: Cookie Management

### What You'll Learn:
- How to set cookies
- How to retrieve cookies
- How to delete cookies
- Cookie security

### Tutorial:

1. **Set a Cookie**
   - Go to http://localhost:8000/request-data/cookie-form
   - Fill in cookie name and value
   - Click "Set Cookie"

2. **Retrieve Cookie**
   - Go to http://localhost:8000/request-data/cookie/retrieve
   - View all cookies your browser has

3. **Cookie Operations:**
   ```php
   // Set cookie
   $cookie = cookie('theme', 'dark', 60);  // 60 minutes
   return response('Success')->cookie($cookie);
   
   // Get cookie
   $theme = $request->cookie('theme');
   
   // Delete cookie
   return response()->cookie('theme', null, -1);
   ```

### Common Uses:
- User preferences (theme, language)
- Remember login credentials
- Tracking information
- Analytics

### ⚠️ Important:
- Cookies are visible to users - don't store passwords!
- Max 4KB per cookie
- Always validate cookie data
- Use HttpOnly flag for sensitive data

### Exercise:
1. Create a theme selector (light/dark)
2. Store preference in cookie
3. Load theme from cookie on page load
4. Change theme dynamically
5. Persist for 30 days

---

## STEP 7: Sending Emails

### What You'll Learn:
- How to send simple emails
- How to send emails with attachments
- How to handle bulk emails
- Email templates

### Tutorial:

1. **Configure Email**
   - Update `.env` with MAIL settings
   - Use Mailtrap.io for testing

2. **Send Email**
   - Go to http://localhost:8000/email/form
   - Enter recipient email
   - Click "Send Email"

3. **Email Code:**
   ```php
   public function sendEmail(Request $request) {
       Mail::send('emails.template', [
           'name' => $request->input('name'),
           'message' => $request->input('message'),
       ], function ($message) use ($request) {
           $message->to($request->input('email'))
                   ->subject('Hello!');
       });
   }
   ```

4. **Email Template:**
   ```blade
   <h2>Hello {{ $name }}!</h2>
   <p>{{ $message }}</p>
   ```

### Email with Attachment:
```php
Mail::send('emails.template', [], function ($message) {
    $message->to('user@example.com')
            ->attach(storage_path('app/document.pdf'));
});
```

### Exercise:
1. Send a welcome email to new users
2. Send email with PDF attachment
3. Send bulk emails to multiple users
4. Create beautiful email templates
5. Add logo and styling to emails

---

## STEP 8: Sessions - Storing Data

### What You'll Learn:
- How to store data in sessions
- How to store arrays in sessions
- How to use flash data

### Tutorial:

1. **Store Session Data**
   - Go to http://localhost:8000/session/form
   - Enter a key and value
   - Click "Store in Session"

2. **Store Data:**
   ```php
   // Single value
   session(['user_name' => 'John']);
   
   // Multiple values
   session([
       'user_id' => 123,
       'user_name' => 'John',
       'role' => 'admin'
   ]);
   
   // Flash data (next request only)
   session()->flash('success', 'Profile updated!');
   ```

3. **Common Patterns:**
   ```php
   // Store array
   $items = session('cart', []);
   $items[] = $product_id;
   session(['cart' => $items]);
   
   // Increment value
   session()->increment('page_views');
   ```

### Exercise:
1. Create a shopping cart system
2. Add items to session
3. Remove items from session
4. Display cart contents
5. Clear cart

---

## STEP 9: Sessions - Accessing Data

### What You'll Learn:
- How to retrieve session data
- How to check if session data exists
- How to use session data in views

### Tutorial:

1. **Access Session Data**
   - Go to http://localhost:8000/session/access
   - View all stored session data

2. **Retrieve Data:**
   ```php
   // Get value
   $name = session('user_name');
   
   // Get with default
   $role = session('role', 'guest');
   
   // Get all data
   $all = session()->all();
   
   // Check if exists
   if (session()->has('user_id')) {
       // Do something
   }
   
   // Get and delete
   $token = session()->pull('reset_token');
   ```

3. **In Blade View:**
   ```blade
   @if (session('user_name'))
       <p>Welcome, {{ session('user_name') }}!</p>
   @endif
   
   @if (session()->has('success'))
       <div class="alert alert-success">
           {{ session('success') }}
       </div>
   @endif
   ```

### Exercise:
1. Create a user profile page
2. Display session data in the page
3. Show success/error messages from session
4. Create a cart summary page

---

## STEP 10: Sessions - Deleting Data

### What You'll Learn:
- How to delete session data
- How to clear all sessions
- When to regenerate session ID

### Tutorial:

1. **Delete Session Data:**
   ```php
   // Delete single key
   session()->forget('theme');
   
   // Delete multiple keys
   session()->forget(['theme', 'language']);
   
   // Delete all data
   session()->flush();
   
   // Invalidate session
   session()->invalidate();
   
   // Regenerate ID (after login)
   session()->regenerate();
   ```

2. **When to Use:**
   - `forget()` - Remove specific preference
   - `flush()` - Clear cart before checkout
   - `invalidate()` - On logout
   - `regenerate()` - After login (security!)

### Exercise:
1. Create logout function that clears session
2. Implement "Clear Cart" button
3. Add session regeneration on login
4. Test data is properly deleted

---

## STEP 11: Localization - Setup

### What You'll Learn:
- How to set up multi-language support
- How to create language files
- How to use translations

### Tutorial:

1. **Language Files Structure:**
   ```
   resources/lang/
       en/
           messages.php
       es/
           messages.php
       fr/
           messages.php
   ```

2. **Create Language File:**
   ```php
   // resources/lang/en/messages.php
   return [
       'welcome' => 'Welcome to our app!',
       'hello' => 'Hello',
       'goodbye' => 'Goodbye',
   ];
   ```

3. **Use in Controller:**
   ```php
   $welcome = __('messages.welcome');
   ```

4. **Use in Blade:**
   ```blade
   <h1>{{ __('messages.welcome') }}</h1>
   ```

### Exercise:
1. Create language files for 3 languages
2. Add 10+ common phrases
3. Use translations in views
4. Create language switcher

---

## STEP 12: Localization - Advanced

### What You'll Learn:
- How to use translation parameters
- How to handle pluralization
- How to set application locale

### Tutorial:

1. **Translation with Parameters:**
   ```php
   // Language file
   'greeting' => 'Hello, :name!'
   
   // Usage
   __('messages.greeting', ['name' => 'John'])
   // Output: Hello, John!
   ```

2. **Pluralization:**
   ```php
   // Language file
   'apples' => '{0} No apples|{1} One apple|[2,*] :count apples'
   
   // Usage
   trans_choice('messages.apples', 5)
   // Output: 5 apples
   ```

3. **Set Application Locale:**
   ```php
   // In controller
   app()->setLocale('es');  // Switch to Spanish
   
   // Store preference
   session(['locale' => 'es']);
   
   // Create middleware
   public function handle(Request $request, Closure $next) {
       if (session('locale')) {
           app()->setLocale(session('locale'));
       }
       return $next($request);
   }
   ```

### Exercise:
1. Add parameters to 5 translations
2. Implement pluralization
3. Create language switcher dropdown
4. Save user's language preference
5. Load preference on login

---

## STEP 13: Integration Project

### Build a Multi-Language E-commerce Cart

**Requirements:**
1. Multi-language interface (EN, ES, FR)
2. Product listing with file uploads (images)
3. Shopping cart (session-based)
4. Send email on order
5. Store user preferences (cookies)
6. User profile with sessions

**Steps:**
1. Create Product model and migration
2. Create upload form for product images
3. Build multi-language product listings
4. Implement shopping cart with sessions
5. Create checkout with email notification
6. Store user preferences with cookies
7. Add language switcher

**Features to Implement:**
- ✅ Upload product images
- ✅ Display in multiple languages
- ✅ Add/remove from cart (session)
- ✅ Save preferences (cookies)
- ✅ Send order confirmation (email)
- ✅ User can switch language
- ✅ Cart persists across pages
- ✅ Old input on validation error

---

## Quick Checklist

### ✅ Completed Topics:
- [ ] URL Generation
- [ ] Request Data Retrieval
- [ ] Old Input (Flash Data)
- [ ] File Upload
- [ ] Cookies
- [ ] Email Sending
- [ ] Sessions - Store
- [ ] Sessions - Access
- [ ] Sessions - Delete
- [ ] Localization - Setup
- [ ] Localization - Advanced

### ✅ Practical Exercises:
- [ ] Form with Validation
- [ ] File Upload System
- [ ] Cookie Preferences
- [ ] Email Notifications
- [ ] Shopping Cart
- [ ] Multi-Language App
- [ ] Integration Project

---

## Troubleshooting

### Mail Not Sending?
1. Check `.env` MAIL_ settings
2. Use Mailtrap.io for testing
3. Check error logs: `storage/logs/laravel.log`

### Sessions Not Working?
1. Check `config/session.php` driver
2. Clear session cache: `php artisan cache:clear`
3. Check cookies are enabled

### Files Not Uploading?
1. Check `storage/app/public` has write permissions
2. Run: `php artisan storage:link`
3. Verify file validation rules

### Translation Not Showing?
1. Check language file syntax
2. Verify file path matches locale
3. Clear cache: `php artisan cache:clear`
4. Check app default locale in `config/app.php`

---

## Next Steps

1. **Review** - Go through each section again
2. **Practice** - Try all exercises
3. **Build** - Create the integration project
4. **Deploy** - Put your project live
5. **Optimize** - Add caching, security features

---

Good luck! 🚀 You've got this! 💪
