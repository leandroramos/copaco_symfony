<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollections;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RedeRepository")
 */
class Rede
{
    public function __construct()
    {
        $this->equipamentos = new ArrayCollections();
    }

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    public function getId()
    {
        return $this->id;
    }

    /**
      * @ORM\OneToMany(targetEntity="Equipamento",mappedBy="rede")
      */
    private $equipamentos;
    
    /**
      * @ORM\Column(type="string")
      */
    private $nome;
    public function getNome()
    {
        return $this->nome;
    }
    
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
      * @ORM\Column(type="string")
      */
    private $iprede;

    /**
      * @ORM\Column(type="string")
      */
    private $cidr;

    public function getIprede()
    {
        return $this->iprede;
    }

    public function setIprede($iprede)
    {
        $this->iprede = $iprede;
    }

    public function getCidr()
    {
        return $this->cidr;
    }

    public function setCidr($cidr)
    {
        $this->cidr = $cidr;
    }
}
