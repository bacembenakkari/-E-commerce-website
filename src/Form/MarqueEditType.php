<?php 
namespace App\Form;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\Marque;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;



class MarqueEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomMarque')
            ->add('paysOrigine')
            ->add('created_at')   
            // Ajoutez d'autres champs de votre entité Marque si nécessaire
            ->add('Valider', SubmitType::class, [
                'label' => 'Valider', // Libellé du bouton
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Marque::class,
        ]);
    }
}
