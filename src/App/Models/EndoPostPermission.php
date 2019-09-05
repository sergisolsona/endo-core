<?php
/**
 * Created by PhpStorm.
 * User: sergisolsona
 * Date: 05/09/2019
 * Time: 11:04
 */

namespace Endo\EndoCore\App\Models;


use Illuminate\Database\Eloquent\Model;

class EndoPostPermission extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];


    public function role()
    {
        return $this->belongsTo(EndoRole::class);
    }
}