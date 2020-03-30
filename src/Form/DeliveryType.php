<?php

namespace App\Form;

use App\Entity\Delivery;
use App\Form\OptionsDeliveryType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class DeliveryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('picture', TextType::class, ['label' => "Image d'entête :"])
            ->add('title', TextType::class, ['label' => "Titre :"])
            ->add('price', NumberType::class, ['label' => "Prix (sans sigle €):"] )
            ->add('optionDeliveries', CollectionType::class,[
                'entry_type' => OptionsDeliveryType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'label' => 'Options :'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Delivery::class,
        ]);
    }
}
