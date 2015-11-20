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
    ];

    public function load(ObjectManager $manager)
    {
        foreach($this->ar_rodzaje_urlopow as $ar_rodzaj_urlopu) {
            $urlopRodzaj = new UrlopRodzaj();
            $urlopRodzaj->setLicznik($ar_rodzaj_urlopu[0]);
            $urlopRodzaj->setNazwa($ar_rodzaj_urlopu[1]);

            $manager->persist($urlopRodzaj);
        }

        $manager->flush();
    }

}