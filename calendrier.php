<?php
require_once __DIR__ . '/blog/helpers.php';

$matchsAll = json_decode(@file_get_contents(__DIR__ . '/data/matchs.json'), true) ?? [];

$competitions = [
    'L1'         => 'Ligue 1',
    'L2'         => 'Ligue 2',
    'CL'         => 'Champions League',
    'Europa'     => 'Europa League',
    'Conference' => 'Ligue Conférence',
    'France'     => 'Équipe de France',
];

$logosCompetitions = [
    'L1'         => '/images/logo/logo-ligue-1.webp',
    'L2'         => '/images/logo/logo-ligue-2.png',
    'CL'         => '/images/logo/logo-champions-league.webp',
    'Europa'     => '/images/logo/logo-europa-league.webp',
    'Conference' => '/images/logo/logo-conference-uefa.png',
];

$filtre = $_GET['comp'] ?? '';
$matchsFiltres = $filtre
    ? array_values(array_filter($matchsAll, fn($m) => ($m['competition'] ?? '') === $filtre))
    : $matchsAll;

$aVenir = array_values(array_filter($matchsFiltres, fn($m) => ($m['status'] ?? 'SCHEDULED') !== 'FINISHED'));
usort($aVenir, fn($a, $b) => strcmp($a['date'] . ($a['heure'] ?? ''), $b['date'] . ($b['heure'] ?? '')));

$termines = array_values(array_filter($matchsFiltres, fn($m) => ($m['status'] ?? '') === 'FINISHED'));
usort($termines, fn($a, $b) => strcmp($b['date'], $a['date']));

$page_title = 'Calendrier — Ligue 1, Ligue 2, Champions League, Europa League, Équipe de France';
$meta_desc  = "Calendrier et résultats en direct : Ligue 1, Ligue 2, Champions League, Europa League et Équipe de France, mis à jour automatiquement.";
include __DIR__ . '/templates/header.php';
?>

<!-- Breadcrumb -->
<nav class="text-xs text-gray-500 mb-8 flex items-center gap-2">
    <a href="/" class="hover:text-green-400 transition-colors">Accueil</a>
    <span>›</span>
    <span class="text-gray-400">Calendrier</span>
</nav>

<header class="mb-8">
    <div class="flex items-center gap-3 mb-2">
        <h1 class="text-4xl font-bold text-white">Calendrier</h1>
        <?php if ($filtre): ?>
        <span class="bg-gray-800 border border-green-700 text-green-400 text-xs font-semibold px-3 py-1 rounded-full">
            Saison <?= htmlspecialchars(saison_fr(date('Y-m-d'))) ?>
        </span>
        <?php endif; ?>
    </div>
    <p class="text-gray-400 text-sm">Prochains matchs et derniers résultats, toutes compétitions confondues.</p>
</header>

<!-- Filtres compétition -->
<div class="flex flex-wrap gap-2 mb-10">
    <a href="/calendrier.php" class="px-4 py-1.5 text-xs font-semibold rounded-full border transition-colors <?= $filtre === '' ? 'bg-green-700 text-white border-green-700' : 'border-gray-600 text-gray-400 hover:border-green-600 hover:text-green-400' ?>">
        Tout
    </a>
    <?php foreach ($competitions as $code => $label): ?>
    <a href="/calendrier.php?comp=<?= urlencode($code) ?>" class="flex items-center gap-1.5 px-4 py-1.5 text-xs font-semibold rounded-full border transition-colors <?= $filtre === $code ? 'bg-green-700 text-white border-green-700' : 'border-gray-600 text-gray-400 hover:border-green-600 hover:text-green-400' ?>">
        <?php if (!empty($logosCompetitions[$code])): ?>
        <span class="inline-flex items-center justify-center w-4 h-4 bg-white rounded-full p-0.5 shrink-0">
            <img src="<?= htmlspecialchars($logosCompetitions[$code]) ?>" alt="" class="w-full h-full object-contain" loading="lazy" />
        </span>
        <?php endif; ?>
        <?= htmlspecialchars($label) ?>
    </a>
    <?php endforeach; ?>
</div>

