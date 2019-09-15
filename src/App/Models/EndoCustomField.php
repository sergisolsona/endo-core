<?php
/**
 * Created by PhpStorm.
 * User: sergisolsona
 * Date: 04/09/2019
 * Time: 10:38
 */

namespace Endo\EndoCore\App\Models;


use Illuminate\Database\Eloquent\Model;

class EndoCustomField extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];


    public function customFieldGroup()
    {
        return $this->belongsTo(EndoCustomFieldGroup::class);
    }


    public function getParams()
    {
        return config('custom_fields.' . $this->type, []);
    }
}