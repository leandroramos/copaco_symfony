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
}
