<?php

namespace InstantSoin\ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use InstantSoin\ProductBundle\Entity\Produits;
use InstantSoin\ProductBundle\Entity\Tva;

use InstantSoin\UserBundle\Component\Validator\Constraints as CustomAssert;

/**
 * produits
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="InstantSoin\ProductBundle\Repository\ProduitsRepository")
 */
class Produits
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
     * @ORM\Column(name="designation", type="string", length=255)
     */
    private $designation;

    

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="InstantSoin\ProductBundle\Entity\CategorieProd")     
     */
    private $categorieProd;

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
     * @ORM\ManyToOne(targetEntity="InstantSoin\ProductBundle\Entity\Fournisseurs")
     */
    private $fournisseurs;

    /**
     * @var integer
     *
     * @ORM\Column(name="stock", type="integer")
     */
    private $stock;

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
     * @ORM\ManyToOne(targetEntity="InstantSoin\ProductBundle\Entity\Tva", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $tva;


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
     * @return Produits
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
     * Set designation
     *
     * @param string $designation
     * @return Produits
     */
    public function setDesignation($designation)
    {
        $this->designation = $designation;

        return $this;
    }

    /**
     * Get designation
     *
     * @return string 
     */
    public function getDesignation()
    {
        return $this->designation;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Produits
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
     * @return Produits
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
     * @return Produits
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
     * @return Produits
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
     * Set stock
     *
     * @param integer $stock
     * @return Produits
     */
    public function setStock($stock)
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * Get stock
     *
     * @return integer 
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Set prix
     *
     * @param string $prix
     * @return Produits
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
     * Set categorieProd
     *
     * @param \InstantSoin\ProductBundle\Entity\CategorieProd $categorieProd
     * @return Produits
     */
    public function setCategorieProd(\InstantSoin\ProductBundle\Entity\CategorieProd $categorieProd = null)
    {
        $this->categorieProd = $categorieProd;

        return $this;
    }

    /**
     * Get categorieProd
     *
     * @return \InstantSoin\ProductBundle\Entity\CategorieProd 
     */
    public function getCategorieProd()
    {
        return $this->categorieProd;
    }

    /**
     * Set fournisseurs
     *
     * @param \InstantSoin\ProductBundle\Entity\Fournisseurs $fournisseurs
     * @return Produits
     */
    public function setFournisseurs(\InstantSoin\ProductBundle\Entity\Fournisseurs $fournisseurs = null)
    {
        $this->fournisseurs = $fournisseurs;

        return $this;
    }

    /**
     * Get fournisseurs
     *
     * @return \InstantSoin\ProductBundle\Entity\Fournisseurs 
     */
    public function getFournisseurs()
    {
        return $this->fournisseurs;
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('reference', new Assert\NotBlank());
        $metadata->addPropertyConstraint('reference', new Assert\Length(array(
            'min'   => 2,
            'max'   => 10,
            'minMessage' => 'Le reference du produit doit être au minimum de 2 caractères.',
            'maxMessage' => 'Le reference du produit doit être au maximum de 10 caractères.',
        )));

        $metadata->addPropertyConstraint('designation', new Assert\NotBlank());
        $metadata->addPropertyConstraint('designation', new Assert\Length(array(
            'min'   => 2,
            'max'   => 50,
            'minMessage' => 'La désignation de ce produit doit être au minimum de 2 caractères.',
            'maxMessage' => 'La désignation de ce produit doit être au maximum de 50 caractères.',
        )));

        $metadata->addPropertyConstraint('description', new Assert\NotBlank());
        $metadata->addPropertyConstraint('description', new Assert\Length(array(
            'min'   => 20,
            'max'   => 250,
            'minMessage' => 'La description du produit doit être au minimum de 20 caractères.',
            'maxMessage' => 'La description du produit doit être au maximum de 250 caractères.',
        )));

        $metadata->addPropertyConstraint('stock', new Assert\GreaterThan(0));
    }




    

    /**
     * Set nouveaute
     *
     * @param boolean $nouveaute
     * @return Produits
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

    /**
     * Set tva
     *
     * @param \InstantSoin\ProductBundle\Entity\Tva $tva
     * @return Produits
     */
    public function setTva(\InstantSoin\ProductBundle\Entity\Tva $tva)
    {
        $this->tva = $tva;
    
        return $this;
    }

    /**
     * Get tva
     *
     * @return \InstantSoin\ProductBundle\Entity\Tva 
     */
    public function getTva()
    {
        return $this->tva;
    }
}