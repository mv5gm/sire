<?php

namespace App\Traits;

trait HasCreateOrUpdate
{
    public static function createOrUpdate(array $attributes)
    {
        if (isset($attributes['id']) && $attributes['id']) {
            // Actualizar
            $instance = static::find($attributes['id']);
            if ($instance){
                $instance->update($attributes);
            }
        } else {
            // Crear
            $instance = static::create($attributes);
        }

        return $instance;
    }

    public function fillFromModel($modelo, $formCampos)
    {
        foreach ($formCampos as $formCampo => $value) {
            if (isset($modelo->$formCampo)) {
                $this->$formCampo = $modelo->$formCampo;
            }
        }
    }
}