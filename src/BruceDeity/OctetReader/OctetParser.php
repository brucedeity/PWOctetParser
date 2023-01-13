<?php

namespace BruceDeity\OctetReader;

class OctetParser
{
    public function ReverseNumber($number)
    {
        // Return the input number as is if it has 1 or fewer digits.
        if (strlen($number) <= 1) {
            return $number;
        }

        // Recursively reverse the order of the digits in the number, starting at the third digit and going to the end.
        // Concatenate the first two digits of the original number to the end of the reversed string.
        return $this->ReverseNumber(substr($number, 2)) . substr($number, 0, 2);
    }

    public function GetRuneList()
    {
        return [
            [2363, 6],
            [2364, 8],
            [3135, 64]
        ];
    }

    public function SearchRuneNameValue($EQType, $AddonId, $Val)
    {
        return '';
    }

    public function IsRune($id)
    {
        $runeList = $this->GetRuneList();

        for ($i = 0; $i < count($runeList); $i++) {
            if ($runeList[$i][0] == $id) {
                return true;
            }
        }
        return false;
    }

    public function SearchSocketNameValue()
    {
        return '';
    }

    public function HextoDec(string $str, int $flen, int $adds, bool $rev): int
    {
        $diff = $flen - strlen($str);
        for ($i=0; $i<$diff; $i++) {
            $str = '0'.$str;
        }   
        if ($rev !== false){
            $hex = $this->ReverseNumber($str);
        } else {
            $hex = $str;
        }
        if (!ctype_xdigit($hex)){
            $hex = 0;
        }
        $hex = ltrim($hex, '0');
        if (empty($hex)){
            $hex = 0;
        }
        if ($adds != 0){
            if (substr($hex, 0, 1) == $adds){
                $hex = substr($hex, 1);
            } else {
                $hex = 0;
            }
        }
        return hexdec($hex);
    }


    public function ToDecimal(string $hexString, int $expectedLength, int $prefixToRemove = 0, bool $reverse = true): int
    {
        // Calculate the number of zeros to pad the hexadecimal string with.
        $paddingLength = $expectedLength - strlen($hexString);
        
        // Pad the hexadecimal string with zeros on the left side.
        $hexString = str_pad($hexString, $paddingLength, '0', STR_PAD_LEFT);
    
        // Reverse the hexadecimal string if specified.
        if ($reverse) {
            $hexString = $this->ReverseNumber($hexString);
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
            if (strpos($hexString, $prefixToRemove) === 0) {
                $hexString = substr($hexString, 1);
            }
        }

        return base_convert($hexString, 16, 10);
    }



    function ToFloat(string $octet): float {
        $float_value = unpack("f", pack("H*", $octet))[1];
        return $float_value;
    }
}
