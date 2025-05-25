<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\CommentAdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CoffeeReviewController;

use App\Models\{User, News, Coffee, FaqCategory, ContactSubmission, FaqSubmission};
use App\Mail\ContactFormSubmitted;

/* Publieke routes */

Route::get('/', function () {
    return view('welcome', [
        'coffees' => Coffee::all(),
        'categories' => FaqCategory::with('faqs')->get(),
        'newsItems' => News::whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->latest('published_at')->take(3)->get(),
    ]);
})->name('home');

Route::get('/menu', function () {
    return view('menu', [
        'coffees' => Coffee::with('reviews.user')->get()
    ]);
})->name('menu');

Route::post('/coffee/{coffee}/review', [CoffeeReviewController::class, 'store'])
    ->middleware('auth')->name('coffee.reviews.store');

Route::get('/faq', function () {
    return view('faq.index', [
        'categories' => FaqCategory::with('faqs')->get()
    ]);
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
    return view('news.index', [
        'newsItems' => News::whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->latest('published_at')->paginate(6)
    ]);
})->name('news.index');

Route::get('/nieuws/{news}', fn (News $news) => view('news.show', compact('news')))->name('news.show');

Route::post('/nieuws/{news}/comment', [CommentController::class, 'store'])
    ->middleware('auth')->name('comments.store');

Route::view('/contact', 'contact')->name('contact');

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

/* Gebruikersprofielen (publiek) */
Route::get('/gebruikers', fn () => view('users.index', [
    'users' => User::select('id', 'name', 'username', 'profile_photo', 'bio')->paginate(12)
]))->name('users.index');

Route::get('/users/{user}', [ProfileController::class, 'show'])->name('users.show');

/* Symlink fix via browser */
Route::get('/storage-link', function () {
    $target = storage_path('app/public');
    $link = public_path('storage');

    if (!file_exists($link)) {
        symlink($target, $link);
        return 'Symlink succesvol aangemaakt!';
    }

    return 'Symlink bestaat al.';
});

/* Auth routes */
require __DIR__ . '/auth.php';

/* Gebruikersroutes */
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', fn () => view('users.dashboard', [
        'user' => Auth::user()
    ]))->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('password.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/bestelling', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/bestelling', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/mijn-bestellingen', [OrderController::class, 'index'])->name('orders.index');
    Route::delete('/bestelling/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');
});

/* Admin routes */
Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', fn () => view('admin.dashboard'))->name('dashboard');

    Route::resource('news', NewsController::class)->except(['show']);
    Route::resource('users', UserController::class)->except(['show']);
    Route::resource('faq', FaqController::class)->except(['show']);
    Route::resource('comments', CommentAdminController::class)->only(['index', 'destroy']);

    Route::get('faq-submissions', fn () => view('admin.faq_submissions.index', [
        'submissions' => FaqSubmission::latest()->paginate(20)
    ]))->name('faq-submissions.index');

    Route::get('contact-submissions', fn () => view('admin.contact_submissions.index', [
        'subs' => ContactSubmission::latest()->paginate(20)
    ]))->name('contact_submissions.index');

    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');

    Route::post('faq-categories', function (Request $request) {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:faq_categories,name'
        ]);
        FaqCategory::create($data);
        return redirect()->route('admin.faq.index')->with('success', 'Categorie toegevoegd.');
    })->name('faq-categories.store');
});