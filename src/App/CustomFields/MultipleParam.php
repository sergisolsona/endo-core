<?php

namespace Endo\EndoCore\App\CustomFields;

class MultipleParam extends FieldParam
{
    protected $id = 'multiple';
    protected $title = 'Multiple';
    protected $instructions = 'Llista de "toggles" o sel·lecció';
    protected $field = 'boolean';
}