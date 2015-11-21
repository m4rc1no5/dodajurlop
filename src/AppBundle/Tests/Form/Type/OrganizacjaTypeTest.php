<?php
/**
 * Created by PhpStorm.
 * User: marcinos
 * Date: 21.11.15
 * Time: 22:11
 */

namespace AppBundle\Tests\Form\Type;


use AppBundle\Entity\Organizacja;
use AppBundle\Form\Type\OrganizacjaType;
use Doctrine\Tests\Common\Persistence\TestObject;
use Symfony\Component\Form\Test\TypeTestCase;

class OrganizacjaTypeTest extends TypeTestCase
{
    public function testSubmitValidData()
    {
        $formData = [
            'nazwa' => 'nazwa',
            'pnazwa' => 'pnazwa'
        ];

        $type = new OrganizacjaType();
        $form = $this->factory->create($type);

        $form->submit($formData);
        $this->assertTrue($form->isSynchronized());

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }
}