<?php

namespace App\classes\model;

class PageModel extends Model {

    protected $table = 'pages';

    public $fillable = [
        'id',
        'name',
        'description',
        'homepage',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

}