<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    /**
     * TOPIC 1: STORING SESSION DATA
     * Various ways to store data in sessions
     */

    public function storeSessionData(Request $request)
    {
        $request->validate([
            'key' => 'required|string',
            'value' => 'required|string',
        ]);

        $key = $request->input('key');
        $value = $request->input('value');

        // Method 1: Using session() helper
        session([$key => $value]);

        // Method 2: Using the Session facade
        // Session::put($key, $value);

        // Store multiple values at once
        $session->put([
            'user_name' => 'John Doe',
            'user_id' => 123,
            'preferences' => ['theme' => 'dark', 'language' => 'en']
        ]);

        // Store only once (until retrieved)
        session()->flash('success', 'Data stored successfully!');

        return redirect('/session/access')->with('success', 'Session data stored!');
    }

    /**
     * TOPIC 2: ACCESSING SESSION DATA
     * Retrieving data from sessions
     */

    public function accessSessionData(Request $request)
    {
        // Method 1: Using session() helper
        $userName = session('user_name');

        // Method 2: Using the Session facade
        // $userName = Session::get('user_name');

        // Get with default value
        $theme = session('preferences.theme', 'light');

        // Get all session data
        $allSession = session()->all();

        // Check if key exists in session
        $hasKey = session()->has('user_name');

        // Check if key exists and is not empty
        $keyExists = session()->exists('user_id');

        // Get and forget (retrieve once then delete)
        $successMessage = session()->pull('success', 'No success message');

        $data = [
            'user_name' => $userName ?? 'Not set',
            'theme' => $theme,
            'all_session' => $allSession,
            'has_key' => $hasKey,
            'key_exists' => $keyExists,
            'success_message' => $successMessage,
        ];

        return view('sessions.access-session', $data);
    }

    /**
     * TOPIC 3: DELETING SESSION DATA
     * Removing data from sessions
     */

    public function deleteSessionData(Request $request)
    {
        $request->validate([
            'key' => 'required|string',
        ]);

        $key = $request->input('key');

        // Method 1: Forget a single key
        session()->forget($key);

        // Method 2: Forget multiple keys
        session()->forget(['user_name', 'user_id']);

        // Method 3: Flush all session data
        // session()->flush();

        // Method 4: Invalidate the entire session
        // session()->invalidate();

        return view('sessions.delete-result', [
            'message' => "Session key '{$key}' deleted successfully!",
        ]);
    }

    /**
     * HELPER METHODS FOR SESSION MANAGEMENT
     */

    // Show session management form
    public function showSessionForm()
    {
        return view('sessions.session-form');
    }

    // Show all current session data
    public function showAllSession()
    {
        $sessionData = session()->all();

        return view('sessions.all-session', [
            'session_data' => $sessionData,
            'session_count' => count($sessionData),
        ]);
    }

    // Regenerate session ID (security best practice)
    public function regenerateSessionId()
    {
        session()->regenerate();

        return view('sessions.regenerate-result', [
            'message' => 'Session ID regenerated successfully!',
        ]);
    }

    // Increment a session value
    public function incrementSessionValue(Request $request)
    {
        $request->validate([
            'key' => 'required|string',
        ]);

        $key = $request->input('key');
        $currentValue = session()->get($key, 0);
        session([$key => $currentValue + 1]);

        return view('sessions.increment-result', [
            'key' => $key,
            'new_value' => session()->get($key),
        ]);
    }

    // Store array in session
    public function storeArrayInSession(Request $request)
    {
        $request->validate([
            'items' => 'required|string', // Comma-separated items
        ]);

        $items = array_map('trim', explode(',', $request->input('items')));

        session(['shopping_cart' => $items]);

        return view('sessions.array-result', [
            'items' => session('shopping_cart'),
        ]);
    }

    // Add item to session array
    public function addToSessionArray(Request $request)
    {
        $request->validate([
            'item' => 'required|string',
        ]);

        $items = session('shopping_cart', []);
        $items[] = $request->input('item');

        session(['shopping_cart' => $items]);

        return view('sessions.array-result', [
            'items' => session('shopping_cart'),
            'message' => 'Item added to session array!',
        ]);
    }

    // Flash data (temporary, one-time use)
    public function flashData(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        // Flash data persists only for the next request
        session()->flash('alert', $request->input('message'));

        // Or using the helper
        // flash('Message text')->success();

        return redirect('/session/access');
    }
}
