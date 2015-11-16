<?php
/**
 * Created by PhpStorm.
 * User: marcinos
 * Date: 11.11.15
 * Time: 11:26
 */

namespace AppBundle\Controller;


use AppBundle\CommandBus\Organizacja\DodajOrganizacjeCommand;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class OrganizacjaController
 * @package AppBundle\Controller
 *
 * @Route("/organizacja", service="app.controller.organizacja")
 */
class OrganizacjaController extends Controller
{
    /** @var DodajOrganizacjeCommand */
    protected $dodajOrganizacjeCommand;

    /**
     * DashboardController constructor.
     * @param DodajOrganizacjeCommand $dodajOrganizacjeCommand
     */
    public function __construct(DodajOrganizacjeCommand $dodajOrganizacjeCommand)
    {
        $this->dodajOrganizacjeCommand = $dodajOrganizacjeCommand;
    }

    /**
     * @Route("/", name="organizacja")
     * @Template()
     *
     * @return array
     */
    public function indexAction()
    {
        return [];
    }


    /**
     * @Route("/dodaj", name="organizacja.dodaj")
     * @Template()
     *
     * @param Request $request
     * @return array
     */
    public function dodajAction(Request $request)
    {
        $form = $this->createForm('organizacja', $this->dodajOrganizacjeCommand);
        $form->handleRequest($request);

        return [
            'form' => $form->createView()
        ];
    }
}