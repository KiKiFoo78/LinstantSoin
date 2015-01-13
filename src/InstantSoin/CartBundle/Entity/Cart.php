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
     * @ORM\Column(name="id_prod", type="string", length=10)
     */
    private $id_prod;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantite", type="integer", length=2)
     */
    private $quantite;

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
     * Set id_prod
     *
     * @param string $id_prod
     * @return Cart
     */
    public function setId_prod($id_prod)
    {
        $this->id_prod = $id_prod;
    
        return $this;
    }

    /**
     * Get id_prod
     *
     * @return string 
     */
    public function getId_prod()
    {
        return $this->id_prod;
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

    /**
     * Set id_prod
     *
     * @param string $idProd
     * @return Cart
     */
    public function setIdProd($idProd)
    {
        $this->id_prod = $idProd;
    
        return $this;
    }

    /**
     * Get id_prod
     *
     * @return string 
     */
    public function getIdProd()
    {
        return $this->id_prod;
    }
}