<?php
require_once __DIR__ . '/blog/helpers.php';

$matchsAll = json_decode(@file_get_contents(__DIR__ . '/data/matchs.json'), true) ?? [];
$matchsCL  = array_values(array_filter($matchsAll, fn($m) => ($m['competition'] ?? '') === 'CL'));

// ── Derniers résultats : la dernière date jouée ──
$termines = array_values(array_filter($matchsCL, fn($m) => ($m['status'] ?? '') === 'FINISHED'));
usort($termines, fn($a, $b) => strcmp($b['date'], $a['date']));
$derniereDate = $termines[0]['date'] ?? null;
$derniersResultats = $derniereDate !== null
    ? array_values(array_filter($termines, fn($m) => $m['date'] === $derniereDate))
    : [];

// ── Prochains matchs, groupés par date ──
$enDirect = array_values(array_filter($matchsCL, fn($m) => ($m['status'] ?? '') === 'LIVE'));
$aVenir = array_values(array_filter($matchsCL, fn($m) => !in_array($m['status'] ?? 'SCHEDULED', ['FINISHED', 'LIVE'], true)));
usort($aVenir, fn($a, $b) => strcmp($a['date'] . ($a['heure'] ?? ''), $b['date'] . ($b['heure'] ?? '')));
$aVenir = array_slice($aVenir, 0, 20);
$parDate = [];
foreach ($aVenir as $m) {
    $parDate[$m['date']][] = $m;
}

// ── Actualités liées ──
$articlesAll = load_articles_index(__DIR__);
$articlesCL  = array_values(array_filter($articlesAll, fn($a) =>
    ($a['categorie'] ?? '') === 'CL' || in_array('Champions League', $a['etiquettes'] ?? [])
));
usort($articlesCL, fn($a, $b) => strtotime($b['date']) <=> strtotime($a['date']));

$page_title = 'Champions League — Résultats et actualités 2026-2027';
$meta_desc  = "Résultats, calendrier et pronostics Ligue des champions 2026-2027 : qualifications, phase de ligue, actualités et infos abonnement.";
include __DIR__ . '/templates/header.php';
?>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "SportsEvent",
  "name": "UEFA Champions League 2026-2027",
  "sport": "Football",
  "url": "https://football-passion.fr/champions-league.php"
}
</script>

<!-- Breadcrumb -->
<nav class="text-xs text-gray-400 mb-8 flex items-center gap-2">
    <a href="/" class="hover:text-green-400 transition-colors">Accueil</a>
    <span>›</span>
    <span class="text-gray-400">Champions League</span>
</nav>

<!-- Hero -->
<header class="mb-10 flex items-center gap-4">
    <span class="inline-flex items-center justify-center w-14 h-14 bg-white rounded-xl p-2 shrink-0">
        <img src="/images/logo/logo-champions-league.webp" alt="Logo Ligue des champions" class="w-full h-full object-contain" />
    </span>
    <div>
        <p class="text-green-400 text-xs font-semibold uppercase tracking-widest mb-1">Coupe d'Europe</p>
        <h1 class="text-4xl font-bold text-white mb-1">Champions League</h1>
        <p class="text-gray-400 text-sm">Saison 2026-2027 · Résultats, pronostics et actualités</p>
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
                <a href="/archives.php?comp=CL&amp;saison=2026-2027" class="text-green-400 hover:text-green-300 text-xs font-semibold shrink-0">Historique de la saison →</a>
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
            <?php if (empty($articlesCL)): ?>
            <div class="bg-gray-800 rounded-xl border border-gray-700 p-5 text-center text-gray-500 text-xs">
                Aucun article publié pour le moment.
                <a href="/blog" class="text-green-400 hover:text-green-300 block mt-1">Voir tous les articles →</a>
            </div>
            <?php else: ?>
            <div class="space-y-3">
                <?php foreach (array_slice($articlesCL, 0, 6) as $a): ?>
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
            <a href="/blog?cat=CL" class="block text-center text-green-400 hover:text-green-300 text-xs font-semibold mt-3">Tous les articles CL →</a>
            <?php endif; ?>
        </section>

    </div>

</div>

<!-- Liens internes -->
<section class="flex flex-wrap gap-4 justify-center pt-8 pb-4">
    <a href="/europa-league.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">🏆 Europa League</a>
    <a href="/calendrier.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">📅 Calendrier toutes compétitions</a>
    <a href="/archives.php?comp=CL&amp;saison=2026-2027" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">🗂️ Tous les résultats de la Champions League</a>
</section>

<?php include __DIR__ . '/templates/footer.php'; ?>
