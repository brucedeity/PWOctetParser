<?php

require_once '../vendor/autoload.php';

use BruceDeity\OctetReader\OctetParser;
use BruceDeity\OctetReader\Weapon;
use BruceDeity\OctetReader\Fashion;
use BruceDeity\OctetReader\Jewelry;
use BruceDeity\OctetReader\Armor;

$octet = $_POST['octet'];
$type = $_POST['type'];

switch ($type) {
    case "Weapon":
        $item = new Weapon($octet);
        $output = $item->GetAttributes();
        break;
    case "Fashion":
        $item = new Fashion($octet);
        $output = $item->GetAttributes();
        break;
    case "Jewelry":
        $item = new Jewelry($octet);
        $output = $item->GetAttributes();
        break;
    case "Armor":
        $item = new Armor($octet);
        $output = $item->GetAttributes();
        break;
    default:
        $output = "Invalid type";
}


$attributes = $item->GetAttributes();
echo json_encode($attributes);
