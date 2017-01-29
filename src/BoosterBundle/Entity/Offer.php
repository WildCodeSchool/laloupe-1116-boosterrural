<?php

namespace BoosterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Offer
 */
class Offer
{
    protected function getUploadDir()
    {
        return 'uploads';
    }
    protected function getUploadRootDir()
    {
        return __DIR__ . '/../../../web/' . $this->getUploadDir();
    }
    public function getWebPath()
    {
        return null === $this->imageOffer ? null : $this->getUploadDir() . '/' . $this->imageOffer;
    }
    public function getAbsolutePath()
    {
        return null === $this->imageOffer ? null : $this->getUploadRootDir() . '/' . $this->imageOffer;
    }
    public $fileOffer;
    public function preUploadOffer()
    {
        if (null !== $this->fileOffer) {
            // do whatever you want to generate a unique name
            $this->imageOffer = uniqid() . '.' . $this->fileOffer->guessExtension();
        }
    }
    public function uploadOffer()
    {
        if (null === $this->fileOffer) {
            return;
        }
        // if there is an error when moving the file, an exception will
        // be automatically thrown by move(). This will properly prevent
        // the entity from being persisted to the database on error
        $this->fileOffer->move($this->getUploadRootDir(), $this->imageOffer);
        unset($this->fileOffer);
    }
    public function removeUploadOffer()
    {
        if ($file = $this->getAbsolutePath()) {
            unlink($file);
        }
    }
    /*************************GENERATE CODE********************************/
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @Assert\Regex(
     *     pattern="/^[0-9]{5}$/"
     *     message="Le code postal ne peut contenir que des chiffres"
     *     )
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
     * @var string
     */
    private $activity;

    /**
     * @var string
     */
    private $wish;

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
     */
    private $imageOffer;

    /**
     * @var \BoosterBundle\Entity\User
     */
    private $users;


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
     *
     * @return Offer
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
     * @param string $cp
     *
     * @return Offer
     */
    public function setCp($cp)
    {
        $this->cp = $cp;

        return $this;
    }

    /**
     * Get cp
     *
     * @return string
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * Set town
     *
     * @param string $town
     *
     * @return Offer
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
     *
     * @return Offer
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
     * Set activity
     *
     * @param string $activity
     *
     * @return Offer
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
     * Set wish
     *
     * @param string $wish
     *
     * @return Offer
     */
    public function setWish($wish)
    {
        $this->wish = $wish;

        return $this;
    }

    /**
     * Get wish
     *
     * @return string
     */
    public function getWish()
    {
        return $this->wish;
    }

    /**
     * Set lat
     *
     * @param integer $lat
     *
     * @return Offer
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
     *
     * @return Offer
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
     * Set imageOffer
     *
     * @param string $imageOffer
     *
     * @return Offer
     */
    public function setImageOffer($imageOffer)
    {
        $this->imageOffer = $imageOffer;

        return $this;
    }

    /**
     * Get imageOffer
     *
     * @return string
     */
    public function getImageOffer()
    {
        return $this->imageOffer;
    }

    /**
     * Set users
     *
     * @param \BoosterBundle\Entity\User $users
     *
     * @return Offer
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

    /**
     * @var string
     */
    private $development;

    /**
     * @var string
     */
    private $habitation;

    /**
     * @var string
     */
    private $culture;

    /**
     * @var string
     */
    private $agriculture;

    /**
     * @var string
     */
    private $transportation;

    /**
     * @var string
     */
    private $coworking;


    /**
     * Set development
     *
     * @param string $development
     *
     * @return Offer
     */
    public function setDevelopment($development)
    {
        $this->development = $development;

        return $this;
    }

    /**
     * Get development
     *
     * @return string
     */
    public function getDevelopment()
    {
        return $this->development;
    }

    /**
     * Set habitation
     *
     * @param string $habitation
     *
     * @return Offer
     */
    public function setHabitation($habitation)
    {
        $this->habitation = $habitation;

        return $this;
    }

    /**
     * Get habitation
     *
     * @return string
     */
    public function getHabitation()
    {
        return $this->habitation;
    }

    /**
     * Set culture
     *
     * @param string $culture
     *
     * @return Offer
     */
    public function setCulture($culture)
    {
        $this->culture = $culture;

        return $this;
    }

    /**
     * Get culture
     *
     * @return string
     */
    public function getCulture()
    {
        return $this->culture;
    }

    /**
     * Set agriculture
     *
     * @param string $agriculture
     *
     * @return Offer
     */
    public function setAgriculture($agriculture)
    {
        $this->agriculture = $agriculture;

        return $this;
    }

    /**
     * Get agriculture
     *
     * @return string
     */
    public function getAgriculture()
    {
        return $this->agriculture;
    }

    /**
     * Set transportation
     *
     * @param string $transportation
     *
     * @return Offer
     */
    public function setTransportation($transportation)
    {
        $this->transportation = $transportation;

        return $this;
    }

    /**
     * Get transportation
     *
     * @return string
     */
    public function getTransportation()
    {
        return $this->transportation;
    }

    /**
     * Set coworking
     *
     * @param string $coworking
     *
     * @return Offer
     */
    public function setCoworking($coworking)
    {
        $this->coworking = $coworking;

        return $this;
    }

    /**
     * Get coworking
     *
     * @return string
     */
    public function getCoworking()
    {
        return $this->coworking;
    }
    /**
     * @var string
     */
    private $category;


    /**
     * Set category
     *
     * @param string $category
     *
     * @return Offer
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
}
