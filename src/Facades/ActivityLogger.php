<?php

namespace LaravelActivityLogger\Facades;

use Illuminate\Support\Facades\Facade;

class ActivityLogger extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'activity.logger';
    }
}
