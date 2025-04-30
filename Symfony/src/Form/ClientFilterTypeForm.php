<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ClientFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $b, array $o)
    {
        $b
            ->add('fullName', TextType::class, ['required'=>false])
            ->add('phone',    TextType::class, ['required'=>false])
            ->add('email',    TextType::class, ['required'=>false])
        ;
    }
}

