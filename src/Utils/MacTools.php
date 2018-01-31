<?php

namespace App\Utils;

class MacTools
{
    public function isValidMac($mac) {
        // 01:23:45:67:89:ab
        if (preg_match('/^([a-fA-F0-9]{2}:){5}[a-fA-F0-9]{2}$/', $mac))
            return true;
        // 01-23-45-67-89-ab
        if (preg_match('/^([a-fA-F0-9]{2}\-){5}[a-fA-F0-9]{2}$/', $mac))
            return true;
        // 0123456789ab
        else if (preg_match('/^[a-fA-F0-9]{12}$/', $mac))
            return true;
        // 0123.4567.89ab
        else if (preg_match('/^([a-fA-F0-9]{4}\.){2}[a-fA-F0-9]{4}$/', $mac))
            return true;
        else
            return false;
    }

    public function normalizeMac($mac) {
        // remove any dots
        $mac =  str_replace(".", "", $mac);

        // replace dashes with colons
        $mac =  str_replace("-", ":", $mac);

        // counting colons
        $colon_count = substr_count ($mac , ":");

        // insert enough colons if none exist
        if ($colon_count == 0)
        {
            $mac =  substr_replace($mac, ":", 2, 0);
            $mac =  substr_replace($mac, ":", 5, 0);
            $mac =  substr_replace($mac, ":", 8, 0);
            $mac =  substr_replace($mac, ":", 11, 0);
            $mac =  substr_replace($mac, ":", 14, 0);
        }
        // uppercase
        $mac = strtoupper($mac);
        // DE:AD:BE:EF:10:24
        return $mac;
    }

    public function check($mac) {

        if($this->isValidMac($mac))
            //return true;
           return $this->normalizeMac($mac);
        else
            return false;
            //echo "Invalid MAC";
    }

}
