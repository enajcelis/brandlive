<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use JMS\Serializer\Annotation\Type;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Count;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Customer
 *
 * @ORM\Table(name="customer")
 * @UniqueEntity(fields="email", message="customer.email.duplicate")
 * @ORM\Entity
 */
class Customer {
  /**
   * @ORM\Column(type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $id;

  /**
   * @Assert\NotBlank(message="customer.validate.firstname")
   * @ORM\Column(name="firstname", type="string", length=100, nullable=false)
   */
  private $firstName;

  /**
   * @Assert\NotBlank(message="customer.validate.lastname")
   * @ORM\Column(name="lastname", type="string", length=100, nullable=false)
   */
  private $lastName;

  /**
   * @Assert\NotBlank(message="customer.validate.email")
   * @ORM\Column(name="email", type="string", length=100, unique=true)
   * @Assert\Email(
   *    message = "customer.invalid.email",
   *    checkMX = true
   * )
   */
  private $email;

  /**
   * @Count(min = 1, minMessage="customer.validate.groups.count")
   * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Group")
   **/
  private $groups;

  /**
   * @Assert\NotBlank(message="customer.validate.observations")
   * @ORM\Column(name="observations", type="text", nullable=false)
   */
  private $observations;


  /**
   * Constructor
   */
  public function __construct(){
    $this->groups = new ArrayCollection();
  }

  /**
   * Customer full name
   */
  public function __toString(){
    return $this->firstName . " " . $this->lastName;
  }

  /**
   * Get id
   */
  public function getId(){
    return $this->id;
  }

  /**
   * Set firstName
   */
  public function setFirstName($firstName){
    $this->firstName = $firstName;

    return $this;
  }

  /**
   * Get fisrtName
   */
  public function getFirstName(){
    return $this->firstName;
  }

  /**
   * Set lastName
   */
  public function setLastName($lastName){
    $this->lastName = $lastName;

    return $this;
  }

  /**
   * Get lastName
   */
  public function getLastName(){
    return $this->lastName;
  }

  /**
   * Set email
   */
  public function setEmail($email){
    $this->email = $email;

    return $this;
  }

  /**
   * Get email
   */
  public function getEmail(){
    return $this->email;
  }

  /**
   * Get groups
   */
  public function getGroups() {
    return $this->groups;
  }

  /**
   * Set groups
   */
  public function setGroups(Group $groups = null){
    $this->groups = $groups;

    return $this;
  }

  /**
   * Add groups
   */
  public function addGroups(Group $groups){
    $this->groups[] = $groups;

    return $this;
  }

  /**
   * Remove groups
   */
  public function removeGroups(Group $groups){
    $this->groups->removeElement($groups);

    return $this;
  }

  /**
   * Set observations
   */
  public function setObservations($observations){
    $this->observations = $observations;

    return $this;
  }

  /**
   * Get observations
   */
  public function getObservations(){
    return $this->observations;
  }

}