<?php

namespace BoosterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Mayor
 */
class Mayor
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $town;

    /**
     * @var int
     */
    private $cp;

    /**
     * @var string
     */
    private $address;

    /**
     * @var string
     */
    private $mail;

    /**
     * @var int
     */
    private $lat;

    /**
     * @var int
     */
    private $lgt;

    /**
     * @var string
     */
    private $phone;

    /**
     * @var int
     */
    private $nbCitizen;

    /**
     * @var string
     */
    private $mayorName;

    /**
     * @var string
     */
    private $website;

    /**
     * @var string
     */
    private $message;

    /**
     * @var string
     */
    private $townDescription;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set town
     *
     * @param string $town
     * @return Mayor
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
     * @return Mayor
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
     * @return Mayor
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
     * Set mail
     *
     * @param string $mail
     * @return Mayor
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string 
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set lat
     *
     * @param integer $lat
     * @return Mayor
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
     * @return Mayor
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
     * Set phone
     *
     * @param string $phone
     * @return Mayor
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set nbCitizen
     *
     * @param integer $nbCitizen
     * @return Mayor
     */
    public function setNbCitizen($nbCitizen)
    {
        $this->nbCitizen = $nbCitizen;

        return $this;
    }

    /**
     * Get nbCitizen
     *
     * @return integer 
     */
    public function getNbCitizen()
    {
        return $this->nbCitizen;
    }

    /**
     * Set mayorName
     *
     * @param string $mayorName
     * @return Mayor
     */
    public function setMayorName($mayorName)
    {
        $this->mayorName = $mayorName;

        return $this;
    }

    /**
     * Get mayorName
     *
     * @return string 
     */
    public function getMayorName()
    {
        return $this->mayorName;
    }

    /**
     * Set website
     *
     * @param string $website
     * @return Mayor
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
     * Set message
     *
     * @param string $message
     * @return Mayor
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string 
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set townDescription
     *
     * @param string $townDescription
     * @return Mayor
     */
    public function setTownDescription($townDescription)
    {
        $this->townDescription = $townDescription;

        return $this;
    }

    /**
     * Get townDescription
     *
     * @return string 
     */
    public function getTownDescription()
    {
        return $this->townDescription;
    }
    /**
     * @var string
     */
    private $oneToMany;


    /**
     * Set oneToMany
     *
     * @param string $oneToMany
     * @return Mayor
     */
    public function setOneToMany($oneToMany)
    {
        $this->oneToMany = $oneToMany;

        return $this;
    }

    /**
     * Get oneToMany
     *
     * @return string 
     */
    public function getOneToMany()
    {
        return $this->oneToMany;
    }
}
