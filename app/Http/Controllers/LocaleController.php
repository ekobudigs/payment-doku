<?php

namespace App\Http\Controllers;

use App\Constants\AppLocale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

class LocaleController extends Controller
{
    /**
     * Switch app locale / language.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function switch(Request $request)
    {
        try {
            $locales = AppLocale::values();
            $locale = in_array($request->locale, $locales) ? $request->locale : $locales[0];

            session()->put('locale', $locale);

            $referer = $request->headers->get('Referer');
            $routeName = Route::getRoutes()->match(request()->create($referer))->getName();

            return redirect()->route($routeName, $locale);
        }
        //
        catch (\Throwable $th) {
            return ResponseController::failed($th->getMessage());
        }
    }
}
