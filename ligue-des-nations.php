<?php
require_once __DIR__ . '/blog/helpers.php';
$date_maj_page = '2026-11-18'; // page evergreen : à mettre à jour à chaque nouvelle édition, vainqueur ou changement de format

$articlesAll = load_articles_index(__DIR__);
$articlesLdn = array_values(array_filter($articlesAll, fn($a) => in_array('Ligue des nations', $a['etiquettes'] ?? [], true)));
usort($articlesLdn, fn($a, $b) => strtotime($b['date']) <=> strtotime($a['date']));

$page_title = 'Ligue des Nations UEFA : classements, calendrier et palmarès';
$meta_desc  = "Ligue des Nations UEFA : édition 2026-2027 en cours, les 14 groupes et leurs classements, palmarès (Portugal, France, Espagne), format et lien avec l'Euro 2028.";
$og_image   = '/images/stades/euro-2028-wembley-stadium.jpg';
include __DIR__ . '/templates/header.php';

$lk = 'class="text-green-400 underline hover:text-green-300"';
$groupes = [
    ['A1', 'France, Italie, Belgique, Turquie', '/ligue-des-nations-groupe-a1.php'],
    ['B', 'Pays-Bas, Grèce, Allemagne, Serbie', '/ligue-des-nations-groupe-b.php'],
    ['C', 'Espagne, Croatie, Angleterre, Tchéquie', '/ligue-des-nations-groupe-c.php'],
    ['D', 'Portugal, Norvège, Danemark, Pays de Galles', '/ligue-des-nations-groupe-d.php'],
    ['E', 'Suisse, Slovénie, Écosse, Macédoine du Nord', '/ligue-des-nations-groupe-e.php'],
    ['F', 'Ukraine, Irlande du Nord, Géorgie, Hongrie', '/ligue-des-nations-groupe-f.php'],
    ['G', 'Autriche, Kosovo, Irlande, Israël', '/ligue-des-nations-groupe-g.php'],
    ['H', 'Suède, Bosnie-Herzégovine, Pologne, Roumanie', '/ligue-des-nations-groupe-h.php'],
    ['I', 'Finlande, Albanie, Biélorussie, Saint-Marin', '/ligue-des-nations-groupe-i.php'],
    ['J', 'Arménie, Monténégro, Chypre, Lettonie', '/ligue-des-nations-groupe-j.php'],
    ['K', 'Slovaquie, Îles Féroé, Kazakhstan, Moldavie', '/ligue-des-nations-groupe-k.php'],
    ['L', 'Luxembourg, Islande, Estonie, Bulgarie', '/ligue-des-nations-groupe-l.php'],
    ['M', 'Malte, Gibraltar, Andorre', '/ligue-des-nations-groupe-m.php'],
    ['N', 'Lituanie, Azerbaïdjan, Liechtenstein', '/ligue-des-nations-groupe-n.php'],
];
$palmares = [
    ['2018-2019', 'Portugal', 'Pays-Bas (1-0)'],
    ['2020-2021', 'France', 'Espagne (2-1)'],
    ['2022-2023', 'Espagne', 'Croatie (0-0 après prolongation, 5-4 aux tirs au but)'],
    ['2024-2025', 'Portugal', 'Espagne (2-2 après prolongation, 5-3 aux tirs au but)'],
];
?>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "Qu'est-ce que la Ligue des Nations UEFA ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "La Ligue des Nations est une compétition organisée par l'UEFA entre sélections nationales européennes, répartie en quatre ligues (A, B, C et D). La phase de groupes se joue entre septembre et novembre, suivie de quarts de finale en mars en Ligue A et d'un carré final en juin."
      }
    },
    {
      "@type": "Question",
      "name": "Qui a gagné la Ligue des Nations ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Le Portugal a gagné la Ligue des Nations en 2019 et en 2025, la France en 2021 et l'Espagne en 2023."
      }
    },
    {
      "@type": "Question",
      "name": "Quand se joue la Ligue des Nations 2026-2027 ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "La phase de groupes de l'édition 2026-2027 se joue du 24 septembre au 17 novembre 2026. Les quarts de finale (aller-retour) ont lieu en mars 2027, suivis de la finale à quatre en juin 2027."
      }
    },
    {
      "@type": "Question",
      "name": "Dans quel groupe joue la France en Ligue des Nations 2026-2027 ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "La France évolue en Ligue A, dans le groupe A1, avec l'Italie, la Belgique et la Turquie."
      }
    },
    {
      "@type": "Question",
      "name": "La Ligue des Nations compte-t-elle pour l'Euro 2028 ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Les éditions impaires de la Ligue des Nations, dont 2026-2027, sont liées aux qualifications du Championnat d'Europe : les barrages de la Ligue des Nations donnent les dernières places de l'Euro. Les qualifications de l'Euro 2028 débutent le 25 mars 2027, après le tirage au sort du 6 décembre 2026."
      }
    }
  ]
}
</script>

