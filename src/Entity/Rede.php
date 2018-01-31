<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\Constraints as CustomAssert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RedeRepository")
 */
class Rede
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    public function __construct()
    {
        $this->equipamentos = new ArrayCollection();
    }

    /**
     * @ORM\OneToMany(targetEntity="Equipamento",mappedBy="rede")
     */
    private $equipamentos;


    /* get e set */
    public function setEquipamentos($equipamentos)
    {
        $this->equipamentos = $equipamentos;
    }

    public function getEquipamentos()
    {
        return $this->equipamentos;
    }

    public function getId()
    {
        return $this->id;
    }
 
    /**
      * @ORM\Column(type="string")
      * @Assert\NotBlank()
      */
    private $nome;

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @CustomAssert\Ip()
      */
    private $iprede;

    public function setIprede($iprede)
    {
        $this->iprede = $iprede;
    }

    public function getIprede()
    {
        return $this->iprede;
    }


    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
      */
    private $cidr;
    public function setCidr($cidr)
    {
        $this->cidr = $cidr;
    }

    public function getCidr()
    {
        return $this->cidr;
    }

    public function __toString()
    {
        return $this->nome;
    }

}
