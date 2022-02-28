<?php

namespace App\Controller;

use App\Facade\ContactFacade;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
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
     * @Route("/{firstname}-{surname}", name="edit")
     * @return Response
     */
    public function edit(Request $request, string $firstname, string $surname): Response
    {
        $contact = $this->contactFacade->findByName($firstname, $surname);
        if (is_null($contact)) {
            throw new NotFoundHttpException();
        }

        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->contactFacade->update($contact);
            return $this->redirectToRoute('edit', [
                'firstname' => $contact->getFirstname(),
                'surname' => $contact->getSurname()
            ]);
        }
        return $this->render('contact/edit.html.twig', [
            'form' => $form->createView(),
            'contact' => $contact
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
