<?php

namespace App\Models\Entity;

use Doctrine\ORM\Mapping;
use App\Models\Entity\Person;


/**
 * @Entity(repositoryClass="App\Models\Repository\PaymentRepository") @Table(name="wunder_db_payment")
 */
class Payment
{
    /** @Id @Column(type="integer", unique=true) @GeneratedValue 
     *  @var int
     */
    private $id;

    /** @Column(type="string", unique=false) 
     *  @var string
     */
    private $owner;

    /** @Column(type="string", unique=false) 
     *  @var string
     */
    private $iban;

    /**
     * One Payment has One Person.
     * @OneToOne(targetEntity="Person", inversedBy="payment")
     * @var Person
     */
    private $person;

    public function getId() : int {
        return $this->id;
    }

    public function getOwner() : string {
        return $this->owner;
    }

    public function setOwner(string $owner) : void {
        $this->owner = $owner;
    }

    public function getIban() : string {
        return $this->iban;
    }

    public function setIban(string $iban) : void {
        $this->iban = $iban;
    }

    public function getPerson() : Person {
        return $this->person;
    }

    public function setPerson(Person $person) : void {
        $this->person = $person;
    }

}