<?php
/**
 * Niedługo nazwiesz mnie… mistrzem…(Imperator)
 * User: Ivan
 * Date: 26.11.15
 */
namespace AppBundle\Tests\Form\Type;


use AppBundle\CommandBus\Organizacja\DodajOrganizacjeCommand;
use AppBundle\CommandBus\Pracownik\DodajPracownikaCommand;
use AppBundle\Form\Type\OrganizacjaType;
use AppBundle\Form\Type\PracownikType;
use Symfony\Component\Form\Test\TypeTestCase;
use Mockery as M;
use Symfony\Component\Security\Core\Authentication\Token\AbstractToken;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class PracownikTypeTest extends TypeTestCase
{
    /** @var M\Mock */
    private $tokenStorage;

    protected function setUp()
    {
        $this->tokenStorage = M::mock(TokenStorage::class);
        parent::setUp();
    }

    public function testSubmitValidDataDodajPracownik()
    {
        //dane formularza - pola i wartości wpisane
        $formData = [
            'imie' => 'Johan',
            'nazw' => 'Kruzestein',
            'email' => 'johan.kruzestein@mail.com',
            'iloscDniWolnych' => '40'
        ];

        // dodajPracownikCommand
        $token = M::mock(AbstractToken::class);
        $token->shouldReceive('getUser')->once();
        $this->tokenStorage->shouldReceive('getToken')->once()->andReturn($token);
        $dodajPracownikCommand = new DodajPracownikaCommand($this->tokenStorage);
        $dodajPracownikCommand->setImie($formData['imie']);
        $dodajPracownikCommand->setNazw($formData['nazw']);
        $dodajPracownikCommand->setEmail($formData['email']);
        $dodajPracownikCommand->setIloscDniWolnych($formData['iloscDniWolnych']);

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