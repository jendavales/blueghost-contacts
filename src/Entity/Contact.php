<?php

namespace App\Entity;

use App\Repository\ContactRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @UniqueEntity(
 *   fields={"firstname", "surname"},
 *   message="Jméno je již existuje"
 * )
 * @ORM\Entity(repositoryClass=ContactRepository::class)
 */
class Contact
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     * @Constraints\Regex(
     *     pattern="/^[ěščřžýáíéóúůďťňĎŇŤŠČŘŽÝÁÍÉÚŮĚÓa-zA-z]+$/",
     *     match=true,
     *     message="Jméno musí obsahovat pouze písmena abecedy"
     *     )
     * @Constraints\Length(
     *      min = 2,
     *      max = 30,
     *      minMessage = "Minimální délka je {{ limit }} znaky",
     *      maxMessage = "Maximální délka je {{ limit }} znaků"
     * )
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=30)
     * @Constraints\Regex(
     *     pattern="/^[ěščřžýáíéóúůďťňĎŇŤŠČŘŽÝÁÍÉÚŮĚÓa-zA-z]+$/",
     *     match=true,
     *     message="Jméno musí obsahovat pouze písmena abecedy"
     *     )
     * @Constraints\Length(
     *      min = 2,
     *      max = 30,
     *      minMessage = "Minimální délka je {{ limit }} znaky",
     *      maxMessage = "Maximální délka je {{ limit }} znaků"
     * )
     */
    private $surname;

    /**
     * @ORM\Column(type="string", length=15)
     * @Constraints\Length(
     *      min = 9,
     *      max = 15,
     *      minMessage = "Minimální délka je {{ limit }} znaků",
     *      maxMessage = "Maximální délka je {{ limit }} znaků"
     * )
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=50)
     * @Constraints\Email(message="Zadejte platný email")
     * @Constraints\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Minimální délka je {{ limit }} znaky",
     *      maxMessage = "Maximální délka je {{ limit }} znaků"
     * )
     */
    private $email;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $note;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getFullName(): string
    {
        return $this->getFirstname() . ' ' . $this->getSurname();
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(?string $note): self
    {
        $this->note = $note;

        return $this;
    }
}
