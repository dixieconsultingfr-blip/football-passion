<?php
$groupeLettre = 'L';
$groupeEquipesLabel = 'Luxembourg, Islande, Estonie, Bulgarie';
$date_maj_page = '2026-10-07';
$classement = [
    ['club' => 'Islande',    'MJ' => 4, 'G' => 2, 'N' => 2, 'P' => 0, 'DB' => 6,  'Pts' => 8],
    ['club' => 'Estonie',    'MJ' => 4, 'G' => 1, 'N' => 3, 'P' => 0, 'DB' => 1,  'Pts' => 6],
    ['club' => 'Bulgarie',   'MJ' => 4, 'G' => 1, 'N' => 1, 'P' => 2, 'DB' => -2, 'Pts' => 4],
    ['club' => 'Luxembourg', 'MJ' => 4, 'G' => 1, 'N' => 0, 'P' => 3, 'DB' => -5, 'Pts' => 3],
];
$page_title = 'Ligue des Nations 2026-2027, Groupe L : classement';
$meta_desc  = "Classement du groupe L de la Ligue des Nations 2026-2027 : Luxembourg, Islande, Estonie, Bulgarie. Résultats et points après la journée 4.";
include __DIR__ . '/templates/ligue-des-nations-groupe-template.php';
