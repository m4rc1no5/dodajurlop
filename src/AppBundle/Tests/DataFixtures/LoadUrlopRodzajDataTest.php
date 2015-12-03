<?php
/**
 * What can I do? What can't I do!
 * User: Ivan
 * Date: 03.12.15
 */

namespace AppBundle\Tests\DataFixtures;


use AppBundle\DataFixtures\ORM\LoadUrlopRodzajData;
use AppBundle\Entity\UrlopRodzaj;
use Doctrine\Tests\Common\Persistence\ObjectManagerDecoratorTest;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use Mockery as M;
use Doctrine\Common\Persistence\ObjectManager;

class LoadUrlopRodzajDataTest extends TestCase
{

    /** @var  LoadUrlopRodzajData */
    private $rodzaj;

    private $ar_rodzaje_urlopow = [ 'Urlop wypoczynkowy',
                                    'Urlop okolicznościowy',
                                    'Badania lekarskie',
                                    'Krwiodawstwo',
                                    'Wezwanie',
                                    'Na ratunek',
                                    'Posiedzenie komisji lub rady',
                                    'Zajęcia dydaktyczne',
                                    'Inny' ];

    /** @var  M\Mock */
    private $manager;

    protected function setUp()
    {
        $this->rodzaj = new LoadUrlopRodzajData();
        $this->manager = M::mock(ObjectManager::class);
        $this->manager->shouldReceive('persist');
        $this->manager->shouldReceive('flush');
    }

    public function testTworzeniaRodzaje()
    {
        $arr_urlop = $this->rodzaj->tworzenieRodzaje();
        /** @var UrlopRodzaj $urlop_type */
        foreach ($arr_urlop as $urlop_type) {
            $this->assertTrue(in_array($urlop_type->getNazwa(),$this->ar_rodzaje_urlopow));
        }

    }

    public function testLoad()
    {
        $this->rodzaj->load($this->manager);
    }


}
