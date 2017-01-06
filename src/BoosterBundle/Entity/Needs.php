<?php

namespace BoosterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Needs
 */
class Needs
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var int
     */
    private $cp;

    /**
     * @var string
     */
    private $town;

    /**
     * @var string
     */
    private $description;

    /**
     * @var int
     */
    private $lat;

    /**
     * @var int
     */
    private $lgt;


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
     * Set title
     *
     * @param string $title
     * @return Needs
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set cp
     *
     * @param integer $cp
     * @return Needs
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
     * Set town
     *
     * @param string $town
     * @return Needs
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
     * Set description
     *
     * @param string $description
     * @return Needs
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
     * @return Needs
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
     * @return Needs
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
     * @var string
     */
    private $activity;

    /**
     * @var string
     */
    private $availability;


    /**
     * Set activity
     *
     * @param string $activity
     * @return Needs
     */
    public function setActivity($activity)
    {
        $this->activity = $activity;

        return $this;
    }

    /**
     * Get activity
     *
     * @return string 
     */
    public function getActivity()
    {
        return $this->activity;
    }

    /**
     * Set availability
     *
     * @param string $availability
     * @return Needs
     */
    public function setAvailability($availability)
    {
        $this->availability = $availability;

        return $this;
    }

    /**
     * Get availability
     *
     * @return string 
     */
    public function getAvailability()
    {
        return $this->availability;
    }
    /**
     * @var \BoosterBundle\Entity\User
     */
    private $users;


    /**
     * Set users
     *
     * @param \BoosterBundle\Entity\User $users
     * @return Needs
     */
    public function setUsers(\BoosterBundle\Entity\User $users = null)
    {
        $this->users = $users;

        return $this;
    }

    /**
     * Get users
     *
     * @return \BoosterBundle\Entity\User 
     */
    public function getUsers()
    {
        return $this->users;
    }
}
