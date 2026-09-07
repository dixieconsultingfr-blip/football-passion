<?php
require_once __DIR__ . '/blog/helpers.php';

$matchsAll = json_decode(@file_get_contents(__DIR__ . '/data/matchs.json'), true) ?? [];
$matchsCE  = array_values(array_filter($matchsAll, fn($m) => ($m['competition'] ?? '') === 'Conference'));

// ── Derniers résultats : la dernière date jouée ──
$termines = array_values(array_filter($matchsCE, fn($m) => ($m['status'] ?? '') === 'FINISHED'));
usort($termines, fn($a, $b) => strcmp($b['date'], $a['date']));
$derniereDate = $termines[0]['date'] ?? null;
$derniersResultats = $derniereDate !== null
    ? array_values(array_filter($termines, fn($m) => $m['date'] === $derniereDate))
    : [];

// ── Prochains matchs, groupés par date ──
$enDirect = array_values(array_filter($matchsCE, fn($m) => ($m['status'] ?? '') === 'LIVE'));
$aVenir = array_values(array_filter($matchsCE, fn($m) => !in_array($m['status'] ?? 'SCHEDULED', ['FINISHED', 'LIVE'], true)));
usort($aVenir, fn($a, $b) => strcmp($a['date'] . ($a['heure'] ?? ''), $b['date'] . ($b['heure'] ?? '')));
$aVenir = array_slice($aVenir, 0, 20);
$parDate = [];
foreach ($aVenir as $m) {
    $parDate[$m['date']][] = $m;
}

// ── Classement de la phase de ligue (format 36 équipes, 6 matchs chacun) ──
// La Ligue Conférence utilise le même format Swiss que la CL et l'EL, mais avec
// seulement 6 journées (contre 8). Compétition non synchronisée automatiquement
// par n8n (voir CLAUDE.md) : saisie manuelle requise.
$matchsPhaseLigue = array_values(array_filter($matchsCE, fn($m) => ($m['date'] ?? '') >= '2026-10-15'));
$termines2 = array_filter($matchsPhaseLigue, fn($m) => ($m['status'] ?? '') === 'FINISHED');
$tableCE = [];
foreach ($matchsPhaseLigue as $m) {
    foreach ([$m['domicile'] ?? null, $m['exterieur'] ?? null] as $eq) {
        if ($eq !== null && !isset($tableCE[$eq])) {
            $tableCE[$eq] = ['club' => $eq, 'MJ' => 0, 'G' => 0, 'N' => 0, 'P' => 0, 'BP' => 0, 'BC' => 0];
        }
    }
}
foreach ($termines2 as $m) {
    foreach ([
        ['equipe' => $m['domicile'] ?? '?', 'bp' => $m['score_dom'] ?? 0, 'bc' => $m['score_ext'] ?? 0],
        ['equipe' => $m['exterieur'] ?? '?', 'bp' => $m['score_ext'] ?? 0, 'bc' => $m['score_dom'] ?? 0],
    ] as $c) {
        $eq = $c['equipe'];
        $tableCE[$eq]['MJ']++;
        $tableCE[$eq]['BP'] += $c['bp'];
        $tableCE[$eq]['BC'] += $c['bc'];
        if ($c['bp'] > $c['bc'])       { $tableCE[$eq]['G']++; }
        elseif ($c['bp'] === $c['bc']) { $tableCE[$eq]['N']++; }
        else                            { $tableCE[$eq]['P']++; }
    }
}
foreach ($tableCE as &$t) {
    $t['DB']  = $t['BP'] - $t['BC'];
    $t['Pts'] = $t['G'] * 3 + $t['N'];
}
unset($t);
$classementCE = array_values($tableCE);
usort($classementCE, fn($a, $b) =>
    $b['Pts'] <=> $a['Pts']
    ?: $b['DB'] <=> $a['DB']
    ?: $b['BP'] <=> $a['BP']
    ?: strcmp($a['club'], $b['club'])
);

// ── Actualités liées ──
$articlesAll = load_articles_index(__DIR__);
$articlesCE  = array_values(array_filter($articlesAll, fn($a) =>
    ($a['categorie'] ?? '') === 'Conference' || in_array('Ligue Conférence', $a['etiquettes'] ?? [])
));
usort($articlesCE, fn($a, $b) => strtotime($b['date']) <=> strtotime($a['date']));

