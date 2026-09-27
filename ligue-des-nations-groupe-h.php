<?php
$groupeLettre = 'H';
$groupeEquipesLabel = 'Suède, Bosnie-Herzégovine, Pologne, Roumanie';
$date_maj_page = '2026-09-27';
$classement = [
    ['club' => 'Suède',              'MJ' => 1, 'G' => 1, 'N' => 0, 'P' => 0, 'DB' => 1, 'Pts' => 3],
    ['club' => 'Bosnie-Herzégovine', 'MJ' => 1, 'G' => 0, 'N' => 1, 'P' => 0, 'DB' => 0, 'Pts' => 1],
    ['club' => 'Pologne',            'MJ' => 1, 'G' => 0, 'N' => 1, 'P' => 0, 'DB' => 0, 'Pts' => 1],
    ['club' => 'Roumanie',           'MJ' => 1, 'G' => 0, 'N' => 0, 'P' => 1, 'DB' => -1, 'Pts' => 0],
];
$page_title = 'Ligue des Nations 2026-2027, Groupe H : classement';
$meta_desc  = "Classement du groupe H de la Ligue des Nations 2026-2027 : Suède, Bosnie-Herzégovine, Pologne, Roumanie. Résultats et points après la phase de ligue.";
include __DIR__ . '/templates/ligue-des-nations-groupe-template.php';
