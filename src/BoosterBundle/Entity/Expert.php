<?php

namespace BoosterBundle\Entity;

/**
 * Expert
 */
class Expert
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
        return null === $this->imageExperts ? null : $this->getUploadDir() . '/' . $this->imageExperts;
    }
    public function getAbsolutePath()
    {
        return null === $this->imageExperts ? null : $this->getUploadRootDir() . '/' . $this->imageExperts;
    }

    public $fileExperts;

    public function preUploadExperts()
    {
        if (null !== $this->fileExperts) {
            // do whatever you want to generate a unique name
            $this->imageExperts = uniqid() . '.' . $this->fileExperts->guessExtension();
        }
    }
    public function uploadExperts()
    {
        if (null === $this->fileExperts) {
            return;
        }
        // if there is an error when moving the file, an exception will
        // be automatically thrown by move(). This will properly prevent
        // the entity from being persisted to the database on error
        $this->fileExperts->move($this->getUploadRootDir(), $this->imageExperts);
        unset($this->fileExperts);
    }
    public function removeUploadExperts()
    {
        if ($file = $this->getAbsolutePath()) {
            unlink($file);
        }
    }

    /*************************************GENERATE CODE*****************************************************/


    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $expertText;

    /**
     * @var string
     */
    private $imageExperts;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set expertText
     *
     * @param string $expertText
     *
     * @return Expert
     */
    public function setExpertText($expertText)
    {
        $this->expertText = $expertText;

        return $this;
    }

    /**
     * Get expertText
     *
     * @return string
     */
    public function getExpertText()
    {
        return $this->expertText;
    }

    /**
     * Set imageExperts
     *
     * @param string $imageExperts
     *
     * @return Expert
     */
    public function setImageExperts($imageExperts)
    {
        $this->imageExperts = $imageExperts;

        return $this;
    }

    /**
     * Get imageExperts
     *
     * @return string
     */
    public function getImageExperts()
    {
        return $this->imageExperts;
    }
}