$page_title = 'Ligue Conférence — Résultats et actualités 2026-2027';
$meta_desc  = "Résultats et calendrier de la Ligue Europa Conférence 2026-2027 : phase de ligue, classement et actualités.";
include __DIR__ . '/templates/header.php';
?>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "SportsEvent",
  "name": "UEFA Europa Conference League 2026-2027",
  "sport": "Football",
  "url": "https://football-passion.fr/conference-league.php"
}
</script>

<!-- Breadcrumb -->
<nav class="text-xs text-gray-400 mb-8 flex items-center gap-2">
    <a href="/" class="hover:text-green-400 transition-colors">Accueil</a>
    <span>›</span>
    <span class="text-gray-400">Ligue Conférence</span>
</nav>

<!-- Hero -->
<header class="mb-10 flex items-center gap-4">
    <span class="inline-flex items-center justify-center w-14 h-14 bg-white rounded-xl p-2 shrink-0">
        <img src="/images/logo/logo-conference-uefa.png" alt="Logo Ligue Europa Conférence" class="w-full h-full object-contain" />
    </span>
    <div>
        <p class="text-green-400 text-xs font-semibold uppercase tracking-widest mb-1">Coupe d'Europe</p>
        <h1 class="text-4xl font-bold text-white mb-1">Ligue Europa Conférence</h1>
        <p class="text-gray-400 text-sm">Saison 2026-2027 · Résultats et actualités</p>
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
                            <span class="text-white leading-tight"><?= htmlspecialchars($m['domicile'] ?? '?') ?></span>
                            <span class="text-white font-bold shrink-0"><?= $m['score_dom'] ?? '-' ?></span>
                        </div>
                        <div class="flex justify-between items-center gap-2 text-sm">
                            <span class="text-white leading-tight"><?= htmlspecialchars($m['exterieur'] ?? '?') ?></span>
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
                <h2 class="text-xl font-bold text-white">Derniers résultats</h2>
                <a href="/archives.php?comp=Conference&amp;saison=2026-2027" class="text-green-400 hover:text-green-300 text-xs font-semibold shrink-0">Historique de la saison →</a>
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
                            <span class="text-white leading-tight"><?= htmlspecialchars($m['domicile'] ?? '?') ?></span>
                            <span class="text-white font-bold shrink-0"><?= $m['score_dom'] ?? '-' ?></span>
                        </div>
                        <div class="flex justify-between items-center gap-2 text-sm">
                            <span class="text-white leading-tight"><?= htmlspecialchars($m['exterieur'] ?? '?') ?></span>
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
            <?php if (empty($parDate)): ?>
            <div class="bg-gray-800 rounded-xl border border-gray-700 p-8 text-center text-gray-500 text-sm">
                Aucun match programmé pour le moment.
            </div>
            <?php else: ?>
            <div class="space-y-5">
                <?php foreach ($parDate as $date => $matchsJour): ?>
                <div>
                    <p class="text-green-400 text-xs font-semibold uppercase tracking-wider mb-2"><?= date_fr_jour($date) ?></p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                        <?php foreach ($matchsJour as $m): ?>
                        <div class="bg-gray-800 border border-gray-700 rounded-lg p-3 flex items-center gap-3">
                            <?php if (!empty($m['heure'])): ?>
                            <div class="text-gray-500 text-xs w-10 shrink-0"><?= htmlspecialchars($m['heure']) ?></div>
                            <?php endif; ?>
                            <div class="flex-1 min-w-0 flex items-center justify-center gap-2">
                                <span class="text-white text-sm text-right flex-1 leading-tight"><?= htmlspecialchars($m['domicile'] ?? '?') ?></span>
                                <span class="text-gray-600 text-xs px-1 shrink-0">vs</span>
                                <span class="text-white text-sm flex-1 leading-tight"><?= htmlspecialchars($m['exterieur'] ?? '?') ?></span>
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

    <!-- Colonne latérale : actualités -->
    <div class="lg:col-span-1 space-y-6">

        <!-- Actualités liées -->
        <section class="bg-gray-900/40 border border-gray-800 rounded-2xl p-5">
            <h2 class="text-lg font-bold text-white mb-3">Actualités</h2>
            <?php if (empty($articlesCE)): ?>
            <div class="bg-gray-800 rounded-xl border border-gray-700 p-5 text-center text-gray-500 text-xs">
                Aucun article publié pour le moment.
                <a href="/blog" class="text-green-400 hover:text-green-300 block mt-1">Voir tous les articles →</a>
            </div>
            <?php else: ?>
            <div class="space-y-3">
                <?php foreach (array_slice($articlesCE, 0, 6) as $a): ?>
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
            <a href="/blog?cat=Conference" class="block text-center text-green-400 hover:text-green-300 text-xs font-semibold mt-3">Tous les articles Ligue Conférence →</a>
            <?php endif; ?>
        </section>

    </div>

