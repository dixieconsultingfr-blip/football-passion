<?php
$groupeLettre = 'L';
$groupeEquipesLabel = 'Luxembourg, Islande, Estonie, Bulgarie';
$date_maj_page = '2026-09-29';
$classement = [
    ['club' => 'Islande',    'MJ' => 2, 'G' => 1, 'N' => 1, 'P' => 0, 'DB' => 3, 'Pts' => 4],
    ['club' => 'Luxembourg', 'MJ' => 2, 'G' => 1, 'N' => 0, 'P' => 1, 'DB' => -2, 'Pts' => 3],
    ['club' => 'Estonie',    'MJ' => 2, 'G' => 0, 'N' => 2, 'P' => 0, 'DB' => 0, 'Pts' => 2],
    ['club' => 'Bulgarie',   'MJ' => 2, 'G' => 0, 'N' => 1, 'P' => 1, 'DB' => -1, 'Pts' => 1],
];
$page_title = 'Ligue des Nations 2026-2027, Groupe L : classement';
$meta_desc  = "Classement du groupe L de la Ligue des Nations 2026-2027 : Luxembourg, Islande, Estonie, Bulgarie. Résultats et points après la phase de ligue.";
include __DIR__ . '/templates/ligue-des-nations-groupe-template.php';
