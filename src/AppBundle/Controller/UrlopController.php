<?php
/**
 * Created by PhpStorm.
 * User: marcinos
 * Date: 27.11.15
 * Time: 20:46
 */

namespace AppBundle\Controller;


use AppBundle\CommandBus\Urlop\DodajUrlopCommand;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class UrlopController
 * @package AppBundle\Controller
 *
 * @Route("/urlop", service="app.controller.urlop")
 */
class UrlopController extends Controller
{

    /** @var DodajUrlopCommand */
    private $dodajUrlopCommand;

    /**
     * UrlopController constructor.
     * @param DodajUrlopCommand $dodajUrlopCommand
     */
    public function __construct(DodajUrlopCommand $dodajUrlopCommand)
    {
        $this->dodajUrlopCommand = $dodajUrlopCommand;
    }

    /**
     * @Route("/", name="urlop")
     * @Template()
     *
     * @return array
     */
    public function indexAction()
    {
        return [
            'urlopy' => ''
        ];
    }

    /**
     * @Route("/dodaj", name="urlop.dodaj")
     * @Template()
     *
     * @param Request $request
     * @return array
     */
    public function dodajAction(Request $request)
    {
        $form = $this->createForm('urlop', $this->dodajUrlopCommand);

        return [
            'form' => $form->createView()
        ];
    }
}