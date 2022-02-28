<?php

namespace App\DataFixtures;

use App\Entity\Contact;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ContactFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $contact = new Contact();
        $contact->setEmail('jenda.vales@seznam.cz');
        $contact->setFirstname('Jan');
        $contact->setSurname('Valeš');
        $contact->setPhone('111 111 111');
        $manager->persist($contact);

        $manager->flush();
    }
}