<!-- Breadcrumb -->
<nav class="text-xs text-gray-400 mb-8 flex items-center gap-2">
    <a href="/" class="hover:text-green-400 transition-colors">Accueil</a>
    <span>›</span>
    <span class="text-gray-400">Ligue des Nations</span>
</nav>

<!-- Hero -->
<header class="mb-10">
    <p class="text-green-400 text-xs font-semibold uppercase tracking-widest mb-1">Compétition UEFA · sélections nationales</p>
    <h1 class="text-4xl font-bold text-white mb-2">Ligue des Nations UEFA : classements, calendrier et palmarès</h1>
    <p class="text-gray-500 text-xs mb-4">Mis à jour le <time datetime="<?= $date_maj_page ?>"><?= date_fr_long($date_maj_page) ?></time></p>
    <p class="text-gray-300 leading-relaxed max-w-2xl">
        La Ligue des Nations oppose les sélections européennes en quatre ligues. Cette page rassemble l'édition en cours, les classements des
        14 groupes, le palmarès et le lien avec l'<a href="/euro-2028.php" <?= $lk ?>>Euro 2028</a>. Chaque édition a sa propre page, par saison.
    </p>
</header>

<!-- Édition en cours -->
<section id="edition-en-cours" style="scroll-margin-top:5rem" class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-4">L'édition en cours : Ligue des Nations 2026-2027</h2>
    <a href="/ligue-des-nations-2026-2027.php" class="bg-gray-800 border border-green-800/60 hover:border-green-600 rounded-xl p-6 transition-colors block mb-4">
        <p class="text-green-400 text-xs font-semibold uppercase tracking-wider mb-2">Saison 2026-2027</p>
        <p class="text-white font-bold text-xl mb-2">Calendrier des Bleus, classements et route vers l'Euro 2028</p>
        <p class="text-gray-400 text-sm">Phase de groupes du 24 septembre au 17 novembre 2026, quarts de finale en mars 2027 et finale à quatre en juin 2027. La France joue dans le groupe A1, avec l'Italie, la Belgique et la Turquie.</p>
        <span class="text-green-400 text-xs font-semibold mt-3 inline-block">Voir l'édition 2026-2027 →</span>
    </a>
    <p class="text-gray-300 text-sm leading-relaxed">
        Derniers articles : <a href="/blog/ligue-des-nations-2026-2027-resultats-journee-6-mardi-17-novembre" <?= $lk ?>>les derniers résultats du 17 novembre</a>,
        <a href="/blog/ligue-des-nations-2026-2027-resultats-journee-6-lundi-16-novembre" <?= $lk ?>>ceux du 16 novembre</a> et
        <a href="/blog/ligue-des-nations-2026-2027-resultats-journee-6-dimanche-15-novembre" <?= $lk ?>>du 15 novembre</a>.
    </p>
</section>

<!-- Fonctionnement -->
<section id="fonctionnement" style="scroll-margin-top:5rem" class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-4">Comment fonctionne la Ligue des Nations ?</h2>
    <div class="bg-gray-800 rounded-xl border border-gray-700 p-6 text-sm text-gray-300 leading-relaxed space-y-3">
        <p>
            La compétition compte <strong class="text-white">quatre ligues (A, B, C et D)</strong>, selon le niveau des sélections. La phase de groupes se joue entre septembre et novembre ;
            un tour supplémentaire en mars comprend les quarts de finale en Ligue A et des barrages de promotion et de relégation entre ligues, puis le « carré final » se joue en juin.
        </p>
        <p>
            Les éditions impaires, dont <strong class="text-white">2026-2027</strong>, sont liées aux éliminatoires du Championnat d'Europe : les barrages de la Ligue des Nations donnent les dernières places de l'Euro.
            Les <a href="/euro-2028-qualifications.php" <?= $lk ?>>qualifications de l'Euro 2028</a> débutent le 25 mars 2027, après le tirage au sort du 6 décembre 2026 à Belfast.
        </p>
        <p>
            À partir de 2028, selon Wikipédia, le nombre de ligues passera de quatre à trois, avec 18 équipes par ligue. Les éditions suivantes auront leur propre page, par saison.
        </p>
    </div>
