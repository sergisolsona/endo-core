<?php

namespace Endo\EndoCore\App\CustomFields;

use App\Models\CustomPost;
use App\Module;
class FieldParam
{
    protected $id;
    protected $title;
    protected $instructions;
    protected $field;
    protected $name;
    protected $post;

    public function __construct($post = null) {
        $this->post = $post;
    }

    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getInstructions() {
        return $this->instructions;
    }

    public function getPost() {
        return $this->post;
    }

    public function getField() {
        $post = $this->getPost();
        
        return view("EndoCore::admin.partials.custom-fields.params.".$this->id, [
            'is_param' => true,
            'title' => $this->getTitle(),
            'instruccions' => $this->getInstructions(),
            'name' => $this->name,
            'value' => $this->getValue(),
            'params' => ($post) ? json_decode($post->params) : null,
            'custom_field' => $post,
        ]);
    }

    public function getValue() {
        $id = $this->id;
        $post = $this->getPost();
        
        return (isset($post) && isset(json_decode($post->params)->$id)) ? json_decode($post->params)->$id : '';
    }
}