<?php

namespace App\Form;

use App\Entity\IntroduceOwner;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class IntroduceOwnerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, array(
                'label' => 'Prénom :'
            ))
            ->add('lastname', TextType::class, array(
                'label' => "Nom :",
                'disabled' => true
            ))
            ->add('description', TextareaType::class, array(
                'label' => 'Description :',
                'attr' => array(
                    'class' => 'tinymce'
                )
            ))
            ->add('imageFile', FileType::class, array(
                'label' => "Chemin de l'image (250px / 250px conseillé) :",
                'required' => false
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => IntroduceOwner::class,
        ]);
    }
}
