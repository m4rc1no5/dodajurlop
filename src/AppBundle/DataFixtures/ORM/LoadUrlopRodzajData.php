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

    public function load(ObjectManager $manager)
    {
        foreach ($this->tworzenieRodzaje() as $urlop_rodzaj) {
            $manager->persist($urlop_rodzaj);
        }
        $manager->flush();
    }

    /**
     * @return array
     */
    public function tworzenieRodzaje()
    {
        $return = [];
        foreach ($this->ar_rodzaje_urlopow as $key => $ar_rodzaj_urlopu) {
            $return[$key] = new UrlopRodzaj();
            $return[$key]->setLicznik($ar_rodzaj_urlopu[0]);
            $return[$key]->setNazwa($ar_rodzaj_urlopu[1]);
        }

        return $return;
    }

}