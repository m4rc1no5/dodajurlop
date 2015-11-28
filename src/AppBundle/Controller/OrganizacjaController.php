<?php
/**
 * Created by PhpStorm.
 * User: marcinos
 * Date: 11.11.15
 * Time: 11:26
 */

namespace AppBundle\Controller;


use AppBundle\CommandBus\Organizacja\DodajOrganizacjeCommand;
use AppBundle\Repository\IOrganizacjaRepository;
use AppBundle\Response\RefererRedirectResponse;
use Component\HasUnitOfWorkTrait;
use Component\IHasUnitOfWork;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use SimpleBus\Message\Bus\MessageBus;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Organizacja;

/**
 * Class OrganizacjaController
 * @package AppBundle\Controller
 *
 * @Route("/organizacja", service="app.controller.organizacja")
 */
class OrganizacjaController extends Controller implements IHasUnitOfWork
{
    use HasUnitOfWorkTrait;

    /** @var DodajOrganizacjeCommand */
    protected $dodajOrganizacjeCommand;

    /** @var MessageBus */
    protected $commandBus;

    /** @var IOrganizacjaRepository */
    protected $organizacjaRepository;

    /**
     * DashboardController constructor.
     * @param DodajOrganizacjeCommand $dodajOrganizacjeCommand
     * @param MessageBus $commandBus
     * @param IOrganizacjaRepository $organizacjaRepository
     */
    public function __construct(DodajOrganizacjeCommand $dodajOrganizacjeCommand, MessageBus $commandBus, IOrganizacjaRepository $organizacjaRepository)
    {
        $this->dodajOrganizacjeCommand = $dodajOrganizacjeCommand;
        $this->commandBus = $commandBus;
        $this->organizacjaRepository = $organizacjaRepository;
    }

    /**
     * @Route("/", name="organizacja")
     * @Template()
     *
     * @return array
     */
    public function indexAction()
    {
        $organizacje = $this->organizacjaRepository->findAllByUser($this->getUser());

        return [
            'organizacje' => $organizacje
        ];
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

        if($form->isValid()) {
            $this->commandBus->handle($this->dodajOrganizacjeCommand);

            $this->unitOfWork->commit();

            return new RefererRedirectResponse($request);
        }

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route("/edytuj/{id}", name="organizacja.edytuj")
     * @Template()
     *
     * @param Request $request
     * @param Organizacja $organizacja
     * @return array
     */
    public function edytujAction(Request $request, Organizacja $organizacja)
    {

        // sprawdzamy czy user edytuje swoją organizację - jeśli nie to redirect
        if($organizacja->getUser()->getId() !== $this->getUser()->getId()){
            return new RefererRedirectResponse($request);
        }

        $form = $this->createForm('organizacja', $organizacja);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->unitOfWork->commit();
            return new RefererRedirectResponse($request);
        }

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route("/delete/{id}", name="organizacja.delete")
     *
     * @param Request $request
     * @param Organizacja $organizacja
     * @return array
     */
    public function deleteAction(Request $request, Organizacja $organizacja)
    {

        // sprawdzamy czy user edytuje swoją organizację - jeśli nie to redirect
        if($organizacja->getUser()->getId() == $this->getUser()->getId()){
            $organizacja->setDel(true);
            $this->unitOfWork->commit();
        }

        return new RefererRedirectResponse($request);
    }
}