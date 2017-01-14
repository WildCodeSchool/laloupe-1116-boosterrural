<?php
namespace BoosterBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * Needs
 */
class Needs
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
        return null === $this->image ? null : $this->getUploadDir() . '/' . $this->image;
    }

    public function getAbsolutePath()
    {
        return null === $this->image ? null : $this->getUploadRootDir() . '/' . $this->image;
    }

    public $fileNeeds;

    public function preUploadNeeds()
    {
        if (null !== $this->fileNeeds) {
            // do whatever you want to generate a unique name
            $this->imageNeeds = uniqid() . '.' . $this->fileNeeds->guessExtension();
        }
    }

    public function uploadNeeds()
    {
        if (null === $this->fileNeeds) {
            return;
        }
        // if there is an error when moving the file, an exception will
        // be automatically thrown by move(). This will properly prevent
        // the entity from being persisted to the database on error
        $this->fileNeeds->move($this->getUploadRootDir(), $this->imageNeeds);
        unset($this->fileNeeds);
    }

    public function removeUploadNeeds()
    {
        if ($file = $this->getAbsolutePath()) {
            unlink($file);
        }
    }

    /**
     * Generate code
     **/
    /**
     * @var integer
     */
    private $id;
    /**
     * @var string
     */
    private $title;
    /**
     * @var string
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
    private $availability;
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
    private $imageNeeds;
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
     * @param string $cp
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
     * Set imageNeeds
     *
     * @param string $imageNeeds
     * @return Needs
     */
    public function setImageNeeds($imageNeeds)
    {
        $this->ImageNeeds = $imageNeeds;
        return $this;
    }

    /**
     * Get imageNeeds
     *
     * @return string
     */
    public function getImageNeeds()
    {
        return $this->imageNeeds;
    }

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


    /**
     * @var string
     */
    private $wish;


    /**
     * Set wish
     *
     * @param string $wish
     *
     * @return Needs
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
}
