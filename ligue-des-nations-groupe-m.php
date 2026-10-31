<?php
$groupeLettre = 'M';
$groupeEquipesLabel = 'Malte, Gibraltar, Andorre';
$date_maj_page = '2026-10-05';
$classement = [
    ['club' => 'Malte',     'MJ' => 3, 'G' => 2, 'N' => 1, 'P' => 0, 'DB' => 2,  'Pts' => 7],
    ['club' => 'Gibraltar', 'MJ' => 2, 'G' => 0, 'N' => 2, 'P' => 0, 'DB' => 0,  'Pts' => 2],
    ['club' => 'Andorre',   'MJ' => 3, 'G' => 0, 'N' => 1, 'P' => 2, 'DB' => -2, 'Pts' => 1],
];
$page_title = 'Ligue des Nations 2026-2027, Groupe M : classement';
$meta_desc  = "Classement du groupe M de la Ligue des Nations 2026-2027 : Malte, Gibraltar, Andorre. Résultats et points après la journée 4.";
include __DIR__ . '/templates/ligue-des-nations-groupe-template.php';
