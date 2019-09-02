<?php
/**
 * Created by PhpStorm.
 * User: sergisolsona
 * Date: 02/09/2019
 * Time: 11:39
 */

namespace Endo\EndoCore\App\Models;


use Illuminate\Database\Eloquent\Model;

class EndoPostTypeTranslation extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];


    public function postType()
    {
        return $this->belongsTo(EndoPostType::class);
    }
}