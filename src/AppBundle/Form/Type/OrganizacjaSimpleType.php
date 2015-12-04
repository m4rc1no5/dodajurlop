<?php
/**
 * Created by PhpStorm.
 * User: marcinos
 * Date: 30.11.15
 * Time: 20:55
 */

namespace AppBundle\Form\Type;


use AppBundle\Entity\User;
use AppBundle\Repository\IOrganizacjaRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class OrganizacjaSimpleType extends AbstractType
{

    const DATA_CLASS = 'AppBundle\Entity\Organizacja';

    /** @var IOrganizacjaRepository */
    private $organizacjaRepository;

    /** @var User */
    private $user;

    /**
     * OrganizacjaSimpleType constructor.
     * @param IOrganizacjaRepository $organizacjaRepository
     * @param TokenStorage $tokenStorage
     */
    public function __construct(IOrganizacjaRepository $organizacjaRepository, TokenStorage $tokenStorage)
    {
        $this->organizacjaRepository = $organizacjaRepository;
        $this->user = $tokenStorage->getToken()->getUser();
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'class' => self::DATA_CLASS,
            'choices' => $this->organizacjaRepository->findAllByUser($this->user),
        ]);
    }


    /**
     * @return string
     */
    public function getParent()
    {
        return EntityType::class;
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'organizacja_simple';
    }

}