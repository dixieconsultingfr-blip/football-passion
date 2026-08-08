<?php
require_once __DIR__ . '/blog/helpers.php';

$matchsAll = json_decode(@file_get_contents(__DIR__ . '/data/matchs.json'), true) ?? [];
$matchsL2  = array_values(array_filter($matchsAll, fn($m) => ($m['competition'] ?? '') === 'L2'));

// ── Classement calculé depuis les résultats FINISHED (pas de saisie manuelle) ──
$termines = array_filter($matchsL2, fn($m) => ($m['status'] ?? '') === 'FINISHED');
$table = [];
foreach ($termines as $m) {
    foreach ([
        ['equipe' => $m['domicile'] ?? '?', 'bp' => $m['score_dom'] ?? 0, 'bc' => $m['score_ext'] ?? 0],
        ['equipe' => $m['exterieur'] ?? '?', 'bp' => $m['score_ext'] ?? 0, 'bc' => $m['score_dom'] ?? 0],
    ] as $c) {
        $eq = $c['equipe'];
        if (!isset($table[$eq])) {
            $table[$eq] = ['club' => $eq, 'MJ' => 0, 'G' => 0, 'N' => 0, 'P' => 0, 'BP' => 0, 'BC' => 0];
        }
        $table[$eq]['MJ']++;
        $table[$eq]['BP'] += $c['bp'];
        $table[$eq]['BC'] += $c['bc'];
        if ($c['bp'] > $c['bc'])      { $table[$eq]['G']++; }
        elseif ($c['bp'] === $c['bc']) { $table[$eq]['N']++; }
        else                            { $table[$eq]['P']++; }
    }
}
foreach ($table as &$t) {
    $t['DB']  = $t['BP'] - $t['BC'];
    $t['Pts'] = $t['G'] * 3 + $t['N'];
}
unset($t);
$classement = array_values($table);
usort($classement, fn($a, $b) =>
    $b['Pts'] <=> $a['Pts']
    ?: $b['DB'] <=> $a['DB']
    ?: $b['BP'] <=> $a['BP']
    ?: strcmp($a['club'], $b['club'])
);

// ── Prochains matchs ──
$aVenir = array_values(array_filter($matchsL2, fn($m) => ($m['status'] ?? 'SCHEDULED') !== 'FINISHED'));
usort($aVenir, fn($a, $b) => strcmp($a['date'] . ($a['heure'] ?? ''), $b['date'] . ($b['heure'] ?? '')));

// ── Actualités liées ──
$articlesAll = load_articles_index(__DIR__);
$articlesL2  = array_values(array_filter($articlesAll, fn($a) => ($a['categorie'] ?? '') === 'L2'));
usort($articlesL2, fn($a, $b) => strtotime($b['date']) <=> strtotime($a['date']));

$page_title = 'Ligue 2 — Classement, résultats et actualités 2026-2027';
$meta_desc  = "Classement en direct de la Ligue 2 2026-2027, calendrier des résultats et prochains matchs, actualités du championnat.";
include __DIR__ . '/templates/header.php';
?>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "SportsEvent",
  "name": "Ligue 2 2026-2027",
  "sport": "Football",
  "url": "https://football-passion.fr/ligue-2.php"
}
</script>

<!-- Breadcrumb -->
<nav class="text-xs text-gray-500 mb-8 flex items-center gap-2">
    <a href="/" class="hover:text-green-400 transition-colors">Accueil</a>
    <span>›</span>
    <span class="text-gray-400">Ligue 2</span>
</nav>

<!-- Hero -->
<header class="mb-10 flex items-center gap-4">
    <span class="inline-flex items-center justify-center w-14 h-14 bg-white rounded-xl p-2 shrink-0">
        <img src="/images/logo/logo-ligue-2.png" alt="Logo Ligue 2" class="w-full h-full object-contain" />
    </span>
    <div>
        <p class="text-green-400 text-xs font-semibold uppercase tracking-widest mb-1">Championnat de France</p>
        <h1 class="text-4xl font-bold text-white mb-1">Ligue 2</h1>
        <p class="text-gray-400 text-sm">Saison 2026-2027 · Classement, résultats et actualités</p>
    </div>
</header>

