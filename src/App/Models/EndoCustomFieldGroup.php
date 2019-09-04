<?php
/**
 * Created by PhpStorm.
 * User: sergisolsona
 * Date: 04/09/2019
 * Time: 10:30
 */

namespace Endo\EndoCore\App\Models;


use Illuminate\Database\Eloquent\Model;

class EndoCustomFieldGroup extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];


    public function customFields()
    {
        return $this->hasMany(EndoCustomField::class);
    }
}