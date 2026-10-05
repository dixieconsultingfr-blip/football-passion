<?php
$groupeLettre = 'L';
$groupeEquipesLabel = 'Luxembourg, Islande, Estonie, Bulgarie';
$date_maj_page = '2026-10-05';
$classement = [
    ['club' => 'Islande',    'MJ' => 3, 'G' => 2, 'N' => 1, 'P' => 0, 'DB' => 6,  'Pts' => 7],
    ['club' => 'Estonie',    'MJ' => 3, 'G' => 1, 'N' => 2, 'P' => 0, 'DB' => 1,  'Pts' => 5],
    ['club' => 'Luxembourg', 'MJ' => 3, 'G' => 1, 'N' => 0, 'P' => 2, 'DB' => -3, 'Pts' => 3],
    ['club' => 'Bulgarie',   'MJ' => 3, 'G' => 0, 'N' => 1, 'P' => 2, 'DB' => -4, 'Pts' => 1],
];
$page_title = 'Ligue des Nations 2026-2027, Groupe L : classement';
$meta_desc  = "Classement du groupe L de la Ligue des Nations 2026-2027 : Luxembourg, Islande, Estonie, Bulgarie. Résultats et points après la journée 3.";
include __DIR__ . '/templates/ligue-des-nations-groupe-template.php';