</section>

<!-- Groupes -->
<section id="groupes" style="scroll-margin-top:5rem" class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-2">Les 14 groupes de l'édition 2026-2027</h2>
    <p class="text-gray-300 text-sm leading-relaxed mb-4">Classement, calendrier et résultats de chaque groupe : cliquez sur le groupe pour le détail.</p>
    <div class="bg-gray-800 border border-gray-700 rounded-xl overflow-x-auto">
        <table class="w-full text-sm">
            <caption class="text-left text-gray-400 text-xs px-4 pt-3 pb-1">Ligue des Nations UEFA 2026-2027 : les 14 groupes de la phase de groupes et leurs équipes</caption>
            <thead>
                <tr class="text-gray-500 uppercase text-xs border-b border-gray-700">
                    <th class="text-left px-4 py-2 font-semibold">Groupe</th>
                    <th class="text-left px-4 py-2 font-semibold">Équipes</th>
                    <th class="text-left px-4 py-2 font-semibold">Classement</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-700/60 text-gray-300">
                <?php foreach ($groupes as $g): ?>
                <tr>
                    <td class="px-4 py-2 text-white font-medium"><?= htmlspecialchars($g[0]) ?></td>
                    <td class="px-4 py-2"><?= htmlspecialchars($g[1]) ?></td>
                    <td class="px-4 py-2"><a href="<?= htmlspecialchars($g[2]) ?>" <?= $lk ?>>Voir le groupe <?= htmlspecialchars($g[0]) ?></a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>

