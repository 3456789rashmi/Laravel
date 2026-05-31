<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model as MongoDBModel;

class Rashmi extends MongoDBModel
{
    protected $connection = 'mongodb';
    protected $collection = 'RashmiData';
    
    protected $fillable = [
        'name',
        'email'
    ];
}
