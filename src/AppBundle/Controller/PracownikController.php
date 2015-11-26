<?php
/**
 * Created by PhpStorm.
 * User: marcinos
 * Date: 22.11.15
 * Time: 20:23
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Pracownik;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\CommandBus\Pracownik\DodajPracownikaCommand;
use SimpleBus\Message\Bus\MessageBus;
use AppBundle\Response\RefererRedirectResponse;
use Component\HasUnitOfWorkTrait;
use Component\IHasUnitOfWork;
use AppBundle\Repository\IPracownikRepository;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class PracownikController
 * @package AppBundle\Controller
 *
 * @Route("/pracownik", service="app.controller.pracownik")
 */
class PracownikController extends Controller implements IHasUnitOfWork
{
    use HasUnitOfWorkTrait;

    /** @var  DodajPracownikaCommand */
    protected $dodajPracownikaCommand;

    /** @var MessageBus */
    protected $commandBus;

    /** @var  IPracownikRepository */
    protected $pracownikRepository;

    public function __construct(DodajPracownikaCommand $dodajPracownikaCommand, MessageBus $commandBus, IPracownikRepository $pracownikRepository)
    {
        $this->dodajPracownikaCommand = $dodajPracownikaCommand;
        $this->commandBus = $commandBus;
        $this->pracownikRepository = $pracownikRepository;
    }

    /**
     * @Route("/", name="pracownik")
     * @Template()
     *
     * @return array
     */
    public function indexAction()
    {
        $pracownicy = $this->pracownikRepository->findAllByUser($this->getUser());

        return [
            'pracownicy' => $pracownicy
        ];
    }

    /**
     * @Route("/dodaj", name="pracownik.dodaj")
     * @Template()
     *
     * @param Request $request
     * @return array
     */
    public function dodajAction(Request $request)
    {
        $form = $this->createForm('pracownik', $this->dodajPracownikaCommand);
        $form->handleRequest($request);

        if($form->isValid()) {
            $this->commandBus->handle($this->dodajPracownikaCommand);

            $this->unitOfWork->commit();

            return new RefererRedirectResponse($request);
        }

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route("/edytuj/{id}", name="pracownik.edytuj")
     * @Template()
     *
     * @param Request $request
     * @param Pracownik $pracownik
     * @return array
     */
    public function edytujAction(Request $request, Pracownik $pracownik)
    {
        // sprawdzamy czy user edytuje swoją organizację - jeśli nie to redirect
        if($pracownik->getUser()->getId() !== $this->getUser()->getId()){
            return new RefererRedirectResponse($request);
        }

        $form = $this->createForm('pracownik', $pracownik);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->unitOfWork->commit();

            return new RefererRedirectResponse($request);
        }

        return [
            'form' => $form->createView()
        ];

    }
}