</div>

<!-- Classement phase de ligue -->
<section class="mb-10">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-2xl font-bold text-white">Classement — phase de ligue</h2>
    </div>
    <div class="flex flex-wrap gap-4 mb-4 text-xs">
        <span class="flex items-center gap-1.5"><span class="w-3 h-3 rounded-sm bg-green-900/40 border border-green-700 inline-block"></span> <span class="text-gray-400">1-8 : qualifiés directs (8es de finale)</span></span>
        <span class="flex items-center gap-1.5"><span class="w-3 h-3 rounded-sm bg-amber-900/40 border border-amber-700 inline-block"></span> <span class="text-gray-400">9-24 : barrages</span></span>
        <span class="flex items-center gap-1.5"><span class="w-3 h-3 rounded-sm bg-red-900/30 border border-red-800 inline-block"></span> <span class="text-gray-400">25-36 : éliminés</span></span>
    </div>
    <?php if (empty($classementCE)): ?>
    <div class="bg-gray-800 rounded-xl border border-gray-700 p-8 text-center text-gray-500 text-sm">
        Le classement s'affichera dès le début de la phase de ligue (15 octobre 2026).
    </div>
    <?php else: ?>
    <div class="bg-gray-900/40 border border-gray-800 rounded-2xl overflow-x-auto">
        <table class="w-full text-sm">
            <caption class="sr-only">Classement de la phase de ligue de la Ligue Europa Conférence 2026-2027</caption>
            <thead>
                <tr class="text-gray-500 uppercase text-xs border-b border-gray-700">
                    <th class="text-left px-4 py-3 font-semibold">Club</th>
                    <th class="text-center px-2 py-3 font-semibold">MJ</th>
                    <th class="text-center px-2 py-3 font-semibold">G</th>
                    <th class="text-center px-2 py-3 font-semibold">N</th>
                    <th class="text-center px-2 py-3 font-semibold">P</th>
                    <th class="text-center px-2 py-3 font-semibold">BP</th>
                    <th class="text-center px-2 py-3 font-semibold">BC</th>
                    <th class="text-center px-2 py-3 font-semibold">DB</th>
                    <th class="text-center px-4 py-3 font-semibold text-green-400">Pts</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-800">
                <?php foreach ($classementCE as $i => $c): $rang = $i + 1; ?>
                <tr class="<?= $rang <= 8 ? 'bg-green-900/10' : ($rang <= 24 ? 'bg-amber-900/5' : 'bg-red-900/10') ?>">
                    <td class="px-4 py-2.5 text-white font-medium whitespace-nowrap">
                        <span class="text-gray-500 font-normal mr-2 inline-block w-5"><?= $rang ?></span><?= htmlspecialchars($c['club']) ?>
                    </td>
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
    <p class="text-gray-600 text-xs mt-2 italic">Classement calculé automatiquement à partir des résultats de la phase de ligue (36 clubs, 6 matchs chacun). Compétition non synchronisée automatiquement : mise à jour manuelle.</p>
    <?php endif; ?>
</section>

<!-- Liens internes -->
<section class="flex flex-wrap gap-4 justify-center pt-8 pb-4">
    <a href="/europa-league.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">🏆 Europa League</a>
    <a href="/champions-league.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">⭐ Champions League</a>
    <a href="/calendrier.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">📅 Calendrier toutes compétitions</a>
</section>

<?php include __DIR__ . '/templates/footer.php'; ?>
