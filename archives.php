<?php
require_once __DIR__ . '/blog/helpers.php';

$competitions = [
    'L1'         => 'Ligue 1',
    'L2'         => 'Ligue 2',
    'CL'         => 'Champions League',
    'Europa'     => 'Europa League',
    'Conference' => 'Ligue Conférence',
    'France'     => 'Équipe de France',
];

$archiveDir = __DIR__ . '/data/archives';

// ── Combinaisons déjà archivées (matchs.json purgé, saison terminée depuis >45 jours) ──
$disponibles = [];
if (is_dir($archiveDir)) {
    foreach (glob($archiveDir . '/*.json') as $file) {
        $base = basename($file, '.json');
        if (preg_match('/^([A-Za-z0-9]+)-(\d{4}-\d{4})$/', $base, $mtc)) {
            $disponibles[$mtc[1] . '-' . $mtc[2]] = ['competition' => $mtc[1], 'saison' => $mtc[2]];
        }
    }
}

// ── Combinaisons encore actives dans matchs.json (saison en cours, pas encore archivée) ──
$matchsAll = json_decode(@file_get_contents(__DIR__ . '/data/matchs.json'), true) ?? [];
$matchsFinis = array_values(array_filter($matchsAll, fn($m) => ($m['status'] ?? '') === 'FINISHED'));
foreach ($matchsFinis as $m) {
    $comp = $m['competition'] ?? '';
    if ($comp === '') { continue; }
    $s = $m['saison'] ?? saison_fr($m['date']);
    $disponibles[$comp . '-' . $s] = ['competition' => $comp, 'saison' => $s];
}

$disponibles = array_values($disponibles);
usort($disponibles, fn($a, $b) => $b['saison'] <=> $a['saison'] ?: strcmp($a['competition'], $b['competition']));

$comp   = $_GET['comp'] ?? '';
$saison = $_GET['saison'] ?? '';

$matchsAffiches = [];
if ($comp !== '' && $saison !== '' && preg_match('/^[A-Za-z0-9]+$/', $comp) && preg_match('/^\d{4}-\d{4}$/', $saison)) {
    // Partie déjà archivée (le cas échéant)
    $archiveFile = "$archiveDir/$comp-$saison.json";
    $depuisArchive = is_file($archiveFile) ? (json_decode(@file_get_contents($archiveFile), true) ?? []) : [];

    // Partie encore dans matchs.json (résultats récents de la saison en cours)
    $depuisMatchsJson = array_values(array_filter($matchsFinis, function ($m) use ($comp, $saison) {
        $s = $m['saison'] ?? saison_fr($m['date']);
        return ($m['competition'] ?? '') === $comp && $s === $saison;
    }));

    // Fusion sans doublon (par id)
    $idsVus = [];
    foreach (array_merge($depuisArchive, $depuisMatchsJson) as $m) {
        $idsVus[$m['id']] = $m;
    }
    $matchsAffiches = array_values($idsVus);

    // Tri : par journée si disponible, sinon par date, plus récent en premier
    usort($matchsAffiches, function ($a, $b) {
        $ja = $a['journee'] ?? null;
        $jb = $b['journee'] ?? null;
        if ($ja !== null && $jb !== null && $ja !== $jb) { return $jb <=> $ja; }
        return strcmp($b['date'], $a['date']);
    });
}

$page_title = 'Archives — Historique des résultats par saison | Football Passion';
$meta_desc  = "Historique complet des résultats par saison et par compétition : Ligue 1, Ligue 2, Champions League, Europa League et Équipe de France.";
include __DIR__ . '/templates/header.php';
?>

<!-- Breadcrumb -->
<nav class="text-xs text-gray-400 mb-8 flex items-center gap-2">
    <a href="/" class="hover:text-green-400 transition-colors">Accueil</a>
    <span>›</span>
    <a href="/calendrier.php" class="hover:text-green-400 transition-colors">Calendrier</a>
    <span>›</span>
    <span class="text-gray-400">Archives</span>
</nav>

<header class="mb-8">
    <h1 class="text-4xl font-bold text-white mb-2">Archives</h1>
    <p class="text-gray-400 text-sm">Historique des résultats, saison par saison, compétition par compétition.</p>
</header>

<?php if (empty($disponibles)): ?>
<div class="bg-gray-800 rounded-xl border border-gray-700 p-8 text-center text-gray-500 text-sm">
    Aucun résultat disponible pour le moment.
</div>
<?php else: ?>

<!-- Sélecteur saison/compétition -->
<div class="flex flex-wrap gap-2 mb-10">
    <?php foreach ($disponibles as $d): ?>
    <a href="/archives.php?comp=<?= urlencode($d['competition']) ?>&saison=<?= urlencode($d['saison']) ?>"
       class="px-4 py-1.5 text-xs font-semibold rounded-full border transition-colors <?= ($comp === $d['competition'] && $saison === $d['saison']) ? 'bg-green-700 text-white border-green-700' : 'border-gray-600 text-gray-400 hover:border-green-600 hover:text-green-400' ?>">
        <?= htmlspecialchars($competitions[$d['competition']] ?? $d['competition']) ?> — <?= htmlspecialchars($d['saison']) ?>
    </a>
    <?php endforeach; ?>
