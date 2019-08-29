<?php
/**
 * Created by PhpStorm.
 * User: sergisolsona
 * Date: 24/08/2019
 * Time: 17:44
 */

namespace Endo\EndoCore\App\Http\Middleware;

use Closure;
use Endo\EndoCore\App\Models\EndoLanguage;
use Illuminate\Support\Facades\URL;

class Locale
{

    public function handle($request, Closure $next)
    {
        $isDomainLocale = endo_setting('domain_locale');
        $isSingleLocale = endo_setting('single_locale');

        $locales = EndoLanguage::where('active', 1)->orderBy('default', 'desc')->get();

        if (!$isDomainLocale && !$isSingleLocale) {
            $currentLocale = $request->route('locale');

            if (!$locales->where('code', $currentLocale)->first()) {
                $defLocale = $locales->where('default', 1)->first();

                if (!$defLocale) {
                    $defLocale = $locales->first();
                }

                return redirect('/' . $defLocale->code . '/' . $request->path(), 301);
            }
        } else {
            // Path could have a locale
            $path = explode('/', $request->path());

            $localePath = count($path) ? $path[0] : null;

            if ($localePath && $locales->where('code', $localePath)->first()) {
                unset($path[0]);
                return redirect('/' . implode('/', $path), 301);
            }

            $currentLocale = $locales->first()->code;
            if ($isDomainLocale) {
                $locale = $locales->where('domain', $request->getHost())->first();
                $currentLocale = $locale ? $locale->code : $currentLocale;
            }
        }

        app()->setLocale($currentLocale);
        URL::defaults(['locale' => $currentLocale]);

        return $next($request);
    }
}