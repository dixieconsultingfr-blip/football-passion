<?php
// Page pilier SEO — droits TV Euro 2028, prépare un futur emplacement de monétisation
// (liens d'affiliation CTA + emplacements publicitaires AdSense, tous deux encore à activer).
require_once __DIR__ . '/blog/helpers.php';
$articlesAll = load_articles_index(__DIR__);
$articlesEuro = array_values(array_filter($articlesAll, fn($a) => ($a['categorie'] ?? '') === 'Euro'));
usort($articlesEuro, fn($a, $b) => strtotime($b['date']) <=> strtotime($a['date']));

$page_title = 'Comment regarder l\'Euro 2028 ? TF1, M6, beIN Sports';
$meta_desc  = "Quelle chaîne pour l'Euro 2028 ? TF1 diffuse les Bleus en exclusivité jusqu'en 2028, beIN Sports détient les 51 matchs du tournoi, TF1 et M6 se partagent 25 rencontres en clair.";
$og_image   = '/images/stades/euro-2028-wembley-stadium.jpg';
include __DIR__ . '/templates/header.php';
?>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "Sur quelle chaîne voir les matchs de l'équipe de France avant l'Euro 2028 ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "TF1 détient l'exclusivité de tous les matchs de l'équipe de France masculine jusqu'en 2028 : qualifications (Euro et Coupe du Monde), matchs amicaux et Ligue des Nations. Ces rencontres sont gratuites, diffusées sur TF1 et TF1+."
      }
    },
    {
      "@type": "Question",
      "name": "Qui diffuse l'Euro 2028 en France ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "beIN SPORTS détient les droits de l'intégralité des 51 matchs de la phase finale de l'Euro 2028 en France. TF1 et M6 se partagent 25 de ces rencontres en clair et gratuitement, dont, en principe, tous les matchs de l'équipe de France si elle est qualifiée."
      }
    },
    {
      "@type": "Question",
      "name": "Combien de matchs de l'Euro 2028 sont gratuits ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "25 matchs sur 51 seront diffusés en clair (gratuitement) sur TF1 et M6. Les 26 matchs restants ne seront visibles que sur beIN SPORTS, chaîne payante."
      }
    }
  ]
}
</script>

<!-- Breadcrumb -->
<nav class="text-xs text-gray-400 mb-8 flex items-center gap-2">
    <a href="/" class="hover:text-green-400 transition-colors">Accueil</a>
    <span>›</span>
    <a href="/euro.php" class="hover:text-green-400 transition-colors">Euro</a>
    <span>›</span>
    <a href="/euro-2028.php" class="hover:text-green-400 transition-colors">2028</a>
    <span>›</span>
    <span class="text-gray-400">Où regarder</span>
</nav>

