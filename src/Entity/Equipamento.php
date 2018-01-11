<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EquipamentoRepository")
 */
class Equipamento
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
    private $patrimonio;
    
    /**
    * @ORM\Column(type="string")
     */
    private $ip;
    
    /**
    * @ORM\Column(type="string")
     */
    private $macaddress;
    
    /**
    * @ORM\Column(type="string")
     */
    private $local;

    /**
    * @ORM\Column(type="datetimetz")
     */
    private $vencimento;

    public function getPatrimonio()
    {
        return $this->patrimonio;
    }

    public function setPatrimonio($patrimonio)
    {
        $this->patrimonio = $patrimonio;
    }

    public function getIp()
    {
        return $this->ip;
    }

    public function setIp($ip)
    {
        $this->ip = $ip;
    }

    public function getMacaddress()
    {
        return $this->macaddress;
    }

    public function setMacaddress($macaddress)
    {
        $this->macaddress = $macaddress;
    }

    public function getLocal()
    {
        return $this->local;
    }

    public function setLocal($local)
    {
        $this->local = $local;
    }

    public function getVencimento()
    {
        return $this->vencimento;
    }

    public function setVencimento($vencimento)
    {
        $this->vencimento = $vencimento;
    }
}
