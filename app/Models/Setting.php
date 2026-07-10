<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    protected static function boot(): void
    {
        parent::boot();

        static::saved(function () {
            Cache::forget('app_settings');
        });

        static::deleted(function () {
            Cache::forget('app_settings');
        });
    }

    public static function get(string $key, $default = null)
    {
        $settings = self::all();

        $setting = $settings->firstWhere('key', $key);

        return $setting?->value ?? $default;
    }

    public static function set(string $key, $value): void
    {
        self::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
    }

    public static function allSettings(): array
    {
        return Cache::rememberForever('app_settings', function () {
            return self::pluck('value', 'key')->toArray();
        });
    }
}
