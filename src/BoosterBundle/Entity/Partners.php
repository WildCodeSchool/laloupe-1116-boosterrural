<?php

namespace BoosterBundle\Entity;

/**
 * Partners
 */
class Partners
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $partnerText;


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
     * Set partnerText
     *
     * @param string $partnerText
     *
     * @return Partners
     */
    public function setPartnerText($partnerText)
    {
        $this->partnerText = $partnerText;

        return $this;
    }

    /**
     * Get partnerText
     *
     * @return string
     */
    public function getPartnerText()
    {
        return $this->partnerText;
    }
}

