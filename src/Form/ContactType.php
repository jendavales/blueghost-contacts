<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', null, [
                'label' => 'Křestní jméno'
            ])
            ->add('surname', null, [
                'label' => 'Příjmení'
            ])
            ->add('phone', null, [
                'label' => 'Telefon'
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email'
            ])
            ->add('note', null, [
                'label' => 'Poznámka'
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Uložit'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
