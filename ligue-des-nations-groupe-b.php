<?php
$groupeLettre = 'B';
$groupeEquipesLabel = 'Pays-Bas, Grèce, Allemagne, Serbie';
$date_maj_page = '2026-09-27';
$classement = [
    ['club' => 'Pays-Bas', 'MJ' => 2, 'G' => 1, 'N' => 1, 'P' => 0, 'DB' => 1, 'Pts' => 4],
    ['club' => 'Grèce',    'MJ' => 2, 'G' => 1, 'N' => 1, 'P' => 0, 'DB' => 1, 'Pts' => 4],
    ['club' => 'Allemagne','MJ' => 2, 'G' => 0, 'N' => 2, 'P' => 0, 'DB' => 0, 'Pts' => 2],
    ['club' => 'Serbie',   'MJ' => 2, 'G' => 0, 'N' => 0, 'P' => 2, 'DB' => -2, 'Pts' => 0],
];
$page_title = 'Ligue des Nations 2026-2027, Groupe B : classement';
$meta_desc  = "Classement du groupe B de la Ligue des Nations 2026-2027 : Pays-Bas, Grèce, Allemagne, Serbie. Résultats et points après la phase de ligue.";
include __DIR__ . '/templates/ligue-des-nations-groupe-template.php';
