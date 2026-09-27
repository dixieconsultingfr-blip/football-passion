<?php
$groupeLettre = 'I';
$groupeEquipesLabel = 'Finlande, Albanie, Biélorussie, Saint-Marin';
$date_maj_page = '2026-09-27';
$classement = [
    ['club' => 'Finlande',     'MJ' => 1, 'G' => 1, 'N' => 0, 'P' => 0, 'DB' => 7, 'Pts' => 3],
    ['club' => 'Albanie',      'MJ' => 1, 'G' => 1, 'N' => 0, 'P' => 0, 'DB' => 2, 'Pts' => 3],
    ['club' => 'Biélorussie',  'MJ' => 1, 'G' => 0, 'N' => 0, 'P' => 1, 'DB' => -2, 'Pts' => 0],
    ['club' => 'Saint-Marin',  'MJ' => 1, 'G' => 0, 'N' => 0, 'P' => 1, 'DB' => -7, 'Pts' => 0],
];
$page_title = 'Ligue des Nations 2026-2027, Groupe I : classement';
$meta_desc  = "Classement du groupe I de la Ligue des Nations 2026-2027 : Finlande, Albanie, Biélorussie, Saint-Marin. Résultats et points après la phase de ligue.";
include __DIR__ . '/templates/ligue-des-nations-groupe-template.php';
