<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    /**
     * Get a setting value by key, with default fallback.
     */
    public static function get(string $key, $default = null)
    {
        return Cache::rememberForever("setting.{$key}", function () use ($key, $default) {
            $setting = static::where('key', $key)->first();
            return $setting ? $setting->value : $default;
        });
    }

    /**
     * Set a setting value by key.
     */
    public static function set(string $key, $value): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value]);
        Cache::forget("setting.{$key}");
    }

    /**
     * Get all settings as an associative key-value array.
     */
    public static function getAll(): array
    {
        return static::all()->pluck('value', 'key')->toArray();
    }

    /**
     * Get the resolved bio/profile photo URL.
     */
    public static function getBioImageUrl(): string
    {
        $image = static::get('bio_image');
        if (!empty($image)) {
            if (str_starts_with($image, 'http://') || str_starts_with($image, 'https://') || str_starts_with($image, 'data:')) {
                return $image;
            }
            return asset('storage/' . ltrim($image, '/'));
        }
        return asset('images/biju-avatar.svg');
    }
}
