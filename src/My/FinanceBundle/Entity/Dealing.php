<?php

namespace My\FinanceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use My\FinanceBundle\Entity\DealingType;

/**
 * Dealing
 *
 * @ORM\Table(name="dealing")
 * @ORM\Entity(repositoryClass="My\FinanceBundle\Entity\Repository\DealingRepository")
 */
class Dealing
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=true)
     */
    private $date;

    /**
     * @var integer
     *
     * @ORM\Column(name="dealing_type_id", type="integer", nullable=true)
     */
    private $dealingTypeId;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="client", type="string", length=255, nullable=true)
     */
    private $client;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="amount", type="integer", nullable=true)
     */
    private $amount;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;


    public function _construct() {
        $this->createdAt = new \Datetime();
    }

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
     * Set date
     *
     * @param \DateTime $date
     * @return Dealing
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set dealingTypeId
     *
     * @param integer $dealingTypeId
     * @return Dealing
     */
    public function setDealingTypeId($dealingTypeId)
    {
        $this->dealingTypeId = $dealingTypeId;

        return $this;
    }

    /**
     * Get dealingTypeId
     *
     * @return integer 
     */
    public function getDealingTypeId()
    {
        return $this->dealingTypeId;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Dealing
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
     * Set client
     *
     * @param string $client
     * @return Dealing
     */
    public function setClient($client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return string 
     */
    public function getClient()
    {
        return $this->client;
    }
    
    /**
     * Set amount
     *
     * @param integer $amount
     * @return Dealing
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return integer 
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set createdAt
     *
     * @param \datetime $createdAt
     * @return Dealing
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \datetime createdAt
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \datetime $updatedAt
     * @return Dealing
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \datetime updatedAt
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
    /**
     * @var \My\FinanceBundle\Entity\DealingType
     */
    private $dealingType;


    /**
     * Set dealingType
     *
     * @param \My\FinanceBundle\Entity\DealingType $dealingType
     * @return Dealing
     */
    public function setDealingType(\My\FinanceBundle\Entity\DealingType $dealingType = null)
    {
        $this->dealingType = $dealingType;

        return $this;
    }

    /**
     * Get dealingType
     *
     * @return \My\FinanceBundle\Entity\DealingType 
     */
    public function getDealingType()
    {
        return $this->dealingType;
    }
}
