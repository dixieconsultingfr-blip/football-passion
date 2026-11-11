<?php
require_once __DIR__ . '/blog/helpers.php';
$date_maj_page = '2026-11-11'; // à mettre à jour à chaque qualification, tirage ou changement de statut — signal E-E-A-T

$articlesAll = load_articles_index(__DIR__);
$articlesEuro = array_values(array_filter($articlesAll, fn($a) => ($a['categorie'] ?? '') === 'Euro'));
usort($articlesEuro, fn($a, $b) => strtotime($b['date']) <=> strtotime($a['date']));

$page_title = 'Euro 2028 : les équipes — qualifiées, pays hôtes et nations à suivre';
$meta_desc  = "Euro 2028 : 24 équipes, 4 nations hôtes (Angleterre, Écosse, pays de Galles, Irlande), qualifications du 25 mars 2027 au 28 mars 2028. Statut des équipes et nations à suivre.";
$og_image   = '/images/stades/euro-2028-wembley-stadium.jpg';
include __DIR__ . '/templates/header.php';

// Groupes de la Ligue A de la Ligue des nations 2026-2027 (équipes issues des pages de groupe du site).
$groupesLigueA = [
    ['A1', 'France, Italie, Belgique, Turquie', '/ligue-des-nations-groupe-a1.php'],
    ['B', 'Pays-Bas, Grèce, Allemagne, Serbie', '/ligue-des-nations-groupe-b.php'],
    ['C', 'Espagne, Croatie, Angleterre, Tchéquie', '/ligue-des-nations-groupe-c.php'],
    ['D', 'Portugal, Norvège, Danemark, Pays de Galles', '/ligue-des-nations-groupe-d.php'],
];
?>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "Combien d'équipes participent à l'Euro 2028 ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "L'Euro 2028 réunit 24 équipes réparties en 6 groupes de 4. Les deux premiers de chaque groupe et les quatre meilleurs troisièmes accèdent aux huitièmes de finale."
      }
    },
    {
      "@type": "Question",
      "name": "Quelles équipes sont qualifiées pour l'Euro 2028 ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Aucune équipe n'est encore qualifiée au 11 novembre 2026. Les qualifications se déroulent du 25 mars 2027 au 28 mars 2028, après le tirage au sort du 6 décembre 2026 à Belfast."
      }
    },
    {
      "@type": "Question",
      "name": "Les pays hôtes de l'Euro 2028 sont-ils qualifiés d'office ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Non. L'Angleterre, l'Écosse, le pays de Galles et l'Irlande jouent aussi les qualifications, dans des groupes différents ; 2 places au maximum leur sont réservées s'ils échouent."
      }
    },
    {
      "@type": "Question",
      "name": "Comment se qualifie-t-on pour l'Euro 2028 ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Les qualifications réunissent 12 groupes de 4 ou 5 équipes. Les 12 vainqueurs de groupe et les 8 meilleurs deuxièmes se qualifient directement, et les places restantes se jouent en barrages en mars 2028."
      }
    },
    {
      "@type": "Question",
      "name": "Le Portugal sera-t-il à l'Euro 2028 sans Cristiano Ronaldo ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Le Portugal n'est pas pays hôte et doit se qualifier comme les autres sélections. Cristiano Ronaldo a annoncé sa retraite internationale le 5 novembre 2026, après 23 ans avec le Portugal."
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
    <span class="text-gray-400">Les équipes</span>
</nav>

<!-- Bandeau de navigation — sous-pages Euro 2028 -->
<nav class="flex flex-wrap gap-2 mb-8" aria-label="Pages Euro 2028">
    <a href="/euro-2028.php" class="inline-flex items-center gap-1.5 bg-gray-800 border border-gray-700 hover:border-green-600 text-gray-300 hover:text-white px-4 py-2 text-xs font-semibold rounded-full transition-colors">🏆 Vue d'ensemble</a>
    <a href="/euro-2028-les-equipes.php" class="inline-flex items-center gap-1.5 bg-green-900/30 border border-green-700 text-white px-4 py-2 text-xs font-semibold rounded-full">🌍 Les équipes</a>
    <a href="/euro-2028-les-8-villes-hotes.php" class="inline-flex items-center gap-1.5 bg-gray-800 border border-gray-700 hover:border-green-600 text-gray-300 hover:text-white px-4 py-2 text-xs font-semibold rounded-full transition-colors">🏙️ Les 8 villes hôtes</a>
    <a href="/euro-2028-les-9-stades.php" class="inline-flex items-center gap-1.5 bg-gray-800 border border-gray-700 hover:border-green-600 text-gray-300 hover:text-white px-4 py-2 text-xs font-semibold rounded-full transition-colors">🏟️ Les 9 stades</a>
    <a href="/euro-2028-qualifications.php" class="inline-flex items-center gap-1.5 bg-gray-800 border border-gray-700 hover:border-green-600 text-gray-300 hover:text-white px-4 py-2 text-xs font-semibold rounded-full transition-colors">📋 Qualifications</a>
    <a href="/comment-regarder-euro-2028.php" class="inline-flex items-center gap-1.5 bg-gray-800 border border-gray-700 hover:border-green-600 text-gray-300 hover:text-white px-4 py-2 text-xs font-semibold rounded-full transition-colors">📺 Où regarder</a>
    <a href="/ligue-des-nations-2026-2027.php" class="inline-flex items-center gap-1.5 bg-gray-800 border border-gray-700 hover:border-green-600 text-gray-300 hover:text-white px-4 py-2 text-xs font-semibold rounded-full transition-colors">🥇 Ligue des Nations 2026-2027</a>
</nav>

<!-- Hero -->
<header class="mb-10">
    <p class="text-green-400 text-xs font-semibold uppercase tracking-widest mb-1">Euro 2028</p>
    <h1 class="text-4xl font-bold text-white mb-2">Euro 2028 : les équipes</h1>
    <p class="text-gray-400 text-sm mb-1">24 places · 4 nations hôtes · qualifications du 25 mars 2027 au 28 mars 2028</p>
    <p class="text-gray-500 text-xs mb-4">Mis à jour le <time datetime="<?= $date_maj_page ?>"><?= date_fr_long($date_maj_page) ?></time></p>
    <p class="text-gray-300 leading-relaxed max-w-2xl">
        Quelles équipes joueront l'Euro 2028 au Royaume-Uni et en Irlande ? À ce jour, aucune n'est encore qualifiée :
        les qualifications commencent en mars 2027. Cette page fait le point sur les 24 places, le statut des nations hôtes,
        la façon de se qualifier et les équipes à suivre, et sera mise à jour à chaque étape.
    </p>
</header>

<!-- Chiffres clés -->
<section id="equipes-qualifiees" style="scroll-margin-top:5rem" class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-10">
    <div class="bg-gray-800 border border-green-800/40 rounded-xl p-4 text-center">
        <div class="text-2xl font-bold text-green-400">24</div>
        <div class="text-gray-400 text-xs mt-1">équipes<br>6 groupes de 4</div>
    </div>
    <div class="bg-gray-800 border border-gray-700 rounded-xl p-4 text-center">
        <div class="text-2xl font-bold text-white">0 sur 24</div>
        <div class="text-gray-400 text-xs mt-1">équipes qualifiées<br>au <?= date_fr_long($date_maj_page) ?></div>
    </div>
    <div class="bg-gray-800 border border-gray-700 rounded-xl p-4 text-center">
        <div class="text-2xl font-bold text-white">4</div>
        <div class="text-gray-400 text-xs mt-1">nations hôtes<br>à qualifier</div>
    </div>
    <div class="bg-gray-800 border border-gray-700 rounded-xl p-4 text-center">
        <div class="text-2xl font-bold text-white">51</div>
        <div class="text-gray-400 text-xs mt-1">matchs<br>9 juin — 9 juillet 2028</div>
    </div>
</section>

<!-- Nations hôtes -->
<section id="nations-hotes" style="scroll-margin-top:5rem" class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-2">Les 4 nations hôtes</h2>
    <p class="text-gray-300 text-sm leading-relaxed mb-5">
        L'Angleterre, l'Écosse, le pays de Galles et l'Irlande accueillent le tournoi. Elles ne sont pas qualifiées d'office :
        elles jouent aussi les qualifications, dans des groupes différents, et 2 places au maximum leur sont réservées si elles échouent
        (<a href="/blog/qualifications-euro-2028-mode-emploi-barrages-pays-hotes" class="text-green-400 underline hover:text-green-300">le mode d'emploi des barrages et des places réservées</a>).
    </p>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div class="bg-gray-800 border border-gray-700 rounded-xl p-5">
            <h3 class="text-white font-bold text-lg mb-1">Angleterre</h3>
            <p class="text-gray-400 text-sm">Wembley (finale), Tottenham, Birmingham, Liverpool, Newcastle et Manchester.</p>
            <p class="text-gray-500 text-xs mt-2">Ligue des nations : <a href="/ligue-des-nations-groupe-c.php" class="text-green-400 underline hover:text-green-300">groupe C</a> (Espagne, Croatie, Angleterre, Tchéquie).</p>
        </div>
        <div class="bg-gray-800 border border-gray-700 rounded-xl p-5">
            <h3 class="text-white font-bold text-lg mb-1">Écosse</h3>
            <p class="text-gray-400 text-sm">Hampden Park, à Glasgow.</p>
            <p class="text-gray-500 text-xs mt-2">Ligue des nations : <a href="/ligue-des-nations-groupe-e.php" class="text-green-400 underline hover:text-green-300">groupe E</a> (Suisse, Slovénie, Écosse, Macédoine du Nord).</p>
        </div>
        <div class="bg-gray-800 border border-gray-700 rounded-xl p-5">
            <h3 class="text-white font-bold text-lg mb-1">Pays de Galles</h3>
            <p class="text-gray-400 text-sm">Cardiff, où se jouera le match d'ouverture, le 9 juin 2028.</p>
            <p class="text-gray-500 text-xs mt-2">Ligue des nations : <a href="/ligue-des-nations-groupe-d.php" class="text-green-400 underline hover:text-green-300">groupe D</a> (Portugal, Norvège, Danemark, Pays de Galles).</p>
        </div>
        <div class="bg-gray-800 border border-gray-700 rounded-xl p-5">
            <h3 class="text-white font-bold text-lg mb-1">Irlande</h3>
            <p class="text-gray-400 text-sm">Dublin Arena, à Dublin.</p>
            <p class="text-gray-500 text-xs mt-2">Ligue des nations : <a href="/ligue-des-nations-groupe-g.php" class="text-green-400 underline hover:text-green-300">groupe G</a> (Autriche, Kosovo, Irlande, Israël).</p>
        </div>
    </div>
    <p class="mt-4"><a href="/euro-2028-les-8-villes-hotes.php" class="text-green-400 hover:text-green-300 text-sm font-semibold">Découvrir les 8 villes hôtes en détail →</a></p>
</section>

<!-- Comment se qualifier -->
<section id="qualification" style="scroll-margin-top:5rem" class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-4">Comment les équipes se qualifient-elles ?</h2>
    <div class="bg-gray-800 rounded-xl border border-gray-700 p-6 text-sm text-gray-300 leading-relaxed space-y-3">
        <ul class="space-y-2">
            <li>📅 <strong class="text-white">Du 25 mars 2027 au 28 mars 2028</strong> : matchs de qualification.</li>
            <li>🎟️ <strong class="text-white">6 décembre 2026</strong> : tirage au sort à Belfast (Irlande du Nord).</li>
            <li>🗂️ <strong class="text-white">12 groupes de 4 ou 5 équipes</strong>.</li>
            <li>✅ Les <strong class="text-white">12 vainqueurs de groupe</strong> et les <strong class="text-white">8 meilleurs deuxièmes</strong> se qualifient directement (20 équipes).</li>
            <li>🔁 Les dernières places se jouent en <strong class="text-white">barrages en mars 2028</strong> (2, 3 ou 4 billets selon le nombre de places réservées aux hôtes).</li>
            <li>🥇 La Ligue des nations 2026-2027 peut ouvrir l'accès aux barrages, sans remplacer les éliminatoires.</li>
        </ul>
        <p>
            Tous les détails dans notre page <a href="/euro-2028-qualifications.php" class="text-green-400 underline hover:text-green-300">qualifications de l'Euro 2028</a>
            et dans notre dossier <a href="/euro-2028.php#format-qualifications" class="text-green-400 underline hover:text-green-300">format et qualifications</a>.
        </p>
    </div>
</section>

<!-- Statut des équipes -->
<section id="statut" style="scroll-margin-top:5rem" class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-4">Statut des équipes au <?= date_fr_long($date_maj_page) ?></h2>
    <div class="bg-gray-800 border border-gray-700 rounded-xl overflow-x-auto">
        <table class="w-full text-sm">
            <caption class="text-left text-gray-400 text-xs px-4 pt-3 pb-1">Euro 2028 : statut des équipes avant les qualifications (24 places, aucune équipe qualifiée à ce jour)</caption>
            <thead>
                <tr class="text-gray-500 uppercase text-xs border-b border-gray-700">
                    <th class="text-left px-4 py-2 font-semibold">Équipes</th>
                    <th class="text-left px-4 py-2 font-semibold">Statut</th>
                    <th class="text-left px-4 py-2 font-semibold">Prochaine étape</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-700/60 text-gray-300">
                <tr>
                    <td class="px-4 py-2 text-white font-medium">Angleterre, Écosse, pays de Galles, Irlande</td>
                    <td class="px-4 py-2">Pays hôtes, à qualifier (2 places réservées au maximum)</td>
                    <td class="px-4 py-2">Tirage au sort le 6 décembre 2026</td>
                </tr>
                <tr>
                    <td class="px-4 py-2 text-white font-medium">Les autres nations européennes (dont la France et le Portugal)</td>
                    <td class="px-4 py-2">En attente des qualifications</td>
                    <td class="px-4 py-2">Premiers matchs le 25 mars 2027</td>
                </tr>
                <tr>
                    <td class="px-4 py-2 text-white font-medium">Équipes qualifiées</td>
                    <td class="px-4 py-2 font-bold text-white">0 sur 24</td>
                    <td class="px-4 py-2">Mise à jour à chaque qualification</td>
                </tr>
            </tbody>
        </table>
    </div>
    <p class="text-gray-600 text-xs mt-3">Statuts d'après le règlement des qualifications présenté sur nos pages Euro 2028, susceptibles d'évoluer à chaque décision de l'UEFA.</p>
</section>

<!-- Équipes à suivre -->
<section id="equipes-a-suivre" style="scroll-margin-top:5rem" class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-4">Les équipes à suivre</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <a href="/blog/cristiano-ronaldo-retraite-internationale-portugal-euro-2028" class="bg-gray-800 border border-green-800/60 hover:border-green-600 rounded-xl p-5 transition-colors block">
            <p class="text-green-400 text-xs font-semibold uppercase tracking-wider mb-2">Portugal</p>
            <p class="text-white font-bold text-lg">Un premier Euro sans Cristiano Ronaldo</p>
            <p class="text-gray-400 text-sm mt-1">Retraite internationale annoncée le 5 novembre 2026, après 23 ans en sélection. Le Portugal joue en Ligue des nations le 14 novembre au Danemark à Braga, puis au pays de Galles à Cardiff. Lire l'article →</p>
        </a>
        <a href="/blog/turquie-equipe-nationale-yalcin-ligue-des-nations-euro-2028" class="bg-gray-800 border border-gray-700 hover:border-green-600 rounded-xl p-5 transition-colors block">
            <p class="text-green-400 text-xs font-semibold uppercase tracking-wider mb-2">Turquie</p>
            <p class="text-white font-bold text-lg">Un nouveau sélectionneur, Sergen Yalçın</p>
            <p class="text-gray-400 text-sm mt-1">Dernière du groupe A1 avec 0 point, la Turquie reçoit la Belgique le 12 novembre à Izmir puis joue en France le 15 novembre. Lire l'article →</p>
        </a>
        <a href="/equipe-france.php" class="bg-gray-800 border border-gray-700 hover:border-green-600 rounded-xl p-5 transition-colors block">
            <p class="text-green-400 text-xs font-semibold uppercase tracking-wider mb-2">France</p>
            <p class="text-white font-bold text-lg">Les Bleus de Zinédine Zidane</p>
            <p class="text-gray-400 text-sm mt-1">En tête du groupe A1 de la Ligue des nations, avec l'Euro 2028 pour objectif. Toute l'actualité sur la page Équipe de France →</p>
        </a>
    </div>
</section>

<!-- Ligue A -->
<section id="ligue-a" style="scroll-margin-top:5rem" class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-2">Où jouent les grandes nations ? La Ligue A de la Ligue des nations</h2>
    <p class="text-gray-300 text-sm leading-relaxed mb-4">
        Avant les qualifications, les sélections de la Ligue A, dont la plupart des grandes nations européennes, s'affrontent en Ligue des nations 2026-2027 :
        quatre groupes de quatre équipes jusqu'au 17 novembre 2026, puis des quarts de finale en mars 2027 pour les 8 meilleures.
    </p>
    <div class="bg-gray-800 border border-gray-700 rounded-xl overflow-x-auto">
        <table class="w-full text-sm">
            <caption class="text-left text-gray-400 text-xs px-4 pt-3 pb-1">Ligue des nations 2026-2027, Ligue A : les quatre groupes et leurs équipes</caption>
            <thead>
                <tr class="text-gray-500 uppercase text-xs border-b border-gray-700">
                    <th class="text-left px-4 py-2 font-semibold">Groupe</th>
                    <th class="text-left px-4 py-2 font-semibold">Équipes</th>
                    <th class="text-left px-4 py-2 font-semibold">Classement</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-700/60 text-gray-300">
                <?php foreach ($groupesLigueA as $g): ?>
                <tr>
                    <td class="px-4 py-2 text-white font-medium"><?= htmlspecialchars($g[0]) ?></td>
                    <td class="px-4 py-2"><?= htmlspecialchars($g[1]) ?></td>
                    <td class="px-4 py-2"><a href="<?= htmlspecialchars($g[2]) ?>" class="text-green-400 underline hover:text-green-300">Voir le groupe</a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <p class="text-gray-400 text-sm mt-4">
        Retrouvez tous les groupes (Ligues A, B, C et D) sur la page
        <a href="/ligue-des-nations-2026-2027.php#classements-groupes" class="text-green-400 underline hover:text-green-300">Ligue des nations 2026-2027</a>.
    </p>
</section>

<!-- FAQ -->
<section id="faq" style="scroll-margin-top:5rem" class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-5">Foire aux questions : les équipes de l'Euro 2028</h2>
    <div class="space-y-3">
        <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
            <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">
                Combien d'équipes participent à l'Euro 2028 ?
                <span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span>
            </summary>
            <p class="text-gray-400 text-sm leading-relaxed mt-3">24 équipes réparties en 6 groupes de 4. Les deux premiers de chaque groupe et les quatre meilleurs troisièmes accèdent aux huitièmes de finale.</p>
        </details>
        <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
            <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">
                Quelles équipes sont qualifiées pour l'Euro 2028 ?
                <span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span>
            </summary>
            <p class="text-gray-400 text-sm leading-relaxed mt-3">Aucune équipe n'est encore qualifiée au <?= date_fr_long($date_maj_page) ?>. Les qualifications se déroulent du 25 mars 2027 au 28 mars 2028, après le tirage au sort du 6 décembre 2026 à Belfast.</p>
        </details>
        <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
            <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">
                Les pays hôtes de l'Euro 2028 sont-ils qualifiés d'office ?
                <span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span>
            </summary>
            <p class="text-gray-400 text-sm leading-relaxed mt-3">Non. L'Angleterre, l'Écosse, le pays de Galles et l'Irlande jouent aussi les qualifications, dans des groupes différents ; 2 places au maximum leur sont réservées s'ils échouent.</p>
        </details>
        <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
            <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">
                Comment se qualifie-t-on pour l'Euro 2028 ?
                <span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span>
            </summary>
            <p class="text-gray-400 text-sm leading-relaxed mt-3">Les qualifications réunissent 12 groupes de 4 ou 5 équipes. Les 12 vainqueurs de groupe et les 8 meilleurs deuxièmes se qualifient directement, et les places restantes se jouent en barrages en mars 2028.</p>
        </details>
        <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
            <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">
                Le Portugal sera-t-il à l'Euro 2028 sans Cristiano Ronaldo ?
                <span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span>
            </summary>
            <p class="text-gray-400 text-sm leading-relaxed mt-3">Le Portugal n'est pas pays hôte et doit se qualifier comme les autres sélections. Cristiano Ronaldo a annoncé sa retraite internationale le 5 novembre 2026, après 23 ans avec le Portugal.</p>
        </details>
    </div>
</section>

<!-- Actualités liées -->
<section class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-5">Actualités — Euro 2028</h2>
    <?php if (empty($articlesEuro)): ?>
    <div class="bg-gray-800 rounded-xl border border-gray-700 p-6 text-center text-gray-500 text-sm">
        Aucun article publié pour le moment dans cette catégorie.
        <a href="/blog/" class="text-green-400 hover:text-green-300 ml-1">Voir tous les articles →</a>
    </div>
    <?php else: ?>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
        <?php foreach (array_slice($articlesEuro, 0, 6) as $a): ?>
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
    <a href="/euro-2028.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">🏆 Euro 2028</a>
    <a href="/euro-2028-qualifications.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">📋 Qualifications</a>
    <a href="/equipe-france.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">🇫🇷 Équipe de France</a>
    <a href="/ligue-des-nations-2026-2027.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">🥇 Ligue des Nations</a>
</section>

<?php include __DIR__ . '/templates/footer.php'; ?>
