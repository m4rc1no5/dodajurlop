<?php
/**
 * Created by PhpStorm.
 * User: marcinos
 * Date: 27.11.15
 * Time: 20:46
 */

namespace AppBundle\Controller;

use AppBundle\CommandBus\Urlop\DodajUrlopCommand;
use AppBundle\Form\Type\UrlopType;
use AppBundle\Response\RefererRedirectResponse;
use Component\HasUnitOfWorkTrait;
use Component\IHasUnitOfWork;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use SimpleBus\Message\Bus\MessageBus;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class UrlopController
 * @package AppBundle\Controller
 *
 * @Route("/urlop", service="app.controller.urlop")
 */
class UrlopController extends Controller implements IHasUnitOfWork
{
    use HasUnitOfWorkTrait;

    /** @var DodajUrlopCommand */
    private $dodajUrlopCommand;

    /** @var MessageBus */
    private $commandBus;

    /**
     * UrlopController constructor.
     * @param DodajUrlopCommand $dodajUrlopCommand
     * @param MessageBus $commandBus
     */
    public function __construct(DodajUrlopCommand $dodajUrlopCommand, MessageBus $commandBus)
    {
        $this->dodajUrlopCommand = $dodajUrlopCommand;
        $this->commandBus = $commandBus;
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
        $this->dodajUrlopCommand->setIloscDni(1);
        $this->dodajUrlopCommand->setRok(date('Y'));

        $form = $this->createForm(UrlopType::class, $this->dodajUrlopCommand);
        $form->handleRequest($request);

        if($form->isValid()){
            $this->commandBus->handle($this->dodajUrlopCommand);

            $this->unitOfWork->commit();

            return new RefererRedirectResponse($request);
        }

        return [
            'form' => $form->createView()
        ];
    }
}