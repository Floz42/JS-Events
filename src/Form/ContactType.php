<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType as TypeTextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;

class ContactType extends AbstractType
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
            ->add('firstname', TypeTextType::class, $this->getOptions("Votre prénom :", "Entrez votre prénom ici", [ 'required' => true]))
            ->add('lastname', TypeTextType::class, $this->getOptions("Votre nom :", "Entrez votre nom ici", [ 'required' => true]))
            ->add('email', EmailType::class, $this->getOptions("Votre e-mail :", "Exemple : cedric@hotmail.fr", [ 'required' => true]))
            ->add('title', TypeTextType::class, $this->getOptions("Titre de votre message :", "Votre titre ici", [ 'required' => true]))
            ->add('content', TextareaType::class, $this->getOptions("Votre message :", "", [ 'required' => true]))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class
        ]);
    }
}
