<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocalizationController extends Controller
{
    /**
     * TOPIC: LARAVEL LOCALIZATION
     * Multi-language support in Laravel
     */

    // Set the application locale
    public function setLocale(Request $request)
    {
        $request->validate([
            'locale' => 'required|string|in:en,es,fr,de', // Available locales
        ]);

        $locale = $request->input('locale');

        // Set locale for the current request
        app()->setLocale($locale);

        // Store in session for persistence
        session(['locale' => $locale]);

        return redirect('/localization/demo')->with('success', 'Language changed to ' . $locale);
    }

    // Get current locale
    public function getCurrentLocale()
    {
        $currentLocale = app()->getLocale();

        return view('localization.current-locale', [
            'current_locale' => $currentLocale,
            'available_locales' => ['en', 'es', 'fr', 'de'],
        ]);
    }

    // Demo localized strings
    public function demoLocalization()
    {
        // Get current locale from session or use default
        if (session()->has('locale')) {
            app()->setLocale(session('locale'));
        }

        $currentLocale = app()->getLocale();

        // Translation examples
        $translations = [
            'welcome' => __('messages.welcome'),
            'greeting' => __('messages.greeting', ['name' => 'John']),
            'items_count' => __('messages.items_count', ['count' => 5]),
            'hello' => trans('messages.hello'),
            'goodbye' => trans('messages.goodbye'),
        ];

        return view('localization.demo', [
            'translations' => $translations,
            'current_locale' => $currentLocale,
            'available_locales' => ['en', 'es', 'fr', 'de'],
        ]);
    }

    // Using trans_choice for pluralization
    public function pluralizationExample(Request $request)
    {
        $request->validate([
            'count' => 'required|integer|min:0',
        ]);

        $count = $request->input('count');

        // Using trans_choice for pluralization
        $message = trans_choice('messages.apples', $count);

        return view('localization.pluralization', [
            'count' => $count,
            'message' => $message,
        ]);
    }

    // Using locale in routes
    public function localeFromRoute($locale = 'en')
    {
        // Validate and set locale
        if (in_array($locale, ['en', 'es', 'fr', 'de'])) {
            app()->setLocale($locale);
        }

        return view('localization.demo', [
            'current_locale' => app()->getLocale(),
            'available_locales' => ['en', 'es', 'fr', 'de'],
        ]);
    }

    // Show localization form
    public function showLocalizationForm()
    {
        return view('localization.localization-form', [
            'available_locales' => ['en', 'es', 'fr', 'de'],
        ]);
    }

    // Using localized validation messages
    public function validateWithLocalization(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'age' => 'required|integer|min:18|max:100',
        ]);

        return view('localization.validation-result', [
            'validated_data' => $validated,
            'message' => __('messages.validation_success'),
        ]);
    }

    // Check if a translation exists
    public function checkTranslationExists(Request $request)
    {
        $request->validate([
            'translation_key' => 'required|string',
        ]);

        $key = $request->input('translation_key');
        $locale = app()->getLocale();

        // Check if translation exists
        $exists = __($key) !== $key; // If returns original key, translation doesn't exist

        return view('localization.translation-check', [
            'key' => $key,
            'exists' => $exists,
            'locale' => $locale,
            'translation' => __($key),
        ]);
    }

    // Get all available locales
    public function getAvailableLocales()
    {
        $locales = ['en', 'es', 'fr', 'de'];
        $localeNames = [
            'en' => 'English',
            'es' => 'Spanish',
            'fr' => 'French',
            'de' => 'German',
        ];

        return view('localization.available-locales', [
            'locales' => $locales,
            'locale_names' => $localeNames,
            'current_locale' => app()->getLocale(),
        ]);
    }

    // Locale-specific date formatting
    public function formatDates()
    {
        $locale = app()->getLocale();
        
        $date = now();

        // Format date based on locale
        $formatted = match($locale) {
            'es' => $date->format('d/m/Y'), // Spanish format
            'fr' => $date->format('d/m/Y'), // French format
            'de' => $date->format('d.m.Y'), // German format
            default => $date->format('m/d/Y'), // English format
        };

        return view('localization.date-formatting', [
            'date' => $date,
            'formatted_date' => $formatted,
            'locale' => $locale,
        ]);
    }

    // Example: Using localized database queries
    public function localizedDatabaseContent()
    {
        $locale = app()->getLocale();

        // Example: Fetch content based on locale
        $content = [
            'en' => 'This is English content',
            'es' => 'Este es contenido en español',
            'fr' => 'Ceci est un contenu en français',
            'de' => 'Dies ist deutscher Inhalt',
        ];

        return view('localization.database-content', [
            'content' => $content[$locale] ?? $content['en'],
            'locale' => $locale,
        ]);
    }
}
