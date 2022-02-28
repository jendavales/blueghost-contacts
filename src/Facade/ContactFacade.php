<?php

namespace App\Facade;

use App\Entity\Contact;
use App\Repository\ContactRepository;
use Doctrine\ORM\EntityManagerInterface;

class ContactFacade
{
    private $contactRepository;
    private $entityManager;

    public function __construct(ContactRepository $contactRepository, EntityManagerInterface $entityManager)
    {
        $this->contactRepository = $contactRepository;
        $this->entityManager = $entityManager;
    }

    public function loadAll(): array
    {
        return $this->contactRepository->findAll();
    }

    public function findByName(string $firstname, string $surname): ?Contact
    {
        return $this->contactRepository->findOneBy(['firstname' => $firstname, 'surname' => $surname]);
    }

    public function update(Contact $contact)
    {
        $this->entityManager->persist($contact);
        $this->entityManager->flush();
    }

    public function delete(int $id): bool
    {
        $contact = $this->contactRepository->findOneBy(['id' => $id]);
        if (is_null($contact)) {
            return false;
        }
        $this->entityManager->remove($contact);
        $this->entityManager->flush();
        return true;
    }
}