<?php

namespace BruceDeity\OctetReader;

use BruceDeity\OctetReader\OctetParser;
use BruceDeity\OctetReader\Interfaces\Item;

class Weapon extends OctetParser implements Item
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

    public function GetRangeType()
    {
        $this->parsedOctet = substr($this->octet, $this->pos, 8);

        $this->attributeValue = parent::ToDecimal($this->parsedOctet, 8, 0, true);
        
        return $this;
    }

    public function GetClassRequirement()
    {
        $this->parsedOctet = substr($this->octet, 4, 4);
        $this->attributeValue = parent::ToDecimal($this->parsedOctet, 4, 0, true);
        return $this;
    }
    // Add the other methods
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
    public function GetItemDurability()
    {
        $this->parsedOctet = substr($this->octet, 24, 8);
        $this->attributeValue = intval((parent::ToDecimal($this->parsedOctet, 8, 0, true)) / 100);
        return $this;
    }
    public function GetItemMaxDurability()
    {
        $this->parsedOctet = substr($this->octet, 32, 8);
        $this->attributeValue = intval((parent::ToDecimal($this->parsedOctet, 8, 0, true)) / 100);
        return $this;
    }
    public function GetItemType()
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

    public function GetWeaponType()
    {
        $this->parsedOctet = substr($this->octet, $this->pos + 8, 8);
        $this->attributeValue = parent::ToDecimal($this->parsedOctet, 8, 0, true);
        return $this;
    }

    public function GetItemGrade()
    {
        $this->parsedOctet = substr($this->octet, $this->pos + 16, 8);
        $this->attributeValue = parent::ToDecimal($this->parsedOctet, 8, 0, true);
        return $this;
    }
    public function GetAmmoType()
    {
        $this->parsedOctet = substr($this->octet, $this->pos + 24, 8);
        $this->attributeValue = parent::ToDecimal($this->parsedOctet, 8, 0, true);
        return $this;
    }
    public function GetPhysicalMinDamage()
    {
        $this->parsedOctet = substr($this->octet, $this->pos + 32, 8);
        $this->attributeValue = intval(parent::ToDecimal($this->parsedOctet, 8, 0, true));
        return $this;
    }
    public function GetPhysicalMaxDamage()
    {
        $this->parsedOctet = substr($this->octet, $this->pos + 40, 8);
        $this->attributeValue = intval(parent::ToDecimal($this->parsedOctet, 8, 0, true));
        return $this;
    }
    public function GetMagicMinDamage()
    {
        $this->parsedOctet = substr($this->octet, $this->pos + 48, 8);
        $this->attributeValue = intval(parent::ToDecimal($this->parsedOctet, 8, 0, true));
        return $this;
    }
    public function GetMagicMaxDamage()
    {
        $this->parsedOctet = substr($this->octet, $this->pos + 56, 8);
        $this->attributeValue = intval(parent::ToDecimal($this->parsedOctet, 8, 0, true));
        return $this;
    }

    public function GetAttackRate()
    {
        $this->parsedOctet = substr($this->octet, $this->pos + 64, 8);
        $this->attributeValue = number_format(20 / parent::ToDecimal($this->parsedOctet, 8, 0, true), 2);
        return $this;
    }

    public function GetRange()
    {
        $this->parsedOctet = substr($this->octet, $this->pos + 72, 8);
        $this->attributeValue = parent::ToFloat($this->parsedOctet);
        return $this;
    }

    public function GetMinEffectiveRange()
    {
        $this->parsedOctet = substr($this->octet, $this->pos + 80, 8);
        $this->attributeValue = parent::ToFloat($this->parsedOctet);
        return $this;
    }

    public function GetSocketsCount()
    {
        $this->parsedOctet = substr($this->octet, $this->pos + 88, 8);
        $this->attributeValue = parent::ToDecimal($this->parsedOctet, 8, 0, true);

        return $this;
    }

    public function GetAddonsCount()
    {
        $this->parsedOctet = substr($this->octet, $this->pos + 112, 8);
        $this->attributeValue = parent::ToDecimal($this->parsedOctet, 8, 0, true);

        return $this;
    }

    public function GetAddons()
    {
        $this->parsedOctet = substr($this->octet, $this->pos + 120, 16);
        $this->attributeValue = parent::ToDecimal($this->parsedOctet, 16, 0, true);

        return $this;
    }

    public function getAttributes() : array
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
            'itemDurability' => [
                'value' => $this->GetItemDurability()->attributeValue,
                'octet' => $this->GetItemDurability()->parsedOctet
            ],
            'itemMaxDurability' => [
                'value' => $this->GetItemMaxDurability()->attributeValue,
                'octet' => $this->GetItemMaxDurability()->parsedOctet
            ],
            'itemType' => [
                'value' => $this->GetItemType()->attributeValue,
                'octet' => $this->GetItemType()->parsedOctet
            ],
            'name' => [
                'value' => $this->GetName()->attributeValue,
                'octet' => $this->GetName()->parsedOctet
            ],
            'attackRate' => [
                'value' => $this->GetAttackRate()->attributeValue,
                'octet' => $this->GetAttackRate()->parsedOctet
            ],
            'rangeType' => [
                'value' => $this->GetRangeType()->attributeValue,
                'octet' => $this->GetRangeType()->parsedOctet
            ],
            'range' => [
                'value' => $this->GetRange()->attributeValue,
                'octet' => $this->GetRange()->parsedOctet
            ],
            'minEffectiveRange' => [
                'value' => $this->GetMinEffectiveRange()->attributeValue,
                'octet' => $this->GetMinEffectiveRange()->parsedOctet
            ],
            'addonsCount' => [
                'value' => $this->GetAddonsCount()->attributeValue,
                'octet' => $this->GetAddonsCount()->parsedOctet
            ],
            'addons' => [
                'value' => $this->GetAddons()->attributeValue,
                'octet' => $this->GetAddons()->parsedOctet
            ],
            'socketsCount' => [
                'value' => $this->GetSocketsCount()->attributeValue,
                'octet' => $this->GetSocketsCount()->parsedOctet
            ],
            // add the rest of the attributes here
        ];

        return $attributes;
    }

}