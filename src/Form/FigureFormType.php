<?php

namespace App\Form;

use App\Entity\Group;
use App\Entity\Figure;
use App\Repository\GroupRepository;
use App\Validator as AppAssert;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class FigureFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class,[
                'constraints' => [
                    new AppAssert\UniqueSlug
                ]
            ])
            ->add('description')
            ->add('groupType', EntityType::class, [
                'label' => 'Groupe de la figure',
                'class' => Group::class,
                'query_builder' => function (GroupRepository $er) {
                    return $er->createQueryBuilder('g')
                        ->orderBy('g.id', 'ASC');
                },
                'choice_label' => 'name',
                'placeholder' => '--- Choisissez un groupe',
            ])
            ->add('illustrations', CollectionType::class, [
                'entry_type' => IllustrationFormType::class,
                'label' => false,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false, // permet de dire que je n'aurai pas forcément d'illustration, donc facultatif
                'required' => false,
            ])
            ->add('videos', CollectionType::class, [
                'entry_type' => VideoFormType::class,
                'label' => false,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Figure::class,
        ]);
    }
}
