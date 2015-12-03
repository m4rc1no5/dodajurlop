<?php
/**
 * Created by PhpStorm.
 * User: marcinos
 * Date: 15.11.15
 * Time: 19:53
 */

namespace AppBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class OrganizacjaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nazwa', TextType::class)
            ->add('pnazwa', TextType::class)
        ;
    }

    public function getBlockPrefix()
    {
        return 'organizacja';
    }

}