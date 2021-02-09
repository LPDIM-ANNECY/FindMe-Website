<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->add('company_name', null, [
                'label' => 'company_name',
                'required' => true
            ])
            ->add('password', PasswordType::class, [
                'label' => 'password'
            ])
            ->add('locale', ChoiceType::class, [
                'required' => false,
                'placeholder' => 'Choisir une langue',
                'choices' => [
                    'en' => 'en',
                    'fr' => 'fr'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'translation_domain' => 'forms'
        ]);
    }
}
