<?php

namespace App\Validator;

use App\Repository\FigureRepository;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class UniqueSlugValidator extends ConstraintValidator
{
    private FigureRepository $figureRepository;
    private SluggerInterface $slugger;
    
    public function __construct(FigureRepository $figureRepository, SluggerInterface $slugger)
    {
        $this->figureRepository = $figureRepository;
        $this->slugger = $slugger;
    }

    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof UniqueSlug) {
            throw new UnexpectedTypeException($constraint, UniqueSlug::class);
        }
        
        if (null === $value || '' === $value) {
            return;
        }

        if (!is_string($value)) {
            throw new UnexpectedValueException($value, 'string');
        }

        //transform the slug in the right format.
        $slug = (string) $this->slugger->slug((string) $value)->lower();

        $figure = $this->figureRepository->findOneBy(['slug' => $slug]);

        if ($figure) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ string }}', $value)
                ->addViolation();
        }
    }
}