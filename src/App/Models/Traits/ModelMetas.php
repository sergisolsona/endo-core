<?php


namespace Endo\EndoCore\App\Models\Traits;


use Endo\EndoCore\App\Models\EndoCustomField;

trait ModelMetas
{

    public function customField()
    {
        return $this->belongsTo(EndoCustomField::class);
    }
}