<div class="max-w-3xl mx-auto">

    <!-- Hero -->
    <header class="mb-8">
        <p class="text-green-400 text-xs font-semibold uppercase tracking-widest mb-2">Guide diffusion TV</p>
        <h1 class="text-4xl font-bold text-white mb-4 leading-tight">Comment regarder l'Euro 2028 ? TF1, M6 et beIN Sports</h1>
        <p class="text-gray-300 text-lg leading-relaxed border-l-4 border-green-500 pl-4">
            Entre les chaînes gratuites et l'abonnement payant, la répartition des droits TV de l'Euro 2028 mêle plusieurs diffuseurs. Voici, dès aujourd'hui, ce qui est officiellement acté — cette page sera complétée au fil des annonces jusqu'en 2028.
        </p>
    </header>

    <!-- Emplacement publicitaire AdSense -->
    <div class="w-full flex justify-center mb-10">
        <!-- FP-DROITS-TV -->
        <ins class="adsbygoogle"
             style="display:block"
             data-ad-client="ca-pub-1397315006076063"
             data-ad-slot="6597827779"
             data-ad-format="auto"
             data-full-width-responsive="true"></ins>
        <script>
             (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
    </div>

    <!-- TF1 : les Bleus -->
    <section class="mb-10">
        <h2 class="text-2xl font-bold text-white mb-4">TF1, diffuseur exclusif des Bleus jusqu'en 2028</h2>
        <p class="text-gray-300 leading-relaxed mb-6">
            Depuis un accord signé avec l'UEFA et la Fédération Française de Football, <strong class="text-white">TF1 détient l'exclusivité de tous les matchs de l'équipe de France masculine jusqu'en 2028</strong> : matchs de qualification pour l'Euro et la Coupe du Monde, matchs amicaux, et intégralité de la Ligue des Nations. Toutes ces rencontres sont diffusées gratuitement, sur TF1 et sur la plateforme TF1+.
        </p>

        <div class="text-center mb-6">
            <a href="#" class="inline-block bg-green-700 hover:bg-green-600 text-white font-bold px-8 py-3.5 rounded-lg transition-colors">
                Suivre le calendrier des Bleus
            </a>
            <!-- TODO : remplacer href="#" par un lien vers /equipe-france.php ou un lien d'affiliation dès qu'il sera disponible, et ajouter rel="sponsored noopener noreferrer" si affiliation -->
        </div>
    </section>

    <!-- beIN Sports : phase finale intégrale -->
    <section class="mb-10">
        <h2 class="text-2xl font-bold text-white mb-4">beIN SPORTS : l'intégralité des 51 matchs de l'Euro 2028</h2>
        <p class="text-gray-300 leading-relaxed mb-6">
            Pour la phase finale du tournoi (9 juin – 9 juillet 2028), <strong class="text-white">beIN SPORTS détient les droits de diffusion de l'intégralité des 51 matchs</strong> de la compétition en France — comme ce fut déjà le cas pour l'Euro 2024. C'est la chaîne payante qui permet de suivre chaque rencontre, y compris celles qui ne sont pas diffusées en clair.
        </p>

        <div class="text-center">
            <a href="#" class="inline-block border border-green-700 text-green-400 hover:bg-green-700 hover:text-white font-semibold px-6 py-3 rounded-lg transition-colors">
                Découvrir les offres beIN Sports
            </a>
            <!-- TODO : remplacer href="#" par le lien d'affiliation dès qu'il sera disponible, et ajouter rel="sponsored noopener noreferrer" -->
        </div>
    </section>

    <!-- TF1 + M6 : 25 matchs en clair -->
    <section class="mb-10">
        <h2 class="text-2xl font-bold text-white mb-4">TF1 et M6 : 25 matchs en clair, gratuitement</h2>
        <p class="text-gray-300 leading-relaxed mb-6">
            Sur les 51 matchs de la compétition, <strong class="text-white">25 seront co-diffusés gratuitement par TF1 et M6</strong>, sélectionnés parmi les meilleures affiches du tournoi — a priori tous les matchs des Bleus s'ils sont qualifiés, ainsi que les grosses affiches de phase de groupes et les principaux matchs à élimination directe (demi-finales, finale). La répartition détaillée, match par match, entre TF1 et M6 n'est pas encore publiée : elle le sera à l'approche du tournoi, une fois le calendrier complet connu.
        </p>

        <div class="overflow-x-auto">
            <table class="w-full text-sm border-collapse">
                <caption class="text-left text-gray-500 text-xs pb-2">Répartition des droits TV de l'Euro 2028 en France</caption>
                <thead>
                    <tr class="bg-green-700 text-white">
                        <th class="p-3 text-left">Compétition / matchs</th>
                        <th class="p-3 text-left">Diffuseur(s)</th>
                        <th class="p-3 text-center">Accès</th>
                    </tr>
                </thead>
                <tbody class="text-gray-300">
                    <tr class="border-b border-gray-700 bg-gray-800">
                        <td class="p-3">Qualifications Euro 2028 – France</td>
                        <td class="p-3">TF1 (exclusif)</td>
                        <td class="p-3 text-center text-green-400 font-semibold">Gratuit</td>
                    </tr>
                    <tr class="border-b border-gray-700">
                        <td class="p-3">Matchs amicaux – France</td>
                        <td class="p-3">TF1 (exclusif)</td>
                        <td class="p-3 text-center text-green-400 font-semibold">Gratuit</td>
                    </tr>
                    <tr class="border-b border-gray-700 bg-gray-800">
                        <td class="p-3">Ligue des Nations – France</td>
                        <td class="p-3">TF1 (exclusif)</td>
                        <td class="p-3 text-center text-green-400 font-semibold">Gratuit</td>
                    </tr>
                    <tr class="border-b border-gray-700">
                        <td class="p-3">Euro 2028 – phase finale (51 matchs)</td>
                        <td class="p-3">beIN SPORTS (51/51)</td>
                        <td class="p-3 text-center text-blue-400 font-semibold">Payant</td>
                    </tr>
                    <tr class="bg-gray-800">
                        <td class="p-3">Dont 25 matchs en clair</td>
                        <td class="p-3">TF1 et M6</td>
                        <td class="p-3 text-center text-green-400 font-semibold">Gratuit</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <p class="text-gray-600 text-xs mt-3">
            * Répartition annoncée par TF1, M6 et beIN SPORTS. La liste précise des 25 matchs en clair sera communiquée à l'approche du tournoi.
        </p>
    </section>

    <!-- FAQ -->
    <section class="mb-8">
        <h2 class="text-2xl font-bold text-white mb-5">Foire aux questions : diffusion TV Euro 2028</h2>
        <div class="space-y-3">

            <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
                <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">
                    Sur quelle chaîne voir les matchs de l'équipe de France avant l'Euro 2028 ?
                    <span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span>
                </summary>
                <p class="text-gray-400 text-sm leading-relaxed mt-3">
                    TF1 détient l'exclusivité de tous les matchs de l'équipe de France masculine jusqu'en 2028 : qualifications (Euro et Coupe du Monde), matchs amicaux et Ligue des Nations. Ces rencontres sont gratuites, diffusées sur TF1 et TF1+.
                </p>
            </details>

            <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
                <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">
                    Qui diffuse l'Euro 2028 en France ?
                    <span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span>
                </summary>
                <p class="text-gray-400 text-sm leading-relaxed mt-3">
                    beIN SPORTS détient les droits de l'intégralité des 51 matchs de la phase finale de l'Euro 2028 en France. TF1 et M6 se partagent 25 de ces rencontres en clair et gratuitement, dont, en principe, tous les matchs de l'équipe de France si elle est qualifiée.
                </p>
            </details>

            <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
                <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">
                    Combien de matchs de l'Euro 2028 sont gratuits ?
                    <span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span>
                </summary>
                <p class="text-gray-400 text-sm leading-relaxed mt-3">
                    25 matchs sur 51 seront diffusés en clair (gratuitement) sur TF1 et M6. Les 26 matchs restants ne seront visibles que sur beIN SPORTS, chaîne payante.
                </p>
            </details>

        </div>
    </section>

    <!-- Actualités liées -->
    <section class="mb-12">
        <h2 class="text-2xl font-bold text-white mb-5">Actualités — Euro 2028</h2>
        <?php if (empty($articlesEuro)): ?>
        <div class="bg-gray-800 rounded-xl border border-gray-700 p-6 text-center text-gray-500 text-sm">
            Aucun article publié pour le moment dans cette catégorie.
            <a href="/blog" class="text-green-400 hover:text-green-300 ml-1">Voir tous les articles →</a>
        </div>
        <?php else: ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            <?php foreach (array_slice($articlesEuro, 0, 3) as $a): ?>
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

    <p class="text-gray-600 text-xs text-center mb-4">
        Informations basées sur les accords de diffusion annoncés par TF1, M6, beIN SPORTS, l'UEFA et la FFF — susceptibles d'évoluer d'ici 2028. Le détail match par match des 25 rencontres en clair sera confirmé à l'approche du tournoi.
    </p>

    <!-- Liens internes -->
    <section class="flex flex-wrap gap-4 justify-center pt-4 pb-2">
        <a href="/euro-2028.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">🏆 Euro 2028</a>
        <a href="/equipe-france.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">🇫🇷 Équipe de France</a>
        <a href="/euro-2028-paris-sportifs.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">🎲 Paris sportifs Euro 2028</a>
    </section>

</div>

<?php include __DIR__ . '/templates/footer.php'; ?>
