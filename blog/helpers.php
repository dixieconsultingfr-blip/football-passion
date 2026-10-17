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

// Renseigne le numéro de journée manquant (matchs de L1 synchronisés par n8n, qui n'envoie pas de champ "journee").
// Numéro = rang du match pour l'équipe la plus avancée, en parcourant les matchs dans l'ordre chronologique.
// Un champ "journee" déjà présent est conservé. L'ordre du tableau d'entrée est préservé.
function completer_journees(array $matchs): array {
    $idx = array_keys($matchs);
    usort($idx, fn($a, $b) => strcmp(($matchs[$a]['date'] ?? '') . ($matchs[$a]['heure'] ?? ''), ($matchs[$b]['date'] ?? '') . ($matchs[$b]['heure'] ?? '')));
    $rang = [];
    foreach ($idx as $i) {
        $dom = $matchs[$i]['domicile'] ?? '';
        $ext = $matchs[$i]['exterieur'] ?? '';
        $n = !empty($matchs[$i]['journee']) ? (int)$matchs[$i]['journee'] : max($rang[$dom] ?? 0, $rang[$ext] ?? 0) + 1;
        if (empty($matchs[$i]['journee'])) { $matchs[$i]['journee'] = $n; }
        $rang[$dom] = $n;
        $rang[$ext] = $n;
    }
    return $matchs;
}

// "vendredi 25 septembre" (sans année, jour de la semaine en minuscule) — pour les phrases de diffusion.
function date_fr_jour_court(string $date): string {
    $jours = ['dimanche','lundi','mardi','mercredi','jeudi','vendredi','samedi'];
    $mois  = ['','janvier','février','mars','avril','mai','juin','juillet','août','septembre','octobre','novembre','décembre'];
    $d = new DateTime($date);
    return $jours[(int)$d->format('w')] . ' ' . $d->format('j') . ' ' . $mois[(int)$d->format('n')];
}

// Bloc SEO "À quelle heure et sur quelle chaîne ?" généré depuis le prochain match (liste $aVenir triée par date).
// $chaine : diffuseur (ex. "Ligue 1+"), $precision : complément affiché après la chaîne (facultatif).
function bloc_diffusion_prochains_matchs(array $aVenir, string $competition, string $chaine, string $precision = ''): string {
    if (empty($aVenir)) { return ''; }
    $prochain = $aVenir[0];
    $heure = !empty($prochain['heure']) ? ' à ' . str_replace(':', 'h', $prochain['heure']) : '';
    $j = $prochain['journee'] ?? null;
    $memeJournee = $j !== null ? array_values(array_filter($aVenir, fn($m) => ($m['journee'] ?? null) === $j)) : [$prochain];
    $dates = array_column($memeJournee, 'date');
    $h = fn(string $s) => htmlspecialchars($s, ENT_QUOTES, 'UTF-8');

    $out  = '<div class="mt-6 pt-5 border-t border-gray-700">';
    $out .= '<h3 class="text-white font-semibold text-sm mb-2">À quelle heure et sur quelle chaîne regarder les prochains matchs de ' . $h($competition) . ' ?</h3>';
    $out .= '<p class="text-gray-400 text-sm leading-relaxed">Le prochain match de ' . $h($competition) . ' est <strong class="text-white">'
          . $h($prochain['domicile'] ?? '?') . ' - ' . $h($prochain['exterieur'] ?? '?') . '</strong>, ' . $h(date_fr_jour_court($prochain['date'])) . $h($heure)
          . ', en direct sur <strong class="text-white">' . $h($chaine) . '</strong>.';
    if ($j !== null && count($memeJournee) > 1) {
        $debut = min($dates); $fin = max($dates);
        $periode = $debut === $fin ? 'le ' . date_fr_jour_court($debut) : 'du ' . date_fr_jour_court($debut) . ' au ' . date_fr_jour_court($fin);
        $out .= ' Les ' . count($memeJournee) . ' rencontres restantes de la journée ' . (int)$j . ' se jouent ' . $h($periode) . ', toutes diffusées sur ' . $h($chaine) . ($precision !== '' ? ' (' . $h($precision) . ')' : '') . '.';
    } elseif ($precision !== '') {
        $out .= ' Diffusion sur ' . $h($chaine) . ' (' . $h($precision) . ').';
    }
    $out .= '</p>';
    $out .= '<p class="text-gray-600 text-xs mt-2">Horaires et diffuseur susceptibles d\'évoluer. Pour comparer les abonnements, consultez notre <a href="/droits-tv-football.php" class="underline hover:text-gray-400">guide des droits TV</a>.</p>';
    $out .= '</div>';
    return $out;
}
