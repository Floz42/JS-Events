<?php

namespace App\Form;

use App\Entity\Rating;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostRatingType extends AbstractType
{
    public function getOptions($label, $placeholder, $options = []) {
        return array_merge_recursive([
            'label' => $label, 
            'attr' => [
                'placeholder' => $placeholder
            ]
            ], $options);
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, $this->getOptions("Votre prénom :","Entrez votre prénom ici", ["required" => true]))
            ->add('lastname', TextType::class, $this->getOptions("Votre nom :","Entrez votre nom ici", ["required" => true]))
            ->add('email', EmailType::class, $this->getOptions("Votre e-mail :","Exemple: cdric@gmail.com",["required" => true]) )
            ->add('comment', TextareaType::class, $this->getOptions("Votre commentaire :", "", ["required" => true]))
            ->add('rating', IntegerType::class, $this->getOptions("Votre note sur 5 :", "Veuillez indiquer une note de 0 à 5", [
                'attr' => [
                    'min' => 0,
                    'max' => 5,
                    'step' => 1
                ]
                ]))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Rating::class,
        ]);
    }
}
