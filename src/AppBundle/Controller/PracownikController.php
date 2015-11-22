<?php
/**
 * Created by PhpStorm.
 * User: marcinos
 * Date: 22.11.15
 * Time: 20:23
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class PracownikController
 * @package AppBundle\Controller
 *
 * @Route("/pracownik", service="app.controller.pracownik")
 */
class PracownikController extends Controller
{

    /**
     * @Route("/", name="pracownik")
     * @Template()
     *
     * @return array
     */
    public function indexAction()
    {
        return [];
    }
}