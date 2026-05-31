    <?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RequestDataController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\LocalizationController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

/**
 * REQUEST DATA & URL GENERATION ROUTES
 */
Route::prefix('request-data')->group(function () {
    Route::get('/', [RequestDataController::class, 'showRequestForm']);
    Route::get('/url-generation', [RequestDataController::class, 'showUrlGeneration']);
    Route::get('/form', [RequestDataController::class, 'showRequestForm']);
    Route::post('/process', [RequestDataController::class, 'processRequest']);
    
    // Old Input Routes
    Route::get('/old-input-form', [RequestDataController::class, 'showFormWithOldInput']);
    Route::post('/redirect-with-old-input', [RequestDataController::class, 'redirectWithOldInput']);
    
    // File Upload Routes
    Route::get('/upload-form', [RequestDataController::class, 'showUploadForm']);
    Route::post('/upload', [RequestDataController::class, 'handleFileUpload']);
    
    // Cookie Routes
    Route::get('/cookie-form', [RequestDataController::class, 'showCookieForm']);
    Route::post('/cookie/set', [RequestDataController::class, 'handleCookie']);
    Route::get('/cookie/retrieve', [RequestDataController::class, 'retrieveCookie']);
    Route::post('/cookie/delete', [RequestDataController::class, 'deleteCookie']);
    
    // Request Info Routes
    Route::get('/info', [RequestDataController::class, 'getRequestInfo']);
});

/**
 * EMAIL ROUTES
 */
Route::prefix('email')->group(function () {
    Route::get('/form', [EmailController::class, 'showEmailForm']);
    Route::post('/send-simple', [EmailController::class, 'sendSimpleEmail']);
    Route::post('/send-mailable', [EmailController::class, 'sendMailableEmail']);
    Route::post('/send-with-attachment', [EmailController::class, 'sendEmailWithAttachment']);
    Route::post('/send-bulk', [EmailController::class, 'sendBulkEmails']);
    Route::post('/send-html', [EmailController::class, 'sendHtmlEmail']);
});

/**
 * SESSION ROUTES
 */
Route::prefix('session')->group(function () {
    Route::get('/', [SessionController::class, 'showSessionForm']);
    Route::get('/form', [SessionController::class, 'showSessionForm']);
    Route::post('/store', [SessionController::class, 'storeSessionData']);
    Route::get('/access', [SessionController::class, 'accessSessionData']);
    Route::post('/delete', [SessionController::class, 'deleteSessionData']);
    Route::get('/show-all', [SessionController::class, 'showAllSession']);
    Route::get('/regenerate', [SessionController::class, 'regenerateSessionId']);
    Route::post('/increment', [SessionController::class, 'incrementSessionValue']);
    Route::post('/array/store', [SessionController::class, 'storeArrayInSession']);
    Route::post('/array/add', [SessionController::class, 'addToSessionArray']);
    Route::post('/flash', [SessionController::class, 'flashData']);
});

/**
 * LOCALIZATION ROUTES
 */
Route::prefix('localization')->group(function () {
    Route::get('/', [LocalizationController::class, 'showLocalizationForm']);
    Route::get('/demo', [LocalizationController::class, 'demoLocalization']);
    Route::get('/current', [LocalizationController::class, 'getCurrentLocale']);
    Route::post('/set-locale', [LocalizationController::class, 'setLocale']);
    Route::get('/set/{locale}', [LocalizationController::class, 'localeFromRoute']);
    Route::get('/pluralization', [LocalizationController::class, 'pluralizationExample']);
    Route::get('/form', [LocalizationController::class, 'showLocalizationForm']);
    Route::post('/validate', [LocalizationController::class, 'validateWithLocalization']);
    Route::get('/check/{key}', [LocalizationController::class, 'checkTranslationExists']);
    Route::get('/locales', [LocalizationController::class, 'getAvailableLocales']);
    Route::get('/dates', [LocalizationController::class, 'formatDates']);
    Route::get('/content', [LocalizationController::class, 'localizedDatabaseContent']);
});
