<?php
$groupeLettre = 'I';
$groupeEquipesLabel = 'Finlande, Albanie, Biélorussie, Saint-Marin';
$date_maj_page = '2026-09-29';
$classement = [
    ['club' => 'Albanie',      'MJ' => 2, 'G' => 2, 'N' => 0, 'P' => 0, 'DB' => 5, 'Pts' => 6],
    ['club' => 'Finlande',     'MJ' => 2, 'G' => 1, 'N' => 1, 'P' => 0, 'DB' => 7, 'Pts' => 4],
    ['club' => 'Biélorussie',  'MJ' => 2, 'G' => 0, 'N' => 1, 'P' => 1, 'DB' => -2, 'Pts' => 1],
    ['club' => 'Saint-Marin',  'MJ' => 2, 'G' => 0, 'N' => 0, 'P' => 2, 'DB' => -10, 'Pts' => 0],
];
$page_title = 'Ligue des Nations 2026-2027, Groupe I : classement';
$meta_desc  = "Classement du groupe I de la Ligue des Nations 2026-2027 : Finlande, Albanie, Biélorussie, Saint-Marin. Résultats et points après la phase de ligue.";
include __DIR__ . '/templates/ligue-des-nations-groupe-template.php';
