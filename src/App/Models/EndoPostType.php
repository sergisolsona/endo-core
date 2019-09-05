<?php
/**
 * Created by PhpStorm.
 * User: sergisolsona
 * Date: 02/09/2019
 * Time: 10:34
 */

namespace Endo\EndoCore\App\Models;


use Illuminate\Database\Eloquent\Model;

class EndoPostType extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];


    public function translations()
    {
        return $this->hasMany(EndoPostTypeTranslation::class);
    }


    public function fillTranslation()
    {
        $translation = $this->translations->filter(function ($translation) {
            return !$translation->locale || $translation->locale == app()->getLocale();
        })->sortByDesc('locale')->first();

        if ($translation) {
            $this->title = $translation->title;
            $this->title_plural = $translation->title_plural;
            $this->url_name = $translation->url_name;
        }
    }
}