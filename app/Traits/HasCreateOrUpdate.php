<?php

namespace App\Traits;

trait HasCreateOrUpdate
{
    public static function createOrUpdate(array $attributes, array $values = [])
    {
        $instance = static::firstOrNew($attributes);
        $instance->fill($values);
        $instance->save();

        return $instance;
    }
}