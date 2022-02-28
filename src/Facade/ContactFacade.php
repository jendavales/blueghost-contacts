<?php

namespace App\Facade;

use App\Repository\ContactRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

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