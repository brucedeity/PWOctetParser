<?php

namespace PWOctetReader;

use PWOctetReader\Item;

class Jewery extends Item
{
    protected $octet;
    public function __construct(string $octet)
    {
        $this->octet = $octet;
    }

    public function getAttributes()
    {
        # code...
    }
}

$octet = '5500ff0f0000000000000000a6590000d85900002400000018000000000000006f0100000000000000000000000000000000000000000000000000000000000004000000a5250000070000005c23000018000000032400006400000033470000ad01000008000000';
$data = octetToArray($octet);

echo json_encode($data);

function octetToArray(string $octet): array
{
    $level_req = hexToDec(substr($octet, 0, 4), 4, 0, true);
    $class_req = hexToDec(substr($octet, 4, 4), 4, 0, true);
    $strength_req = hexToDec(substr($octet, 8, 4), 4, 0, true);
    $constitution_req = hexToDec(substr($octet, 12, 4), 4, 0, true);
    $agility_req = hexToDec(substr($octet, 16, 4), 4, 0, true);
    $intelligence_req = hexToDec(substr($octet, 20, 4), 4, 0, true);
    $durability1 = intval(hexToDec(substr($octet, 24, 8), 8, 0, true) / 100);
    $durability2 = intval(hexToDec(substr($octet, 32, 8), 8, 0, true) / 100);
    $equipment_type = hexToDec(substr($octet, 40, 4), 4, 0, true);
    $item_flag = hexToDec(substr($octet, 44, 2), 2, 0, true);
    $name_length = intdiv(hexToDec(substr($octet, 46, 2), 2, 0, true), 2);
    $name = '';
    $pos = 48;
    for ($i = 0; $i < $name_length; $i++) {
        $str = substr($octet, $pos + $i * 4, 4);
        $n = hexToDec(substr($str, 0, 2), 2, 0, true);
        $name .= chr($n);
        $pos = 48 + $i * 4 + 4;
    }
    $physical_attack = hexToDec(substr($octet, $pos, 8), 8, 0, true);
    $magical_attack = hexToDec(substr($octet, $pos + 8, 8), 8, 0, true);
    $physical_defense = hexToDec(substr($octet, $pos + 16, 8), 8, 0, true);
    $dodge = hexToDec(substr($octet, $pos + 24, 8), 8, 0, true);
$metal = hexToDec(substr($octet, $pos + 32, 8), 8, 0, true);
$wood = hexToDec(substr($octet, $pos + 40, 8), 8, 0, true);
$water = hexToDec(substr($octet, $pos + 48, 8), 8, 0, true);
$fire = hexToDec(substr($octet, $pos + 56, 8), 8, 0, true);
$earth = hexToDec(substr($octet, $pos + 64, 8), 8, 0, true);

$socket_count = hexToDec(substr($octet, $pos + 72, 8), 8, 0, true);

// if ($socket_count > 0){
// $sockets_state = array();
// for ($i = 1; $i <= $socket_count; $i++){
// $sockets_state[$i] = hexToDec(substr($octet, $pos + 72 + ($i * 8), 8), 8, 0, true);
// }
// }
$pos = $pos + 72 + ($socket_count * 8);

$add_on_count = hexToDec(substr($octet, $pos + 80, 8), 8, 0, true);

// continue from here with the rest of the variables according to the javascript code
// and add the new variables like socket_count and sockets_state

$data = array(
'level_req' => $level_req,
'class_req' => $class_req,
'strength_req' => $strength_req,
'constitution_req' => $constitution_req,
'agility_req' => $agility_req,
'intelligence_req' => $intelligence_req,
'durability1' => $durability1,
'durability2' => $durability2,
'equipment_type' => $equipment_type,
'item_flag' => $item_flag,
'name' => $name,
'physical_attack' => $physical_attack,
'magical_attack' => $magical_attack,
'physical_defense' => $physical_defense,
'dodge' => $dodge,
'metal' => $metal,
'wood' => $wood,
'water' => $water,
'fire' => $fire,
'earth' => $earth,
'socket_count' => $socket_count,
// 'sockets_state' => $sockets_state,
'add_on_count' => $add_on_count
);

return $data;
}


  /**
     * Reverses the order of the digits in a number.
     *
     * @param string $number The number to reverse.
     * @return string The reversed number.
     */
    function ReverseNumber($number)
    {
        // Return the input number as is if it has 1 or fewer digits.
        if (strlen($number) <= 1) {
            return $number;
        }

        // Recursively reverse the order of the digits in the number, starting at the third digit and going to the end.
        // Concatenate the first two digits of the original number to the end of the reversed string.
        return ReverseNumber(substr($number, 2)) . substr($number, 0, 2);
    }
    
    /**
     * Converts a hexadecimal string to a decimal number.
     *
     * @param string $hexString The hexadecimal string to convert.
     * @param int $expectedLength The expected length of the hexadecimal string. If the string is shorter than this length, it will be padded with zeros.
     * @param int $prefixToRemove An optional prefix to remove from the hexadecimal string before conversion. If the first character of the string matches this prefix, it will be removed.
     * @param bool $reverse Whether to reverse the hexadecimal string before conversion.
     * @return int The decimal equivalent of the hexadecimal string.
     */
    function hexToDec(string $hexString, int $expectedLength, int $prefixToRemove = 0, bool $reverse = true): int
    {
        // Calculate the number of zeros to pad the hexadecimal string with.
        $paddingLength = $expectedLength - strlen($hexString);
        
        // Pad the hexadecimal string with zeros on the left side.
        $hexString = str_pad($hexString, $paddingLength, '0', STR_PAD_LEFT);

        // Reverse the hexadecimal string if specified.
        if ($reverse) {
            $hexString = reverseNumber($hexString);
        }

        // Return 0 if the hexadecimal string contains non-hexadecimal characters.
        if (!ctype_xdigit($hexString)) {
            return 0;
        }

        // Return 0 if the hexadecimal string is empty.
        if (empty($hexString)) {
            return 0;
        }

        // Remove the specified prefix from the hexadecimal string if it exists.
        if ($prefixToRemove !== 0) {
            $hexString = substr($hexString, 0, 1) === $prefixToRemove ? substr($hexString, 1) : 0;
        }

        // Convert the hexadecimal string to a decimal number and return the result.
        return hexdec($hexString);
    }