<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AIMatchingController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\InternshipController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Models\Contact;
use App\Models\Internship;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $internships = Internship::where('is_active', true)->latest()->paginate(6);
    return view('welcome', compact('internships'));
});

Route::get('/register/business', function () {
    return view('auth.register', ['role' => 'business']);
})->name('register.business');

Route::get('/features', function () {
    return view('pages.features');
})->name('features');

Route::get('/how-it-works', function () {
    return view('pages.how-it-works');
})->name('how-it-works');

Route::get('/faq', function () {
    return view('pages.faq');
})->name('faq');

Route::get('/about', function () {
    return view('pages.about');
})->name('about');

Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');

Route::post('/contact', function (\Illuminate\Http\Request $request) {
    $request->validate([
        'name'    => 'required|string|max:255',
        'email'   => 'required|email',
        'subject' => 'required|string|max:255',
        'message' => 'required|string',
    ]);

    Contact::create([
        'name'    => $request->name,
        'email'   => $request->email,
        'subject' => $request->subject,
        'message' => $request->message,
    ]);

    Mail::raw("Name: {$request->name}\nEmail: {$request->email}\n\nMessage: {$request->message}", function ($mail) use ($request) {
        $mail->to('wizlad3@gmail.com')
            ->subject("Contact Form: {$request->subject}")
            ->replyTo($request->email);
    });

    return back()->with('contact_success', true);
})->name('contact.submit');

Route::get('/privacy', function () {
    return view('pages.privacy');
})->name('privacy');

Route::get('/terms', function () {
    return view('pages.terms');
})->name('terms');

Route::get('/dashboard', function () {
    if (Auth::user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    if (Auth::user()->role === 'business') {
        return view('dashboards.business');
    }
    if (Auth::user()->role === 'student') {
        $applications     = Auth::user()->applications ?? collect();
        $internshipsCount = Internship::where('is_active', true)->count();
        return view('dashboard', compact('applications', 'internshipsCount'));
    }
    return redirect('/');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth', 'verified')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth', 'verified')->group(function () {
    Route::get('/internships', [InternshipController::class, 'index'])->name('internships.index');

    Route::get('/internships/create', [InternshipController::class, 'create'])->name('internships.create');

    Route::post('/internships', [InternshipController::class, 'store'])->name('internships.store');

    Route::get('/internships/{internship}', [InternshipController::class, 'show'])->name('internships.show');

    Route::get('/dashboard/matched', [InternshipController::class, 'matched'])->name('dashboard.matched');

    Route::get('/applications', [ApplicationController::class, 'index'])->name('applications.index');

    Route::post('/applications', [ApplicationController::class, 'store'])->name('applications.store');

    Route::get('/applications/create/{internship}', [ApplicationController::class, 'create'])->name('applications.create');

    Route::patch('/applications/{application}', [ApplicationController::class, 'update'])->name('applications.update');

    Route::get('/internships/{internship}/applications', [InternshipController::class, 'applications'])->name('internships.applications');

    Route::get('/student/{user}', [ProfileController::class, 'showStudent'])->name('student.show');

    // AI Matching
    Route::get('/ai-matches', [AIMatchingController::class, 'getMatches'])->name('ai.matches');

    // Messages
    Route::get('/applications/{application}/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::post('/applications/{application}/messages', [MessageController::class, 'store'])->name('messages.store');
    Route::get('/applications/{application}/messages/json', [MessageController::class, 'getMessages'])->name('messages.json');
    Route::get('/messages/unread', [MessageController::class, 'getUnreadCount'])->name('messages.unread');
});

// Activity feed (public)
Route::get('/activity-feed', [ActivityController::class, 'getFeed'])->name('activity.feed');

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/internships', [AdminController::class, 'internships'])->name('internships');
    Route::get('/applications', [AdminController::class, 'applications'])->name('applications');
    Route::get('/contacts', [AdminController::class, 'contacts'])->name('contacts');
    Route::post('/contact/{contact}/read', [AdminController::class, 'markContactRead'])->name('contact.read');
    Route::delete('/user/{user}', [AdminController::class, 'deleteUser'])->name('user.delete');
    Route::delete('/internship/{internship}', [AdminController::class, 'deleteInternship'])->name('internship.delete');
    Route::post('/contact/{contact}/reply', [AdminController::class, 'replyContact'])->name('contact.reply');
});

require __DIR__ . '/auth.php';
Route::get('/test', function () {return view('test');});
Route::get('/full', function () {return view('test-full');});
