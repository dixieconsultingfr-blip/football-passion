<?php
$groupeLettre = 'F';
$groupeEquipesLabel = 'Ukraine, Irlande du Nord, Géorgie, Hongrie';
$date_maj_page = '2026-09-27';
$classement = [
    ['club' => 'Ukraine',         'MJ' => 1, 'G' => 1, 'N' => 0, 'P' => 0, 'DB' => 1, 'Pts' => 3],
    ['club' => 'Irlande du Nord', 'MJ' => 1, 'G' => 1, 'N' => 0, 'P' => 0, 'DB' => 1, 'Pts' => 3],
    ['club' => 'Géorgie',         'MJ' => 1, 'G' => 0, 'N' => 0, 'P' => 1, 'DB' => -1, 'Pts' => 0],
    ['club' => 'Hongrie',         'MJ' => 1, 'G' => 0, 'N' => 0, 'P' => 1, 'DB' => -1, 'Pts' => 0],
];
$page_title = 'Ligue des Nations 2026-2027, Groupe F : classement';
$meta_desc  = "Classement du groupe F de la Ligue des Nations 2026-2027 : Ukraine, Irlande du Nord, Géorgie, Hongrie. Résultats et points après la phase de ligue.";
include __DIR__ . '/templates/ligue-des-nations-groupe-template.php';
