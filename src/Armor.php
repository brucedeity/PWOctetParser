<?php

// namespace PWOctetReader;

// use ItemPattern;
// use PWOctetReader\Item;

require 'item.php';

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

    public function GetLevelRequirement()
    {
        // Extract first four characters of octet
        $this->parsedOctet = substr($this->octet, 0, 4);

        // Convert extracted substring to decimal and store in attributeValue
        $this->attributeValue = parent::ToDecimal($this->parsedOctet, 4, 0, true);
        
        // Return current instance of class
        return $this;
    }

    public function GetClassRequirement()
    {
        // Extract next four characters of octet after level requirement
        $this->parsedOctet = substr($this->octet, 4, 4);

        // Convert extracted substring to decimal and store in attributeValue
        $this->attributeValue = parent::ToDecimal($this->parsedOctet, 4, 0, true);
        
        // Return current instance of class
        return $this;
    }

    public function GetStrengthRequirement()
    {
        // Extract next four characters of octet after class requirement
        $this->parsedOctet = substr($this->octet, 8, 4);

        // Convert extracted substring to decimal and store in attributeValue
        $this->attributeValue = parent::ToDecimal($this->parsedOctet, 4, 0, true);
        
        // Return current instance of class
        return $this;
    }

    public function GetConstitutionRequirement()
    {
        // Extract next four characters of octet after strength requirement
        $this->parsedOctet = substr($this->octet, 12, 4);

        // Convert extracted substring to decimal and store in attributeValue
        $this->attributeValue = parent::ToDecimal($this->parsedOctet, 4, 0, true);
        
        // Return current instance of class
        return $this;
    }

    public function GetAgilityRequirement()
    {
        // Extract next four characters of octet after constitution requirement
        $this->parsedOctet = substr($this->octet, 16, 4);

        // Convert extracted substring to decimal and store in attributeValue
        $this->attributeValue = parent::ToDecimal($this->parsedOctet, 4, 0, true);
        
        // Return current instance of class
        return $this;
    }

    public function GetInteligenceRequirement()
    {
        // Extract next four characters of octet after agility requirement
        $this->parsedOctet = substr($this->octet, 20, 4);

        // Convert extracted substring to decimal and store in attributeValue
        $this->attributeValue = parent::ToDecimal($this->parsedOctet, 4, 0, true);
        
        // Return current instance of class
        return $this;
    }

    public function GetDurability1()
    {
        // Extract next 8 characters of octet after intelligence requirement
        $this->parsedOctet = substr($this->octet, 24, 8);

        // Convert extracted substring to decimal, divide by 100 and store in attributeValue
        $this->attributeValue = intval(parent::ToDecimal($this->parsedOctet, 8, 0, true) / 100);
        
        // Return current instance of class
        return $this;
    }

    public function GetDurability2()
    {
        // Extract next 8 characters of octet after durability 1
        $this->parsedOctet = substr($this->octet, 32, 8);

        // Convert extracted substring to decimal, divide by 100 and store in attributeValue
        $this->attributeValue = intval(parent::ToDecimal($this->parsedOctet, 8, 0, true) / 100);
        
        // Return current instance of class
        return $this;
    }

    public function GetEquipmentType()
    {
        // Extract next 4 characters of octet after durability 2
        $this->parsedOctet = substr($this->octet, 40, 4);

        // Convert extracted substring to decimal and store in attributeValue
        $this->attributeValue = parent::ToDecimal($this->parsedOctet, 4, 0, true);
        
        // Return current instance of class
        return $this;
    }

    public function GetItemFlag()
    {
        // Extract next 2 characters of octet after equipment type
        $this->parsedOctet = substr($this->octet, 44, 2);

        // Convert extracted substring to decimal and store in attributeValue
        $this->attributeValue = parent::ToDecimal($this->parsedOctet, 2, 0, true);
        
        // Return current instance of class
        return $this;
    }

    public function GetName()
    {
        // Extract next 2 characters of octet after item flag
        $this->parsedOctet = substr($this->octet, 46, 2);

        // Convert extracted substring to decimal, divide by 2 and store in attributeValue
        $this->attributeValue = intdiv(parent::ToDecimal($this->parsedOctet, 2, 0, true), 2);
        
        // Return current instance of class
        return $this;
    }

    public function GetPhysicalDefence()
    {
        // Extract next 8 characters of octet after name
        $this->parsedOctet = substr($this->octet, $this->pos, 8);

        // Convert extracted substring to decimal and store in attributeValue
        $this->attributeValue = parent::ToDecimal($this->parsedOctet, 8, 0, true);
        
        // Return current instance of class
        return $this;
    }

    public function GetSocketCount()
    {
        // Extract next 8 characters of octet 72 characters after physical defence
        $this->parsedOctet = substr($this->octet, $this->pos + 72, 8);

        // Convert extracted substring to decimal and store in attributeValue
        $this->attributeValue = parent::ToDecimal($this->parsedOctet, 8, 0, true);

        $this->pos = ($this->pos + $this->attributeValue) * 8;
        
        return $this;
    }

    public function GetDodgeAmount()
    {
        $this->parsedOctet = substr($this->octet, $this->pos + 8, 8);

        $this->attributeValue = parent::ToDecimal($this->parsedOctet, 8, 0, true);
        
        return $this;
    }

    public function GetHealthAmount()
    {
        $this->parsedOctet = substr($this->octet, $this->pos + 24, 8);

        $this->attributeValue = parent::ToDecimal($this->parsedOctet, 8, 0, true);
        
        return $this;
    }

    public function GetManaAmount()
    {
        $this->parsedOctet = substr($this->octet, $this->pos + 16, 8);

        $this->attributeValue = parent::ToDecimal($this->parsedOctet, 8, 0, true);
        
        return $this;
    }

    public function GetMetalDefence()
    {
        $this->parsedOctet = substr($this->octet, $this->pos + 32, 8);

        $this->attributeValue = parent::ToDecimal($this->parsedOctet, 8, 0, true);
        
        return $this;
    }

    public function GetWoodDefence()
    {
        $this->parsedOctet = substr($this->octet, $this->pos + 40, 8);

        $this->attributeValue = parent::ToDecimal($this->parsedOctet, 8, 0, true);
        
        return $this;
    }

    public function GetWaterDefence()
    {
        $this->parsedOctet = substr($this->octet, $this->pos + 48, 8);

        $this->attributeValue = parent::ToDecimal($this->parsedOctet, 8, 0, true);
        
        return $this;
    }

    public function GetFireDefence()
    {
        $this->parsedOctet = substr($this->octet, $this->pos + 56, 8);

        $this->attributeValue = parent::ToDecimal($this->parsedOctet, 8, 0, true);
        
        return $this;
    }

    public function GetEarthDefence()
    {
        $this->parsedOctet = substr($this->octet, $this->pos + 64, 8);

        $this->attributeValue = parent::ToDecimal($this->parsedOctet, 8, 0, true);
        
        return $this;
    }

    public function GetAddounCount()
    {
        $this->parsedOctet = substr($this->octet, $this->pos + 80, 8);

        $this->attributeValue = parent::ToDecimal($this->parsedOctet, 8, 0, true);
        
        return $this;
    }

    public function ShowValue()
    {
        return $this->attributeValue;
    }

    public function ShowOctet()
    {
        return $this->parsedOctet;
    }

    public function getAttributes()
    {
        $attributes = [
            'levelRequired' => [
                'value' => $this->GetLevelRequirement()->attributeValue,
                'octet' => $this->parsedOctet
            ],
            'classRequired' => [
                'value' => $this->GetClassRequirement()->attributeValue,
                'octet' => $this->parsedOctet
            ],
            'strengthRequired' => [
                'value' => $this->GetStrengthRequirement()->attributeValue,
                'octet' => $this->parsedOctet
            ],
            'constitutionRequired' => [
                'value' => $this->GetConstitutionRequirement()->attributeValue,
                'octet' => $this->parsedOctet
            ],
            'agilityRequired' => [
                'value' => $this->GetAgilityRequirement()->attributeValue,
                'octet' => $this->parsedOctet
            ],
            'intelligenceRequired' => [
                'value' => $this->GetInteligenceRequirement()->attributeValue,
                'octet' => $this->parsedOctet
            ],
            'durability1' => [
                'value' => $this->GetDurability1()->attributeValue,
                'octet' => $this->parsedOctet
            ],
            'durability2' => [
                'value' => $this->GetDurability2()->attributeValue,
                'octet' => $this->parsedOctet
            ],
            'equipmentType' => [
                'value' => $this->GetEquipmentType()->attributeValue,
                'octet' => $this->parsedOctet
            ],
            'itemFlag' => [
                'value' => $this->GetItemFlag()->attributeValue,
                'octet' => $this->parsedOctet
            ],
            'name' => [
                'value' => $this->GetName()->attributeValue,
                'octet' => $this->parsedOctet
            ],
            'physicalDefence' => [
                'value' => $this->GetPhysicalDefence()->attributeValue,
                'octet' => $this->parsedOctet
            ],
            'socketCount' => [
                'value' => $this->GetSocketCount()->attributeValue,
                'octet' => $this->parsedOctet
            ],
            'magicDefence' => [
                'value' => $this->GetMagicDefence()->attributeValue,
                'octet' => $this->parsedOctet
            ],
            'price' => [
                'value' => $this->GetPrice()->attributeValue,
                'octet' => $this->parsedOctet
            ]
        ];
        return json_encode($attributes);
    }
}

$Armour = new Armor('6300ff0f6700000067000000a67200003c73000024000000d3020000000000000000000050000000650400006504000065040000650400006504000004000d00f3180000f3180000f3180000f3180000080000007422000050000000b225000009000000bc250000090000000b470000ad0100000800000099a400003e00000099a400003e00000099a400003e00000099a400003e000000');

echo $Armour->getAttributes();
