<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\Constraints as CustomAssert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EquipamentoRepository")
 * @UniqueEntity(fields={"macaddress"}, message="Mac já cadastrado!")
 */
class Equipamento
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    // add your own fields

    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $descricaosempatrimonio;
    public function getDescricaosempatrimonio()
    {
        return $this->descricaosempatrimonio;
    }

    public function setDescricaosempatrimonio($descricaosempatrimonio)
    {
        $this->descricaosempatrimonio = $descricaosempatrimonio;
    }

    /**
     * @ORM\Column(type="boolean")
     */
    private $naopatrimoniado;
    public function getNaopatrimoniado()
    {
        return $this->naopatrimoniado;
    }

    public function setNaopatrimoniado($naopatrimoniado)
    {
        $this->naopatrimoniado = $naopatrimoniado;
    }

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $patrimonio;

    public function __toString()
    {
        return $this->patrimonio;
    }

    /**
     * @ORM\Column(type="string", unique=true)
     * @Assert\NotBlank
     * @CustomAssert\MacAddress
     */
    private $macaddress;

    /**
     * @ORM\Column(type="string")
     *  @Assert\NotBlank()
     */
    private $local;

    /**
     * @ORM\Column(name="vencimento", type="date")
     * @Assert\NotBlank()
     */
    private $vencimento;

    /**
     * @ORM\Column(name="ip", type="string", length=15,nullable=true)
     * @CustomAssert\Ip()
     */
    private $ip;

    /*** get e set ***/
    public function getId()
    {
        return $this->id;
    }

    /* patrimonio */
    public function setPatrimonio($patrimonio)
    {
        $this->patrimonio = $patrimonio;
    }

    public function getPatrimonio()
    {
        return $this->patrimonio;
    }

    /* macaddress */
    public function setMacaddress($macaddress)
    {
        $this->macaddress = $macaddress;
    }

    public function getMacaddress()
    {
        return $this->macaddress;
    }

    /* local */
    public function setLocal($local)
    {
        $this->local = $local;
    }

    public function getLocal()
    {
        return $this->local;
    }

    /* vencimento */
    public function setVencimento($vencimento)
    {
        $this->vencimento = $vencimento;
    }

    public function getVencimento()
    {
        return $this->vencimento;
    }

    /* ip */
    public function setIp($ip)
    {
        $this->ip = $ip;
    }

    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @ORM\ManyToOne(targetEntity="Rede", inversedBy="equipamentos")
     * @ORM\JoinColumn(nullable=true)
     */
    private $rede;

    /* get e set */
    public function setRede($rede)
    {
        $this->rede = $rede;
    }

    public function getRede()
    {
        return $this->rede;
    }
}
