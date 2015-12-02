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
            ->add('urlopRodzaj', 'urlop_rodzaj')
            ->add('pracownik', 'pracownik_simple')
            ->add('organizacja', 'organizacja_simple')
            ->add('dataOd', 'date', [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd'
            ])
            ;
    }

    public function getName()
    {
        return 'urlop';
    }

}