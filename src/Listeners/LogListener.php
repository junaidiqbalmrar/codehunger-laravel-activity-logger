<?php

namespace LaravelActivityLogger\Listeners;

use LaravelActivityLogger\Facades\ActivityLogger;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Auth\Events\Registered;

class LogListener
{
    public function handleLogin(Login $event)
    {
        ActivityLogger::log('login', $event->user);
    }

    public function handleLogout(Logout $event)
    {
        ActivityLogger::log('logout', $event->user);
    }

    public function handleRegistered(Registered $event)
    {
        ActivityLogger::log('registered', $event->user);
    }
}
