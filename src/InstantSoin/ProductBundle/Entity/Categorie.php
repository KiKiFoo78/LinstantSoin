<?php

namespace InstantSoin\ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use InstantSoin\ProductBundle\Entity\Categorie;

use InstantSoin\UserBundle\Component\Validator\Constraints as CustomAssert;

/**
 * categorie
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="InstantSoin\ProductBundle\Repository\CategorieRepository")
 */
class Categorie
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
     * @ORM\Column(name="intitule", type="string", length=50)
     */
    private $intitule;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
    * @var ArrayCollection $produits
    *
    * @ORM\OneToMany(targetEntity="InstantSoin\ProductBundle\Entity\Produits", mappedBy="categorie", cascade={"persist", "remove"})
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
     * Set intitule
     *
     * @param string $intitule
     * @return Categorie
     */
    public function setIntitule($intitule)
    {
        $this->intitule = $intitule;

        return $this;
    }

    /**
     * Get intitule
     *
     * @return string 
     */
    public function getIntitule()
    {
        return $this->intitule;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Categorie
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
     * Add produits
     *
     * @param \InstantSoin\ProductBundle\Entity\Produits $produits
     * @return Categorie
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
        $metadata->addPropertyConstraint('intitule', new Assert\NotBlank());
        $metadata->addPropertyConstraint('intitule', new Assert\Length(array(
            'min'   => 2,
            'max'   => 50,
            'minMessage' => 'L\'intitule de la catégorie doit être au minimum de 2 caractères.',
            'maxMessage' => 'L\'intitule de la catégorie doit être au maximum de 50 caractères.',
        )));

        $metadata->addPropertyConstraint('description', new Assert\NotBlank());
        $metadata->addPropertyConstraint('description', new Assert\Length(array(
            'min'   => 2,
            'max'   => 50,
            'minMessage' => 'La description de cette catégorie doit être au minimum de 2 caractères.',
            'maxMessage' => 'La description de cette catégorie doit être au maximum de 250 caractères.',
        )));
    }

}
