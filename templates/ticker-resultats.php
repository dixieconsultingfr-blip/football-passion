<?php
/**
 * Bandeau défilant : derniers articles (option) puis derniers résultats.
 * Sources : data/matchs.json (L1, L2, L3, coupes d'Europe) et data/resultats-selections.json
 * (résultats saisis à la main : CAN, Ligue des Nations...).
 *
 * Variables attendues avant l'include :
 *   $tickerComps    (array)  ex. ['L1'] ou ['L1', 'L2', 'L3']
 *   $tickerLabel    (string) libellé de gauche
 *   $tickerLink     (string) lien du libellé
 *   $tickerLimit    (int)    nombre de matchs par compétition (défaut 9)
 * Options :
 *   $tickerGlobal   (int)    mode « accueil » : garde les N derniers matchs de chaque compétition de $tickerComps
 *                            (et des sélections), triés du plus récent au plus ancien
 *   $tickerArticles (int)    nombre d'articles récents affichés en tête du bandeau
 *   $tickerArtCats  (array)  si défini : seuls les articles de ces catégories ou étiquettes (ex. ['L1'], ['CAN', 'CAN 2027'])
 */
$tickerLimit = $tickerLimit ?? 9;
$tickerAll = json_decode(@file_get_contents(__DIR__ . '/../data/matchs.json'), true) ?? [];
$tickerSelections = json_decode(@file_get_contents(__DIR__ . '/../data/resultats-selections.json'), true) ?? [];
$tickerCourt = [
    'AS Monaco FC' => 'Monaco', 'Angers SCO' => 'Angers', 'ES Troyes AC' => 'Troyes', 'FC Lorient' => 'Lorient', 'Le Havre AC' => 'Le Havre',
    'Le Mans FC' => 'Le Mans', 'Lille OSC' => 'Lille', 'OGC Nice' => 'Nice', 'Olympique Lyonnais' => 'Lyon', 'Olympique de Marseille' => 'OM',
    'Paris Saint-Germain FC' => 'PSG', 'RC Strasbourg Alsace' => 'Strasbourg', 'Racing Club de Lens' => 'Lens', 'Stade Brestois 29' => 'Brest',
    'Stade Rennais FC 1901' => 'Rennes', 'Toulouse FC' => 'Toulouse', 'AJ Auxerre' => 'Auxerre',
];
$tickerEtiquettes = ['CL' => 'C1', 'Europa' => 'C3', 'Conference' => 'C4'];
$tickerLiens = [
    'L1' => '/ligue-1.php#resultats', 'L2' => '/ligue-2.php#resultats', 'L3' => '/ligue-3.php#resultats',
    'CL' => '/champions-league.php', 'Europa' => '/europa-league.php', 'Conference' => '/conference-league.php',
    'LDN' => '/ligue-des-nations.php', 'CAN' => '/can-2027.php#classements',
];
$tickerPriorite = ['LDN' => 0, 'CAN' => 1, 'CL' => 2, 'Europa' => 3, 'Conference' => 4, 'L1' => 5, 'L2' => 6, 'L3' => 7];

// Tous les matchs terminés des sources
$tickerPool = [];
foreach ($tickerAll as $m) {
    if (($m['status'] ?? '') === 'FINISHED' && $m['score_dom'] !== null && $m['score_ext'] !== null) {
        $tickerPool[] = $m + ['heure' => ''];
    }
}
foreach ($tickerSelections as $m) { $tickerPool[] = $m + ['heure' => '']; }
if (isset($tickerGlobal)) {
    $tickerComps = array_merge($tickerComps, ['LDN', 'CAN']);
}

$tickerItems = [];
foreach ($tickerComps as $comp) {
    $f = array_values(array_filter($tickerPool, fn($m) => ($m['competition'] ?? '') === $comp));
    usort($f, fn($a, $b) => strcmp($b['date'] . $b['heure'], $a['date'] . $a['heure']));
    $n = isset($tickerGlobal) ? (int) $tickerGlobal : $tickerLimit;
    foreach (array_slice($f, 0, $n) as $m) {
        $tickerItems[] = [
            'etiquette' => $tickerEtiquettes[$comp] ?? $comp,
            'comp' => $comp,
            'date' => $m['date'] . $m['heure'],
            'dom' => $tickerCourt[$m['domicile']] ?? $m['domicile'],
            'sd' => (int) $m['score_dom'], 'se' => (int) $m['score_ext'],
            'ext' => $tickerCourt[$m['exterieur']] ?? $m['exterieur'],
        ];
    }
}
if (isset($tickerGlobal)) {
    usort($tickerItems, function ($a, $b) use ($tickerPriorite) {
        $c = strcmp($b['date'], $a['date']);
        return $c !== 0 ? $c : (($tickerPriorite[$a['comp']] ?? 9) <=> ($tickerPriorite[$b['comp']] ?? 9));
    });
}

