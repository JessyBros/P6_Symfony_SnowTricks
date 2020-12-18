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

        // Ne peut être null
        if (null === $value || '' === $value) {
            return;
        }

        // Doit être de type string
        if (!is_string($value)) {
            throw new UnexpectedValueException($value, 'string');
        }

        //transforme le slug selon le bon format.
        $slug = (string) $this->slugger->slug((string) $value)->lower();
        // Puis vérifie si il n'existe déjà pas dans la base de donné
        $figure = $this->figureRepository->findOneBy(['slug' => $slug]);
        if ($figure) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ string }}', $value)
                ->addViolation();
        }
    }
}