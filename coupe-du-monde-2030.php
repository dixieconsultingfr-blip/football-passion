<?php
require_once __DIR__ . '/blog/helpers.php';
$articlesAll = load_articles_index(__DIR__);
$articlesCDM = array_values(array_filter($articlesAll, fn($a) => ($a['categorie'] ?? '') === 'CDM'));
usort($articlesCDM, fn($a, $b) => strtotime($b['date']) <=> strtotime($a['date']));

$page_title = 'Coupe du Monde 2030 — Dates, pays hôtes, stades et format';
$meta_desc  = "Tout savoir sur la Coupe du Monde 2030 : Espagne, Portugal, Maroc et matchs du centenaire en Amérique du Sud (Uruguay, Argentine, Paraguay). Dates, stades, format.";
include __DIR__ . '/templates/header.php';
?>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "SportsEvent",
  "name": "Coupe du Monde de la FIFA 2030",
  "startDate": "2030-06-08",
  "endDate": "2030-07-21",
  "location": [
    { "@type": "Country", "name": "Espagne" },
    { "@type": "Country", "name": "Portugal" },
    { "@type": "Country", "name": "Maroc" },
    { "@type": "Country", "name": "Uruguay" },
    { "@type": "Country", "name": "Argentine" },
    { "@type": "Country", "name": "Paraguay" }
  ],
  "url": "https://football-passion.fr/coupe-du-monde-2030.php"
}
</script>

<!-- Breadcrumb -->
<nav class="text-xs text-gray-500 mb-8 flex items-center gap-2">
    <a href="/" class="hover:text-green-400 transition-colors">Accueil</a>
    <span>›</span>
    <span class="text-gray-400">Coupe du Monde 2030</span>
</nav>

<!-- Hero -->
<header class="mb-10">
    <p class="text-green-400 text-xs font-semibold uppercase tracking-widest mb-1">Le centenaire du Mondial</p>
    <h1 class="text-4xl font-bold text-white mb-2">Coupe du Monde 2030</h1>
    <p class="text-gray-400 text-sm mb-4">8 juin — 21 juillet 2030 · Espagne, Portugal, Maroc + matchs du centenaire en Amérique du Sud</p>
    <p class="text-gray-300 leading-relaxed max-w-2xl">
        Pour ses 100 ans, la Coupe du Monde devient historique : trois matchs du centenaire ouvriront le tournoi en Uruguay, en Argentine et au Paraguay — là où tout a commencé en 1930 — avant que l'essentiel de la compétition ne se joue en Espagne, au Portugal et au Maroc. Une première Coupe du Monde disputée sur trois continents.
    </p>
</header>

<!-- Chiffres clés -->
<section class="grid grid-cols-3 sm:grid-cols-6 gap-3 mb-10">
    <?php
    $stats = [['6','Pays hôtes'],['3','Continents'],['48','Équipes'],['23','Stades'],['104','Matchs'],['44','Jours']];
    foreach ($stats as $s): ?>
    <div class="bg-gray-800 border border-gray-700 rounded-xl p-3 text-center">
        <div class="text-xl font-bold text-green-400"><?= $s[0] ?></div>
        <div class="text-gray-500 text-xs mt-1"><?= $s[1] ?></div>
    </div>
    <?php endforeach; ?>
