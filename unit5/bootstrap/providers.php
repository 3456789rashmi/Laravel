<?php

use App\Providers\AppServiceProvider;
use Jenssegers\Mongodb\ServiceProvider as MongoDbServiceProvider;

return [
    AppServiceProvider::class,
    MongoDbServiceProvider::class,
];
