<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class CarFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $b, array $o)
    {
        $b
            ->add('brand', TextType::class, ['required'=>false])
            ->add('model', TextType::class, ['required'=>false])
            ->add('year', ChoiceType::class, [
                'required'=>false,
                'choices'=>array_combine(range(date('Y'),1980),range(date('Y'),1980)),
                'placeholder'=>'—'
            ])
            ->add('category', TextType::class, ['required'=>false, 'mapped'=>false])
        ;
    }
}

