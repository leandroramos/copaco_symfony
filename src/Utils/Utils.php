<?php

namespace App\Utils;

class Utils
{
    public function EnDate2PtDate($date)
    {
        // convert 10/11/1986 to 1986-11-10
        return implode('-',array_reverse(explode('/',$date)));
    }
}