</div>

<?php if ($comp === '' || $saison === ''): ?>
<div class="bg-gray-800 rounded-xl border border-gray-700 p-8 text-center text-gray-500 text-sm">
    Sélectionnez une compétition et une saison ci-dessus pour afficher l'historique des résultats.
</div>
<?php elseif (empty($matchsAffiches)): ?>
<div class="bg-gray-800 rounded-xl border border-gray-700 p-8 text-center text-gray-500 text-sm">
    Aucun résultat pour cette sélection.
</div>
<?php else: ?>
<h2 class="text-2xl font-bold text-white mb-5"><?= htmlspecialchars($competitions[$comp] ?? $comp) ?> — Saison <?= htmlspecialchars($saison) ?></h2>

<?php
// Regroupement par journée si disponible, sinon par tour (qualifs/barrages), sinon liste simple
$parJournee = null;
$parTour    = null;
if (($matchsAffiches[0]['journee'] ?? null) !== null) {
    $parJournee = [];
    foreach ($matchsAffiches as $m) {
        $parJournee[$m['journee'] ?? 0][] = $m;
    }
} elseif (!empty(array_filter($matchsAffiches, fn($m) => !empty($m['tour'])))) {
    $parTour = [];
    foreach ($matchsAffiches as $m) {
        $parTour[$m['tour'] ?? 'Phase de groupes'][] = $m;
    }
}
?>

<?php if ($parJournee !== null): ?>
<div class="space-y-6">
    <?php foreach ($parJournee as $num => $matchsJournee): ?>
    <div>
        <p class="text-green-400 text-xs font-semibold uppercase tracking-wider mb-2">Journée <?= (int)$num ?></p>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            <?php foreach ($matchsJournee as $m): ?>
            <div class="bg-gray-800 border border-gray-700 rounded-lg p-3 flex items-center justify-between gap-3">
                <div class="flex-1 min-w-0 space-y-1.5">
                    <div class="flex justify-between items-center gap-2 text-sm">
                        <span class="text-white truncate"><?= htmlspecialchars($m['domicile'] ?? '?') ?></span>
                        <span class="text-white font-bold shrink-0"><?= $m['score_dom'] ?? '-' ?></span>
                    </div>
                    <div class="flex justify-between items-center gap-2 text-sm">
                        <span class="text-white truncate"><?= htmlspecialchars($m['exterieur'] ?? '?') ?></span>
                        <span class="text-white font-bold shrink-0"><?= $m['score_ext'] ?? '-' ?></span>
                    </div>
                </div>
                <div class="text-gray-500 text-xs shrink-0"><?= date('d/m/Y', strtotime($m['date'])) ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<?php elseif ($parTour !== null): ?>
<div class="space-y-6">
    <?php foreach ($parTour as $libelle => $matchsTour): ?>
    <div>
        <p class="text-green-400 text-xs font-semibold uppercase tracking-wider mb-2"><?= htmlspecialchars($libelle) ?></p>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            <?php foreach ($matchsTour as $m): ?>
            <div class="bg-gray-800 border border-gray-700 rounded-lg p-3 flex items-center justify-between gap-3">
                <div class="flex-1 min-w-0 space-y-1.5">
                    <div class="flex justify-between items-center gap-2 text-sm">
                        <span class="text-white truncate"><?= htmlspecialchars($m['domicile'] ?? '?') ?></span>
                        <span class="text-white font-bold shrink-0"><?= $m['score_dom'] ?? '-' ?></span>
                    </div>
                    <div class="flex justify-between items-center gap-2 text-sm">
                        <span class="text-white truncate"><?= htmlspecialchars($m['exterieur'] ?? '?') ?></span>
                        <span class="text-white font-bold shrink-0"><?= $m['score_ext'] ?? '-' ?></span>
                    </div>
                </div>
                <div class="text-gray-500 text-xs shrink-0"><?= date('d/m/Y', strtotime($m['date'])) ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<?php else: ?>
<div class="space-y-3">
    <?php foreach ($matchsAffiches as $m): ?>
    <div class="bg-gray-800 border border-gray-700 rounded-xl p-4 flex flex-col sm:flex-row sm:items-center gap-3 sm:gap-6">
        <div class="text-gray-500 text-xs sm:w-32 shrink-0"><?= date('d/m/Y', strtotime($m['date'])) ?></div>
        <div class="flex-1 flex items-center justify-center gap-3">
            <span class="text-white font-semibold text-sm text-right flex-1"><?= htmlspecialchars($m['domicile'] ?? '?') ?></span>
            <span class="text-green-400 font-bold text-sm px-2"><?= $m['score_dom'] ?? '-' ?> – <?= $m['score_ext'] ?? '-' ?></span>
            <span class="text-white font-semibold text-sm flex-1"><?= htmlspecialchars($m['exterieur'] ?? '?') ?></span>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<?php endif; ?>
<?php endif; ?>
<?php endif; ?>

<section class="flex flex-wrap gap-4 justify-center pb-4 pt-8">
    <a href="/calendrier.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">📅 Calendrier en cours</a>
    <a href="/blog" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">📰 Tous les articles</a>
</section>

<?php include __DIR__ . '/templates/footer.php'; ?>