</section>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">

    <!-- Pays hôtes -->
    <section>
        <h2 class="text-2xl font-bold text-white mb-4">Six pays hôtes, trois continents</h2>
        <div class="space-y-3">
            <?php
            $pays = [
                ['🇪🇸', 'Espagne', 'Tournoi principal — 10-11 stades (dont Madrid, Barcelone)'],
                ['🇵🇹', 'Portugal', 'Tournoi principal — 3 stades (Lisbonne, Porto)'],
                ['🇲🇦', 'Maroc', 'Tournoi principal — 6 stades (dont Casablanca)'],
                ['🇺🇾', 'Uruguay', 'Match du centenaire — Montevideo, 8 juin'],
                ['🇦🇷', 'Argentine', 'Match du centenaire — Buenos Aires, 8 juin'],
                ['🇵🇾', 'Paraguay', 'Match du centenaire — Asunción, 9 juin'],
            ];
            foreach ($pays as $p): ?>
            <div class="bg-gray-800 border border-gray-700 rounded-xl p-4 flex items-start gap-3">
                <span class="text-2xl"><?= $p[0] ?></span>
                <div>
                    <div class="text-white font-semibold text-sm"><?= $p[1] ?></div>
                    <div class="text-gray-500 text-xs mt-1"><?= $p[2] ?></div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <a href="/coupe-du-monde-2030-les-villes-hotes.php" class="inline-flex items-center gap-1 text-green-400 hover:text-green-300 text-xs font-semibold mt-3">
            Découvrir les villes hôtes en détail →
        </a>
    </section>

    <!-- Format -->
    <section>
        <h2 class="text-2xl font-bold text-white mb-4">Format et qualifications</h2>
        <div class="bg-gray-800 rounded-xl border border-gray-700 p-6 text-sm text-gray-300 leading-relaxed space-y-3">
            <p>
                Comme en 2026, la compétition réunit <strong class="text-white">48 équipes</strong> réparties en
                12 groupes de 4, pour un total de 104 matchs. Une expansion à 64 équipes a été proposée par
                la CONMEBOL mais s'est heurtée à l'opposition des trois pays hôtes principaux — le format à 48
                reste à ce jour le format retenu.
            </p>
            <ul class="space-y-1.5 text-gray-400 pt-2 border-t border-gray-700">
                <li>🏆 <strong class="text-white">6 nations hôtes qualifiées d'office</strong> : Espagne, Portugal, Maroc, Argentine, Uruguay, Paraguay</li>
                <li>🌍 Places restantes réparties entre les confédérations continentales (UEFA, CAF, CONMEBOL, AFC, CONCACAF, OFC)</li>
                <li>📅 Matchs du centenaire les 8 et 9 juin 2030 en Amérique du Sud</li>
                <li>⚽ Tournoi principal du 13 juin au 21 juillet 2030</li>
            </ul>
        </div>
    </section>

</div>

<!-- Stades -->
<section class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-4">23 stades sur 3 continents</h2>
    <p class="text-gray-400 text-sm mb-4">Répartition indicative, susceptible d'évoluer d'ici 2030 (un stade espagnol déjà retiré du projet à ce jour).</p>
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
        <?php
        $paysStades = [
            ['Espagne', '10-11'],
            ['Maroc', '6'],
            ['Portugal', '3'],
            ['Amérique du Sud', '3'],
        ];
        foreach ($paysStades as $p): ?>
        <div class="bg-gray-800 border border-gray-700 rounded-xl p-4 text-center">
            <div class="text-2xl font-bold text-green-400"><?= $p[1] ?></div>
            <div class="text-gray-500 text-xs mt-1"><?= $p[0] ?></div>
        </div>
        <?php endforeach; ?>
    </div>
    <a href="/coupe-du-monde-2030-les-stades.php" class="inline-flex items-center gap-1 text-green-400 hover:text-green-300 text-xs font-semibold mt-4">
        Voir le détail de chaque stade et son rôle dans le tournoi →
    </a>
</section>

<!-- La France de Zidane -->
<section class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-4">La France de Zidane — objectif Mondial</h2>
    <div class="bg-gray-800 rounded-xl border border-green-800/40 p-6">
        <p class="text-gray-300 text-sm leading-relaxed mb-5">
            Nommé sélectionneur le 28 juillet 2026 avec un contrat courant jusqu'en 2030, Zinédine Zidane a un objectif clairement affiché : cette Coupe du Monde organisée en Espagne, au Maroc et au Portugal. Après l'Euro 2028, ce Mondial du centenaire sera le grand rendez-vous de son mandat.
        </p>
        <a href="/equipe-france.php" class="inline-flex items-center gap-1 text-green-400 hover:text-green-300 text-xs font-semibold">
            Voir la fiche complète de l'équipe de France →
        </a>
    </div>
</section>

<!-- Actualités liées -->
<section class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-5">Actualités — Coupe du Monde 2030</h2>
    <?php if (empty($articlesCDM)): ?>
    <div class="bg-gray-800 rounded-xl border border-gray-700 p-6 text-center text-gray-500 text-sm">
        Aucun article publié pour le moment dans cette catégorie.
        <a href="/blog" class="text-green-400 hover:text-green-300 ml-1">Voir tous les articles →</a>
    </div>
    <?php else: ?>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
        <?php foreach (array_slice($articlesCDM, 0, 6) as $a): ?>
        <a href="/blog/<?= urlencode($a['slug']) ?>" class="flex flex-col bg-gray-800 border border-gray-700 hover:border-green-600 rounded-xl overflow-hidden transition-colors">
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
    <a href="/coupe-du-monde-2030-les-stades.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">🏟️ Les stades</a>
    <a href="/coupe-du-monde-2030-les-villes-hotes.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">🏙️ Les villes hôtes</a>
    <a href="/equipe-france.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">🇫🇷 Équipe de France</a>
</section>

<?php include __DIR__ . '/templates/footer.php'; ?>
