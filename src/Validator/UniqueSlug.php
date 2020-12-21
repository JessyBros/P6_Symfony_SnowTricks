<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class UniqueSlug extends Constraint
{
    public $message = 'Le nom de la figure existe déjà.';

    public function validatedBy()
    {
        return static::class.'Validator';
    }
}