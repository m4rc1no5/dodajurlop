<?php
/**
 * Created by PhpStorm.
 * User: marcinos
 * Date: 27.11.15
 * Time: 20:46
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class UrlopController
 * @package AppBundle\Controller
 *
 * @Route("/urlop", service="app.controller.urlop")
 */
class UrlopController extends Controller
{

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
}