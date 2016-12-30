<?php

namespace BoosterBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

class User extends BaseUser
{

    protected $id;


    /**
     * @var string
     * @ORM\Column (type="string", length=255)
     */
    private $town;

    /**
     * @var integer
     * @ORM\Column (type="integer")
     */
    private $cp;

    /**
     * @var string
     * @ORM\Column (type="string", length=255)
     */
    private $address;

    /**
     * @var integer
     * @ORM\Column (type="integer", nullable=true)
     */
    private $phone;

    /**
     * @var integer
     * @ORM\Column (type="integer")
     */
    private $resident;

    /**
     * @var string
     * @ORM\Column (type="string", length=255)
     */
    private $website;

    /**
     * @var string
     * @ORM\Column (type="string", length=255)
     */
    private $firstname;

    /**
     * @var string
     * @ORM\Column (type="string", length=255)
     */
    private $lastname;

    /**
     * @var string
     */
    private $message_mayor;

    /**
     * @var string
     */
    private $description;

    /**
     * @var integer
     */
    private $lat;

    /**
     * @var integer
     */
    private $lgt;

    /**
     * @var string
     * @ORM\Column (type="string", length=255)
     */
    private $organization;

    /**
     * @var string
     * @ORM\Column (type="string", length=255)
     */
    private $status_actor;

    /**
     * @var string
     * @ORM\Column (type="string", length=255)
     */
    private $status_citizen;

    /**
     * @var string
     * @ORM\Column (type="string", length=255)
     */
    private $category;

    /**
     * @var string
     * @ORM\Column (type="string", length=255)
     */
    private $project;


    /**
     * Set town
     *
     * @param string $town
     * @return User
     */
    public function setTown($town)
    {
        $this->town = $town;

        return $this;
    }

    /**
     * Get town
     *
     * @return string 
     */
    public function getTown()
    {
        return $this->town;
    }

    /**
     * Set cp
     *
     * @param integer $cp
     * @return User
     */
    public function setCp($cp)
    {
        $this->cp = $cp;

        return $this;
    }

    /**
     * Get cp
     *
     * @return integer 
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return User
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set phone
     *
     * @param integer $phone
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return integer 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set resident
     *
     * @param integer $resident
     * @return User
     */
    public function setResident($resident)
    {
        $this->resident = $resident;

        return $this;
    }

    /**
     * Get resident
     *
     * @return integer 
     */
    public function getResident()
    {
        return $this->resident;
    }

    /**
     * Set website
     *
     * @param string $website
     * @return User
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Get website
     *
     * @return string 
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string 
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set message_mayor
     *
     * @param string $messageMayor
     * @return User
     */
    public function setMessageMayor($messageMayor)
    {
        $this->message_mayor = $messageMayor;

        return $this;
    }

    /**
     * Get message_mayor
     *
     * @return string 
     */
    public function getMessageMayor()
    {
        return $this->message_mayor;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return User
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set lat
     *
     * @param integer $lat
     * @return User
     */
    public function setLat($lat)
    {
        $this->lat = $lat;

        return $this;
    }

    /**
     * Get lat
     *
     * @return integer 
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * Set lgt
     *
     * @param integer $lgt
     * @return User
     */
    public function setLgt($lgt)
    {
        $this->lgt = $lgt;

        return $this;
    }

    /**
     * Get lgt
     *
     * @return integer 
     */
    public function getLgt()
    {
        return $this->lgt;
    }

    /**
     * Set organization
     *
     * @param string $organization
     * @return User
     */
    public function setOrganization($organization)
    {
        $this->organization = $organization;

        return $this;
    }

    /**
     * Get organization
     *
     * @return string 
     */
    public function getOrganization()
    {
        return $this->organization;
    }

    /**
     * Set status_actor
     *
     * @param string $statusActor
     * @return User
     */
    public function setStatusActor($statusActor)
    {
        $this->status_actor = $statusActor;

        return $this;
    }

    /**
     * Get status_actor
     *
     * @return string 
     */
    public function getStatusActor()
    {
        return $this->status_actor;
    }

    /**
     * Set status_citizen
     *
     * @param string $statusCitizen
     * @return User
     */
    public function setStatusCitizen($statusCitizen)
    {
        $this->status_citizen = $statusCitizen;

        return $this;
    }

    /**
     * Get status_citizen
     *
     * @return string 
     */
    public function getStatusCitizen()
    {
        return $this->status_citizen;
    }

    /**
     * Set category
     *
     * @param string $category
     * @return User
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return string 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set project
     *
     * @param string $project
     * @return User
     */
    public function setProject($project)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project
     *
     * @return string 
     */
    public function getProject()
    {
        return $this->project;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $offers;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $needs;


    /**
     * Add offers
     *
     * @param \BoosterBundle\Entity\Offer $offers
     * @return User
     */
    public function addOffer(\BoosterBundle\Entity\Offer $offers)
    {
        $this->offers[] = $offers;

        return $this;
    }

    /**
     * Remove offers
     *
     * @param \BoosterBundle\Entity\Offer $offers
     */
    public function removeOffer(\BoosterBundle\Entity\Offer $offers)
    {
        $this->offers->removeElement($offers);
    }

    /**
     * Get offers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOffers()
    {
        return $this->offers;
    }

    /**
     * Add needs
     *
     * @param \BoosterBundle\Entity\Needs $needs
     * @return User
     */
    public function addNeed(\BoosterBundle\Entity\Needs $needs)
    {
        $this->needs[] = $needs;

        return $this;
    }

    /**
     * Remove needs
     *
     * @param \BoosterBundle\Entity\Needs $needs
     */
    public function removeNeed(\BoosterBundle\Entity\Needs $needs)
    {
        $this->needs->removeElement($needs);
    }

    /**
     * Get needs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getNeeds()
    {
        return $this->needs;
    }
}
