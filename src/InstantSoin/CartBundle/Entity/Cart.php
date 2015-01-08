<?php

namespace InstantSoin\CartBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use InstantSoin\CartBundle\Entity\Cart;
use InstantSoin\UserBundle\Entity\User;

use InstantSoin\UserBundle\Component\Validator\Constraints as CustomAssert;

/**
 * cart
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="InstantSoin\CartBundle\Repository\CartRepository")
 */
class Cart
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="InstantSoin\UserBundle\Entity\User")
     **/
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="reference", type="string", length=10, unique=true)
     */
    private $reference;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantite", type="integer", length=2)
     */
    private $quantite;

    /**
     * @var decimal
     *
     * @ORM\Column(name="prix", type="decimal", scale=2)
     */
    private $prix;


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
     * Set reference
     *
     * @param string $reference
     * @return Cart
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
    
        return $this;
    }

    /**
     * Get reference
     *
     * @return string 
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Set quantite
     *
     * @param integer $quantite
     * @return Cart
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;
    
        return $this;
    }

    /**
     * Get quantite
     *
     * @return integer 
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * Set prix
     *
     * @param string $prix
     * @return Cart
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;
    
        return $this;
    }

    /**
     * Get prix
     *
     * @return string 
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set user
     *
     * @param \InstantSoin\UserBundle\Entity\User $user
     * @return Cart
     */
    public function setUser(\InstantSoin\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \InstantSoin\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}