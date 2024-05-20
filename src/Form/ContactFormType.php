<?php

namespace App\Form;

use App\Entity\ContactMail;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Votre nom'
            ])
            ->add('email', EmailType::class, [
                'label' => 'Votre email'
            ])
            ->add('sujet', TextType::class, [
                'label' => 'Sujet'
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Message'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ContactMail::class,
        ]);
    }
}
