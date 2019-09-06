<?php

namespace Endo\EndoCore\App\CustomFields;

class RequiredParam extends FieldParam
{
    protected $id = 'required';
    protected $title = 'Required';
    protected $instructions = '';
    protected $field = 'boolean';
}