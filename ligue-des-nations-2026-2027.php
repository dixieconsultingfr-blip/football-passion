<?php
require_once __DIR__ . '/blog/helpers.php';
$articlesAll = load_articles_index(__DIR__);
$articlesFrance = array_values(array_filter($articlesAll, fn($a) => ($a['categorie'] ?? '') === 'France'));
usort($articlesFrance, fn($a, $b) => strtotime($b['date']) <=> strtotime($a['date']));

$page_title = 'Ligue des Nations 2026-2027 : calendrier des Bleus avant l\'Euro 2028';
$meta_desc  = "La Ligue des Nations UEFA 2026-2027 est la grande compétition européenne avant l'Euro 2028. Calendrier complet des Bleus de Zidane : phase de groupes, quarts de finale, finale à quatre.";
include __DIR__ . '/templates/header.php';
?>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "Quelle est la grande compétition européenne avant l'Euro 2028 ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Avant l'Euro 2028, la grande compétition européenne de sélections est la Ligue des Nations UEFA 2026-2027. Le nouveau système de compétitions de sélections de l'UEFA ne débutera qu'à partir de 2028-2029, après l'Euro 2028."
      }
    },
    {
      "@type": "Question",
      "name": "Quel est le calendrier de la Ligue des Nations 2026-2027 ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "La phase de ligue se déroule du 24 septembre au 17 novembre 2026. Les quarts de finale (aller-retour) ont lieu en mars 2027, suivis de la finale à quatre (demi-finales, petite finale et finale) du 9 au 13 juin 2027."
      }
    },
    {
      "@type": "Question",
      "name": "Dans quel groupe se trouve la France en Ligue des Nations 2026-2027 ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "La France évolue en Ligue A, dans un groupe avec l'Italie, la Belgique et la Turquie. Premiers matchs : Turquie - France le 25 septembre 2026, Belgique - France le 28 septembre 2026, puis France - Italie le 2 octobre 2026."
      }
    }
  ]
}
</script>

<!-- Breadcrumb -->
<nav class="text-xs text-gray-400 mb-8 flex items-center gap-2">
    <a href="/" class="hover:text-green-400 transition-colors">Accueil</a>
    <span>›</span>
    <a href="/equipe-france.php" class="hover:text-green-400 transition-colors">Équipe de France</a>
    <span>›</span>
    <span class="text-gray-400">Ligue des Nations 2026-2027</span>
</nav>

<!-- Hero -->
<header class="mb-10">
    <p class="text-green-400 text-xs font-semibold uppercase tracking-widest mb-1">Avant l'Euro 2028</p>
    <h1 class="text-4xl font-bold text-white mb-2">Ligue des Nations 2026-2027</h1>
    <p class="text-gray-400 text-sm mb-4">24 septembre 2026 — 13 juin 2027 · Zinédine Zidane sur le banc des Bleus</p>
    <p class="text-gray-300 leading-relaxed max-w-2xl">
        Avant l'Euro 2028, la grande compétition européenne de sélections sera la <strong class="text-white">Ligue des
        Nations UEFA 2026-2027</strong>. Le nouveau système de compétitions de sélections de l'UEFA ne débutera qu'à
        partir de 2028-2029, une fois l'Euro 2028 passé — cette édition reste donc construite sur le format actuel.
    </p>
</header>

<!-- La route vers l'Euro 2028 -->
<section class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-4">La route vers l'Euro 2028</h2>
    <div class="bg-gray-800 rounded-xl border border-gray-700 divide-y divide-gray-700">
        <div class="flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-4 px-4 py-3 bg-green-900/10">
            <span class="text-green-400 text-xs font-semibold sm:w-48 shrink-0">Sept. 2026 – Juin 2027</span>
            <div>
                <span class="text-white text-sm font-semibold">Ligue des Nations 2026-2027</span>
                <span class="text-gray-500 text-xs ml-2">Vous êtes ici</span>
            </div>
        </div>
        <div class="flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-4 px-4 py-3">
            <span class="text-green-400 text-xs font-semibold sm:w-48 shrink-0">Mars – Nov. 2027</span>
            <div>
                <span class="text-white text-sm font-semibold">Qualifications Euro 2028</span>
                <span class="text-gray-500 text-xs ml-2">Phase de groupes</span>
            </div>
        </div>
        <div class="flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-4 px-4 py-3">
            <span class="text-green-400 text-xs font-semibold sm:w-48 shrink-0">Mars 2028</span>
            <div>
                <span class="text-white text-sm font-semibold">Barrages Euro 2028</span>
                <span class="text-gray-500 text-xs ml-2">Dernières places qualificatives</span>
            </div>
        </div>
        <div class="flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-4 px-4 py-3">
            <span class="text-green-400 text-xs font-semibold sm:w-48 shrink-0">9 juin – 9 juil. 2028</span>
            <div>
                <span class="text-white text-sm font-semibold">Euro 2028</span>
                <span class="text-gray-500 text-xs ml-2">Royaume-Uni &amp; République d'Irlande</span>
            </div>
        </div>
    </div>
    <a href="/euro-2028-qualifications.php" class="inline-flex items-center gap-1 text-green-400 hover:text-green-300 text-xs font-semibold mt-3">
        Voir le détail des qualifications Euro 2028 →
    </a>
