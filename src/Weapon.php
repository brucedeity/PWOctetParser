<?php

namespace PWOctetReader;

use PWOctetReader\Item;

class Weapon extends Item
{
    
}

$octet = '5a0040003b00000029010000e8550000f05500002c000000010000000d0000000d00000063210000030300000507000000000000000000001e0000000000a0410000b040020000000000000000000000040000001e450000de00000001000000a5210000020000008a25000019000000d04600008601000008000000';
$data = octetToArray($octet);

echo json_encode($data);

function octetToArray(string $octet): array
{
    $level = hexToDec(substr($octet, 0, 4), 4, 0, true);
    $class = hexToDec(substr($octet, 4, 4), 4, 0, true);
    $strength = hexToDec(substr($octet, 8, 4), 4, 0, true);
    $constitution = hexToDec(substr($octet, 12, 4), 4, 0, true);
    $agility = hexToDec(substr($octet, 16, 4), 4, 0, true);
    $intelligence = hexToDec(substr($octet, 20, 4), 4, 0, true);
    $item_durability = hexToDec(substr($octet, 24, 8), 8, 0, true);
    $item_max_durability = hexToDec(substr($octet, 32, 8), 8, 0, true);
    $item_type = hexToDec(substr($octet, 40, 4), 4, 0, true);
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
    $range_type = hexToDec(substr($octet, $pos, 8), 8, 0, true);
    $weapon_type = hexToDec(substr($octet, $pos + 8, 8), 8, 0, true);
    $item_grade = hexToDec(substr($octet, $pos + 16, 8), 8, 0, true);
    $ammo_type = hexToDec(substr($octet, $pos + 24, 8), 8, 0, true);
    $physical_min_damage = intval(hexToDec(substr($octet, $pos + 32, 8), 8, 0, true));
    $physical_max_damage = intval(hexToDec(substr($octet, $pos + 40, 8), 8, 0, true));
    $magic_min_damage = intval(hexToDec(substr($octet, $pos + 48, 8), 8, 0, true));
    $magic_max_damage = intval(hexToDec(substr($octet, $pos + 56, 8), 8, 0, true));
    $attack_rate = hexToDec(substr($octet, $pos + 64, 8), 8, 0, true);
    
    $range = convertOctetToFloat(substr($octet, $pos + 72, 8));
    $minimum_effective_range = convertOctetToFloat(substr($octet, $pos + 80, 8));
    
    
    $num_sockets = hexToDec(substr($octet, $pos + 88, 8), 8, 0, true);
    $socket1 = hexToDec(substr($octet, $pos + 96, 8), 8, 0, true);
    $socket2 = hexToDec(substr($octet, $pos + 104, 8), 8, 0, true);
    $addons = hexToDec(substr($octet, $pos + 112, 8), 8, 0, true);
    $addon = hexToDec(substr($octet, $pos + 120, 16), 16, 0, true);
    return array(
        'level' => $level,
        'class' => $class,
        'strength' => $strength,
        'constitution' => $constitution,
        'agility' => $agility,
        'intelligence' => $intelligence,
        'item_durability' => $item_durability,
        'item_max_durability' => $item_max_durability,
        'item_type' => $item_type,
        'item_flag' => $item_flag,
        'name_length' => $name_length,
        'name' => $name,
        'range_type' => $range_type,
        'weapon_type' => $weapon_type,
        'item_grade' => $item_grade,
        'ammo_type' => $ammo_type,
        'physical_min_damage' => $physical_min_damage,
        'physical_max_damage' => $physical_max_damage,
        'magic_min_damage' => $magic_min_damage,
        'magic_max_damage' => $magic_max_damage,
        'attack_rate' => $attack_rate,
        'range' => $range,
        'minimum_effective_range' => $minimum_effective_range,
        'num_sockets' => $num_sockets,
        'socket1' => $socket1,
        'socket2' => $socket2,
        'addons' => $addons,
        'addon' => $addon
        );
}

    function convertOctetToFloat(string $octet): float {
        $float_value = unpack("f", pack("H*", $octet))[1];
        return $float_value;
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