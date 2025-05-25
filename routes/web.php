<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\CommentAdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CoffeeReviewController;

use App\Mail\ContactFormSubmitted;
use App\Models\ContactSubmission;
use App\Models\News;
use App\Models\FaqCategory;
use App\Models\Coffee;
use App\Models\FaqSubmission;
use App\Models\User;

/* Publieke routes */

Route::get('/', function () {
    $coffees = Coffee::all();
    $categories = FaqCategory::with('faqs')->get();
    $newsItems = News::whereNotNull('published_at')
        ->where('published_at', '<=', now())
        ->latest('published_at')
        ->take(3)
        ->get();

    return view('welcome', compact('coffees', 'categories', 'newsItems'));
})->name('home');

Route::get('/menu', function () {
    $coffees = Coffee::with('reviews.user')->get();
    return view('menu', compact('coffees'));
})->name('menu');

Route::post('/coffee/{coffee}/review', [CoffeeReviewController::class, 'store'])
    ->middleware('auth')
    ->name('coffee.reviews.store');

Route::get('/faq', function () {
    $categories = FaqCategory::with('faqs')->get();
    return view('faq.index', compact('categories'));
})->name('faq.index');

Route::post('/faq/submit', function (Request $request) {
    $data = $request->validate([
        'name'    => 'required|string|max:255',
        'email'   => 'required|email|max:255',
        'message' => 'required|string',
    ]);

    FaqSubmission::create($data);
    return redirect()->route('faq.index')->with('success', 'Bedankt voor je vraag!');
})->name('faq.submit');

Route::get('/nieuws', function () {
    $newsItems = News::whereNotNull('published_at')
        ->where('published_at', '<=', now())
        ->latest('published_at')
        ->paginate(6);

    return view('news.index', compact('newsItems'));
})->name('news.index');

Route::get('/nieuws/{news}', function (News $news) {
    return view('news.show', compact('news'));
})->name('news.show');

Route::post('/nieuws/{news}/comment', [CommentController::class, 'store'])
    ->middleware('auth')
    ->name('comments.store');

Route::get('/contact', fn () => view('contact'))->name('contact');

Route::post('/contact', function (Request $request) {
    $data = $request->validate([
        'name'    => 'required|string|max:255',
        'email'   => 'required|email|max:255',
        'message' => 'required|string',
    ]);

    ContactSubmission::create($data);
    Mail::to(config('mail.admin_address'))->send(new ContactFormSubmitted($data));
    return back()->with('success', 'Je bericht is verzonden!');
})->name('contact.send');

/* Publieke gebruikersprofielen */

Route::get('/gebruikers', function () {
    $users = User::select('id', 'name', 'username', 'profile_photo')->paginate(12);
    return view('users.index', compact('users'));
})->name('users.index');

Route::get('/users/{user}', [ProfileController::class, 'show'])->name('users.show');

/* Storage symlink aanmaken via browser (alleen tijdelijk nodig!) */
Route::get('/storage-link', function () {
    $targetFolder = storage_path('app/public');
    $linkFolder = $_SERVER['DOCUMENT_ROOT'] . '/storage';

    if (!file_exists($linkFolder)) {
        symlink($targetFolder, $linkFolder);
        return 'Symlink succesvol aangemaakt!';
    }

    return 'Symlink bestaat al.';
});

/* Auth routes */
require __DIR__ . '/auth.php';

/* Gebruikersroutes (auth + verified) */

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', fn () => view('users.dashboard'))->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/bestelling', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/bestelling', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/mijn-bestellingen', [OrderController::class, 'index'])->name('orders.index');
    Route::delete('/bestelling/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');
});

/* Admin routes */

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', fn () => view('admin.dashboard'))->name('dashboard');

    Route::resource('news', NewsController::class)->except(['show']);
    Route::resource('users', UserController::class)->except(['show']);
    Route::resource('faq', FaqController::class)->except(['show']);
    Route::resource('comments', CommentAdminController::class)->only(['index', 'destroy']);

    Route::get('faq-submissions', fn () => view('admin.faq_submissions.index', [
        'submissions' => FaqSubmission::latest()->paginate(20),
    ]))->name('faq-submissions.index');

    Route::get('contact-submissions', fn () => view('admin.contact_submissions.index', [
        'subs' => ContactSubmission::latest()->paginate(20),
    ]))->name('contact_submissions.index');

    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');

    Route::post('faq-categories', function (Request $request) {
        $data = $request->validate(['name' => 'required|string|max:255|unique:faq_categories,name']);
        FaqCategory::create($data);
        return redirect()->route('admin.faq.index')->with('success', 'Categorie toegevoegd.');
    })->name('faq-categories.store');
});