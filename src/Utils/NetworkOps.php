<?php

namespace App\Utils;

use IPTools\IP;
use IPTools\Network;
use IPTools\Range;

class NetworkOps
{
    public function build($redes)
    {
       $dhcp = "ddns-update-style none;\n";
       $dhcp .= "default-lease-time 86400;\n";
       $dhcp .= "max-lease-time 86400;\n";
       $dhcp .= "authoritative;\n";
       $dhcp .= "option domain-name-servers 143.107.253.3,143.107.253.5;\n";
       $dhcp .= "shared-network \"default\" {\n\n";

        foreach($redes as $rede){
            
            $iprede = (string)$rede->getIprede();
            $cidr = (string)$rede->getCidr();
            $ips = $this->ipsAsArray($iprede,$cidr);
            $range_begin = $ips[1]; 
            $range_end = $ips[count($ips)-2];
            $gateway = $ips[0];
            $broadcast = end($ips);
            $mask = (string)Network::parse("$iprede/$cidr")->netmask;
            $dhcp .= "  subnet $iprede netmask $mask {\n";
            $dhcp .= "    range $range_begin $range_end; \n";
            $dhcp .= "    option routers $gateway; \n";
            $dhcp .= "    option broadcast-address $broadcast; \n";
            $dhcp .= "    deny unknown-clients; \n";

            $equipamentos = $rede->getEquipamentos();
            foreach($equipamentos as $equipamento) {
                $dhcp .= "      host equipamento{$equipamento->getId()} {\n";
                $dhcp .= "        hardware ethernet {$equipamento->getMacAddress()};\n";
                $dhcp .= "        fixed-address {$equipamento->getIp()};\n";
                $dhcp .= "      }\n";
            }
            $dhcp .= "  }\n";
        }
       $dhcp .= "}";
        return $dhcp;
    }
   
    public function availableIp($ips_alocados, $iprede, $cidr)
    {
       $ips = $this->ipsAsArray($iprede,$cidr);
       unset($ips[0]); //gateway
        foreach ($ips as $ip) {
            if (!in_array((string)$ip, $ips_alocados)) {
                return (string)$ip;
            }
        }
        return false;
    }
    
    public function ipsAsArray($iprede,$cidr)
    {
        $ips = [];
        $hosts = Network::parse("{$iprede}/{$cidr}")->hosts;
        foreach ($hosts as $ip) {
            array_push($ips, (string)$ip);
        }
        return $ips; 
    }

    public function verificaSeIpDisponivel($equipamento) 
    {
    	$rede = $equipamento->getRede();
        $alocados = $rede->getEquipamentos();
        $ips_alocados = [];
        foreach ($alocados as $alocado) {
            array_push($ips_alocados, $alocado->getIp());
        }
        $ip_sugerido = $equipamento->getIp();
        //$esta_no_range = (string) Range::parse("{$rede->getIprede()}/{$rede->getCidr()}")->contains(new IP("$ip_sugerido"));   
        $esta_no_range = (string) Network::parse("{$rede->getIprede()}/{$rede->getCidr()}")->hosts->contains(new IP("$ip_sugerido"));    
        $ja_alocado = in_array($ip_sugerido,$ips_alocados);    
        if (!$esta_no_range) {
            return ['status'=>false,'msg'=>'O ip sugerido nao pertence a rede selecionada, portando foi alocado o próximo ip disponível na mesma rede'];
        }
        if ($ja_alocado) {
            return ['status'=>false,'msg'=>'Ip sugerido ja esta alocado para outro equipamento, portando foi alocado o proximo ip disponivel na mesma rede'];
        }
        return ['status'=>true];
    }
    

    public function alocaProximoIpDisponivel($equipamento) 
    {
    	$rede = $equipamento->getRede();
        $alocados = $rede->getEquipamentos();
        $ips_alocados = [];
        foreach ($alocados as $alocado) {
            array_push($ips_alocados, $alocado->getIp());
        }
 
        $ip = $this->availableIp($ips_alocados, $rede->getIprede(), $cidr = $rede->getCidr());
        if ($ip){
            return ['status'=>true,'ip'=>$ip];
        }
        else {
            return ['status'=>false,'msg'=>'Acabaram os IPs dessa rede!'];
        }
    }
}
