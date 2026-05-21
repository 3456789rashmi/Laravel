<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use MongoDB\Laravel\Eloquent\Model as MongoDBModel;

class EI extends MongoDBModel
{
    protected $connection = 'mongodb';
    protected $collection = 'Studentdata';
    protected $fillable = [
        'name',
        'email'
    ];
}
