<?php
/**
 * Created by PhpStorm.
 * User: marcinos
 * Date: 15.11.15
 * Time: 19:53
 */

namespace AppBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class OrganizacjaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nazwa', 'text')
            ->add('pnazwa', 'text')
        ;
    }

    public function getName()
    {
        return 'organizacja';
    }

}