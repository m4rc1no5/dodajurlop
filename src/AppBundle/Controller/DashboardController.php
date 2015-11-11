<?php
/**
 * Created by PhpStorm.
 * User: marcinos
 * Date: 08.11.15
 * Time: 19:19
 */

namespace AppBundle\Controller;

use AppBundle\CommandBus\Organizacja\DodajOrganizacjeCommand;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class DashboardController
 * @package AppBundle\Controller
 *
 * @Route("/dashboard", service="app.controller.dashboard")
 */
class DashboardController extends Controller
{

    /**
     * @Route("/", name="dashboard")
     * @Template()
     *
     * @return array
     */
    public function indexAction()
    {
        return [
            'user' => ''
        ];
    }
}