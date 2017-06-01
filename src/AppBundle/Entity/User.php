<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Table(name="User")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User Implements UserInterface
{
    

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $uId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $uName;
    
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $uUserName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $uPhone;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $uEmail;
    
     /**
     * @Assert\NotBlank()
     * @Assert\Length(max=4096)
     */
    private $plainPassword;

    /**
     * @ORM\Column(type="string", length=max)
     */
    private $uPassword;

    /**
     * @ORM\Column(type="integer")
     */
    private $uRole;

     /**
     * @ORM\Column(type="integer")
     */
    private $uActive;

    /**
     * @ORM\Column(type="integer")
     */
    private $uCreateuid;

    /**
     * @ORM\Column(type="DateTime")
     */
    private $uCreatedate;

    /**
     * @ORM\Column(type="integer")
     */
    private $uModifyuid;

    /**
     * @ORM\Column(type="DateTime")
     */
    private $uModifydate;


    /**
     * Get uId
     *
     * @return integer 
     */
    public function getUId()
    {
        return $this->uId;
    }

    
    /**
     * Set uName
     *
     * @param string $uName
     * @return User
     */
    public function setUName($uName)
    {
        $this->uName = $uName;

        return $this;
    }

    /**
     * Get uName
     *
     * @return string 
     */
    public function getUName()
    {
        return $this->uName;
    }
    
    /**
     * Set uUserName
     *
     * @param string $uUserName
     * @return User
     */
    public function setUUserName($uUserName)
    {
        $this->uUserName = $uUserName;

        return $this;
    }

    /**
     * Get uUserName
     *
     * @return string 
     */
    public function getUUserName()
    {
        return $this->uUserName;
    }

    /**
     * Set uPhone
     *
     * @param string $uPhone
     * @return User
     */
    public function setUPhone($uPhone)
    {
        $this->uPhone = $uPhone;

        return $this;
    }

    /**
     * Get uPhone
     *
     * @return string 
     */
    public function getUPhone()
    {
        return $this->uPhone;
    }

    /**
     * Set uEmail
     *
     * @param string $uEmail
     * @return User
     */
    public function setUEmail($uEmail)
    {
        $this->uEmail = $uEmail;

        return $this;
    }

    /**
     * Get uEmail
     *
     * @return string 
     */
    public function getUEmail()
    {
        return $this->uEmail;
    }
    
     public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($password)
    {
        $this->plainPassword = $password;
    }

    /**
     * Set uPassword
     *
     * @param string $uPassword
     * @return User
     */
    public function setUPassword($uPassword)
    {
        $this->uPassword = $uPassword;

        return $this;
    }

    /**
     * Get uPassword
     *
     * @return string 
     */
    public function getUPassword()
    {
        return $this->uPassword;
    }

    /**
     * Set uRole
     *
     * @param integer $uRole
     * @return User
     */
    public function setURole($uRole)
    {
        $this->uRole = $uRole;

        return $this;
    }

    /**
     * Get uRole
     *
     * @return integer 
     */
    public function getURole()
    {
        return $this->uRole;
    }

    /**
     * Set uActive
     *
     * @param integer $uActive
     * @return User
     */
    public function setUActive($uActive)
    {
        $this->uActive = $uActive;

        return $this;
    }

    /**
     * Get uActive
     *
     * @return integer 
     */
    public function getUActive()
    {
        return $this->uActive;
    }

    /**
     * Set uCreateuid
     *
     * @param integer $uCreateuid
     * @return User
     */
    public function setUCreateuid($uCreateuid)
    {
        $this->uCreateuid = $uCreateuid;

        return $this;
    }

    /**
     * Get uCreateuid
     *
     * @return integer 
     */
    public function getUCreateuid()
    {
        return $this->uCreateuid;
    }

    /**
     * Set uCreatedate
     *
     * @param \DateTime $uCreatedate
     * @return User
     */
    public function setUCreatedate($uCreatedate)
    {
        $this->uCreatedate = $uCreatedate;

        return $this;
    }

    /**
     * Get uCreatedate
     *
     * @return \DateTime 
     */
    public function getUCreatedate()
    {
        return $this->uCreatedate;
    }

    /**
     * Set uModifyuid
     *
     * @param integer $uModifyuid
     * @return User
     */
    public function setUModifyuid($uModifyuid)
    {
        $this->uModifyuid = $uModifyuid;

        return $this;
    }

    /**
     * Get uModifyuid
     *
     * @return integer 
     */
    public function getUModifyuid()
    {
        return $this->uModifyuid;
    }

    /**
     * Set uModifydate
     *
     * @param \DateTime $uModifydate
     * @return User
     */
    public function setUModifydate($uModifydate)
    {
        $this->uModifydate = $uModifydate;

        return $this;
    }

    /**
     * Get uModifydate
     *
     * @return \DateTime 
     */
    public function getUModifydate()
    {
        return $this->uModifydate;
    }
    
    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }
    
    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->uId,
            $this->uName,
            $this->uPassword,
            $this->uRole,
            $this->uUserName,
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->uId,
            $this->uName,
            $this->uPassword,
            $this->uRole,
            $this->uUserName,    
            // see section on salt below
            // $this->salt
        ) = unserialize($serialized);
    }

    public function getPassword(): string {
        return $this->uPassword;
    }

    public function getRoles() {
        return $this->uRole;
    }

    public function getUsername(): string {
        return $this->uUserName;
    }

}
