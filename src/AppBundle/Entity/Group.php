<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Group
 * 
 * @ORM\Table(name="customgroup")
 * @ORM\Entity
 */
class Group {
  /**
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   * @ORM\Column(type="integer")
   */
  private $id;

  /**
   * @ORM\Column(name="name", type="string", length=50, nullable=false, unique=true)
   */
  private $name;


  /**
   * Group name
   */
  public function __toString(){
    return $this->name;
  }

  /**
  * Get id
  */
  public function getId(){
    return $this->id;
  }

  /**
   * Set name   
   */
  public function setName($name){
    $this->name = $name;

    return $this;
  }

  /**
   * Get name
   */
  public function getName(){
    return $this->name;
  }

}