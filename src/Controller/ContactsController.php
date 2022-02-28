<?php

namespace App\Controller;

use App\Facade\ContactFacade;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactsController extends AbstractController
{
    private $contactFacade;

    public function __construct(ContactFacade $contactFacade)
    {
        $this->contactFacade = $contactFacade;
    }

    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        return $this->render('index.html.twig', [
            'contacts' => $this->contactFacade->loadAll(),
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete")
     * @param int $id
     * @return Response
     */
    public function delete(int $id): Response
    {
        $result = $this->contactFacade->delete($id);
        if ($result) {
            $this->addFlash('success', 'Kontakt byl smazán');
        }
        return $this->redirectToRoute('index');
    }
}
