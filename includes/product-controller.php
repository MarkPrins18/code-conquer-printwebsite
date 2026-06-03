<?php

class ProductController {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function handleRequest($searchTerm) {
        
        return $this->model->getAll($searchTerm);
    }
}