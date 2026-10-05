<?php
$groupeLettre = 'J';
$groupeEquipesLabel = 'Arménie, Monténégro, Chypre, Lettonie';
$date_maj_page = '2026-10-05';
$classement = [
    ['club' => 'Monténégro', 'MJ' => 3, 'G' => 3, 'N' => 0, 'P' => 0, 'DB' => 3,  'Pts' => 9],
    ['club' => 'Chypre',     'MJ' => 4, 'G' => 2, 'N' => 1, 'P' => 1, 'DB' => 2,  'Pts' => 7],
    ['club' => 'Arménie',    'MJ' => 3, 'G' => 1, 'N' => 0, 'P' => 2, 'DB' => -1, 'Pts' => 3],
    ['club' => 'Lettonie',   'MJ' => 4, 'G' => 0, 'N' => 1, 'P' => 3, 'DB' => -4, 'Pts' => 1],
];
$page_title = 'Ligue des Nations 2026-2027, Groupe J : classement';
$meta_desc  = "Classement du groupe J de la Ligue des Nations 2026-2027 : Arménie, Monténégro, Chypre, Lettonie. Résultats et points à jour.";
include __DIR__ . '/templates/ligue-des-nations-groupe-template.php';
