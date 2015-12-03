<?php
/**
 * Created by PhpStorm.
 * User: marcinos
 * Date: 28.11.15
 * Time: 12:13
 */

namespace AppBundle\Tests\Form\Type;


use AppBundle\Form\Type\UrlopRodzajType;
use Symfony\Component\Form\Test\TypeTestCase;
use Mockery as M;
use AppBundle\Repository\Doctrine\UrlopRodzajRepository;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UrlopRodzajTypeTest extends TypeTestCase
{

    /** @var M\Mock */
    private $urlopRodzajRepository;

    public function setUp()
    {
        $this->urlopRodzajRepository = M::mock(UrlopRodzajRepository::class);
        parent::setUp();
    }

    public function testParentAndName()
    {
        $ur = $this->getUrlopRodzajType();

        // parent
        $this->assertEquals('entity', $ur->getParent());

        // name
        $this->assertEquals('urlop_rodzaj', $ur->getBlockPrefix());
    }

    public function testDataClass()
    {
        $this->assertEquals('AppBundle\Entity\UrlopRodzaj', UrlopRodzajType::DATA_CLASS);
    }

    public function testConfigureOptions()
    {
        $ur = $this->getUrlopRodzajType();

        // prepare
        $this->urlopRodzajRepository->shouldReceive('getAll')->once();
        $optionResolver = M::mock(OptionsResolver::class);
        $optionResolver->shouldReceive('setDefaults')->once();

        $ur->configureOptions($optionResolver);
    }

    /**
     * @return UrlopRodzajType
     */
    public function getUrlopRodzajType()
    {
        return new UrlopRodzajType($this->urlopRodzajRepository);
    }
}