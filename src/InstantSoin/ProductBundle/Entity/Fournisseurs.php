<?php

namespace InstantSoin\ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use InstantSoin\ProductBundle\Entity\Fournisseurs;

use InstantSoin\UserBundle\Component\Validator\Constraints as CustomAssert;

/**
 * Fournisseurs
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="InstantSoin\ProductBundle\Repository\FournisseursRepository")
 */
class Fournisseurs
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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

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
     * @var string
     *
     * @ORM\Column(name="adresse1", type="string", length=255)
     */
    private $adresse1;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse2", type="string", length=255)
     */
    private $adresse2;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse3", type="string", length=255)
     */
    private $adresse3;

    /**
     * @var string
     *
     * @ORM\Column(name="code_postal", type="string", length=5)
     */
    private $code_postal;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=50)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="contact", type="string", length=50)
     */
    private $contact;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=10)
     */
    private $telephone;

    /**
    * @var ArrayCollection $produits
    *
    * @ORM\OneToMany(targetEntity="InstantSoin\ProductBundle\Entity\Produits", mappedBy="Fournisseurs", cascade={"persist", "remove"})
    */
    private $produits;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->produits = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set nom
     *
     * @param string $nom
     * @return Fournisseurs
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Fournisseurs
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
     * @return Fournisseurs
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
     * @return Fournisseurs
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
     * @return Fournisseurs
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
     * Set adresse1
     *
     * @param string $adresse1
     * @return Fournisseurs
     */
    public function setAdresse1($adresse1)
    {
        $this->adresse1 = $adresse1;

        return $this;
    }

    /**
     * Get adresse1
     *
     * @return string 
     */
    public function getAdresse1()
    {
        return $this->adresse1;
    }

    /**
     * Set adresse2
     *
     * @param string $adresse2
     * @return Fournisseurs
     */
    public function setAdresse2($adresse2)
    {
        $this->adresse2 = $adresse2;

        return $this;
    }

    /**
     * Get adresse2
     *
     * @return string 
     */
    public function getAdresse2()
    {
        return $this->adresse2;
    }

    /**
     * Set adresse3
     *
     * @param string $adresse3
     * @return Fournisseurs
     */
    public function setAdresse3($adresse3)
    {
        $this->adresse3 = $adresse3;

        return $this;
    }

    /**
     * Get adresse3
     *
     * @return string 
     */
    public function getAdresse3()
    {
        return $this->adresse3;
    }

    /**
     * Set code_postal
     *
     * @param string $codePostal
     * @return Fournisseurs
     */
    public function setCodePostal($codePostal)
    {
        $this->code_postal = $codePostal;

        return $this;
    }

    /**
     * Get code_postal
     *
     * @return string 
     */
    public function getCodePostal()
    {
        return $this->code_postal;
    }

    /**
     * Set ville
     *
     * @param string $ville
     * @return Fournisseurs
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string 
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set contact
     *
     * @param string $contact
     * @return Fournisseurs
     */
    public function setContact($contact)
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * Get contact
     *
     * @return string 
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     * @return Fournisseurs
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string 
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Add produits
     *
     * @param \InstantSoin\ProductBundle\Entity\Produits $produits
     * @return Fournisseurs
     */
    public function addProduit(\InstantSoin\ProductBundle\Entity\Produits $produits)
    {
        $this->produits[] = $produits;

        return $this;
    }

    /**
     * Remove produits
     *
     * @param \InstantSoin\ProductBundle\Entity\Produits $produits
     */
    public function removeProduit(\InstantSoin\ProductBundle\Entity\Produits $produits)
    {
        $this->produits->removeElement($produits);
    }

    /**
     * Get produits
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProduits()
    {
        return $this->produits;
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('nom', new Assert\NotBlank());
        $metadata->addPropertyConstraint('nom', new Assert\Length(array(
            'min'   => 2,
            'max'   => 50,
            'minMessage' => 'Le nom du fournisseur doit avoir un minimum de 2 caractères.',
            'maxMessage' => 'Le nom du fournisseur avoir un maximum de 50 caractères.',
        )));

        $metadata->addPropertyConstraint('description', new Assert\NotBlank());
        $metadata->addPropertyConstraint('description', new Assert\Length(array(
            'min'   => 2,
            'max'   => 50,
            'minMessage' => 'La description de ce fournisseur doit être au minimum de 2 caractères.',
            'maxMessage' => 'La description de ce fournisseur doit être au maximum de 250 caractères.',
        )));

        $metadata->addPropertyConstraint('adresse1', new Assert\NotBlank());
        $metadata->addPropertyConstraint('adresse1', new Assert\Length(array(
            'min'   => 2,
            'max'   => 50,
            'minMessage' => 'L\'adresse doit avoir un minimum de 2 caractères.',
            'maxMessage' => 'L\'adresse doit avoir un maximum de 50 caractères.',
        )));

        $metadata->addPropertyConstraint('code_postal', new Assert\NotBlank());
        $metadata->addPropertyConstraint('code_postal', new CustomAssert\ZipCode());

        $metadata->addPropertyConstraint('ville', new Assert\NotBlank());
        $metadata->addPropertyConstraint('ville', new Assert\Length(array(
            'min'   => 2,
            'max'   => 50,
            'minMessage' => 'La ville doit avoir un minimum de 2 caractères.',
            'maxMessage' => 'La ville doit avoir un maximum de 50 caractères.',
        )));

        $metadata->addPropertyConstraint('telephone', new Assert\NotBlank());
        $metadata->addPropertyConstraint('telephone', new Assert\Length(array(
            'min'   => 10,
            'max'   => 10,
            'exactMessage' => 'Le numéro de téléphone doit avoir 10 chiffres.',
        )));

    }

}
