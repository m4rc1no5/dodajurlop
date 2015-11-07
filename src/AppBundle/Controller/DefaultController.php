<?php
/**
 * Created by PhpStorm.
 * User: marcinos
 * Date: 06.09.15
 * Time: 17:25
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="default")
     * @Template()
     *
     * @return array
     */
    public function indexAction()
    {
        return [];
    }
}