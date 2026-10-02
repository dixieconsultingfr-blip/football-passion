<?php
$groupeLettre = 'C';
$groupeEquipesLabel = 'Espagne, Croatie, Angleterre, Tchéquie';
$date_maj_page = '2026-09-29';
$classement = [
    ['club' => 'Espagne',    'MJ' => 2, 'G' => 2, 'N' => 0, 'P' => 0, 'DB' => 4, 'Pts' => 6],
    ['club' => 'Angleterre', 'MJ' => 2, 'G' => 1, 'N' => 0, 'P' => 1, 'DB' => 1, 'Pts' => 3],
    ['club' => 'Croatie',    'MJ' => 2, 'G' => 1, 'N' => 0, 'P' => 1, 'DB' => -2, 'Pts' => 3],
    ['club' => 'Tchéquie',   'MJ' => 2, 'G' => 0, 'N' => 0, 'P' => 2, 'DB' => -3, 'Pts' => 0],
];
$page_title = 'Ligue des Nations 2026-2027, Groupe C : classement';
$meta_desc  = "Classement du groupe C de la Ligue des Nations 2026-2027 : Espagne, Croatie, Angleterre, Tchéquie. Résultats et points après la phase de ligue.";
include __DIR__ . '/templates/ligue-des-nations-groupe-template.php';
