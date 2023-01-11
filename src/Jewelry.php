<?php

// namespace PWOctetReader;

// use OctetParser;
// use PWOctetReader\Item;

require 'OctetParser.php';

class Jewelry extends OctetParser
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

    public function GetAttributes()
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

        return json_encode($attributes);
    }
}

$Jewelry = new Jewelry('5f00ff0f0000000000000000ba5e0000b45f00002400000061000000000000000000000000000000c8000000c8000000c8000000c8000000c80000000000000004000000662100000300000087210000320000007c210000c800000034470000d401000008000000');

echo $Jewelry->getAttributes();

// $octet = '5500ff0f0000000000000000a6590000d85900002400000018000000000000006f0100000000000000000000000000000000000000000000000000000000000004000000a5250000070000005c23000018000000032400006400000033470000ad01000008000000';
// $data = octetToArray($octet);

// echo json_encode($data);

// function octetToArray(string $octet): array
// {
//     $level_req = parent::ToDecimal(substr($octet, 0, 4), 4, 0, true);
//     $class_req = parent::ToDecimal(substr($octet, 4, 4), 4, 0, true);
//     $strength_req = parent::ToDecimal(substr($octet, 8, 4), 4, 0, true);
//     $constitution_req = parent::ToDecimal(substr($octet, 12, 4), 4, 0, true);
//     $agility_req = parent::ToDecimal(substr($octet, 16, 4), 4, 0, true);
//     $intelligence_req = parent::ToDecimal(substr($octet, 20, 4), 4, 0, true);
//     $durability1 = intval(parent::ToDecimal(substr($octet, 24, 8), 8, 0, true) / 100);
//     $durability2 = intval(parent::ToDecimal(substr($octet, 32, 8), 8, 0, true) / 100);
//     $equipment_type = parent::ToDecimal(substr($octet, 40, 4), 4, 0, true);
//     $item_flag = parent::ToDecimal(substr($octet, 44, 2), 2, 0, true);
//     $name_length = intdiv(parent::ToDecimal(substr($octet, 46, 2), 2, 0, true), 2);
//     $name = '';
//     $pos = 48;
//     for ($i = 0; $i < $name_length; $i++) {
//         $str = substr($octet, $pos + $i * 4, 4);
//         $n = parent::ToDecimal(substr($str, 0, 2), 2, 0, true);
//         $name .= chr($n);
//         $pos = 48 + $i * 4 + 4;
//     }
//     $physical_attack = parent::ToDecimal(substr($octet, $pos, 8), 8, 0, true);
//     $magical_attack = parent::ToDecimal(substr($octet, $pos + 8, 8), 8, 0, true);
//     $physical_defense = parent::ToDecimal(substr($octet, $pos + 16, 8), 8, 0, true);
//     $dodge = parent::ToDecimal(substr($octet, $pos + 24, 8), 8, 0, true);
// $metal = parent::ToDecimal(substr($octet, $pos + 32, 8), 8, 0, true);
// $wood = parent::ToDecimal(substr($octet, $pos + 40, 8), 8, 0, true);
// $water = parent::ToDecimal(substr($octet, $pos + 48, 8), 8, 0, true);
// $fire = parent::ToDecimal(substr($octet, $pos + 56, 8), 8, 0, true);
// $earth = parent::ToDecimal(substr($octet, $pos + 64, 8), 8, 0, true);

// $socket_count = parent::ToDecimal(substr($octet, $pos + 72, 8), 8, 0, true);

// // if ($socket_count > 0){
// // $sockets_state = array();
// // for ($i = 1; $i <= $socket_count; $i++){
// // $sockets_state[$i] = parent::ToDecimal(substr($octet, $pos + 72 + ($i * 8), 8), 8, 0, true);
// // }
// // }
// $pos = $pos + 72 + ($socket_count * 8);

// $add_on_count = parent::ToDecimal(substr($octet, $pos + 80, 8), 8, 0, true);

// // continue from here with the rest of the variables according to the javascript code
// // and add the new variables like socket_count and sockets_state

// $data = array(
// 'level_req' => $level_req,
// 'class_req' => $class_req,
// 'strength_req' => $strength_req,
// 'constitution_req' => $constitution_req,
// 'agility_req' => $agility_req,
// 'intelligence_req' => $intelligence_req,
// 'durability1' => $durability1,
// 'durability2' => $durability2,
// 'equipment_type' => $equipment_type,
// 'item_flag' => $item_flag,
// 'name' => $name,
// 'physical_attack' => $physical_attack,
// 'magical_attack' => $magical_attack,
// 'physical_defense' => $physical_defense,
// 'dodge' => $dodge,
// 'metal' => $metal,
// 'wood' => $wood,
// 'water' => $water,
// 'fire' => $fire,
// 'earth' => $earth,
// 'socket_count' => $socket_count,
// // 'sockets_state' => $sockets_state,
// 'add_on_count' => $add_on_count
// );

// return $data;
// }