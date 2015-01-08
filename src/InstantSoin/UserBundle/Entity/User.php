<?php

namespace InstantSoin\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;

use InstantSoin\UserBundle\Component\Validator\Constraints as CustomAssert;

/**
 * user
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="InstantSoin\UserBundle\Repository\userRepository")
 */
class User implements UserInterface
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
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse1", type="string", length=255)
     */
    private $adresse1;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse2", type="string", length=255, nullable=true)
     */
    private $adresse2;

    /**
     * @var integer
     *
     * @ORM\Column(name="codepostal", type="integer", length=5)
     */
    private $codepostal;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=30)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=10)
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="text", length=10)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, unique=true)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="text", nullable=false)
     */
    private $salt = "v1-s@lt";

    /**
     * @var array
     *
     * @ORM\Column(name="roles", type="string", length=255)
     */
    private $roles;

    /**
    * @var ArrayCollection $cart
    *
    * @ORM\OneToMany(targetEntity="InstantSoin\CartBundle\Entity\Cart", mappedBy="cart")
    */
    private $cart;


    public function eraseCredentials()
    {

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
     * Set username
     *
     * @param string $username
     * @return user
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return user
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set salt
     *
     * @param string $salt
     * @return user
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Get salt
     *
     * @return string 
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Set roles
     *
     * @param array $roles
     * @return user
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Get roles
     *
     * @return array 
     */
    public function getRoles()
    {
        return array($this->roles);
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return User
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
     * Set prenom
     *
     * @param string $prenom
     * @return User
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string 
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set adresse1
     *
     * @param string $adresse1
     * @return User
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
     * @return User
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
     * Set codepostal
     *
     * @param integer $codepostal
     * @return User
     */
    public function setCodepostal($codepostal)
    {
        $this->codepostal = $codepostal;

        return $this;
    }

    /**
     * Get codepostal
     *
     * @return integer 
     */
    public function getCodepostal()
    {
        return $this->codepostal;
    }

    /**
     * Set ville
     *
     * @param string $ville
     * @return User
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
     * Set telephone
     *
     * @param string $telephone
     * @return User
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
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('nom', new Assert\NotBlank());
        $metadata->addPropertyConstraint('nom', new Assert\Length(array(
            'min'   => 2,
            'max'   => 50,
            'minMessage' => 'Votre nom doit avoir un minimum de 2 caractères.',
            'maxMessage' => 'Votre nom doit avoir un maximum de 50 caractères.',
        )));

        $metadata->addPropertyConstraint('prenom', new Assert\NotBlank());
        $metadata->addPropertyConstraint('prenom', new Assert\Length(array(
            'min'   => 2,
            'max'   => 50,
            'minMessage' => 'Votre prénom doit avoir un minimum de 2 caractères.',
            'maxMessage' => 'Votre prénom doit avoir un maximum de 50 caractères.',
        )));

        $metadata->addPropertyConstraint('adresse1', new Assert\NotBlank());
        $metadata->addPropertyConstraint('adresse1', new Assert\Length(array(
            'min'   => 2,
            'max'   => 50,
            'minMessage' => 'Votre adresse doit avoir un minimum de 2 caractères.',
            'maxMessage' => 'Votre adresse doit avoir un maximum de 50 caractères.',
        )));

        $metadata->addPropertyConstraint('codepostal', new Assert\NotBlank());
        $metadata->addPropertyConstraint('codepostal', new CustomAssert\ZipCode());

        $metadata->addPropertyConstraint('ville', new Assert\NotBlank());
        $metadata->addPropertyConstraint('ville', new Assert\Length(array(
            'min'   => 2,
            'max'   => 50,
            'minMessage' => 'Votre ville doit avoir un minimum de 2 caractères.',
            'maxMessage' => 'Votre ville doit avoir un maximum de 50 caractères.',
        )));

        $metadata->addPropertyConstraint('telephone', new Assert\NotBlank());
        $metadata->addPropertyConstraint('telephone', new Assert\Length(array(
            'min'   => 10,
            'max'   => 10,
            'exactMessage' => 'Le numéro de téléphone doit avoir 10 chiffres.',
        )));

        $metadata->addPropertyConstraint('email', new Assert\Email());

    }


    /**
     * Set cart
     *
     * @param \InstantSoin\CartBundle\Entity\Cart $cart
     * @return User
     */
    public function setCart(\InstantSoin\CartBundle\Entity\Cart $cart = null)
    {
        $this->cart = $cart;
    
        return $this;
    }

    /**
     * Get cart
     *
     * @return \InstantSoin\CartBundle\Entity\Cart 
     */
    public function getCart()
    {
        return $this->cart;
    }
}