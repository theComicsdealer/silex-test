<?php
// src/App/Models/Entity/Person.php
namespace App\Models\Entity;

use Doctrine\ORM\Mapping;
use App\Models\Entity\Address;
use App\Models\Entity\Payment;


/**
 * @Entity(repositoryClass="App\Models\REpository\PersonRepository") @Table(name="wunder_db_person")
 */
class Person
{
    /** @Id @Column(type="integer", unique=true) @GeneratedValue 
     *  @var int
     */
    private $id;

    /** @Column(type="string", unique=false) 
     *  @var string
     */
    private $firstName;

    /** @Column(type="string", unique=false) 
     *  @var string
     */
    private $lastName;

    /** @Column(type="string", unique=false) 
     *  @var string
     */
    private $telephone;

    /**
     * One Person has One Address.
     * @OneToOne(targetEntity="Address", mappedBy="person")
     * @var Address
     */
    private $address;

    /**
     * One Person has One Payment.
     * @OneToOne(targetEntity="Payment", mappedBy="payment")
     * @var Payment
     */
    private $payment;

    public function getId() : int {
        return $this->id;
    }

    public function getFirstName() : string {
        return $this->firstName;
    }

    public function setFirstName(string $firstName) : void {
        $this->firstName = $firstName;
    }

    public function getLastName() : string {
        return $this->lastName;
    }

    public function setLastName(string $lastName) : void {
        $this->lastName = $lastName;
    }

    public function getTelephone() : string {
        return $this->telephone;
    }

    public function setTelephone(string $telephone) : void {
        $this->telephone = $telephone;
    }

    public function getAddress() : Address {
        return $this->address;
    }

    public function setAddress(Address $address) : void {
        $this->address = $address;
    }

    public function getPayment() : Payment {
        return $this->payment;
    }

    public function setPayment(Payment $payment) : void {
        $this->payment = $payment;
    }

    public function getFullName() : string {
        return $this->firstName . ' ' . $this->lastName;
    }

}