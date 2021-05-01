<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Place;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class PlaceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('latitude')
            ->add('longitude')
            ->add('difficulty')
            ->add('radius_type')
            ->add('active')
            ->add('description')
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'label' => 'Catégories',
                'choice_label' => 'name',
                'expanded' => false,
                'multiple' => false
            ])
            ->add('image', FileType::class, [
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Place::class,
        ]);
    }
}
