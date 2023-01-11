<?php

// namespace PWOctetReader;

// use ItemPattern;
// use PWOctetReader\Item;

require 'OctetParser.php';

class Armor extends OctetParser
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

    private function GetLevelRequirement()
    {
        // Extract first four characters of octet
        $this->parsedOctet = substr($this->octet, 0, 4);

        // Convert extracted substring to decimal and store in attributeValue
        $this->attributeValue = parent::ToDecimal($this->parsedOctet, 4, 0, true);
        
        // Return current instance of class
        return $this;
    }

    private function GetClassRequirement()
    {
        // Extract next four characters of octet after level requirement
        $this->parsedOctet = substr($this->octet, 4, 4);

        // Convert extracted substring to decimal and store in attributeValue
        $this->attributeValue = parent::ToDecimal($this->parsedOctet, 4, 0, true);
        
        // Return current instance of class
        return $this;
    }

    private function GetStrengthRequirement()
    {
        // Extract next four characters of octet after class requirement
        $this->parsedOctet = substr($this->octet, 8, 4);

        // Convert extracted substring to decimal and store in attributeValue
        $this->attributeValue = parent::ToDecimal($this->parsedOctet, 4, 0, true);
        
        // Return current instance of class
        return $this;
    }

    private function GetConstitutionRequirement()
    {
        // Extract next four characters of octet after strength requirement
        $this->parsedOctet = substr($this->octet, 12, 4);

        // Convert extracted substring to decimal and store in attributeValue
        $this->attributeValue = parent::ToDecimal($this->parsedOctet, 4, 0, true);
        
        // Return current instance of class
        return $this;
    }

    private function GetAgilityRequirement()
    {
        // Extract next four characters of octet after constitution requirement
        $this->parsedOctet = substr($this->octet, 16, 4);

        // Convert extracted substring to decimal and store in attributeValue
        $this->attributeValue = parent::ToDecimal($this->parsedOctet, 4, 0, true);
        
        // Return current instance of class
        return $this;
    }

    private function GetInteligenceRequirement()
    {
        // Extract next four characters of octet after agility requirement
        $this->parsedOctet = substr($this->octet, 20, 4);

        // Convert extracted substring to decimal and store in attributeValue
        $this->attributeValue = parent::ToDecimal($this->parsedOctet, 4, 0, true);
        
        // Return current instance of class
        return $this;
    }

    private function GetDurability1()
    {
        // Extract next 8 characters of octet after intelligence requirement
        $this->parsedOctet = substr($this->octet, 24, 8);

        // Convert extracted substring to decimal, divide by 100 and store in attributeValue
        $this->attributeValue = intval(parent::ToDecimal($this->parsedOctet, 8, 0, true) / 100);
        
        // Return current instance of class
        return $this;
    }

    private function GetDurability2()
    {
        // Extract next 8 characters of octet after durability 1
        $this->parsedOctet = substr($this->octet, 32, 8);

        // Convert extracted substring to decimal, divide by 100 and store in attributeValue
        $this->attributeValue = intval(parent::ToDecimal($this->parsedOctet, 8, 0, true) / 100);
        
        // Return current instance of class
        return $this;
    }

    private function GetEquipmentType()
    {
        // Extract next 4 characters of octet after durability 2
        $this->parsedOctet = substr($this->octet, 40, 4);

        // Convert extracted substring to decimal and store in attributeValue
        $this->attributeValue = parent::ToDecimal($this->parsedOctet, 4, 0, true);
        
        // Return current instance of class
        return $this;
    }

    private function GetItemFlag()
    {
        // Extract next 2 characters of octet after equipment type
        $this->parsedOctet = substr($this->octet, 44, 2);

        // Convert extracted substring to decimal and store in attributeValue
        $this->attributeValue = parent::ToDecimal($this->parsedOctet, 2, 0, true);
        
        // Return current instance of class
        return $this;
    }

    private function GetName()
    {
        // Extract next 2 characters of octet after item flag
        $this->parsedOctet = substr($this->octet, 46, 2);

        // Convert extracted substring to decimal, divide by 2 and store in attributeValue
        $this->attributeValue = intdiv(parent::ToDecimal($this->parsedOctet, 2, 0, true), 2);
        
        // Return current instance of class
        return $this;
    }

    private function GetPhysicalDefence()
    {
        // Extract next 8 characters of octet after name
        $this->parsedOctet = substr($this->octet, $this->pos, 8);

        // Convert extracted substring to decimal and store in attributeValue
        $this->attributeValue = parent::ToDecimal($this->parsedOctet, 8, 0, true);
        
        // Return current instance of class
        return $this;
    }

    private function GetSocketCount()
    {
        // Extract next 8 characters of octet 72 characters after physical defence
        $this->parsedOctet = substr($this->octet, $this->pos + 72, 8);

        // Convert extracted substring to decimal and store in attributeValue
        $this->attributeValue = parent::ToDecimal($this->parsedOctet, 8, 0, true);

        $this->pos = ($this->pos + $this->attributeValue) * 8;
        
        return $this;
    }

    private function GetDodgeAmount()
    {
        $this->parsedOctet = substr($this->octet, $this->pos + 8, 8);

        $this->attributeValue = parent::ToDecimal($this->parsedOctet, 8, 0, true);
        
        return $this;
    }

    private function GetHealthAmount()
    {
        $this->parsedOctet = substr($this->octet, $this->pos + 24, 8);

        $this->attributeValue = parent::ToDecimal($this->parsedOctet, 8, 0, true);
        
        return $this;
    }

    private function GetManaAmount()
    {
        $this->parsedOctet = substr($this->octet, $this->pos + 16, 8);

        $this->attributeValue = parent::ToDecimal($this->parsedOctet, 8, 0, true);
        
        return $this;
    }

    private function GetMetalDefence()
    {
        $this->parsedOctet = substr($this->octet, $this->pos + 32, 8);

        $this->attributeValue = parent::ToDecimal($this->parsedOctet, 8, 0, true);
        
        return $this;
    }

    private function GetWoodDefence()
    {
        $this->parsedOctet = substr($this->octet, $this->pos + 40, 8);

        $this->attributeValue = parent::ToDecimal($this->parsedOctet, 8, 0, true);
        
        return $this;
    }

    private function GetWaterDefence()
    {
        $this->parsedOctet = substr($this->octet, $this->pos + 48, 8);

        $this->attributeValue = parent::ToDecimal($this->parsedOctet, 8, 0, true);
        
        return $this;
    }

    private function GetFireDefence()
    {
        $this->parsedOctet = substr($this->octet, $this->pos + 56, 8);

        $this->attributeValue = parent::ToDecimal($this->parsedOctet, 8, 0, true);
        
        return $this;
    }

    private function GetEarthDefence()
    {
        $this->parsedOctet = substr($this->octet, $this->pos + 64, 8);

        $this->attributeValue = parent::ToDecimal($this->parsedOctet, 8, 0, true);
        
        return $this;
    }

    private function GetAddounCount()
    {
        $this->parsedOctet = substr($this->octet, $this->pos + 80, 8);

        $this->attributeValue = parent::ToDecimal($this->parsedOctet, 8, 0, true);
        
        return $this;
    }

    private function ShowValue()
    {
        return $this->attributeValue;
    }

    private function ShowOctet()
    {
        return $this->parsedOctet;
    }

    public function getAttributes()
    {
        $attributes = [
            'levelRequired' => [
                'value' => $this->GetLevelRequirement()->attributeValue,
                'octet' => $this->GetLevelRequirement()->parsedOctet
            ],
            'classRequired' => [
                'value' => $this->GetClassRequirement()->attributeValue,
                'octet' => $this->GetClassRequirement()->parsedOctet
            ],
            'strengthRequired' => [
                'value' => $this->GetStrengthRequirement()->attributeValue,
                'octet' => $this->GetStrengthRequirement()->parsedOctet
            ],
            'constitutionRequired' => [
                'value' => $this->GetConstitutionRequirement()->attributeValue,
                'octet' => $this->GetConstitutionRequirement()->parsedOctet
            ],
            'agilityRequired' => [
                'value' => $this->GetAgilityRequirement()->attributeValue,
                'octet' => $this->GetAgilityRequirement()->parsedOctet
            ],
            'intelligenceRequired' => [
                'value' => $this->GetInteligenceRequirement()->attributeValue,
                'octet' => $this->GetInteligenceRequirement()->parsedOctet
            ],
            'durability1' => [
                'value' => $this->GetDurability1()->attributeValue,
                'octet' => $this->GetDurability1()->parsedOctet
            ],
            'durability2' => [
                'value' => $this->GetDurability2()->attributeValue,
                'octet' => $this->GetDurability2()->parsedOctet
            ],
            'equipmentType' => [
                'value' => $this->GetEquipmentType()->attributeValue,
                'octet' => $this->GetEquipmentType()->parsedOctet
            ],
            'itemFlag' => [
                'value' => $this->GetItemFlag()->attributeValue,
                'octet' => $this->GetItemFlag()->parsedOctet
            ],
            'name' => [
                'value' => $this->GetName()->attributeValue,
                'octet' => $this->GetName()->parsedOctet
            ],
            'physicalDefence' => [
                'value' => $this->GetPhysicalDefence()->attributeValue,
                'octet' => $this->GetPhysicalDefence()->parsedOctet
            ],
            'dodge' => [
                'value' => $this->GetDodgeAmount()->attributeValue,
                'octet' => $this->GetDodgeAmount()->parsedOctet
            ],
            'health' => [
                'value' => $this->GetHealthAmount()->attributeValue,
                'octet' => $this->GetHealthAmount()->parsedOctet
            ],
            'mana' => [
                'value' => $this->GetManaAmount()->attributeValue,
                'octet' => $this->GetManaAmount()->parsedOctet
            ],
            'metalDefence' => [
                'value' => $this->GetMetalDefence()->attributeValue,
                'octet' => $this->GetMetalDefence()->parsedOctet
            ],
            'woodDefence' => [
                'value' => $this->GetWoodDefence()->attributeValue,
                'octet' => $this->GetWoodDefence()->parsedOctet
            ],
            'waterDefence' => [
                'value' => $this->GetWaterDefence()->attributeValue,
                'octet' => $this->GetWaterDefence()->parsedOctet
            ],
            'fireDefence' => [
                'value' => $this->GetFireDefence()->attributeValue,
                'octet' => $this->GetFireDefence()->parsedOctet
            ],
            'earthDefence' => [
                'value' => $this->GetEarthDefence()->attributeValue,
                'octet' => $this->GetEarthDefence()->parsedOctet
            ],
            'socketCount' => [
                'value' => $this->GetSocketCount()->attributeValue,
                'octet' => $this->GetSocketCount()->parsedOctet
            ],
            'addounCount' => [
                'value' => $this->GetAddounCount()->attributeValue,
                'octet' => $this->GetAddounCount()->parsedOctet
            ],
        ];
        return json_encode($attributes);
    }
}

$Armour = new Armor('6300ff0f6700000067000000b1530000fc53000024000000360100007e0000000000000050000000e0010000e0010000e0010000e0010000e001000004000d00f3180000f3180000f3180000f318000008000000742200005000000051210000020000009e2200007e0000000b470000ad0100000800000099a400003e00000099a400003e00000099a400003e00000099a400003e000000');

echo $Armour->getAttributes();
