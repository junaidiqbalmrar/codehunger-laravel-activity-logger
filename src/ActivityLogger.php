<?php

namespace LaravelActivityLogger;

use LaravelActivityLogger\Models\UserActivity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ActivityLogger
{
    public function log(string $event, $model = null, string $description = null): void
    {
        if (config('activitylogger.storage') === 'log') {
            Log::info("Activity: $event", [
                'user_id' => Auth::id(),
                'model' => $model ? get_class($model) : null,
                'description' => $description,
            ]);
            return;
        }

        UserActivity::create([
            'user_id'     => Auth::id(),
            'event'       => $event,
            'model_type'  => $model ? get_class($model) : null,
            'model_id'    => $model->id ?? null,
            'description' => $description,
            'ip'          => request()->ip(),
            'user_agent'  => request()->userAgent(),
        ]);
    }
}
