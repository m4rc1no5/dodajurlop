<?php
/**
 * Created by PhpStorm.
 * User: marcinos
 * Date: 03.12.15
 * Time: 17:57
 */

namespace AppBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DateWithDatepickerType extends AbstractType
{

    /**
     * @param OptionsResolver $resolver
     * @return array
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $ar_defaults = [
            'widget' => 'single_text',
            'format' => 'yyyy-MM-dd',
            'attr' => [
                'class' => 'form-control input-inline datepicker',
                'data-provide' => 'datepicker',
                'data-date-format' => 'yyyy-mm-dd',
                'data-date-autoclose' => true,
                'data-date-today-highlight' => true,
            ],
        ];

        $resolver->setDefaults($ar_defaults);

        return $ar_defaults;
    }

    /**
     * @return string
     */
    public function getParent()
    {
        return 'date';
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'date_with_datepicker';
    }

}