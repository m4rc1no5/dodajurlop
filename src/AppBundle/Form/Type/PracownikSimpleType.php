<?php
/**
 * Created by PhpStorm.
 * User: marcinos
 * Date: 29.11.15
 * Time: 13:07
 */

namespace AppBundle\Form\Type;


use AppBundle\Entity\User;
use AppBundle\Repository\IPracownikRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class PracownikSimpleType extends AbstractType
{

    const DATA_CLASS = 'AppBundle\Entity\Pracownik';

    /** @var IPracownikRepository */
    private $pracownikRepository;

    /** @var User */
    private $user;

    /**
     * PracownikType constructor.
     * @param IPracownikRepository $pracownikRepository
     * @param TokenStorage $tokenStorage
     */
    public function __construct(IPracownikRepository $pracownikRepository, TokenStorage $tokenStorage)
    {
        $this->pracownikRepository = $pracownikRepository;
        $this->user = $tokenStorage->getToken()->getUser();
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'class' => self::DATA_CLASS,
            'choices' => $this->pracownikRepository->findAllByUser($this->user),
            'choice_label' => 'getNazw'
        ]);
    }

    /**
     * @return string
     */
    public function getParent()
    {
        return 'entity';
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'pracownik_simple';
    }

}