<?php

namespace App\Form;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Marque;
use App\Entity\Voiture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Vich\UploaderBundle\Form\Type\VichImageType;


use Symfony\Component\Form\Extension\Core\Type\FileType;

class VoitureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomVoiture', TextType::class)
            ->add('puissance')
            ->add('caracteristique')
            ->add('marque', EntityType::class, [
                'class' => Marque::class, // Entité Marque
                'choice_label' => 'nomMarque', // Le champ de la marque à afficher dans le formulaire
                'placeholder' => 'Sélectionnez une marque', // Texte par défaut pour le champ
            ])
           
            ->add('imageFile', VichImageType::class, [ // Utilisez le type de champ FileType
                'required' => false,
                'label' => 'Image de la voiture (Fichier JPG ou PNG)',
            ])

            
            ->add('Valider',SubmitType::class)
        ;

        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
            'data_class' => Voiture::class,
        ]);
    }
}
