<?php
$groupeLettre = 'M';
$groupeEquipesLabel = 'Malte, Gibraltar, Andorre';
$date_maj_page = '2026-09-27';
$classement = [
    ['club' => 'Malte',     'MJ' => 1, 'G' => 1, 'N' => 0, 'P' => 0, 'DB' => 1, 'Pts' => 3],
    ['club' => 'Gibraltar', 'MJ' => 1, 'G' => 0, 'N' => 1, 'P' => 0, 'DB' => 0, 'Pts' => 1],
    ['club' => 'Andorre',   'MJ' => 2, 'G' => 0, 'N' => 1, 'P' => 1, 'DB' => -1, 'Pts' => 1],
];
$page_title = 'Ligue des Nations 2026-2027, Groupe M : classement';
$meta_desc  = "Classement du groupe M de la Ligue des Nations 2026-2027 : Malte, Gibraltar, Andorre. Résultats et points après la phase de ligue.";
include __DIR__ . '/templates/ligue-des-nations-groupe-template.php';
