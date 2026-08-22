<?php
require_once __DIR__ . '/blog/helpers.php';

$matchsAll = json_decode(@file_get_contents(__DIR__ . '/data/matchs.json'), true) ?? [];
$matchsL1  = array_values(array_filter($matchsAll, fn($m) => ($m['competition'] ?? '') === 'L1'));

// ── Classement calculé depuis les résultats FINISHED (pas de saisie manuelle) ──
$termines = array_filter($matchsL1, fn($m) => ($m['status'] ?? '') === 'FINISHED');
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

// ── Derniers résultats : uniquement la dernière journée jouée (numéro de journée si connu, sinon date) ──
$resultats = array_values($termines);
usort($resultats, fn($a, $b) => strcmp($b['date'], $a['date']));
$derniersResultats = [];
$derniereJournee = null;
if (!empty($resultats)) {
    $derniereJournee = $resultats[0]['journee'] ?? null;
    $derniersResultats = $derniereJournee !== null
        ? array_values(array_filter($resultats, fn($m) => ($m['journee'] ?? null) === $derniereJournee))
        : array_values(array_filter($resultats, fn($m) => $m['date'] === $resultats[0]['date']));
}

// ── Matchs en direct ──
$enDirect = array_values(array_filter($matchsL1, fn($m) => ($m['status'] ?? '') === 'LIVE'));

// ── Prochains matchs, groupés par journée si connue, sinon par date ──
$aVenir = array_values(array_filter($matchsL1, fn($m) => !in_array($m['status'] ?? 'SCHEDULED', ['FINISHED', 'LIVE'], true)));
usort($aVenir, fn($a, $b) => strcmp($a['date'] . ($a['heure'] ?? ''), $b['date'] . ($b['heure'] ?? '')));
$aVenir = array_slice($aVenir, 0, 20);
$parJournee = [];
foreach ($aVenir as $m) {
    $cle = $m['journee'] ?? $m['date'];
    $parJournee[$cle][] = $m;
}

// ── Actualités liées ──
$articlesAll = load_articles_index(__DIR__);
$articlesL1  = array_values(array_filter($articlesAll, fn($a) => ($a['categorie'] ?? '') === 'L1'));
usort($articlesL1, fn($a, $b) => strtotime($b['date']) <=> strtotime($a['date']));

$page_title = 'Ligue 1 — Classement, résultats et actualités 2026-2027';
$meta_desc  = "Classement, résultats et pronostics Ligue 1 2026-2027 : calendrier, actualités et infos abonnement pour suivre tout le championnat.";
include __DIR__ . '/templates/header.php';
?>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "SportsEvent",
  "name": "Ligue 1 2026-2027",
  "sport": "Football",
  "url": "https://football-passion.fr/ligue-1.php"
}
</script>

<!-- Breadcrumb -->
<nav class="text-xs text-gray-500 mb-8 flex items-center gap-2">
    <a href="/" class="hover:text-green-400 transition-colors">Accueil</a>
    <span>›</span>
    <span class="text-gray-400">Ligue 1</span>
</nav>

<!-- Hero -->
<header class="mb-10 flex items-center gap-4">
    <span class="inline-flex items-center justify-center w-14 h-14 bg-white rounded-xl p-2 shrink-0">
        <img src="/images/logo/logo-ligue-1.webp" alt="Logo Ligue 1" class="w-full h-full object-contain" />
    </span>
    <div>
        <p class="text-green-400 text-xs font-semibold uppercase tracking-widest mb-1">Championnat de France</p>
        <h1 class="text-4xl font-bold text-white mb-1">Ligue 1</h1>
        <p class="text-gray-400 text-sm">Saison 2026-2027 · Classement, résultats, pronostics et actualités</p>
    </div>
