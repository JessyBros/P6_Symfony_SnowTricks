<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class RegexVideo extends Constraint
{
    public $message = 'L\'url de votre vidéo doit provenir soit de youtube, soit de daylimotion';

    public function validatedBy()
    {
        return static::class.'Validator';
    }
}
