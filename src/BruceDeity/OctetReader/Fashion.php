<?php

namespace BruceDeity\OctetReader;

use BruceDeity\OctetReader\OctetParser;
use BruceDeity\OctetReader\Interfaces\Item;

class Fashion extends OctetParser implements Item
{
    private $octet;
    private $pos;
    private $parsedOctet;
    private $attributeValue;

    public function __construct(string $octet)
    {
        // Initialize position of substring as 48
        $this->pos = 48;

        // Store octet passed as argument in class variable
        $this->octet = $octet;
    }
    
    public function GetAttributes() : array
    {
        return [];
    }
}

