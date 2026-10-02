<?php
$groupeLettre = 'B';
$groupeEquipesLabel = 'Pays-Bas, Grèce, Allemagne, Serbie';
$date_maj_page = '2026-10-02';
$classement = [
    ['club' => 'Grèce',     'MJ' => 3, 'G' => 2, 'N' => 1, 'P' => 0, 'DB' => 2,  'Pts' => 7],
    ['club' => 'Pays-Bas',  'MJ' => 3, 'G' => 1, 'N' => 2, 'P' => 0, 'DB' => 1,  'Pts' => 5],
    ['club' => 'Allemagne', 'MJ' => 3, 'G' => 1, 'N' => 1, 'P' => 1, 'DB' => 1,  'Pts' => 4],
    ['club' => 'Serbie',    'MJ' => 3, 'G' => 0, 'N' => 0, 'P' => 3, 'DB' => -4, 'Pts' => 0],
];
$page_title = 'Ligue des Nations 2026-2027, Groupe B : classement';
$meta_desc  = "Classement du groupe B de la Ligue des Nations 2026-2027 : Pays-Bas, Grèce, Allemagne, Serbie. Résultats et points après la journée 3.";
include __DIR__ . '/templates/ligue-des-nations-groupe-template.php';
