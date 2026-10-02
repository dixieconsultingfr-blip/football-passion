<?php
$groupeLettre = 'E';
$groupeEquipesLabel = 'Suisse, Slovénie, Écosse, Macédoine du Nord';
$date_maj_page = '2026-09-29';
$classement = [
    ['club' => 'Suisse',             'MJ' => 2, 'G' => 2, 'N' => 0, 'P' => 0, 'DB' => 6, 'Pts' => 6],
    ['club' => 'Slovénie',           'MJ' => 2, 'G' => 1, 'N' => 1, 'P' => 0, 'DB' => 2, 'Pts' => 4],
    ['club' => 'Écosse',             'MJ' => 2, 'G' => 0, 'N' => 1, 'P' => 1, 'DB' => -3, 'Pts' => 1],
    ['club' => 'Macédoine du Nord',  'MJ' => 2, 'G' => 0, 'N' => 0, 'P' => 2, 'DB' => -5, 'Pts' => 0],
];
$page_title = 'Ligue des Nations 2026-2027, Groupe E : classement';
$meta_desc  = "Classement du groupe E de la Ligue des Nations 2026-2027 : Suisse, Slovénie, Écosse, Macédoine du Nord. Résultats et points après la phase de ligue.";
include __DIR__ . '/templates/ligue-des-nations-groupe-template.php';
