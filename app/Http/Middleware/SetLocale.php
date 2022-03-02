<?php
declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if ($request->is('cs/*')) {
            $locale = 'cs';
        } else if ($request->is('pl/*')) {
            $locale = 'pl';
        } else if ($request->is('sk/*')) {
            $locale = 'sk';
        } else if ($request->is('hu/*')) {
            $locale = 'hu';
        } else if ($request->is('ro/*')) {
            $locale = 'ro';
        } else if ($request->is('de/*')) {
            $locale = 'de';
        } else if ($request->is('ua/*')) {
            $locale = 'ua';
        }

        //set the derived locale
        App::setLocale($locale ?? 'en');

        return $next($request);
    }
}