</section>

<!-- Le groupe de la France -->
<section class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-4">Le groupe de la France en Ligue A</h2>
    <div class="bg-gray-800 rounded-xl border border-green-800/40 p-6 text-sm text-gray-300 leading-relaxed space-y-3">
        <p>
            Pour cette édition, la France évolue en <strong class="text-white">Ligue A</strong>, dans un groupe relevé
            face à l'<strong class="text-white">Italie</strong>, la <strong class="text-white">Belgique</strong> et la
            <strong class="text-white">Turquie</strong>.
        </p>
        <ul class="space-y-1.5 text-gray-400 pt-2 border-t border-gray-700">
            <li>📅 <strong class="text-white">25 septembre 2026</strong> — Turquie - France</li>
            <li>📅 <strong class="text-white">28 septembre 2026</strong> — Belgique - France</li>
            <li>📅 <strong class="text-white">2 octobre 2026</strong> — France - Italie</li>
            <li>📅 Journées retour à confirmer, dans la fenêtre du 24 septembre au 17 novembre 2026</li>
        </ul>
    </div>
</section>

<!-- Calendrier complet -->
<section class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-4">Calendrier complet de la compétition</h2>
    <div class="bg-gray-800 rounded-xl border border-gray-700 divide-y divide-gray-700">
        <?php
        $etapes = [
            ['24 sept. – 17 nov. 2026', 'Phase de ligue', 'Ligue A : 4 groupes de 4 équipes'],
            ['Mars 2027', 'Quarts de finale', 'Matchs aller-retour, 8 meilleures équipes de Ligue A'],
            ['9-10 juin 2027', 'Demi-finales', 'Finale à quatre'],
            ['13 juin 2027', 'Petite finale et finale', 'Désignation du vainqueur de la Ligue des Nations'],
        ];
        foreach ($etapes as $e): ?>
        <div class="flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-4 px-4 py-3">
            <span class="text-green-400 text-xs font-semibold sm:w-40 shrink-0"><?= $e[0] ?></span>
            <div>
                <span class="text-white text-sm font-semibold"><?= $e[1] ?></span>
                <span class="text-gray-500 text-xs ml-2"><?= $e[2] ?></span>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <p class="text-gray-600 text-xs mt-2 italic">
        * Seule la France (Ligue A) s'affiche ici en détail. Les Ligues B, C et D suivent leur propre calendrier de phase de groupes sur la même période.
    </p>
</section>

<!-- FAQ -->
<section class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-5">Foire aux questions : Ligue des Nations 2026-2027</h2>
    <div class="space-y-3">

        <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
            <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">
                Quelle est la grande compétition européenne avant l'Euro 2028 ?
                <span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span>
            </summary>
            <p class="text-gray-400 text-sm leading-relaxed mt-3">
                Avant l'Euro 2028, la grande compétition européenne de sélections est la Ligue des Nations UEFA 2026-2027. Le nouveau système de compétitions de sélections de l'UEFA ne débutera qu'à partir de 2028-2029, après l'Euro 2028.
            </p>
        </details>

        <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
            <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">
                Quel est le calendrier de la Ligue des Nations 2026-2027 ?
                <span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span>
            </summary>
            <p class="text-gray-400 text-sm leading-relaxed mt-3">
                La phase de ligue se déroule du 24 septembre au 17 novembre 2026. Les quarts de finale (aller-retour) ont lieu en mars 2027, suivis de la finale à quatre (demi-finales, petite finale et finale) du 9 au 13 juin 2027.
            </p>
        </details>

        <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
            <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">
                Dans quel groupe se trouve la France en Ligue des Nations 2026-2027 ?
                <span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span>
            </summary>
            <p class="text-gray-400 text-sm leading-relaxed mt-3">
                La France évolue en Ligue A, dans un groupe avec l'Italie, la Belgique et la Turquie. Premiers matchs : Turquie - France le 25 septembre 2026, Belgique - France le 28 septembre 2026, puis France - Italie le 2 octobre 2026.
            </p>
        </details>

    </div>
</section>

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
        <?php foreach (array_slice($articlesFrance, 0, 3) as $a): ?>
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
    <a href="/equipe-france.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">🇫🇷 Équipe de France</a>
    <a href="/euro-2028-qualifications.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">📋 Qualifications Euro 2028</a>
    <a href="/euro-2028.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">🏆 Euro 2028</a>
</section>

<?php include __DIR__ . '/templates/footer.php'; ?>
