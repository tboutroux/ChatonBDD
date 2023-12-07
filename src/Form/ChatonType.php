<?php

namespace App\Form;

use App\Entity\Chaton;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType; 

class ChatonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Nom')
            ->add('Photo',  )  // Upload une photo
            ->add('Categorie', null, [
                'choice_label' => 'Titre',
                'expanded' => false,
                'multiple' => false,
                'placeholder' => 'Choisissez une catégorie',
            ])
            ->add('OK', SubmitType::class, [
                'attr' => ['class' => 'btn btn-dark'],
                'label'=> 'Ajouter',
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Chaton::class,
        ]);
    }
}
