<?php
/**
 * Created by PhpStorm.
 * User: marcinos
 * Date: 21.11.15
 * Time: 22:11
 */

namespace AppBundle\Tests\Form\Type;


use AppBundle\CommandBus\Organizacja\DodajOrganizacjeCommand;
use AppBundle\Form\Type\OrganizacjaType;
use Symfony\Component\Form\Test\TypeTestCase;
use Mockery as M;
use Symfony\Component\Security\Core\Authentication\Token\AbstractToken;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class OrganizacjaTypeTest extends TypeTestCase
{

    /** @var M\Mock */
    private $tokenStorage;

    protected function setUp()
    {
        $this->tokenStorage = M::mock(TokenStorage::class);
        parent::setUp();
    }

    public function testSubmitValidDataDodajOrganizacje()
    {

        //dane formularza - pola i wartości wpisane
        $formData = [
            'nazwa' => 'Testowa nazwa',
            'pnazwa' => 'Pełna nazwa'
        ];

        // dodajOrganizacjeCommand
        $token = M::mock(AbstractToken::class);
        $token->shouldReceive('getUser')->once();
        $this->tokenStorage->shouldReceive('getToken')->once()->andReturn($token);
        $dodajOrganizacjeCommand = new DodajOrganizacjeCommand($this->tokenStorage);
        $dodajOrganizacjeCommand->setNazwa($formData['nazwa']);
        $dodajOrganizacjeCommand->setPnazwa($formData['pnazwa']);

        // formularz
        $form = $this->factory->create(OrganizacjaType::class, $dodajOrganizacjeCommand);

        // submit formularza
        $form->submit($formData);

        // this test checks that none of your data transformers used by the form failed
        $this->assertTrue($form->isSynchronized());

        // sprawdzamy czy obiekty są sobie równe
        $this->assertEquals($dodajOrganizacjeCommand, $form->getData());

        // sprawdzamy czy zgadzają się pola formularza
        $view = $form->createView();
        $children = $view->children;
        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }
}