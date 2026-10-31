<?php
// Template partagé pour les pages de groupe de la Ligue des Nations 2026-2027 (hors groupe A1 des Bleus, qui a sa propre page dédiée avec calendrier et diffusion TF1).
// Variables attendues, définies par le fichier appelant avant l'include :
// $groupeLettre (ex. 'B'), $groupeEquipesLabel (ex. "Pays-Bas, Grèce, Allemagne, Serbie"), $classement (tableau trié), $date_maj_page, $page_title, $meta_desc

require_once __DIR__ . '/../blog/helpers.php';
include __DIR__ . '/header.php';
?>

<!-- Breadcrumb -->
<nav class="text-xs text-gray-400 mb-8 flex items-center gap-2 flex-wrap">
    <a href="/" class="hover:text-green-400 transition-colors">Accueil</a>
    <span>›</span>
    <a href="/euro.php" class="hover:text-green-400 transition-colors">Euro</a>
    <span>›</span>
    <a href="/ligue-des-nations-2026-2027.php" class="hover:text-green-400 transition-colors">Ligue des Nations 2026-2027</a>
    <span>›</span>
    <span class="text-gray-400">Groupe <?= htmlspecialchars($groupeLettre) ?></span>
</nav>

<!-- Hero -->
<header class="mb-10">
    <div class="flex items-center gap-3 mb-1">
        <p class="text-green-400 text-xs font-semibold uppercase tracking-widest">Ligue des Nations 2026-2027</p>
        <span class="text-gray-600 text-xs">· mis à jour le <?= date_fr_long($date_maj_page) ?></span>
    </div>
    <h1 class="text-4xl font-bold text-white mb-2">Ligue des Nations — Groupe <?= htmlspecialchars($groupeLettre) ?></h1>
    <p class="text-gray-400 text-sm mb-4">Saison 2026-2027 · <?= htmlspecialchars($groupeEquipesLabel) ?></p>
    <p class="text-gray-300 leading-relaxed max-w-2xl">
        Retrouvez ici le classement du groupe <?= htmlspecialchars($groupeLettre) ?> de la Ligue des Nations UEFA 2026-2027,
        mis à jour au fil des résultats de la phase de ligue.
    </p>
</header>

<!-- Classement -->
<section class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-4">Classement du groupe <?= htmlspecialchars($groupeLettre) ?></h2>
    <div class="bg-gray-800 border border-gray-700 rounded-xl overflow-x-auto">
        <table class="w-full text-sm">
            <caption class="text-left text-gray-400 text-xs px-4 pt-3 pb-1">Classement du groupe <?= htmlspecialchars($groupeLettre) ?>, Ligue des Nations 2026-2027</caption>
            <thead>
                <tr class="text-gray-500 uppercase text-xs border-b border-gray-700">
                    <th class="text-left px-4 py-2 font-semibold">Équipe</th>
                    <th class="text-center px-2 py-2 font-semibold">MJ</th>
                    <th class="text-center px-2 py-2 font-semibold">G</th>
                    <th class="text-center px-2 py-2 font-semibold">N</th>
                    <th class="text-center px-2 py-2 font-semibold">P</th>
                    <th class="text-center px-2 py-2 font-semibold">DB</th>
                    <th class="text-center px-4 py-2 font-semibold text-green-400">Pts</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-700/60">
                <?php foreach ($classement as $i => $c): ?>
                <tr class="<?= $i < 2 ? 'bg-green-900/10' : '' ?>">
                    <td class="px-4 py-2 text-white font-medium"><span class="text-gray-500 font-normal mr-2"><?= $i + 1 ?></span><?= htmlspecialchars($c['club']) ?></td>
                    <td class="px-2 py-2 text-center text-gray-400"><?= $c['MJ'] ?></td>
                    <td class="px-2 py-2 text-center text-gray-400"><?= $c['G'] ?></td>
                    <td class="px-2 py-2 text-center text-gray-400"><?= $c['N'] ?></td>
                    <td class="px-2 py-2 text-center text-gray-400"><?= $c['P'] ?></td>
                    <td class="px-2 py-2 text-center text-gray-400"><?= $c['DB'] > 0 ? '+' . $c['DB'] : $c['DB'] ?></td>
                    <td class="px-4 py-2 text-center text-green-400 font-bold"><?= $c['Pts'] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <p class="text-gray-600 text-xs mt-2 italic">Classement basé sur les résultats disputés à ce stade de la phase de ligue ; il sera complété au fil des prochaines journées.</p>
</section>

<!-- Renvoi vers le groupe des Bleus -->
<section class="mb-12">
    <a href="/ligue-des-nations-groupe-a1.php" class="flex flex-col sm:flex-row sm:items-center gap-3 bg-green-900/10 border border-green-800 hover:border-green-600 rounded-xl p-5 transition-colors">
        <div class="flex-1">
            <p class="text-green-400 text-xs font-semibold uppercase tracking-wider mb-1">Suivre les Bleus</p>
            <p class="text-white font-bold">Groupe A1 : France, Italie, Belgique, Turquie</p>
            <p class="text-gray-400 text-sm mt-1">Calendrier complet, classement et diffusion TF1 des matchs de l'équipe de France de Zidane.</p>
        </div>
        <span class="text-green-400 text-xs font-semibold shrink-0">Voir le groupe →</span>
    </a>
</section>

<!-- FAQ -->
<section class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-5">Foire aux questions : groupe <?= htmlspecialchars($groupeLettre) ?></h2>
    <div class="space-y-3">
        <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
            <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">
                Quelles équipes composent le groupe <?= htmlspecialchars($groupeLettre) ?> de la Ligue des Nations 2026-2027 ?
                <span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span>
            </summary>
            <p class="text-gray-400 text-sm leading-relaxed mt-3">
                Le groupe <?= htmlspecialchars($groupeLettre) ?> réunit <?= htmlspecialchars($groupeEquipesLabel) ?> pour la phase de ligue de la Ligue des Nations UEFA 2026-2027.
            </p>
        </details>
        <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
            <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">
                Que se passe-t-il après la phase de groupes ?
                <span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span>
            </summary>
            <p class="text-gray-400 text-sm leading-relaxed mt-3">
                La phase de ligue se termine le 17 novembre 2026. Selon la ligue (A, B, C ou D) et le classement final, les équipes sont promues, reléguées ou peuvent disputer les quarts de finale de la Ligue des Nations (Ligue A) en mars 2027.
            </p>
        </details>
    </div>
</section>

<!-- Liens internes -->
<section class="flex flex-wrap gap-4 justify-center pb-4">
    <a href="/ligue-des-nations-2026-2027.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">🥇 Ligue des Nations 2026-2027</a>
    <a href="/ligue-des-nations-groupe-a1.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">🇫🇷 Groupe A1 des Bleus</a>
    <a href="/blog/ligue-des-nations-2026-2027-resultats-journee-1" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">📰 Résultats de la journée 1</a>
</section>

<?php include __DIR__ . '/footer.php'; ?>
