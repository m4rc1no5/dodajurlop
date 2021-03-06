<?php
/**
 * Created by PhpStorm.
 * User: marcinos
 * Date: 10.11.15
 * Time: 22:12
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\UrlopRodzaj;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadUrlopRodzajData implements FixtureInterface
{
    private $ar_rodzaje_urlopow = [
        ['100', 'Urlop wypoczynkowy'],
        ['99', 'Urlop okolicznościowy'],
        ['1', 'Badania lekarskie'],
        ['1', 'Krwiodawstwo'],
        ['1', 'Wezwanie'],
        ['1', 'Na ratunek'],
        ['1', 'Posiedzenie komisji lub rady'],
        ['1', 'Zajęcia dydaktyczne'],
        ['1', 'Inny'],
    ];

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $arUrlopRodzaj = $this->getArrayUrlopRodzaj();

        /** @var UrlopRodzaj $urlopRodzaj */
        foreach ($arUrlopRodzaj as $urlopRodzaj) {
            $manager->persist($urlopRodzaj);
        }
        $manager->flush();
    }

    /**
     * @return array
     */
    public function getArrayUrlopRodzaj()
    {
        $arUrlopRodzaj = [];
        foreach ($this->ar_rodzaje_urlopow as $key => $ar_rodzaj_urlopu) {
            $arUrlopRodzaj[$key] = new UrlopRodzaj();
            $arUrlopRodzaj[$key]->setLicznik($ar_rodzaj_urlopu[0]);
            $arUrlopRodzaj[$key]->setNazwa($ar_rodzaj_urlopu[1]);
        }

        return $arUrlopRodzaj;
    }

}