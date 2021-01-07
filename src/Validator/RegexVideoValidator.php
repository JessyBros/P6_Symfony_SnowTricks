<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class RegexVideoValidator extends ConstraintValidator
{
    const URL_YOUTUBE = '#'.
                        "^https:\/\/www.youtube.com\/watch\?v=([0-9a-zA-Z_])+"
                .'|'."^https:\/\/youtu\.be\/([0-9a-zA-Z_])+"
                .'|'."^https:\/\/youtube\.com\/embed\/([0-9a-zA-Z_])+"
                        .'#';

    const URL_DAILYMOTION = '#'.
                            "^https:\/\/dai\.ly\/([0-9a-zA-Z_])+"
                    .'|'."^https:\/\/dailymotion\.com\/embed\/video\/([0-9a-zA-Z_])+"
                            .'#';

    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof RegexVideo) {
            throw new UnexpectedTypeException($constraint, RegexVideo::class);
        }

        if (null === $value || '' === $value) {
            return;
        }

        if (!preg_match(self::URL_YOUTUBE, $value, $matches) && !preg_match(self::URL_DAILYMOTION, $value, $matches)) {
            // the argument must be a string or an object implementing __toString()
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ string }}', $value)
                ->addViolation();
        }
    }
}
