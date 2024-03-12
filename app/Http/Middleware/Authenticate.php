<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('login');
    }
    // Authenticate.php
// protected function redirectTo($request)
// {
//     if (! $request->expectsJson()) {
//         // Jangan mengarahkan pengguna yang sudah login kembali ke halaman login
//         return route('home');
//     }
// }
}
