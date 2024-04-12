<?php

use App\Models\User;
use App\Models\Ticket;
use Illuminate\Support\Facades\Route;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use App\Http\Controllers\RoadMap\DataController;
use App\Http\Controllers\Auth\OidcAuthController;
use Laravel\Socialite\Facades\Socialite;

// Share ticket
Route::get('/tickets/share/{ticket:code}', function (Ticket $ticket) {
    return redirect()->to(route('filament.resources.tickets.view', $ticket));
})->name('filament.resources.tickets.share');

// Validate an account
Route::get('/validate-account/{user:creation_token}', function (User $user) {
    return view('validate-account', compact('user'));
})
    ->name('validate-account')
    ->middleware([
        'web',
        DispatchServingFilamentEvent::class
    ]);

// Login default redirection
Route::redirect('/login-redirect', '/login')->name('login');

// Road map JSON data
Route::get('road-map/data/{project}', [DataController::class, 'data'])
    ->middleware(['verified', 'auth'])
    ->name('road-map.data');

Route::name('oidc.')
    ->prefix('oidc')
    ->group(function () {
        Route::get('redirect', [OidcAuthController::class, 'redirect'])->name('redirect');
        Route::get('callback', [OidcAuthController::class, 'callback'])->name('callback');
    });


// Login and Registration overriden to use the passport

Route::get("/login", function () {
    return Socialite::driver('laravelpassport')->redirect();
})->name("filament.auth.login");

Route::get("/register", function () {
    return Socialite::driver('laravelpassport')->redirect();
})->name("filament.auth.register");


Route::get("/", function(){
    return "THis is home";
});


Route::get('/auth/callback', function () {
    $res = Socialite::driver('laravelpassport')->user();
    $nexudyUser = $res->user;

    $user = User::where('email', $nexudyUser["email"])->first();
    if (!$user) {
        $user = User::createUser(
            (object) [
                "email" => $nexudyUser["email"],
                "name" => $nexudyUser["first_name"] ." ". $nexudyUser["last_name"],                
                "password" => null,
            ]
        );

        try {
            // Mail::to( $nexudyUser->getEmail() )->send(new AccountCreated ());
        } catch (\Exception $e) {
            return response([
                'errors' => [
                    'email' => [
                        $e->getMessage()
                    ]
                ]
            ], 422);
        }

    }

    Auth::login($user);
    return redirect()->route('filament.pages.dashboard');
});