<!-- Palmarès -->
<section id="palmares" style="scroll-margin-top:5rem" class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-4">Palmarès de la Ligue des Nations</h2>
    <div class="bg-gray-800 border border-gray-700 rounded-xl overflow-x-auto">
        <table class="w-full text-sm">
            <caption class="text-left text-gray-400 text-xs px-4 pt-3 pb-1">Ligue des Nations UEFA : vainqueurs et finalistes des quatre premières éditions</caption>
            <thead>
                <tr class="text-gray-500 uppercase text-xs border-b border-gray-700">
                    <th class="text-left px-4 py-2 font-semibold">Édition</th>
                    <th class="text-left px-4 py-2 font-semibold">Vainqueur</th>
                    <th class="text-left px-4 py-2 font-semibold">Finaliste</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-700/60 text-gray-300">
                <?php foreach ($palmares as $p): ?>
                <tr>
                    <td class="px-4 py-2 whitespace-nowrap"><?= htmlspecialchars($p[0]) ?></td>
                    <td class="px-4 py-2 text-white font-bold"><?= htmlspecialchars($p[1]) ?></td>
                    <td class="px-4 py-2"><?= htmlspecialchars($p[2]) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <p class="text-gray-600 text-xs mt-3">Source : Wikipédia (Ligue des nations de l'UEFA). Le Portugal a gagné en 2019 et en 2025, la France en 2021 et l'Espagne en 2023.</p>
</section>

<!-- Euro 2028 -->
<section id="euro-2028" style="scroll-margin-top:5rem" class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-4">Ligue des Nations et Euro 2028</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <a href="/euro-2028.php" class="bg-gray-800 border border-gray-700 hover:border-green-600 rounded-xl p-5 transition-colors block">
            <p class="text-green-400 text-xs font-semibold uppercase tracking-wider mb-2">Euro 2028</p>
            <p class="text-white font-bold">Date, lieu, équipes et calendrier</p>
            <p class="text-gray-400 text-xs mt-1">9 juin - 9 juillet 2028, quatre pays hôtes →</p>
        </a>
        <a href="/euro-2028-les-equipes.php" class="bg-gray-800 border border-gray-700 hover:border-green-600 rounded-xl p-5 transition-colors block">
            <p class="text-green-400 text-xs font-semibold uppercase tracking-wider mb-2">Les équipes</p>
            <p class="text-white font-bold">Qui sera à l'Euro 2028 ?</p>
            <p class="text-gray-400 text-xs mt-1">Statut des 24 places, aucune équipe qualifiée à ce jour →</p>
        </a>
    </div>
</section>

<!-- FAQ -->
<section id="faq" style="scroll-margin-top:5rem" class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-5">Foire aux questions : Ligue des Nations</h2>
    <div class="space-y-3">
        <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
            <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">
                Qu'est-ce que la Ligue des Nations UEFA ?
                <span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span>
            </summary>
            <p class="text-gray-400 text-sm leading-relaxed mt-3">La Ligue des Nations est une compétition organisée par l'UEFA entre sélections nationales européennes, répartie en quatre ligues (A, B, C et D). La phase de groupes se joue entre septembre et novembre, suivie de quarts de finale en mars en Ligue A et d'un carré final en juin.</p>
        </details>
        <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
            <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">
                Qui a gagné la Ligue des Nations ?
                <span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span>
            </summary>
            <p class="text-gray-400 text-sm leading-relaxed mt-3">Le Portugal a gagné la Ligue des Nations en 2019 et en 2025, la France en 2021 et l'Espagne en 2023.</p>
        </details>
        <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
            <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">
                Quand se joue la Ligue des Nations 2026-2027 ?
                <span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span>
            </summary>
            <p class="text-gray-400 text-sm leading-relaxed mt-3">La phase de groupes de l'édition 2026-2027 se joue du 24 septembre au 17 novembre 2026. Les quarts de finale (aller-retour) ont lieu en mars 2027, suivis de la finale à quatre en juin 2027.</p>
        </details>
        <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
            <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">
                Dans quel groupe joue la France en Ligue des Nations 2026-2027 ?
                <span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span>
            </summary>
            <p class="text-gray-400 text-sm leading-relaxed mt-3">La France évolue en Ligue A, dans le groupe A1, avec l'Italie, la Belgique et la Turquie.</p>
        </details>
        <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
            <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">
                La Ligue des Nations compte-t-elle pour l'Euro 2028 ?
                <span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span>
            </summary>
            <p class="text-gray-400 text-sm leading-relaxed mt-3">Les éditions impaires de la Ligue des Nations, dont 2026-2027, sont liées aux qualifications du Championnat d'Europe : les barrages de la Ligue des Nations donnent les dernières places de l'Euro. Les qualifications de l'Euro 2028 débutent le 25 mars 2027, après le tirage au sort du 6 décembre 2026.</p>
        </details>
    </div>
</section>

<!-- Actualités liées -->
<section class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-5">Actualités — Ligue des Nations</h2>
    <?php if (empty($articlesLdn)): ?>
    <div class="bg-gray-800 rounded-xl border border-gray-700 p-6 text-center text-gray-500 text-sm">
        Aucun article publié pour le moment.
        <a href="/blog/" class="text-green-400 hover:text-green-300 ml-1">Voir tous les articles →</a>
    </div>
    <?php else: ?>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
        <?php foreach (array_slice($articlesLdn, 0, 6) as $a): ?>
        <a href="/blog/<?= urlencode($a['slug']) ?>" class="flex flex-col bg-gray-800 border border-gray-700 hover:border-green-600 rounded-xl overflow-hidden transition-colors">
            <div class="p-4 flex flex-col gap-2 flex-1">
                <p class="text-gray-500 text-xs"><?= !empty($a['date_maj']) ? 'Maj ' : '' ?><?= date('d/m/Y', strtotime($a['date_maj'] ?? $a['date'])) ?></p>
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
    <a href="/ligue-des-nations-2026-2027.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">🥇 Édition 2026-2027</a>
    <a href="/ligue-des-nations-groupe-a1.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">🇫🇷 Groupe A1 (France)</a>
    <a href="/euro-2028.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">🏆 Euro 2028</a>
    <a href="/equipe-france.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">🇫🇷 Équipe de France</a>
</section>

<?php include __DIR__ . '/templates/footer.php'; ?>
