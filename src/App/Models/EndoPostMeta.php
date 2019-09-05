<?php
/**
 * Created by PhpStorm.
 * User: sergisolsona
 * Date: 04/09/2019
 * Time: 13:34
 */

namespace Endo\EndoCore\App\Models;


use Endo\EndoCore\App\Models\Traits\ModelMetas;
use Illuminate\Database\Eloquent\Model;

class EndoPostMeta extends Model
{

    use ModelMetas;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];


    public function post()
    {
        return $this->belongsTo(EndoPost::class);
    }
}