<!-- Prochains matchs -->
<section class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-5">Prochains matchs</h2>

    <?php if (empty($aVenir)): ?>
    <div class="bg-gray-800 rounded-xl border border-gray-700 p-8 text-center text-gray-500 text-sm">
        Aucun match programmé pour le moment dans cette sélection.<br>
        <span class="text-gray-600 text-xs">Le calendrier se met à jour automatiquement dès que les compétitions reprennent.</span>
    </div>
    <?php else: ?>
    <div class="space-y-3">
        <?php foreach (array_slice($aVenir, 0, 15) as $m): ?>
        <div class="bg-gray-800 border border-gray-700 rounded-xl p-4 flex flex-col sm:flex-row sm:items-center gap-3 sm:gap-6">
            <div class="text-gray-500 text-xs sm:w-32 shrink-0">
                <?= date('d/m/Y', strtotime($m['date'])) ?><?= !empty($m['heure']) ? ' · ' . htmlspecialchars($m['heure']) : '' ?>
            </div>
            <div class="flex-1 flex flex-col items-center justify-center gap-1">
                <?php if (!empty($m['tour'])): ?>
                <span class="text-gray-500 text-[11px] uppercase tracking-wide"><?= htmlspecialchars($m['tour']) ?></span>
                <?php elseif (!empty($m['journee'])): ?>
                <span class="text-gray-500 text-[11px] uppercase tracking-wide">Journée <?= (int)$m['journee'] ?></span>
                <?php endif; ?>
                <div class="flex items-center justify-center gap-3 w-full">
                    <span class="text-white font-semibold text-sm text-right flex-1"><?= htmlspecialchars($m['domicile'] ?? '?') ?></span>
                    <span class="text-gray-600 text-xs px-2">vs</span>
                    <span class="text-white font-semibold text-sm flex-1"><?= htmlspecialchars($m['exterieur'] ?? '?') ?></span>
                </div>
            </div>
            <div class="flex items-center gap-1.5 justify-start sm:justify-end sm:w-28 shrink-0">
                <?php if (!empty($logosCompetitions[$m['competition'] ?? ''])): ?>
                <span class="inline-flex items-center justify-center w-4 h-4 bg-white rounded-full p-0.5 shrink-0">
                    <img src="<?= htmlspecialchars($logosCompetitions[$m['competition']]) ?>" alt="" class="w-full h-full object-contain" loading="lazy" />
                </span>
                <?php endif; ?>
                <span class="text-green-500 text-xs font-semibold uppercase">
                    <?= htmlspecialchars($competitions[$m['competition'] ?? ''] ?? ($m['competition'] ?? '')) ?>
                </span>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</section>

<!-- Derniers résultats -->
<section class="mb-8">
    <h2 class="text-2xl font-bold text-white mb-5">Derniers résultats</h2>

    <?php if (empty($termines)): ?>
    <div class="bg-gray-800 rounded-xl border border-gray-700 p-8 text-center text-gray-500 text-sm">
        Aucun résultat disponible pour le moment dans cette sélection.
    </div>
    <?php else: ?>
    <div class="space-y-3">
        <?php foreach (array_slice($termines, 0, 15) as $m): ?>
        <div class="bg-gray-800 border border-gray-700 rounded-xl p-4 flex flex-col sm:flex-row sm:items-center gap-3 sm:gap-6">
            <div class="text-gray-500 text-xs sm:w-32 shrink-0"><?= date('d/m/Y', strtotime($m['date'])) ?></div>
            <div class="flex-1 flex flex-col items-center justify-center gap-1">
                <?php if (!empty($m['tour'])): ?>
                <span class="text-gray-500 text-[11px] uppercase tracking-wide"><?= htmlspecialchars($m['tour']) ?></span>
                <?php elseif (!empty($m['journee'])): ?>
                <span class="text-gray-500 text-[11px] uppercase tracking-wide">Journée <?= (int)$m['journee'] ?></span>
                <?php endif; ?>
                <div class="flex items-center justify-center gap-3 w-full">
                    <span class="text-white font-semibold text-sm text-right flex-1"><?= htmlspecialchars($m['domicile'] ?? '?') ?></span>
                    <span class="text-green-400 font-bold text-sm px-2"><?= $m['score_dom'] ?? '-' ?> – <?= $m['score_ext'] ?? '-' ?></span>
                    <span class="text-white font-semibold text-sm flex-1"><?= htmlspecialchars($m['exterieur'] ?? '?') ?></span>
                </div>
            </div>
            <div class="flex items-center gap-1.5 justify-start sm:justify-end sm:w-28 shrink-0">
                <?php if (!empty($logosCompetitions[$m['competition'] ?? ''])): ?>
                <span class="inline-flex items-center justify-center w-4 h-4 bg-white rounded-full p-0.5 shrink-0">
                    <img src="<?= htmlspecialchars($logosCompetitions[$m['competition']]) ?>" alt="" class="w-full h-full object-contain" loading="lazy" />
                </span>
                <?php endif; ?>
                <span class="text-gray-500 text-xs font-semibold uppercase">
                    <?= htmlspecialchars($competitions[$m['competition'] ?? ''] ?? ($m['competition'] ?? '')) ?>
                </span>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</section>

<!-- Liens internes -->
<section class="flex flex-wrap gap-4 justify-center pb-4">
    <a href="/equipe-france.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">🇫🇷 Équipe de France</a>
    <a href="/euro.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">🏆 Euro 2028</a>
    <a href="/blog" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">📰 Tous les articles</a>
    <a href="/archives.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">🗂️ Archives des saisons</a>
</section>

<?php include __DIR__ . '/templates/footer.php'; ?>
