<?php

namespace App\Form;

use App\Entity\Video;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Regex;

class VideoFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('path', TextType::class, [
                'label' => false,
                'required' => false,
                'constraints' => new Regex([
                    'pattern' => '#^https:\/\/www.youtube.com\/watch\?v=([0-9a-zA-Z_])+$|^https:\/\/www.youtu.be\/([0-9a-zA-Z_])+$#',
                    'message' => 'Votre url doit provenir de youtube (https://www.youtube.com/watch?v=) ou (https://www.youtu.be/)',
                    ]),
                'attr' =>[
                    'placeholder' => 'https://www.youtube.com/watch?v=',
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
