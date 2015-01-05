<?php

namespace InstantSoin\ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use InstantSoin\ProductBundle\Entity\Services;

use InstantSoin\UserBundle\Component\Validator\Constraints as CustomAssert;

/**
 * services
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="InstantSoin\ProductBundle\Repository\ServicesRepository")
 */
class Services
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
     * @var string
     *
     * @ORM\Column(name="reference", type="string", length=10, unique=true)
     */
    private $reference;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="InstantSoin\ProductBundle\Entity\CategorieServ")     
     */
    private $categorieServ;

    /**
     * @var string
     * @Assert\File( maxSize = "2048k", mimeTypesMessage = "Please upload a valid Image")
     * @ORM\Column(name="image", type="string", length=255)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="urlimage", type="string", length=255)
     */
    private $urlimage;

    /**
     * @var string
     *
     * @ORM\Column(name="altimage", type="string", length=255)
     */
    private $altimage;

    /**
     * @var boolean
     *
     * @ORM\Column(name="nouveaute", type="boolean")
     */
    private $nouveaute;

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
     * @return Services
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
     * Set libelle
     *
     * @param string $libelle
     * @return Services
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string 
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Services
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
     * Set image
     *
     * @param string $image
     * @return Services
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set urlimage
     *
     * @param string $urlimage
     * @return Services
     */
    public function setUrlimage($urlimage)
    {
        $this->urlimage = $urlimage;

        return $this;
    }

    /**
     * Get urlimage
     *
     * @return string 
     */
    public function getUrlimage()
    {
        return $this->urlimage;
    }

    /**
     * Set altimage
     *
     * @param string $altimage
     * @return Services
     */
    public function setAltimage($altimage)
    {
        $this->altimage = $altimage;

        return $this;
    }

    /**
     * Get altimage
     *
     * @return string 
     */
    public function getAltimage()
    {
        return $this->altimage;
    }

    /**
     * Set categorieServ
     *
     * @param \InstantSoin\ProductBundle\Entity\CategorieServ $categorieServ
     * @return Services
     */
    public function setCategorieServ(\InstantSoin\ProductBundle\Entity\CategorieServ $categorieServ = null)
    {
        $this->categorieServ = $categorieServ;

        return $this;
    }

    /**
     * Get categorieServ
     *
     * @return \InstantSoin\ProductBundle\Entity\CategorieServ 
     */
    public function getCategorieServ()
    {
        return $this->categorieServ;
    }

    /**
     * Set prix
     *
     * @param string $prix
     * @return Services
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
     * Set nouveaute
     *
     * @param boolean $nouveaute
     * @return Services
     */
    public function setNouveaute($nouveaute)
    {
        $this->nouveaute = $nouveaute;

        return $this;
    }

    /**
     * Get nouveaute
     *
     * @return boolean 
     */
    public function getNouveaute()
    {
        return $this->nouveaute;
    }
}
