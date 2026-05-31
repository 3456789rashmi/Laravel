<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RequestDataController extends Controller
{
    /**
     * TOPIC 1: URL GENERATION
     * Generating URLs in Laravel
     */
    
    // Display URL generation examples
    public function showUrlGeneration()
    {
        return view('request-data.url-generation');
    }

    /**
     * TOPIC 2: REQUEST DATA RETRIEVAL
     * Retrieving different types of request data
     */
    
    // Display a form to submit data
    public function showRequestForm()
    {
        return view('request-data.request-form');
    }

    // Process the form and retrieve request data
    public function processRequest(Request $request)
    {
        // Retrieve individual input values
        $name = $request->input('name');
        $email = $request->input('email');
        $message = $request->input('message', 'No message provided'); // With default value

        // Get all input data
        $allData = $request->all();

        // Get only specific input fields
        $onlyInputs = $request->only('name', 'email');

        // Get all except specific fields
        $exceptInputs = $request->except('_token');

        // Check if input exists
        $hasName = $request->has('name');
        $hasPhone = $request->filled('phone'); // Checks if field exists and is not empty

        $data = [
            'name' => $name,
            'email' => $email,
            'message' => $message,
            'all_data' => $allData,
            'only_inputs' => $onlyInputs,
            'except_inputs' => $exceptInputs,
            'has_name' => $hasName,
            'phone_filled' => $hasPhone,
        ];

        return view('request-data.request-result', $data);
    }

    /**
     * TOPIC 3: OLD INPUT (Flash Data)
     * Retrieving previously submitted form data after redirect
     */

    // Redirect with old input
    public function redirectWithOldInput(Request $request)
    {
        // Validation might fail, so redirect back with old input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
        ]);

        return redirect('/')->with('success', 'Data validated!');
    }

    // Show form with old input (useful after validation errors)
    public function showFormWithOldInput()
    {
        return view('request-data.form-with-old-input');
    }

    /**
     * TOPIC 4: UPLOADED FILES
     * Handling file uploads
     */

    public function showUploadForm()
    {
        return view('request-data.upload-form');
    }

    public function handleFileUpload(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'document' => 'nullable|mimes:pdf,doc,docx|max:5120',
        ]);

        $data = [];

        // Handle profile photo upload
        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');

            // Get file information
            $data['file_name'] = $file->getClientOriginalName();
            $data['file_size'] = $file->getSize();
            $data['file_mime'] = $file->getMimeType();
            $data['file_extension'] = $file->getClientOriginalExtension();

            // Store the file
            $path = $file->store('uploads/profiles', 'public');
            $data['file_path'] = $path;
            $data['file_url'] = asset('storage/' . $path);
        }

        // Handle optional document upload
        if ($request->hasFile('document')) {
            $document = $request->file('document');
            $docPath = $document->store('uploads/documents', 'public');
            $data['document_path'] = $docPath;
        }

        return view('request-data.upload-result', $data);
    }

    /**
     * TOPIC 5: COOKIES
     * Setting, retrieving, and managing cookies
     */

    public function showCookieForm()
    {
        return view('request-data.cookie-form');
    }

    public function handleCookie(Request $request)
    {
        $request->validate([
            'cookie_name' => 'required|string',
            'cookie_value' => 'required|string',
        ]);

        $cookieName = $request->input('cookie_name');
        $cookieValue = $request->input('cookie_value');

        // Create a cookie and return response
        $cookie = cookie($cookieName, $cookieValue, 60); // 60 minutes

        return response('Cookie set successfully!')
                    ->cookie($cookie);
    }

    public function retrieveCookie(Request $request)
    {
        // Get a specific cookie
        $userPreference = $request->cookie('user_preference');

        // Get all cookies
        $allCookies = $request->cookies->all();

        // Check if cookie exists
        $hasCookie = $request->hasCookie('user_preference');

        $data = [
            'user_preference' => $userPreference ?? 'No preference set',
            'all_cookies' => $allCookies,
            'has_cookie' => $hasCookie,
        ];

        return view('request-data.cookie-result', $data);
    }

    public function deleteCookie()
    {
        // Delete a cookie by setting it to null
        return response('Cookie deleted!')
                    ->cookie('user_preference', null, -1);
    }

    /**
     * TOPIC 6: REQUEST HEADERS AND BODY
     * Accessing request headers and raw body
     */

    public function getRequestInfo(Request $request)
    {
        $data = [
            'method' => $request->method(),
            'path' => $request->path(),
            'url' => $request->url(),
            'user_agent' => $request->userAgent(),
            'ip' => $request->ip(),
            'headers' => $request->headers->all(),
            'is_ajax' => $request->ajax(),
        ];

        return view('request-data.request-info', $data);
    }
}
