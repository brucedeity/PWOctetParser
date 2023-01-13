<?php

namespace BruceDeity\OctetReader;

use BruceDeity\OctetReader\OctetParser;
use BruceDeity\OctetReader\Interfaces\Item;

class Jewelry extends OctetParser implements Item
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

    public function GetLevelRequirement()
    {
        $this->parsedOctet = substr($this->octet, 0, 4);
        $this->attributeValue = parent::ToDecimal($this->parsedOctet, 4, 0, true);
        return $this;
    }
    public function GetClassRequirement()
    {
        $this->parsedOctet = substr($this->octet, 4, 4);
        $this->attributeValue = parent::ToDecimal($this->parsedOctet, 4, 0, true);
        return $this;
    }
    public function GetStrengthRequirement()
    {
        $this->parsedOctet = substr($this->octet, 8, 4);
        $this->attributeValue = parent::ToDecimal($this->parsedOctet, 4, 0, true);
        return $this;
    }
    public function GetConstitutionRequirement()
    {
        $this->parsedOctet = substr($this->octet, 12, 4);
        $this->attributeValue = parent::ToDecimal($this->parsedOctet, 4, 0, true);
        return $this;
    }
    public function GetAgilityRequirement()
    {
        $this->parsedOctet = substr($this->octet, 16, 4);
        $this->attributeValue = parent::ToDecimal($this->parsedOctet, 4, 0, true);
        return $this;
    }
    public function GetInteligenceRequirement()
    {
        $this->parsedOctet = substr($this->octet, 20, 4);
        $this->attributeValue = parent::ToDecimal($this->parsedOctet, 4, 0, true);
        return $this;
    }
    public function GetDurability1()
    {
        $this->parsedOctet = substr($this->octet, 24, 8);
        $this->attributeValue = intval(parent::ToDecimal($this->parsedOctet, 8, 0, true) / 100);
        return $this;
    }
    public function GetDurability2()
    {
        $this->parsedOctet = substr($this->octet, 32, 8);
        $this->attributeValue = intval(parent::ToDecimal($this->parsedOctet, 8, 0, true) / 100);
        return $this;
    }
    public function GetEquipmentType()
    {
        $this->parsedOctet = substr($this->octet, 40, 4);
        $this->attributeValue = parent::ToDecimal($this->parsedOctet, 4, 0, true);
        return $this;
    }

    public function GetItemFlag()
    {
        $this->parsedOctet = substr($this->octet, 44, 2);
        $this->attributeValue = parent::ToDecimal($this->parsedOctet, 2, 0, true);
        return $this;
    }

    public function GetNameLength()
    {
        $this->parsedOctet = substr($this->octet, 46, 2);
        $this->attributeValue = intdiv(parent::ToDecimal($this->parsedOctet, 2, 0, true), 2);
        return $this;
    }

    public function GetName()
    {
        $name = '';
        $name_length = $this->GetNameLength()->attributeValue;
        for ($i = 0; $i < $name_length; $i++) {
            $str = substr($this->octet, $this->pos + $i * 4, 4);
            $n = parent::ToDecimal(substr($str, 0, 2), 2, 0, true);
            $name .= chr($n);
            $this->pos = 48 + $i * 4 + 4;
        }
        $this->attributeValue = $name;
        return $this;
    }

    public function GetPhysicalAttack()
    {
        $this->parsedOctet = substr($this->octet, $this->pos, 8);
        $this->attributeValue = parent::ToDecimal($this->parsedOctet, 8, 0, true);
        return $this;
    }

    public function GetMagicalAttack()
    {
        $this->parsedOctet = substr($this->octet, $this->pos + 8, 8);
        $this->attributeValue = parent::ToDecimal($this->parsedOctet, 8, 0, true);
        return $this;
    }

    public function GetPhysicalDefense()
    {
        $this->parsedOctet = substr($this->octet, $this->pos + 16, 8);
        $this->attributeValue = parent::ToDecimal($this->parsedOctet, 8, 0, true);
        return $this;
    }

    public function GetDodge()
    {
        $this->parsedOctet = substr($this->octet, $this->pos + 24, 8);
        $this->attributeValue = parent::ToDecimal($this->parsedOctet, 8, 0, true);
        return $this;
    }
    public function GetMetalDefense(){
        $this->parsedOctet = substr($this->octet, $this->pos + 32, 8);
        $this->attributeValue = parent::ToDecimal($this->parsedOctet, 8, 0, true);
        return $this;
    }
    public function GetWoodDefense(){
        $this->parsedOctet = substr($this->octet, $this->pos + 40, 8);
        $this->attributeValue = parent::ToDecimal($this->parsedOctet, 8, 0, true);
        return $this;
    }

    public function GetWater()
    {
    $this->parsedOctet = substr($this->octet, $this->pos + 48, 8);
    $this->attributeValue = parent::ToDecimal($this->parsedOctet, 8, 0, true);
    return $this;
    }
    public function GetFire()
    {
    $this->parsedOctet = substr($this->octet, $this->pos + 56, 8);
    $this->attributeValue = parent::ToDecimal($this->parsedOctet, 8, 0, true);
    return $this;
    }
    public function GetEarth()
    {
    $this->parsedOctet = substr($this->octet, $this->pos + 64, 8);
    $this->attributeValue = parent::ToDecimal($this->parsedOctet, 8, 0, true);
    return $this;
    }
    public function GetSocketCount()
    {
    $this->parsedOctet = substr($this->octet, $this->pos + 72, 8);
    $this->attributeValue = parent::ToDecimal($this->parsedOctet, 8, 0, true);
    return $this;
    }

    public function GetAttributes() : array
    {
        $attributes = [
            'levelRequired' => [
                'value' => $this->GetLevelRequirement()->attributeValue,
                'octet' => $this->parsedOctet,
            ],
            'classRequired' => [
                'value' => $this->GetClassRequirement()->attributeValue,
                'octet' => $this->parsedOctet,
            ],
            'strengthRequired' => [
                'value' => $this->GetStrengthRequirement()->attributeValue,
                'octet' => $this->parsedOctet,
            ],
            'constitutionRequired' => [
                'value' => $this->GetConstitutionRequirement()->attributeValue,
                'octet' => $this->parsedOctet,
            ],
            'agilityRequired' => [
                'value' => $this->GetAgilityRequirement()->attributeValue,
                'octet' => $this->parsedOctet,
            ],
            'intelligenceRequired' => [
                'value' => $this->GetInteligenceRequirement()->attributeValue,
                'octet' => $this->parsedOctet,
            ],
            'durability1' => [
                'value' => $this->GetDurability1()->attributeValue,
                'octet' => $this->parsedOctet,
            ],
            'durability2' => [
                'value' => $this->GetDurability2()->attributeValue,
                'octet' => $this->parsedOctet,
            ],
            'equipmentType' => [
                'value' => $this->GetEquipmentType()->attributeValue,
                'octet' => $this->parsedOctet,
            ],
            'itemFlag' => [
                'value' => $this->GetItemFlag()->attributeValue,
                'octet' => $this->parsedOctet,
            ],
            'name' => [
                'value' => $this->GetName()->attributeValue,
                'octet' => $this->parsedOctet,
            ],
            //  Add the rest of the attribute here

            'physicalAttack' => [
                'value' => $this->GetPhysicalAttack()->attributeValue,
                'octet' => $this->parsedOctet,
            ],
            'magicalAttack' => [
                'value' => $this->GetMagicalAttack()->attributeValue,
                'octet' => $this->parsedOctet,
            ],
            'physicalDefense' => [
                'value' => $this->GetPhysicalDefense()->attributeValue,
                'octet' => $this->parsedOctet,
            ],
            'dodge' => [
                'value' => $this->GetDodge()->attributeValue,
                'octet' => $this->parsedOctet,
            ],
        ];

        return $attributes;
    }
}