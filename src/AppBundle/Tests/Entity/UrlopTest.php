<?php
/**
 * Created by PhpStorm.
 * User: marcinos
 * Date: 06.12.15
 * Time: 07:26
 */

namespace AppBundle\Tests\Entity;

use AppBundle\Entity\Urlop;
use AppBundle\Tests\AppTestCase;
use Mockery as M;
use AppBundle\Entity\User;
use AppBundle\Entity\UrlopRodzaj;
use AppBundle\Entity\Pracownik;
use AppBundle\Entity\Organizacja;


class UrlopTest extends AppTestCase
{
    public function testCreateUrlop()
    {
        $user = M::mock(User::class);
        $urlopRodzaj = M::mock(UrlopRodzaj::class);
        $pracownik = M::mock(Pracownik::class);
        $organizacja = M::mock(Organizacja::class);
        $dataod = new \DateTime('2015-12-06');
        $datado = new \DateTime();
        $ilosc_dni = 26;
        $rok = 2015;

        $urlop = new Urlop(
            $user,
            $urlopRodzaj,
            $pracownik,
            $organizacja,
            $dataod,
            $datado,
            $ilosc_dni,
            $rok
        );

        $this->assertEquals($urlopRodzaj, $urlop->getUrlopRodzaj());
        $this->assertEquals($pracownik, $urlop->getPracownik());
        $this->assertEquals($organizacja, $urlop->getOrganizacja());
        $this->assertEquals($dataod, $urlop->getDataOd());
        $this->assertEquals($datado, $urlop->getDataDo());
        $this->assertEquals($ilosc_dni, $urlop->getIloscDni());
        $this->assertEquals($rok, $urlop->getRok());
    }
}