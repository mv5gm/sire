<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class AsignarEstudianteRepresentante extends Form
{
    public $idEst;
    public $estudiante_id;
    public $relacion = 'Legal';
}
