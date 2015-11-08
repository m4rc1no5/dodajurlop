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
use Symfony\Component\HttpFoundation\RedirectResponse;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="start")
     * @Template()
     *
     * @return array
     */
    public function indexAction()
    {
        if($this->get('security.authorization_checker')->isGranted('ROLE_USER') === true) {
            return new RedirectResponse($this->generateUrl('dashboard'));
        }

        return [];
    }
}