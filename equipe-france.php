<?php
require_once __DIR__ . '/blog/helpers.php';
$articlesAll = load_articles_index(__DIR__);
$articlesFrance = array_values(array_filter($articlesAll, fn($a) => ($a['categorie'] ?? '') === 'France'));
usort($articlesFrance, fn($a, $b) => strtotime($b['date']) <=> strtotime($a['date']));

$page_title = 'Équipe de France — Palmarès, actualités et parcours des Bleus';
$meta_desc  = "L'équipe de France de football : palmarès complet, campagne CDM 2026, sélectionneur Zidane et toute l'actualité des Bleus sur Football Passion.";
include __DIR__ . '/templates/header.php';
?>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "SportsTeam",
  "name": "Équipe de France de football",
  "sport": "Football",
  "url": "https://football-passion.fr/equipe-france.php",
  "memberOf": { "@type": "SportsOrganization", "name": "Fédération Française de Football" },
  "description": "Équipe nationale masculine de football de la France, double championne du monde (1998, 2018) et double championne d'Europe (1984, 2000)."
}
</script>

<!-- Breadcrumb -->
<nav class="text-xs text-gray-500 mb-8 flex items-center gap-2">
    <a href="/" class="hover:text-green-400 transition-colors">Accueil</a>
    <span>›</span>
    <span class="text-gray-400">Équipe de France</span>
</nav>

<!-- Hero -->
<header class="mb-10 flex flex-col sm:flex-row items-start sm:items-center gap-5">
    <img src="https://flagcdn.com/h120/fr.png" alt="Drapeau France" width="90" height="60"
         class="rounded shadow-lg shrink-0" loading="eager">
    <div>
        <p class="text-green-400 text-xs font-semibold uppercase tracking-widest mb-1">Fiche équipe</p>
        <h1 class="text-4xl font-bold text-white mb-2">Équipe de France</h1>
        <p class="text-gray-400 leading-relaxed max-w-2xl">
            Deux étoiles sur le maillot, un vivier de talents renouvelé à chaque génération : les Bleus
            comptent parmi les nations les plus titrées du football mondial depuis trois décennies.
            Zinédine Zidane a pris la suite de Didier Deschamps sur le banc à l'été 2026, avec l'Euro 2028
            et la Coupe du Monde 2030 en ligne de mire.
        </p>
    </div>
</header>

<!-- Chiffres clés -->
<section class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-10">
    <div class="bg-gray-800 border border-yellow-800/40 rounded-xl p-4 text-center">
        <div class="text-2xl font-bold text-yellow-400">2</div>
        <div class="text-gray-400 text-xs mt-1">Titres mondiaux<br>1998 · 2018</div>
    </div>
    <div class="bg-gray-800 border border-gray-700 rounded-xl p-4 text-center">
        <div class="text-2xl font-bold text-white">2</div>
        <div class="text-gray-400 text-xs mt-1">Titres européens<br>1984 · 2000</div>
    </div>
    <div class="bg-gray-800 border border-gray-700 rounded-xl p-4 text-center">
        <div class="text-2xl font-bold text-white">1</div>
        <div class="text-gray-400 text-xs mt-1">Ligue des Nations<br>2021</div>
    </div>
    <div class="bg-gray-800 border border-green-800/40 rounded-xl p-4 text-center">
        <div class="text-2xl font-bold text-green-400">2026</div>
        <div class="text-gray-400 text-xs mt-1">Arrivée de<br>Zidane</div>
    </div>
</section>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">

    <!-- Palmarès -->
    <section>
        <h2 class="text-2xl font-bold text-white mb-4">Palmarès en Coupe du Monde</h2>
        <div class="bg-gray-800 rounded-xl border border-gray-700 overflow-hidden">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-900/60 border-b border-gray-700 text-gray-400 text-xs uppercase">
                        <th class="text-left px-4 py-2">Année</th>
                        <th class="text-left px-4 py-2">Hôte</th>
                        <th class="text-left px-4 py-2">Résultat</th>
                    </tr>
                </thead>
                <tbody class="text-gray-300">
                    <?php
                    $palmares = [
                        ['2026', 'USA / Canada / Mexique', '4e place'],
                        ['2022', 'Qatar', '🥈 Finaliste'],
                        ['2018', 'Russie', '🏆 Championne du monde'],
                        ['2014', 'Brésil', 'Quart de finale'],
                        ['2006', 'Allemagne', '🥈 Finaliste'],
                        ['1998', 'France', '🏆 Championne du monde'],
                    ];
                    foreach ($palmares as $p): ?>
                    <tr class="border-b border-gray-700/60 last:border-0">
                        <td class="px-4 py-2 font-semibold text-white"><?= $p[0] ?></td>
                        <td class="px-4 py-2 text-gray-400"><?= $p[1] ?></td>
                        <td class="px-4 py-2 <?= str_contains($p[2], '🏆') ? 'text-yellow-400 font-semibold' : '' ?>"><?= $p[2] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>

    <!-- L'ère Zidane -->
    <section>
        <h2 class="text-2xl font-bold text-white mb-4">L'ère Zidane</h2>
        <div class="bg-gray-800 rounded-xl border border-gray-700 p-6 text-sm text-gray-300 leading-relaxed space-y-3">
            <p>
                Après 14 ans à la tête des Bleus (juillet 2012 – juillet 2026), Didier Deschamps a cédé sa place à
                <strong class="text-white">Zinédine Zidane</strong>, nommé sélectionneur à l'été 2026 avec un
                contrat courant jusqu'en 2030. Le nouveau sélectionneur hérite d'un groupe solide, arrivé en
                demi-finale de la Coupe du Monde 2026 avant de terminer à la 4e place.
            </p>
            <p>
                Les deux prochains grands rendez-vous : l'<strong class="text-white">Euro 2028</strong>
                (Royaume-Uni et Irlande) et la <strong class="text-white">Coupe du Monde 2030</strong>,
                co-organisée par le Maroc, l'Espagne et le Portugal.
            </p>
            <a href="https://www.coupe-du-monde-2026.info/equipe-france.php" target="_blank" rel="nofollow noopener noreferrer"
               class="inline-flex items-center gap-1 text-green-400 hover:text-green-300 text-xs font-semibold mt-2">
                Couverture complète de la campagne 2026 →
            </a>
        </div>
    </section>

</div>

<!-- Actualités liées -->
<section class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-5">Actualités — Équipe de France</h2>

    <?php if (empty($articlesFrance)): ?>
    <div class="bg-gray-800 rounded-xl border border-gray-700 p-6 text-center text-gray-500 text-sm">
        Aucun article publié pour le moment dans cette catégorie.
        <a href="/blog" class="text-green-400 hover:text-green-300 ml-1">Voir tous les articles →</a>
    </div>
    <?php else: ?>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
        <?php foreach (array_slice($articlesFrance, 0, 6) as $a): ?>
        <a href="/blog/<?= urlencode($a['slug']) ?>" class="flex flex-col bg-gray-800 border border-gray-700 hover:border-green-600 rounded-xl overflow-hidden transition-colors">
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
    <a href="/calendrier.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">📅 Calendrier</a>
    <a href="/blog?cat=France" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">📰 Tous les articles France</a>
    <a href="/blog?cat=CDM" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">🏆 Coupe du Monde</a>
</section>

<?php include __DIR__ . '/templates/footer.php'; ?>
