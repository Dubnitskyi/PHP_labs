<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class RentalFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $b, array $o)
    {
        $b
            ->add('rentFrom', DateType::class, ['required'=>false,'widget'=>'single_text'])
            ->add('rentTo',   DateType::class, ['required'=>false,'widget'=>'single_text'])
            ->add('car',      TextType::class, ['required'=>false,'mapped'=>false])
            ->add('clients',   TextType::class, ['required'=>false,'mapped'=>false])
        ;
    }
}