<!-- Classement -->
<section class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-4">Classement</h2>
    <?php if (empty($classement)): ?>
    <div class="bg-gray-800 rounded-xl border border-gray-700 p-8 text-center text-gray-500 text-sm">
        Le classement s'affichera dès les premiers résultats de la saison.
    </div>
    <?php else: ?>
    <div class="bg-gray-800 rounded-xl border border-gray-700 overflow-x-auto">
        <table class="w-full text-sm min-w-[520px]">
            <thead>
                <tr class="text-gray-500 text-xs uppercase border-b border-gray-700">
                    <th class="text-left px-4 py-3 font-semibold">#</th>
                    <th class="text-left px-2 py-3 font-semibold">Club</th>
                    <th class="text-center px-2 py-3 font-semibold">MJ</th>
                    <th class="text-center px-2 py-3 font-semibold">G</th>
                    <th class="text-center px-2 py-3 font-semibold">N</th>
                    <th class="text-center px-2 py-3 font-semibold">P</th>
                    <th class="text-center px-2 py-3 font-semibold">BP</th>
                    <th class="text-center px-2 py-3 font-semibold">BC</th>
                    <th class="text-center px-2 py-3 font-semibold">Diff.</th>
                    <th class="text-center px-4 py-3 font-semibold text-green-400">Pts</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-700">
                <?php foreach ($classement as $i => $c): $rang = $i + 1; ?>
                <tr class="<?= $rang <= 3 ? 'bg-green-900/10' : ($rang >= count($classement) - 2 ? 'bg-red-900/10' : '') ?>">
                    <td class="px-4 py-2.5 text-gray-500 font-semibold"><?= $rang ?></td>
                    <td class="px-2 py-2.5 text-white font-semibold"><?= htmlspecialchars($c['club']) ?></td>
                    <td class="px-2 py-2.5 text-center text-gray-400"><?= $c['MJ'] ?></td>
                    <td class="px-2 py-2.5 text-center text-gray-400"><?= $c['G'] ?></td>
                    <td class="px-2 py-2.5 text-center text-gray-400"><?= $c['N'] ?></td>
                    <td class="px-2 py-2.5 text-center text-gray-400"><?= $c['P'] ?></td>
                    <td class="px-2 py-2.5 text-center text-gray-400"><?= $c['BP'] ?></td>
                    <td class="px-2 py-2.5 text-center text-gray-400"><?= $c['BC'] ?></td>
                    <td class="px-2 py-2.5 text-center text-gray-400"><?= $c['DB'] > 0 ? '+' . $c['DB'] : $c['DB'] ?></td>
                    <td class="px-4 py-2.5 text-center text-green-400 font-bold"><?= $c['Pts'] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <p class="text-gray-600 text-xs mt-2 italic">Classement calculé automatiquement à partir des résultats enregistrés.</p>
    <?php endif; ?>
</section>

<!-- Prochains matchs -->
<section class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-5">Prochains matchs</h2>
    <?php if (empty($aVenir)): ?>
    <div class="bg-gray-800 rounded-xl border border-gray-700 p-8 text-center text-gray-500 text-sm">
        Aucun match programmé pour le moment.
    </div>
    <?php else: ?>
    <div class="space-y-3">
        <?php foreach (array_slice($aVenir, 0, 10) as $m): ?>
        <div class="bg-gray-800 border border-gray-700 rounded-xl p-4 flex flex-col sm:flex-row sm:items-center gap-3 sm:gap-6">
            <div class="text-gray-500 text-xs sm:w-32 shrink-0">
                <?= date('d/m/Y', strtotime($m['date'])) ?><?= !empty($m['heure']) ? ' · ' . htmlspecialchars($m['heure']) : '' ?>
            </div>
            <div class="flex-1 flex items-center justify-center gap-3">
                <span class="text-white font-semibold text-sm text-right flex-1"><?= htmlspecialchars($m['domicile'] ?? '?') ?></span>
                <span class="text-gray-600 text-xs px-2">vs</span>
                <span class="text-white font-semibold text-sm flex-1"><?= htmlspecialchars($m['exterieur'] ?? '?') ?></span>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</section>

<!-- Actualités liées -->
<section class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-5">Actualités — Ligue 2</h2>
    <?php if (empty($articlesL2)): ?>
    <div class="bg-gray-800 rounded-xl border border-gray-700 p-6 text-center text-gray-500 text-sm">
        Aucun article publié pour le moment dans cette catégorie.
        <a href="/blog" class="text-green-400 hover:text-green-300 ml-1">Voir tous les articles →</a>
    </div>
    <?php else: ?>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
        <?php foreach (array_slice($articlesL2, 0, 6) as $a): ?>
        <a href="/blog?slug=<?= urlencode($a['slug']) ?>" class="flex flex-col bg-gray-800 border border-gray-700 hover:border-green-600 rounded-xl overflow-hidden transition-colors">
            <?php if (!empty($a['vignette'])): ?>
            <div class="relative overflow-hidden" style="aspect-ratio:16/9;">
                <img src="<?= htmlspecialchars($a['vignette']) ?>" alt="<?= htmlspecialchars($a['image_alt'] ?? $a['titre']) ?>" class="w-full h-full object-cover" loading="lazy">
            </div>
            <?php endif; ?>
            <div class="p-4 flex flex-col gap-2 flex-1">
                <p class="text-gray-500 text-xs"><?= date('d/m/Y', strtotime($a['date'])) ?></p>
                <h3 class="text-white font-semibold text-sm leading-snug"><?= htmlspecialchars($a['titre']) ?></h3>
                <p class="text-gray-400 text-xs leading-relaxed flex-1"><?= htmlspecialchars($a['extrait']) ?></p>
            </div>
        </a>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</section>

<!-- Liens internes -->
<section class="flex flex-wrap gap-4 justify-center pb-4">
    <a href="/calendrier.php?comp=L2" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">📅 Calendrier complet</a>
    <a href="/blog?cat=L2" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">📰 Tous les articles L2</a>
    <a href="/archives.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">🗂️ Archives des saisons</a>
</section>

<?php include __DIR__ . '/templates/footer.php'; ?>
