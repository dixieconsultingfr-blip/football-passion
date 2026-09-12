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

function date_fr_jour(string $date): string {
    $jours = ['dimanche','lundi','mardi','mercredi','jeudi','vendredi','samedi'];
    $d = new DateTime($date);
    $jour = ucfirst($jours[(int)$d->format('w')]);
    return $jour . ' ' . date_fr_long($date);
}

function saison_fr(string $date): string {
    $d = new DateTime($date);
    $mois = (int)$d->format('n');
    $annee = (int)$d->format('Y');
    return $mois >= 7 ? "$annee-" . ($annee + 1) : ($annee - 1) . "-$annee";
}

function date_fr_relatif(string $date): string {
    $today = new DateTime('today');
    $d = new DateTime($date);
    $diff = (int)$today->diff($d)->format('%r%a');
    if ($diff === 0)  { return "Aujourd'hui"; }
    if ($diff === -1) { return 'Hier'; }
    if ($diff === 1)  { return 'Demain'; }
    return date_fr_long($date);
}

function load_articles_index(string $basePath): array {
    $raw = @file_get_contents($basePath . '/data/articles-index.json');
    if (!$raw) return [];
    if (str_starts_with($raw, "\xEF\xBB\xBF")) {
        $raw = substr($raw, 3);
    }
    $articles = json_decode($raw, true) ?? [];
    usort($articles, fn($a, $b) => strcmp($b['date'], $a['date']));
    return $articles;
}

function load_article(string $basePath, string $slug): ?array {
    if (!preg_match('/^[a-z0-9-]+$/', $slug)) return null;
    $file = $basePath . '/data/articles/' . $slug . '.json';
    if (!is_file($file)) return null;
    $raw = @file_get_contents($file);
    if (!$raw) return null;
    if (str_starts_with($raw, "\xEF\xBB\xBF")) {
        $raw = substr($raw, 3);
    }
    return json_decode($raw, true) ?: null;
}

function load_joueurs(string $basePath): array {
    $raw = @file_get_contents($basePath . '/data/joueurs.json');
    if (!$raw) return [];
    if (str_starts_with($raw, "\xEF\xBB\xBF")) {
        $raw = substr($raw, 3);
    }
    return json_decode($raw, true) ?? [];
}

function load_joueur(string $basePath, string $slug): ?array {
    if (!preg_match('/^[a-z0-9-]+$/', $slug)) return null;
    foreach (load_joueurs($basePath) as $j) {
        if (($j['slug'] ?? '') === $slug) return $j;
    }
    return null;
}
