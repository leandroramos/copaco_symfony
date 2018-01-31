<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Role\Role;
use Symfony\Component\Security\Core\User\UserInterface;


/**
 * @ORM\Entity(repositoryClass="App\Repository\LocalUserRepository")
 */
class LocalUser implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    public function getId(){
        return $this->id;
    }
   
    /**
     * @ORM\Column(type="string")
     */
    private $username;

    public function getUsername(){
        return $this->username;
    }

    public function setUsername($username){
        $this->username = $username;
    }

    /**
     * @ORM\Column(type="string")
     */
   private $password;
   public function getPassword(){
        return $this->password;
    }

    public function setPassword($password){
        $this->password = $password;
    }

    

    public function getSalt()
    {}
    
    public function eraseCredentials()
    {
    }
    
    /**
     * @ORM\Column(type="json_array")
     */
    private $roles= [];

    public function getRoles()
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';
        return array_unique($roles);
    }

    public function setRoles($roles)
    {
        $this->roles = $roles;
    }

}
