<?php


namespace Endo\EndoCore\App\CustomFields;


class TextType extends FieldParam
{
    protected $id = 'input_type';
    protected $title = 'Type';
    protected $instructions = 'text, password, email...';
    protected $field = 'text';
}