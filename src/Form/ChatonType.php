<?php

namespace App\Form;

use App\Entity\Chaton;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType; 
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ChatonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Nom')
            ->add('image', FileType::class, [
                'label' => 'Image du chaton',
                'mapped' => false, // Le champ n'est pas mappé à une propriété de l'entité
                'required' => false, // Le champ n'est pas obligatoire
            ])// Upload une photo
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
