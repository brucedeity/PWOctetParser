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
    public function GetMinPhysicalDamage()
    {
        $this->parsedOctet = substr($this->octet, $this->pos + 32, 8);
        $this->attributeValue = intval(parent::ToDecimal($this->parsedOctet, 8, 0, true));
        return $this;
    }
    public function GetMaxPhysicalDamage()
    {
        $this->parsedOctet = substr($this->octet, $this->pos + 40, 8);
        $this->attributeValue = intval(parent::ToDecimal($this->parsedOctet, 8, 0, true));
        return $this;
    }
    public function GetMinMagicDamage()
    {
        $this->parsedOctet = substr($this->octet, $this->pos + 48, 8);
        $this->attributeValue = intval(parent::ToDecimal($this->parsedOctet, 8, 0, true));
        return $this;
    }
    public function GetMaxMagicDamage()
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
        // $this->parsedOctet = $this->pos;
        $this->parsedOctet = substr($this->octet, $this->pos + 88, 8);
        // $this->parsedOctet = substr($this->octet, $this->pos + 88, 8);

        $count = parent::ToDecimal($this->parsedOctet, 8, 0, true);

        // Limit max sockets to 4 so it don't give a invalid socket amount if a invalid octet is passed
        $this->attributeValue = $count <= 4 ? $count : 0;
        $this->attributeValue = 2;

        return $this;
    }

    public function GetSockets()
    {
        $socketsCount = $this->GetSocketsCount()->attributeValue;
        if ($socketsCount > 0) {

            $socketsData = [];

            for ($i = 1; $i <= $socketsCount; $i++) {
                $socketsData[$i] = parent::ToDecimal(substr($this->octet, $this->pos + 88 + $i * 8, 8), 8, 0, true);
            }

            $this->attributeValue = $socketsData;
        }
        $this->pos = $this->pos + $socketsCount * 8;

        return $this;
    }

    public function GetAddonCount()
    {
        $this->parsedOctet = substr($this->octet, $this->pos + 96, 8);
        $this->attributeValue = parent::ToDecimal($this->parsedOctet, 8, 0, true);

        return $this;
    }

    public function GetAddons()
    {
        $this->parsedOctet = substr($this->octet, $this->pos + 120, 16);

        $addonsCount = parent::ToDecimal($this->parsedOctet, 16, 0, true);

        if ($addonsCount > 0) {
            $shift = 0;

            for ($i=0; $i < $addonsCount; $i++) {
                $hex = parent::ReverseNumber(substr($this->octet, $this->pos + 104 + $i * 16 + $shift, 8));
                $hex = ltrim($hex, '0');
                $hex = trim($hex);

                // Break out of the loop if $hex is not valid
                // if (!strlen($hex) % 2 == 0)
                //     continue;


                // Get addon type, 2 = normal addon, 4 = special or refine, 'a' = is a socket addon
                $type = substr($hex, 0, 1);

                switch ($type) {
                    case 4:
                        $hexDec = $this->ToDecimal($hex, 8, $type, false);

                        $shift += 8;
                        break;
        
                    case 'a':
        
                        break;
        
                    default:
                        // Normal addon
        
                        // TODO: check the other ocasions with ifs, see the js code
        
                        $addonType = parent::ReverseNumber($hex);

                        $addonId = parent::ToDecimal($hex, 8, $type, false);

                        $addonValue = parent::ToDecimal(substr($this->octet, $this->pos + 104 + $i * 16 + $shift + 8, 8), 8, 0, true);
                        // $addonValue = substr($this->octet, $this->pos + 104 + $i * 16 + $shift + 8, 8);
                        // $addonValue = $this->ToDecimal($hex, 8, $type, false);
                        break;
                }

                // switch ($type) {
                //     case 4:
                //         $hexDec = parent::ToDecimal($hex, 8, $type, false);




                //         break;
                    
                //     default:
                //         # code...
                //         break;
                // }

                $this->attributeValue = [
                    $addonId => $addonValue
                ];

                break;
            }
        }

        // $this->attributeValue = $addonsCount;

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

    public function GetRefineLv()
    {
        //     $RefLv = 0;

        //     $AddonC = parent::ToDecimal(substr($this->octet, $this->pos + 96, 8), 8, 0, true);
        //     if ($AddonC > 0) {
        //         $AHex = NULL;
        //         $tmp = NULL;
        //         $shift = 0;
        //         $AddInd = 0;
        //         $SckInd = 0;
        //         $aType = NULL;
        //         $bAddon = NULL;
        //         $vAddon = NULL;
        //         for ($i = 0; $i < $AddonC; $i++) {
        //             $AHex = parent::ReverseNumber(substr($this->octet, $this->pos + 104 + $i * 16 + $shift, 8));
        //             $AHex = str_replace("^0+", "", trim($AHex));
        //             if (strlen($AHex) % 2 == 0) {
        //                 $aType = substr($AHex, 0, 1);
        //                 if ($aType == "4") {
        //                     $tmp = parent::ToDecimal($AHex, 8, $aType, false);
        //                     if (($tmp > 1691) && ($tmp < 1892)) {
        //                         $RefLv = parent::ToDecimal(substr($this->octet, $this->pos + 104 + $i * 16 + $shift + 16, 8), 8, 0, true);
        //                     } else {
        //                         $AddonId = parent::ToDecimal($AHex, 8, $aType, false);
        //                         if (parent::IsRune($AddonId) !== false) {
        //                             $AddInd++;
        //                             $Addons[$AddInd] = parent::SearchRuneNameValue(1, $AddonId, parent::ToDecimal(substr($this->octet, $this->pos + 104 + $i * 16 + $shift + 8, 8), 8, 0, true) + " " + parent::ToDecimal(substr($this->octet, $this->pos + 104 + $i * 16 + $shift + 16, 8), 8, 0, true));
        //                         } else {
        //                             $AddInd++;
        //                             $Addons[$AddInd] = parent::SearchAddonNameValue(1, $AddonId, parent::ToDecimal(substr($this->octet, $this->pos + 104 + $i * 16 + $shift + 8, 8), 8, 0, true) + " " + parent::ToDecimal(substr($this->octet, $this->pos + 104 + $i * 16 + $shift + 16, 8), 8, 0, true));
        //                         }
        //                     }
        //                     $shift = $shift + 8;
        //                 } else {
        //                     if
        //                 ($aType == "3" || $aType == "2") {
        //                     $SckInd++;
        //                     $Sockets[$SckInd] = parent::SearchSocketNameValue(2, parent::ToDecimal($AHex, 8, $aType, false), $SocketSt[$SckInd]);
        //                 }
        //             }
        //         }
        //     }
        // }

        return $this;
    }

    public function GetAttributes() : array
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
            'minPhysicalDamage' => [
                'value' => $this->GetMinPhysicalDamage()->attributeValue,
                'octet' => $this->GetMinPhysicalDamage()->parsedOctet
            ],
            'maxPhysicalDamage' => [
                'value' => $this->GetMaxPhysicalDamage()->attributeValue,
                'octet' => $this->GetMaxPhysicalDamage()->parsedOctet
            ],
            'minMagicDamage' => [
                'value' => $this->GetMinMagicDamage()->attributeValue,
                'octet' => $this->GetMinMagicDamage()->parsedOctet
            ],
            'maxMagicDamage' => [
                'value' => $this->GetMaxMagicDamage()->attributeValue,
                'octet' => $this->GetMaxMagicDamage()->parsedOctet
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
            'sockets' => [
                'count' => [
                    'value' => $this->GetSocketsCount()->attributeValue,
                    'octet' => $this->GetSocketsCount()->parsedOctet
                ],
                'stones' => $this->GetSockets()->attributeValue
            ],
            'addons' => [
                'count' => [
                    'value' => $this->GetAddonCount()->attributeValue,
                    'octet' => $this->GetAddonCount()->parsedOctet
                ],
                'data' => $this->GetAddons()->attributeValue,
            ],

            'refineLevel' => [
                'value' => $this->GetRefineLv()->attributeValue,
                'octet' => $this->GetRefineLv()->parsedOctet
            ]
        ];

        return $attributes;
    }

}