<?php

// namespace PWOctetReader;

// use ItemPattern;
// use PWOctetReader\Item;

require 'item.php';

class Armor extends Item
{
    private $octet;
    public function __construct(string $octet)
    {
        $this->octet = $octet;
    }

	/**
	 * @return array
	 */
	public function getAttributes(): array {
        $pos = 48;

        $socket_count = parent::hexToDec(substr($this->octet, $pos + 72, 8), 8, 0, true);

        return [
            'level_req' => parent::hexToDec(substr($this->octet, 0, 4), 4, 0, true),
            'class_req' => parent::hexToDec(substr($this->octet, 4, 4), 4, 0, true),
            'strength_req' => parent::hexToDec(substr($this->octet, 8, 4), 4, 0, true),
            'constitution_req' => parent::hexToDec(substr($this->octet, 12, 4), 4, 0, true),
            'agility_req' => parent::hexToDec(substr($this->octet, 16, 4), 4, 0, true),
            'intelligence_req' => parent::hexToDec(substr($this->octet, 20, 4), 4, 0, true),
            'durability1' => intval(parent::hexToDec(substr($this->octet, 24, 8), 8, 0, true) / 100),
            'durability2' => intval(parent::hexToDec(substr($this->octet, 32, 8), 8, 0, true) / 100),
            'equipment_type' => parent::hexToDec(substr($this->octet, 40, 4), 4, 0, true),
            'item_flag' => parent::hexToDec(substr($this->octet, 44, 2), 2, 0, true),
            'name_length' => intdiv(parent::hexToDec(substr($this->octet, 46, 2), 2, 0, true), 2),
            'name' => '',
            'physical_defense' => parent::hexToDec(substr($this->octet, $pos, 8), 8, 0, true),
            'dodge' => parent::hexToDec(substr($this->octet, $pos + 8, 8), 8, 0, true),
            'heath' => parent::hexToDec(substr($this->octet, $pos + 24, 8), 8, 0, true),
            'mana' => parent::hexToDec(substr($this->octet, $pos + 16, 8), 8, 0, true),
            'metal' => parent::hexToDec(substr($this->octet, $pos + 32, 8), 8, 0, true),
            'wood' => parent::hexToDec(substr($this->octet, $pos + 40, 8), 8, 0, true),
            'water' => parent::hexToDec(substr($this->octet, $pos + 48, 8), 8, 0, true),
            'fire' => parent::hexToDec(substr($this->octet, $pos + 56, 8), 8, 0, true),
            'earth' => parent::hexToDec(substr($this->octet, $pos + 64, 8), 8, 0, true),
            'bpdef' => 0,
            'bhp' => 0,
            'bmp' => 0,
            'bmdef' => 0,
            'bstr' => 0,
            'bint' => 0,
            'bcons' => 0,
            'bagil' => 0,
            'socket_count' => $socket_count,
            'ref_level' => 0,
            'pos' => $pos + $socket_count * 8,
            'addon_count' => parent::hexToDec(substr($this->octet, $pos + 80, 8), 8, 0, true),
        ];
	}
}

$Armour = new Armor('6300ff0f6700000067000000a67200003c73000024000000d3020000000000000000000050000000650400006504000065040000650400006504000004000d00f3180000f3180000f3180000f3180000080000007422000050000000b225000009000000bc250000090000000b470000ad0100000800000099a400003e00000099a400003e00000099a400003e00000099a400003e000000');

echo json_encode($Armour->getAttributes());
