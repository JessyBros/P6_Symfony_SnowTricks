<?php

namespace App\Form;

use App\Entity\Video;
use App\Validator as AppAssert;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Regex;

class VideoFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('path', TextType::class, [
                'label' => false,
                'required' => false,
                'constraints' => [
                    new AppAssert\RegexVideo
                ],
                'attr' => [
                    'placeholder' => "https://www.youtube.com/watch?v=SQyTWk7OxSI"
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Video::class,
        ]);
    }
}
