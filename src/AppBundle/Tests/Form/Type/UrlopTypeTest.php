<?php
/**
 * Created by PhpStorm.
 * User: marcinos
 * Date: 29.11.15
 * Time: 11:17
 */

namespace AppBundle\Tests\Form\Type;


use AppBundle\Form\Type\UrlopType;
use FOS\UserBundle\Tests\Form\Type\TypeTestCase;

class UrlopTypeTest extends TypeTestCase
{

    public function testSubmitValidDataDodajUrlop()
    {
        $formData = [

        ];
    }

    public function testName()
    {
        $u = $this->getUrlopType();

        $this->assertEquals('urlop', $u->getName());
    }

    private function getUrlopType()
    {
        return new UrlopType();
    }
}