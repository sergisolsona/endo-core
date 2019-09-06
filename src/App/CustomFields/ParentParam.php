<?php

namespace Endo\EndoCore\App\CustomFields;

class ParentParam extends FieldParam
{
    protected $id = 'parent_param';
    protected $title = 'Relationship';
    protected $instructions = 'Només es mostraràn els valors que estiguin dins al Post espeficat';
    protected $field = 'text';
}