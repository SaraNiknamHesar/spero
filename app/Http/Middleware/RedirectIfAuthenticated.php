<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

///sara
class RedirectIfAuthenticated
{
    /**
     * The callback that should be used to generate the authentication redirect path.
     *
     * @var callable|null
     */
    protected static $redirectToCallback;

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // این متد بررسی می‌کند که آیا کاربر با یکی از گاردهای مشخص‌شده احراز هویت شده است یا نه.
    // اگر لاگین باشد او را به مسیر مشخص‌شده Redirect می‌کند؛ اگر نه، درخواست را ادامه می‌دهد.
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return redirect($this->redirectTo($request, $guard));
            }
        }

        return $next($request);
    }

    /**
     * Get the path the user should be redirected to when they are authenticated.
     */
    // این گارد وب رو خودمون وارد کردیم 
    protected function redirectTo(Request $request, string $guard = 'web'): ?string
    {
        return static::$redirectToCallback
            ? call_user_func(static::$redirectToCallback, $request)
            : $this->defaultRedirectUri($guard);
    }

    /**
     * Get the default URI the user should be redirected to when they are authenticated.
     */
    protected function defaultRedirectUri(String $guard): string
    {
        // foreach (['dashboard', 'home'] as $uri) {
        //     if (Route::has($uri)) {
        //         return route($uri);
        //     }
        // }

        // $routes = Route::getRoutes()->get('GET');

        // foreach (['dashboard', 'home'] as $uri) {
        //     if (isset($routes[$uri])) {
        //         return '/' . $uri;
        //     }
        // }

        if ($guard == "admin") {
            return route('admin.dashboard');
        }
        if ($guard = "web") {
            return route('dashboard');
        }
        return '/';
    }

    /**
     * Specify the callback that should be used to generate the redirect path.
     *
     * @param  callable  $redirectToCallback
     * @return void
     */
    public static function redirectUsing(callable $redirectToCallback)
    {
        static::$redirectToCallback = $redirectToCallback;
    }
}
