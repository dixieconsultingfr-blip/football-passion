<?php
$groupeLettre = 'J';
$groupeEquipesLabel = 'Arménie, Monténégro, Chypre, Lettonie';
$date_maj_page = '2026-10-02';
$classement = [
    ['club' => 'Monténégro', 'MJ' => 3, 'G' => 3, 'N' => 0, 'P' => 0, 'DB' => 3,  'Pts' => 9],
    ['club' => 'Chypre',     'MJ' => 3, 'G' => 1, 'N' => 1, 'P' => 1, 'DB' => 1,  'Pts' => 4],
    ['club' => 'Arménie',    'MJ' => 3, 'G' => 1, 'N' => 0, 'P' => 2, 'DB' => -1, 'Pts' => 3],
    ['club' => 'Lettonie',   'MJ' => 3, 'G' => 0, 'N' => 1, 'P' => 2, 'DB' => -3, 'Pts' => 1],
];
$page_title = 'Ligue des Nations 2026-2027, Groupe J : classement';
$meta_desc  = "Classement du groupe J de la Ligue des Nations 2026-2027 : Arménie, Monténégro, Chypre, Lettonie. Résultats et points après la journée 3.";
include __DIR__ . '/templates/ligue-des-nations-groupe-template.php';
