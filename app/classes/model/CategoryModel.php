<?php

namespace App\classes\model;

class CategoryModel extends Model {

    protected $table;

    public $fillable = [
        'id',
        'name',
        'description',
        'image',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

}