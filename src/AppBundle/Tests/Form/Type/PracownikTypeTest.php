<?php
/**
 * Niedługo nazwiesz mnie… mistrzem…(Imperator)
 * User: Ivan
 * Date: 26.11.15
 */
namespace AppBundle\Tests\Form\Type;


use AppBundle\CommandBus\Organizacja\DodajOrganizacjeCommand;
use AppBundle\CommandBus\Pracownik\DodajPracownikaCommand;
use AppBundle\Entity\Organizacja;
use AppBundle\Form\Type\OrganizacjaType;
use AppBundle\Form\Type\PracownikType;
use Symfony\Component\Form\Test\TypeTestCase;
use Mockery as M;
use Symfony\Component\Security\Core\Authentication\Token\AbstractToken;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use AppBundle\Entity\Pracownik;
use AppBundle\Entity\UrlopRodzaj;
use AppBundle\Entity\User;
use AppBundle\Form\Type\OrganizacjaSimpleType;
use AppBundle\Form\Type\PracownikSimpleType;
use AppBundle\Repository\IOrganizacjaRepository;
use AppBundle\Repository\IPracownikRepository;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Entity;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use AppBundle\CommandBus\Urlop\DodajUrlopCommand;
use AppBundle\Form\Type\UrlopRodzajType;
use AppBundle\Form\Type\UrlopType;
use AppBundle\Repository\Doctrine\UrlopRodzajRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\PreloadedExtension;

class PracownikTypeTest extends TypeTestCase
{
    /** @var M\Mock */
    private $tokenStorage;

    /** @var  M\Mock */
    private $token;

    protected function setUp()
    {
        $this->tokenStorage = M::mock(TokenStorage::class);
        $this->token = M::mock(AbstractToken::class);
        $this->token->shouldReceive('getUser')->andReturn(new User());
        $this->tokenStorage->shouldReceive('getToken')->once()->andReturn($this->token);
        parent::setUp();
    }

    protected function getExtensions()
    {
        $repoEntity = M::mock(EntityRepository::class);
        $repoEntity->shouldReceive('findAll')->andReturn(new ArrayCollection());

        $mockEntityManager = M::mock(EntityManager::class);
        $mockEntityManager->shouldReceive('getClassMetadata')->andReturn(new ClassMetadata(Entity::class));
        $mockEntityManager->shouldReceive('getRepository')->andReturn($repoEntity);

        $mockRegistry = M::mock(Registry::class);
        $mockRegistry->shouldReceive('getManagerForClass')->andReturn($mockEntityManager);

        $entityType = new EntityType($mockRegistry);

        $repoOrganizacja = M::mock(IOrganizacjaRepository::class);
        $repoOrganizacja->shouldReceive('findAllByUser')->andReturn(['zwrócił to co miał']);
        $organizacjaType = new OrganizacjaSimpleType($repoOrganizacja, $this->tokenStorage);

        return array(new PreloadedExtension(array(
            EntityType::class => $entityType,
            OrganizacjaSimpleType::class => $organizacjaType
        ), array()));
    }

    public function testSubmitValidDataDodajPracownik()
    {
        //dane formularza - pola i wartości wpisane
        $formData = [
            'imie'              => 'Johan',
            'nazw'              => 'Kruzestein',
            'email'             => 'johan.kruzestein@mail.com',
            'iloscDniWolnych'   => '40',
            'organizacja'       => M::mock(Organizacja::class),
        ];

        // dodajPracownikCommand
        $dodajPracownikCommand = new DodajPracownikaCommand($this->tokenStorage);
        $dodajPracownikCommand->setImie($formData['imie']);
        $dodajPracownikCommand->setNazw($formData['nazw']);
        $dodajPracownikCommand->setEmail($formData['email']);
        $dodajPracownikCommand->setIloscDniWolnych($formData['iloscDniWolnych']);
        $dodajPracownikCommand->setOrganizacja($formData['organizacja']);

        //formularz
        $form = $this->factory->create(PracownikType::class, $dodajPracownikCommand);

        //submit formularz
        $form->submit($formData);

        // this test checks that none of your data transformers used by the form failed
        $this->assertTrue($form->isSynchronized());

        // sprawdzamy czy obiekty są sobie równe
        $this->assertEquals($dodajPracownikCommand, $form->getData());

        // sprawdzamy czy zgadzają się pola formularza
        $view = $form->createView();
        $children = $view->children;
        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }

    }

}