<?php

namespace App\Models\Entity;

use Doctrine\ORM\Mapping;
use App\Models\Entity\Person;


/**
 * @Entity(repositoryClass="App\Models\Repository\AddressRepository") @Table(name="wunder_db_address")
 */
class Address
{
    /** @Id @Column(type="integer", unique=true) @GeneratedValue 
     *  @var int
     */
    private $id;

    /** @Column(type="integer", unique=false) 
     *  @var string
     */
    private $houseNumber;

    /** @Column(type="string", unique=false) 
     *  @var string
     */
    private $street;

    /** @Column(type="string", unique=false) 
     *  @var string
     */
    private $zipCode;

    /** @Column(type="string", unique=false) 
     *  @var string
     */
    private $city;

    /**
     * One Address has One Person.
     * @OneToOne(targetEntity="Person", inversedBy="address")
     * @var Person
     */
    private $person;

    public function getId() : int {
        return $this->id;
    }

    public function getHouseNumber() : int {
        return $this->houseNumber;
    }

    public function setHouseNumber(int $houseNumber) : void {
        $this->houseNumber = $houseNumber;
    }

    public function getStreet() : string {
        return $this->street;
    }

    public function setStreet(string $street) : void {
        $this->street = $street;
    }

    public function getZipCode() : string {
        return $this->zipCode;
    }

    public function setZipCode(string $zipCode) : void {
        $this->zipCode = $zipCode;
    }

    public function getCity() : string {
        return $this->city;
    }

    public function setCity(string $city) : void {
        $this->city = $city;
    }

    public function getFullName() : string {
        return $this->firstName . ' ' . $this->lastName;
    }

    public function getPerson() : Person {
        return $this->person;
    }

    public function setPerson(Person $person) : void {
        $this->person = $person;
    }

    public function getFullAddress() : string {
        return $this->houseNumber . ' ' . $this->street . ', ' . $this->zipCode . ' ' . ucfirst($this->city);
    }
}