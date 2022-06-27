<?php

namespace App\classes\model;

class ArticleModel extends Model{

    protected $table;

    public $fillable = [
        'id',
        'subcategory_id',
        'name',
        'path', //Upload de arquivo
        'description',
        'authors',
        'resume',
        'abstract',
        'keywords'
    ];
}