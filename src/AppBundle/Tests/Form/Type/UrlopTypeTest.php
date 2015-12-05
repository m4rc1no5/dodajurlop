<?php
/**
 * Created by PhpStorm.
 * User: marcinos
 * Date: 29.11.15
 * Time: 11:17
 */

namespace AppBundle\Tests\Form\Type;


use AppBundle\Entity\Organizacja;
use AppBundle\Entity\Pracownik;
use AppBundle\Entity\UrlopRodzaj;
use AppBundle\Entity\User;
use AppBundle\Form\Type\OrganizacjaSimpleType;
use AppBundle\Form\Type\PracownikSimpleType;
use AppBundle\Form\Type\PracownikType;
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
use FOS\UserBundle\Tests\Form\Type\TypeTestCase;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\PreloadedExtension;
use Symfony\Component\Security\Core\Authentication\Token\AbstractToken;
use Mockery as M;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class UrlopTypeTest extends TypeTestCase
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

        $repoUrlopRodzaj = M::mock(UrlopRodzajRepository::class);
        $urlopRodzaj = M::mock(UrlopRodzaj::class);
        $urlopRodzaj->shouldReceive('getNazwa')->once();
        $repoUrlopRodzaj->shouldReceive('getAll')->andReturn([
            $urlopRodzaj
        ]);
        $urlop = new UrlopRodzajType($repoUrlopRodzaj);

        $repoPracownik = M::mock(IPracownikRepository::class);
        $repoPracownik->shouldReceive('findAllByUser')->andReturn(['zwrócił to co miał']);

        $pracnownikType = new PracownikSimpleType($repoPracownik, $this->tokenStorage);

        $repoOrganizacja = M::mock(IOrganizacjaRepository::class);
        $repoOrganizacja->shouldReceive('findAllByUser')->andReturn(['zwrócił to co miał']);
        $organizacjaType = new OrganizacjaSimpleType($repoOrganizacja, $this->tokenStorage);

        return array(new PreloadedExtension(array(
            EntityType::class => $entityType,
            UrlopRodzajType::class => $urlop,
            PracownikType::class => $pracnownikType,
            OrganizacjaSimpleType::class => $organizacjaType
        ), array()));
    }

    public function testSubmitValidDataDodajUrlop()
    {

        $formData = [
            'dataDo'            => new \DateTime('2015-01-10'),
            'dataOd'            => new \DateTime('2010-01-10'),
            'organizacja'       => M::mock(Organizacja::class),
            'pracownik'         => M::mock(Pracownik::class),
            'urlopRodzaj'       => M::mock(UrlopRodzaj::class)
        ];

        // dodajPracownikCommand
        $dodajUrlopCommand = new DodajUrlopCommand($this->tokenStorage);
        $dodajUrlopCommand->setDataDo($formData['dataDo']);
        $dodajUrlopCommand->setDataOd($formData['dataOd']);
        $dodajUrlopCommand->setOrganizacja($formData['organizacja']);
        $dodajUrlopCommand->setPracownik($formData['pracownik']);
        $dodajUrlopCommand->setUrlopRodzaj($formData['urlopRodzaj']);

        //formularz
        $form = $this->factory->create(UrlopType::class, $dodajUrlopCommand);

        //submit formularz
        $form->submit($formData);

        // this test checks that none of your data transformers used by the form failed
        $this->assertTrue($form->isSynchronized());

        // sprawdzamy czy obiekty są sobie równe
        $this->assertEquals($dodajUrlopCommand, $form->getData());

        // sprawdzamy czy zgadzają się pola formularza
        $view = $form->createView();
        $children = $view->children;
        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }

    }

    public function testName()
    {
        $u = $this->getUrlopType();

        $this->assertEquals('urlop', $u->getBlockPrefix());
    }

    private function getUrlopType()
    {
        return new UrlopType();
    }

}