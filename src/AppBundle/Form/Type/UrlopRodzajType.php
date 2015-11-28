<?php
/**
 * Created by PhpStorm.
 * User: marcinos
 * Date: 28.11.15
 * Time: 11:46
 */

namespace AppBundle\Form\Type;


use AppBundle\Repository\IUrlopRodzajRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UrlopRodzajType extends AbstractType
{

    const DATA_CLASS = 'AppBundle\Entity\UrlopRodzaj';

    /** @var IUrlopRodzajRepository */
    private $urlopRodzajRepository;

    /**
     * UrlopRodzajType constructor.
     * @param IUrlopRodzajRepository $urlopRodzajRepository
     */
    public function __construct(IUrlopRodzajRepository $urlopRodzajRepository)
    {
        $this->urlopRodzajRepository = $urlopRodzajRepository;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => self::DATA_CLASS,
            'choices' => $this->urlopRodzajRepository->getAll()
        ]);
    }

    public function getParent()
    {
        return 'entity';
    }

    public function getName()
    {
        return 'urlop_rodzaj';
    }
}