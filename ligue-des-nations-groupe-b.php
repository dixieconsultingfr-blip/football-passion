<?php
$groupeLettre = 'B';
$groupeEquipesLabel = 'Pays-Bas, Grèce, Allemagne, Serbie';
$date_maj_page = '2026-10-05';
$classement = [
    ['club' => 'Pays-Bas',  'MJ' => 4, 'G' => 2, 'N' => 2, 'P' => 0, 'DB' => 2,  'Pts' => 8],
    ['club' => 'Grèce',     'MJ' => 4, 'G' => 2, 'N' => 2, 'P' => 0, 'DB' => 2,  'Pts' => 8],
    ['club' => 'Allemagne', 'MJ' => 4, 'G' => 1, 'N' => 2, 'P' => 1, 'DB' => 1,  'Pts' => 5],
    ['club' => 'Serbie',    'MJ' => 4, 'G' => 0, 'N' => 0, 'P' => 4, 'DB' => -5, 'Pts' => 0],
];
$page_title = 'Ligue des Nations 2026-2027, Groupe B : classement';
$meta_desc  = "Classement du groupe B de la Ligue des Nations 2026-2027 : Pays-Bas, Grèce, Allemagne, Serbie. Résultats et points après la journée 4.";
include __DIR__ . '/templates/ligue-des-nations-groupe-template.php';
