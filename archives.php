<?php
$competitions = [
    'L1'      => 'Ligue 1',
    'L2'      => 'Ligue 2',
    'CL'      => 'Champions League',
    'Europa'  => 'Europa League',
    'France'  => 'Équipe de France',
];

$archiveDir = __DIR__ . '/data/archives';
$disponibles = [];
if (is_dir($archiveDir)) {
    foreach (glob($archiveDir . '/*.json') as $file) {
        $base = basename($file, '.json');
        if (preg_match('/^([A-Za-z0-9]+)-(\d{4}-\d{4})$/', $base, $mtc)) {
            $disponibles[] = ['competition' => $mtc[1], 'saison' => $mtc[2], 'file' => $file];
        }
    }
}
usort($disponibles, fn($a, $b) => $b['saison'] <=> $a['saison']);

$comp   = $_GET['comp'] ?? '';
$saison = $_GET['saison'] ?? '';

$matchsArchive = [];
if ($comp !== '' && $saison !== '') {
    $slug = preg_match('/^[A-Za-z0-9]+$/', $comp) && preg_match('/^\d{4}-\d{4}$/', $saison) ? "$comp-$saison" : '';
    $file = $slug !== '' ? "$archiveDir/$slug.json" : '';
    if ($file !== '' && is_file($file)) {
        $matchsArchive = json_decode(@file_get_contents($file), true) ?? [];
        usort($matchsArchive, fn($a, $b) => strcmp($b['date'], $a['date']));
    }
}

$page_title = 'Archives — Résultats des saisons précédentes | Football Passion';
$meta_desc  = "Retrouvez les résultats archivés des saisons précédentes : Ligue 1, Ligue 2, Champions League, Europa League et Équipe de France.";
include __DIR__ . '/templates/header.php';
?>

<!-- Breadcrumb -->
<nav class="text-xs text-gray-500 mb-8 flex items-center gap-2">
    <a href="/" class="hover:text-green-400 transition-colors">Accueil</a>
    <span>›</span>
    <a href="/calendrier.php" class="hover:text-green-400 transition-colors">Calendrier</a>
    <span>›</span>
    <span class="text-gray-400">Archives</span>
</nav>

<header class="mb-8">
    <h1 class="text-4xl font-bold text-white mb-2">Archives</h1>
    <p class="text-gray-400 text-sm">Résultats des saisons précédentes, par compétition.</p>
</header>

<?php if (empty($disponibles)): ?>
<div class="bg-gray-800 rounded-xl border border-gray-700 p-8 text-center text-gray-500 text-sm">
    Aucune saison archivée pour le moment.<br>
    <span class="text-gray-600 text-xs">Les résultats sont archivés automatiquement une fois la saison terminée.</span>
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
    Sélectionnez une compétition et une saison ci-dessus pour afficher les résultats archivés.
</div>
<?php elseif (empty($matchsArchive)): ?>
<div class="bg-gray-800 rounded-xl border border-gray-700 p-8 text-center text-gray-500 text-sm">
    Aucun résultat archivé pour cette sélection.
</div>
<?php else: ?>
<h2 class="text-2xl font-bold text-white mb-5"><?= htmlspecialchars($competitions[$comp] ?? $comp) ?> — Saison <?= htmlspecialchars($saison) ?></h2>
<div class="space-y-3">
    <?php foreach ($matchsArchive as $m): ?>
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

<section class="flex flex-wrap gap-4 justify-center pb-4 pt-8">
    <a href="/calendrier.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">📅 Calendrier en cours</a>
    <a href="/blog" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">📰 Tous les articles</a>
</section>

<?php include __DIR__ . '/templates/footer.php'; ?>
