<?php
/**
 * Created by PhpStorm.
 * User: marcinos
 * Date: 22.11.15
 * Time: 20:55
 */

namespace AppBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class PracownikType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('imie', 'text')
            ->add('nazw', 'text')
            ->add('email', 'text')
            ->add('iloscDniWolnych', 'integer')
        ;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'pracownik';
    }

}