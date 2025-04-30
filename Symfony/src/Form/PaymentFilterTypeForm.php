<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class PaymentFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $b, array $o)
    {
        $b
            ->add('amount', NumberType::class, ['required'=>false])
            ->add('paidAt', DateType::class, ['required'=>false,'widget'=>'single_text'])
            ->add('method', TextType::class, ['required'=>false])
            ->add('rental',TextType::class,['required'=>false,'mapped'=>false])
        ;
    }
}

