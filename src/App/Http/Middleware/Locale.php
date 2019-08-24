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

        if (!$isDomainLocale) {
            $locales = EndoLanguage::all();
            $currentLocale = $request->route('locale');

            if (!$locales->where('code', $currentLocale)->first()) {
                $defLocale = $locales->where('default', 1)->first();

                if (!$defLocale) {
                    $defLocale = $locales->first();
                }

                return redirect('/' . $defLocale->code . '/' . $request->path(), 301);
            }

            URL::defaults(['locale' => $currentLocale]);
        }

        return $next($request);
    }
}