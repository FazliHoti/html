<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    protected $fillable = ['key', 'value'];

    public static function text(string $key, string $default): string
    {
        return Cache::rememberForever('site-setting:'.$key, function () use ($key, $default): string {
            $value = static::query()->where('key', $key)->value('value');

            return $value === null ? $default : (string) $value;
        });
    }

    public static function saveText(string $key, string $value): void
    {
        static::query()->updateOrCreate(['key' => $key], ['value' => $value]);
        Cache::forget('site-setting:'.$key);
    }
}
