<?php
/**
 * Created by PhpStorm.
 * User: marcinos
 * Date: 10.11.15
 * Time: 22:12
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\ZwolnienieRodzaj;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadZwolnienieRodzajData implements FixtureInterface
{
    private $ar_rodzaje_zwolnien = [
        ['100', 'Urlop wypoczynkowy'],
        ['99', 'Urlop okolicznościowy'],
        ['1', 'Badania lekarskie'],
        ['1', 'Krwiodawstwo'],
        ['1', 'Wezwanie'],
        ['1', 'Na ratunek'],
        ['1', 'Posiedzenie komisji lub rady'],
        ['1', 'Zajęcia dydaktyczne'],
    ];

    public function load(ObjectManager $manager)
    {
        foreach($this->ar_rodzaje_zwolnien as $ar_rodzaj_zwolnienia) {
            $zwolnienieRodzaj = new ZwolnienieRodzaj();
            $zwolnienieRodzaj->setLicznik($ar_rodzaj_zwolnienia[0]);
            $zwolnienieRodzaj->setNazwa($ar_rodzaj_zwolnienia[1]);

            $manager->persist($zwolnienieRodzaj);
        }

        $manager->flush();
    }

}