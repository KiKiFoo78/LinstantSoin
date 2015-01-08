<?php

namespace InstantSoin\ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use InstantSoin\ProductBundle\Entity\CategorieServ;

use InstantSoin\UserBundle\Component\Validator\Constraints as CustomAssert;

/**
 * categorieServ
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="InstantSoin\ProductBundle\Repository\CategorieServRepository")
 */
class CategorieServ
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
    * @var ArrayCollection $services
    *
    * @ORM\OneToMany(targetEntity="InstantSoin\ProductBundle\Entity\Services", mappedBy="categorieServ", cascade={"persist", "remove"})
    */
    private $services;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->services = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return CategorieServ
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
     * @return CategorieServ
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
     * Add services
     *
     * @param \InstantSoin\ProductBundle\Entity\services $services
     * @return CategorieServ
     */
    public function addServices(\InstantSoin\ProductBundle\Entity\Services $services)
    {
        $this->services[] = $services;

        return $this;
    }

    /**
     * Remove services
     *
     * @param \InstantSoin\ProductBundle\Entity\Services $services
     */
    public function removeServices(\InstantSoin\ProductBundle\Entity\Services $services)
    {
        $this->services->removeElement($services);
    }

    /**
     * Get services
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getServices()
    {
        return $this->services;
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
            'max'   => 250,
            'minMessage' => 'La description de cette catégorie doit être au minimum de 2 caractères.',
            'maxMessage' => 'La description de cette catégorie doit être au maximum de 250 caractères.',
        )));
    }


    /**
     * Add services
     *
     * @param \InstantSoin\ProductBundle\Entity\Services $services
     * @return CategorieServ
     */
    public function addService(\InstantSoin\ProductBundle\Entity\Services $services)
    {
        $this->services[] = $services;

        return $this;
    }

    /**
     * Remove services
     *
     * @param \InstantSoin\ProductBundle\Entity\Services $services
     */
    public function removeService(\InstantSoin\ProductBundle\Entity\Services $services)
    {
        $this->services->removeElement($services);
    }

    /**
     * Set image
     *
     * @param string $image
     * @return CategorieServ
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
     * @return CategorieServ
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
     * @return CategorieServ
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
}