// Derniers articles (même tri que la liste de l'accueil : mise à jour sinon création, puis id décroissant)
$tickerArts = [];
if (!empty($tickerArticles)) {
    $arts = load_articles_index(__DIR__ . '/..');
    if (!empty($tickerArtCats)) {
        $arts = array_values(array_filter($arts, fn($a) => in_array($a['categorie'] ?? '', $tickerArtCats, true) || array_intersect($tickerArtCats, $a['etiquettes'] ?? [])));
    }
    usort($arts, function ($a, $b) {
        $c = strcmp($b['date_maj'] ?? $b['date'], $a['date_maj'] ?? $a['date']);
        return $c !== 0 ? $c : ($b['id'] <=> $a['id']);
    });
    $tickerArts = array_slice($arts, 0, (int) $tickerArticles);
}

if (!empty($tickerItems)):
    $tickerMulti = isset($tickerGlobal) || count($tickerComps) > 1;
    $tickerDuree = max(40, (count($tickerItems) + 3 * count($tickerArts)) * 6);
?>
<style>
.res-ticker{overflow:hidden;white-space:nowrap}
.res-track{display:inline-flex;animation:res-scroll linear infinite}
.res-ticker:hover .res-track{animation-play-state:paused}
@keyframes res-scroll{from{transform:translateX(0)}to{transform:translateX(-50%)}}
@media (prefers-reduced-motion:reduce){.res-ticker{overflow-x:auto}.res-track{animation:none}}
</style>
<div class="mb-6 flex items-stretch bg-gray-800 border border-green-800 rounded-lg overflow-hidden text-sm" role="region" aria-label="<?= htmlspecialchars($tickerLabel) ?>">
    <a href="<?= htmlspecialchars($tickerLink) ?>" class="shrink-0 bg-green-700 hover:bg-green-600 text-white font-semibold px-3 py-2 text-xs sm:text-sm flex items-center transition-colors"><?= htmlspecialchars($tickerLabel) ?></a>
    <div class="res-ticker flex-1 py-2">
        <div class="res-track" style="animation-duration:<?= $tickerDuree ?>s">
            <?php for ($i = 0; $i < 2; $i++): $aria = $i ? ' aria-hidden="true" tabindex="-1"' : ''; ?>
            <span class="inline-flex items-center gap-6 pr-6">
                <?php foreach ($tickerArts as $a): ?>
                <a href="/blog/<?= urlencode($a['slug']) ?>" class="text-gray-100 hover:text-green-300"<?= $aria ?>><span class="text-green-400 text-xs font-semibold mr-1">📰 À LA UNE</span><?= htmlspecialchars($a['titre_court'] ?? (mb_strlen($a['titre']) > 48 ? rtrim(mb_substr($a['titre'], 0, mb_strrpos(mb_substr($a['titre'], 0, 48), ' ') ?: 48), ' ,:-') . '…' : $a['titre'])) ?></a>
                <?php endforeach; ?>
                <?php foreach ($tickerItems as $r): ?>
                <a href="<?= htmlspecialchars($tickerLiens[$r['comp']] ?? $tickerLink) ?>" class="text-gray-300 hover:text-white"<?= $aria ?>><?php if ($tickerMulti): ?><em class="not-italic text-green-400 text-xs font-semibold mr-1"><?= htmlspecialchars($r['etiquette']) ?></em><?php endif; ?><?= htmlspecialchars($r['dom']) ?> <strong class="text-white"><?= $r['sd'] ?>-<?= $r['se'] ?></strong> <?= htmlspecialchars($r['ext']) ?></a>
                <?php endforeach; ?>
            </span>
            <?php endfor; ?>
        </div>
    </div>
</div>
<?php endif; ?>
