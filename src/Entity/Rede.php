<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

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
    
    /**
      * @ORM\Column(type="string")
      */
    private $nome;

    /**
      * @ORM\Column(type="string")
      */
    private $iprede;

    /**
      * @ORM\Column(type="string")
      */
    private $cidr;


    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

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
