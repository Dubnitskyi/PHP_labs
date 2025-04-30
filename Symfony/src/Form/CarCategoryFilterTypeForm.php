<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CarCategoryFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $b, array $o)
    {
        $b->add('name', TextType::class, ['required'=>false]);
    }
}
