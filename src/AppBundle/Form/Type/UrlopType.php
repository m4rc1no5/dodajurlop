<?php
/**
 * Created by PhpStorm.
 * User: marcinos
 * Date: 28.11.15
 * Time: 12:10
 */

namespace AppBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class UrlopType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('urlopRodzaj', UrlopRodzajType::class)
            ->add('pracownik', PracownikSimpleType::class)
            ->add('organizacja', OrganizacjaSimpleType::class)
            ->add('dataOd', DateWithDatepickerType::class)
            ->add('dataDo', DateWithDatepickerType::class)
            ;
    }

    public function getBlockPrefix()
    {
        return 'urlop';
    }

}