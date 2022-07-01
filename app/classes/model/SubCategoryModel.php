<?php

namespace App\classes\model;

class SubCategoryModel extends Model {
    public $fillable = [
        'id',
        'category_id',
        'name',
        'description',
        'image',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}