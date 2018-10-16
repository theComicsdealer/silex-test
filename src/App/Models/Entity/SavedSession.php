<?php
// src/App/Models/Entity/SavedSession.php
namespace App\Models\Entity;

use Doctrine\ORM\Mapping;

/**
 * @Entity(repositoryClass="App\Models\Repository\SavedSessionRepository") @Table(name="wunder_db_saved_session")
 */
class SavedSession
{
    /** @Id @Column(type="integer", unique=true) @GeneratedValue 
     *  @var int
     */
    private $id;

    /** @Column(type="string", unique=true) 
     *  @var string
     */
    private $identifier;

    /** @Column(type="blob", unique=false) 
     *  @var string
     */
    private $content;

    public function getId() : int {
        return $this->id;
    }

    public function getIdentifier() : string {
        return $this->identifier;
    }

    public function generateIdentifier() : void {
        $randNumber1 = random_int(1, 100000);
        $randNumber2 = random_int(1, 100000);
        $randNumber = $randNumber1 + $randNumber2;
        $this->identifier = hash('sha256', $randNumber);
    }

    public function setContent($data = array()) : void {
        $this->content = json_encode($data);
    }

    public function getData() : array {
        return json_decode($this->content);
    }

}