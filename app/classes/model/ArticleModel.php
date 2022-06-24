<?php

namespace App\classes\model;

class ArticleModel {

    protected $table;

    public $fillable = [
        'id',
        'sub_category_id',
        'name',
        'description',
    ];
}