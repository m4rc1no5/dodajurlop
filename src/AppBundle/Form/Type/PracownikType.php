<?php
/**
 * Created by PhpStorm.
 * User: marcinos
 * Date: 22.11.15
 * Time: 20:55
 */

namespace AppBundle\Form\Type;


use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
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
            ->add('imie', TextType::class)
            ->add('nazw', TextType::class)
            ->add('email', TextType::class)
            ->add('organizacja', OrganizacjaSimpleType::class)
            ->add('iloscDniWolnych', IntegerType::class)
        ;
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'pracownik';
    }

}