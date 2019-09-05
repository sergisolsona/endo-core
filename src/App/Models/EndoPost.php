<?php
/**
 * Created by PhpStorm.
 * User: sergisolsona
 * Date: 04/09/2019
 * Time: 13:34
 */

namespace Endo\EndoCore\App\Models;


use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EndoPost extends Model
{
    use SoftDeletes;
    use Translatable;

    public $translatedAttributes = ['title', 'description', 'post_name', 'url_name', 'endo_media_id'];

    protected $useTranslationFallback = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];


    public function metas()
    {
        return $this->hasMany(EndoPostMeta::class);
    }
}