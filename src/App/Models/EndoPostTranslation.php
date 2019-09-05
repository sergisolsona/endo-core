<?php
/**
 * Created by PhpStorm.
 * User: sergisolsona
 * Date: 04/09/2019
 * Time: 13:39
 */

namespace Endo\EndoCore\App\Models;


use Illuminate\Database\Eloquent\Model;

class EndoPostTranslation extends Model
{

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