<?php
function slugify(string $str): string {
    $str = mb_strtolower(trim($str), 'UTF-8');
    $str = strtr($str, [
        'é'=>'e','è'=>'e','ê'=>'e','ë'=>'e',
        'à'=>'a','â'=>'a','ä'=>'a',
        'î'=>'i','ï'=>'i',
        'ô'=>'o','ö'=>'o','œ'=>'oe',
        'û'=>'u','ù'=>'u','ü'=>'u',
        'ç'=>'c','æ'=>'ae','ñ'=>'n',
        "'"=>'-',"''"=>'-'
    ]);
    $str = preg_replace('/[^a-z0-9]+/', '-', $str);
    return trim($str, '-');
}

function date_fr_short(string $date): string {
    $mois = ['','jan','fév','mar','avr','mai','juin','juil','août','sep','oct','nov','déc'];
    $d = new DateTime($date);
    return $d->format('j') . ' ' . $mois[(int)$d->format('n')] . ' ' . $d->format('Y');
}

function date_fr_long(string $date): string {
    $mois = ['','janvier','février','mars','avril','mai','juin','juillet','août','septembre','octobre','novembre','décembre'];
    $d = new DateTime($date);
    return $d->format('j') . ' ' . $mois[(int)$d->format('n')] . ' ' . $d->format('Y');
}

function load_articles(string $basePath): array {
    $raw = @file_get_contents($basePath . '/data/articles.json');
    if (!$raw) return [];
    if (str_starts_with($raw, "\xEF\xBB\xBF")) {
        $raw = substr($raw, 3);
    }
    $articles = json_decode($raw, true) ?? [];
    usort($articles, fn($a, $b) => strcmp($b['date'], $a['date']));
    return $articles;
}