</header>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <!-- Colonne principale : résultats + prochains matchs -->
    <div class="lg:col-span-2 space-y-6">

        <?php if (!empty($enDirect)): ?>
        <!-- En direct -->
        <section class="bg-gray-900/40 border border-red-800/50 rounded-2xl p-5 sm:p-6">
            <div class="flex items-center gap-2 mb-4">
                <span class="relative flex h-2.5 w-2.5">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-500 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-red-500"></span>
                </span>
                <h2 class="text-xl font-bold text-white">En direct</h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <?php foreach ($enDirect as $m): ?>
                <div class="bg-gray-800 border border-red-800/40 rounded-lg p-3 flex items-center justify-between gap-3">
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
                    <div class="text-right text-[11px] text-red-400 font-bold shrink-0 uppercase tracking-wide">En direct</div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
        <?php endif; ?>

        <!-- Derniers résultats -->
        <section class="bg-gray-900/40 border border-gray-800 rounded-2xl p-5 sm:p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-bold text-white">Derniers résultats<?= $derniereJournee !== null ? ' — Journée ' . (int)$derniereJournee : '' ?></h2>
                <a href="/archives.php?comp=L1&amp;saison=2026-2027" class="text-green-400 hover:text-green-300 text-xs font-semibold shrink-0">Historique de la saison →</a>
            </div>
            <?php if (empty($derniersResultats)): ?>
            <div class="bg-gray-800 rounded-xl border border-gray-700 p-8 text-center text-gray-500 text-sm">
                Aucun résultat disponible pour le moment.
            </div>
            <?php else: ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <?php foreach ($derniersResultats as $m): ?>
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
                    <div class="text-right text-xs text-gray-500 shrink-0 leading-snug">
                        Terminé<br><?= date_fr_relatif($m['date']) ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </section>

        <!-- Prochains matchs -->
        <section class="bg-gray-900/40 border border-gray-800 rounded-2xl p-5 sm:p-6">
            <h2 class="text-xl font-bold text-white mb-4">Prochains matchs</h2>
            <?php if (empty($parJournee)): ?>
            <div class="bg-gray-800 rounded-xl border border-gray-700 p-8 text-center text-gray-500 text-sm">
                Aucun match programmé pour le moment.
            </div>
            <?php else: ?>
            <div class="space-y-5">
                <?php foreach ($parJournee as $cle => $matchsJour): ?>
                <div>
                    <p class="text-green-400 text-xs font-semibold uppercase tracking-wider mb-2">
                        <?= ctype_digit((string)$cle) ? 'Journée ' . (int)$cle : date_fr_jour($cle) ?>
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                        <?php foreach ($matchsJour as $m): ?>
                        <div class="bg-gray-800 border border-gray-700 rounded-lg p-3 flex items-center gap-3">
                            <div class="text-gray-500 text-[11px] w-16 shrink-0 leading-tight">
                                <?= date_fr_relatif($m['date']) ?><?= !empty($m['heure']) ? '<br>' . htmlspecialchars($m['heure']) : '' ?>
                            </div>
                            <div class="flex-1 min-w-0 flex items-center justify-center gap-2">
                                <span class="text-white text-sm text-right flex-1 truncate"><?= htmlspecialchars($m['domicile'] ?? '?') ?></span>
                                <span class="text-gray-600 text-xs px-1 shrink-0">vs</span>
                                <span class="text-white text-sm flex-1 truncate"><?= htmlspecialchars($m['exterieur'] ?? '?') ?></span>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </section>

    </div>

    <!-- Colonne latérale : actualités + classement compact -->
    <div class="lg:col-span-1 space-y-6">

        <!-- Actualités liées -->
        <section class="bg-gray-900/40 border border-gray-800 rounded-2xl p-5">
            <h2 class="text-lg font-bold text-white mb-3">Actualités</h2>
            <?php if (empty($articlesL1)): ?>
            <div class="bg-gray-800 rounded-xl border border-gray-700 p-5 text-center text-gray-500 text-xs">
                Aucun article publié pour le moment.
                <a href="/blog" class="text-green-400 hover:text-green-300 block mt-1">Voir tous les articles →</a>
            </div>
            <?php else: ?>
            <div class="space-y-3">
                <?php foreach (array_slice($articlesL1, 0, 4) as $a): ?>
                <a href="/blog/<?= urlencode($a['slug']) ?>" class="flex gap-3 bg-gray-800 border border-gray-700 hover:border-green-600 rounded-lg overflow-hidden transition-colors p-2.5">
                    <?php if (!empty($a['vignette'])): ?>
                    <div class="w-16 h-16 shrink-0 rounded-md overflow-hidden">
                        <img src="<?= htmlspecialchars($a['vignette']) ?>" alt="<?= htmlspecialchars($a['image_alt'] ?? $a['titre']) ?>" class="w-full h-full object-cover" loading="lazy">
                    </div>
                    <?php endif; ?>
                    <div class="min-w-0 flex flex-col justify-center gap-0.5">
                        <p class="text-gray-500 text-[11px]"><?= date('d/m/Y', strtotime($a['date'])) ?></p>
                        <h3 class="text-white font-semibold text-xs leading-snug line-clamp-2"><?= htmlspecialchars($a['titre']) ?></h3>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>
            <a href="/blog?cat=L1" class="block text-center text-green-400 hover:text-green-300 text-xs font-semibold mt-3">Tous les articles L1 →</a>
            <?php endif; ?>
        </section>

        <!-- Classement -->
        <section class="bg-gray-900/40 border border-gray-800 rounded-2xl p-5">
            <h2 class="text-lg font-bold text-white mb-3">Classement</h2>
            <?php if (empty($classement)): ?>
            <div class="bg-gray-800 rounded-xl border border-gray-700 p-6 text-center text-gray-500 text-xs">
                Le classement s'affichera dès les premiers résultats.
            </div>
            <?php else: ?>
            <div class="bg-gray-800 rounded-xl border border-gray-700 overflow-x-auto">
                <table class="w-full text-xs">
                    <thead>
                        <tr class="text-gray-500 uppercase border-b border-gray-700">
                            <th class="text-left px-3 py-2 font-semibold">Club</th>
                            <th class="text-center px-1.5 py-2 font-semibold">MJ</th>
                            <th class="text-center px-1.5 py-2 font-semibold">DB</th>
                            <th class="text-center px-3 py-2 font-semibold text-green-400">Pts</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700/60">
                        <?php foreach ($classement as $i => $c): $rang = $i + 1; ?>
                        <tr class="<?= $rang <= 3 ? 'bg-green-900/10' : ($rang >= count($classement) - 2 ? 'bg-red-900/10' : ($i % 2 === 1 ? 'bg-white/[0.02]' : '')) ?>">
                            <td class="px-3 py-2 text-white font-medium whitespace-nowrap">
                                <span class="text-gray-500 font-normal mr-1.5"><?= $rang ?></span><?= htmlspecialchars($c['club']) ?>
                            </td>
                            <td class="px-1.5 py-2 text-center text-gray-400"><?= $c['MJ'] ?></td>
                            <td class="px-1.5 py-2 text-center text-gray-400"><?= $c['DB'] > 0 ? '+' . $c['DB'] : $c['DB'] ?></td>
                            <td class="px-3 py-2 text-center text-green-400 font-bold"><?= $c['Pts'] ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <p class="text-gray-600 text-[11px] mt-2 italic">Calculé automatiquement à partir des résultats.</p>
            <?php endif; ?>
        </section>

    </div>

</div>

<!-- Liens internes -->
<section class="flex flex-wrap gap-4 justify-center pt-8 pb-4">
    <a href="/ligue-2.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">⚽ Ligue 2</a>
    <a href="/calendrier.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">📅 Calendrier toutes compétitions</a>
    <a href="/archives.php?comp=L1&amp;saison=2026-2027" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">🗂️ Tous les résultats de la Ligue 1</a>
</section>

<?php include __DIR__ . '/templates/footer.php'; ?>
