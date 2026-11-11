<?php
require_once __DIR__ . '/blog/helpers.php';
$articlesAll = load_articles_index(__DIR__);
$articlesEuro = array_values(array_filter($articlesAll, fn($a) => ($a['categorie'] ?? '') === 'Euro'));
usort($articlesEuro, fn($a, $b) => strtotime($b['date']) <=> strtotime($a['date']));

$page_title = 'Euro 2028 — Dates, pays hôtes, stades et qualifications';
$meta_desc  = "Tout savoir sur l'Euro 2028 au Royaume-Uni et en Irlande : dates, stades, format, qualifications et objectifs des Bleus de Zidane.";
$og_image   = '/images/stades/euro-2028-wembley-stadium.jpg';
$date_maj_page = '2026-11-11';
include __DIR__ . '/templates/header.php';
?>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "SportsEvent",
  "name": "UEFA Euro 2028",
  "startDate": "2028-06-09",
  "endDate": "2028-07-09",
  "location": [
    { "@type": "Country", "name": "Royaume-Uni" },
    { "@type": "Country", "name": "Irlande" }
  ],
  "url": "https://football-passion.fr/euro-2028.php"
}
</script>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "Quand a lieu l'Euro 2028 ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "L'Euro 2028 (Championnat d'Europe de football) se déroule du 9 juin au 9 juillet 2028. Les qualifications UEFA débutent dès le 25 mars 2027 et se terminent le 28 mars 2028."
      }
    },
    {
      "@type": "Question",
      "name": "Où se déroule l'Euro 2028 ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "L'Euro 2028 se joue au Royaume-Uni et en République d'Irlande, dans 9 stades répartis sur 8 villes : Londres (Wembley, Tottenham Hotspur Stadium), Cardiff, Manchester, Liverpool, Newcastle, Birmingham, Glasgow et Dublin. Le match d'ouverture a lieu à Cardiff, la finale à Wembley."
      }
    },
    {
      "@type": "Question",
      "name": "Coupe d'Europe 2028, Euro 2028 : est-ce la même compétition ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Oui. \"Coupe d'Europe\" est une appellation courante pour désigner le Championnat d'Europe de football (UEFA Euro), organisé tous les quatre ans. L'édition 2028 est donc l'Euro 2028, au Royaume-Uni et en Irlande."
      }
    },
    {
      "@type": "Question",
      "name": "L'Euro 2028 est-il la Coupe du Monde 2028 ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Non, il n'y a pas de Coupe du Monde en 2028 — la Coupe du Monde de football se joue tous les quatre ans, avec une édition en 2026 (États-Unis, Canada, Mexique) puis la suivante en 2030 (Espagne, Maroc, Portugal). En 2028, la seule grande compétition internationale de sélections en Europe est l'Euro, aussi appelé Coupe d'Europe."
      }
    },
    {
      "@type": "Question",
      "name": "Comment se qualifier pour l'Euro 2028 ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Les qualifications réunissent 12 groupes de 4 ou 5 équipes, de mars à novembre 2027. Les 12 vainqueurs de groupe et les 8 meilleurs deuxièmes se qualifient directement. Les places restantes se jouent en barrages en mars 2028, auxquels la Ligue des nations 2026-2027 peut donner accès. Le tirage au sort a lieu le 6 décembre 2026 à Belfast."
      }
    },
    {
      "@type": "Question",
      "name": "Combien d'équipes participent à l'Euro 2028 ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "24 équipes participent à l'Euro 2028, réparties en 6 groupes de 4. Les deux premiers de chaque groupe et les quatre meilleurs troisièmes se qualifient pour les huitièmes de finale, pour un total de 51 matchs."
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
    <span class="text-gray-400">2028</span>
</nav>

<!-- Hero -->
<header class="mb-10">
    <p class="text-green-400 text-xs font-semibold uppercase tracking-widest mb-1">Prochain grand tournoi européen</p>
    <h1 class="text-4xl font-bold text-white mb-2">Euro 2028</h1>
    <p class="text-gray-400 text-sm mb-1">9 juin — 9 juillet 2028 · Royaume-Uni &amp; République d'Irlande</p>
    <p class="text-gray-500 text-xs mb-4">Mis à jour le <time datetime="<?= $date_maj_page ?>"><?= date_fr_long($date_maj_page) ?></time></p>
    <p class="text-gray-300 leading-relaxed max-w-2xl">
        Pour la première fois depuis 1996, le Championnat d'Europe revient sur les îles britanniques.
        <a href="#pays-hotes" class="underline hover:text-green-400">Quatre nations hôtes</a>, <a href="#stades" class="underline hover:text-green-400">neuf stades</a>, Wembley pour la finale — et une équipe de France emmenée
        par Zinédine Zidane pour son premier grand tournoi international sur le banc des Bleus.
    </p>
</header>

<!-- Bandeau de navigation — sous-pages Euro 2028 -->
<nav class="flex flex-wrap gap-2 mb-10" aria-label="Pages Euro 2028">
    <a href="/euro-2028-les-8-villes-hotes.php" class="inline-flex items-center gap-1.5 bg-gray-800 border border-gray-700 hover:border-green-600 text-gray-300 hover:text-white px-4 py-2 text-xs font-semibold rounded-full transition-colors">🏙️ Les 8 villes hôtes</a>
    <a href="/euro-2028-les-9-stades.php" class="inline-flex items-center gap-1.5 bg-gray-800 border border-gray-700 hover:border-green-600 text-gray-300 hover:text-white px-4 py-2 text-xs font-semibold rounded-full transition-colors">🏟️ Les 9 stades</a>
    <a href="/euro-2028-les-equipes.php" class="inline-flex items-center gap-1.5 bg-gray-800 border border-gray-700 hover:border-green-600 text-gray-300 hover:text-white px-4 py-2 text-xs font-semibold rounded-full transition-colors">🌍 Les équipes</a>
    <a href="/euro-2028-pays-hotes.php" class="inline-flex items-center gap-1.5 bg-gray-800 border border-gray-700 hover:border-green-600 text-gray-300 hover:text-white px-4 py-2 text-xs font-semibold rounded-full transition-colors">🇬🇧 Les 4 nations hôtes</a>
    <a href="/comment-regarder-euro-2028.php" class="inline-flex items-center gap-1.5 bg-gray-800 border border-gray-700 hover:border-green-600 text-gray-300 hover:text-white px-4 py-2 text-xs font-semibold rounded-full transition-colors">📺 Où regarder (TF1, M6, beIN)</a>
    <a href="/euro-2028-paris-sportifs.php" class="inline-flex items-center gap-1.5 bg-gray-800 border border-gray-700 hover:border-green-600 text-gray-300 hover:text-white px-4 py-2 text-xs font-semibold rounded-full transition-colors">🎲 Paris sportifs</a>
    <a href="/euro-2028-qualifications.php" class="inline-flex items-center gap-1.5 bg-gray-800 border border-gray-700 hover:border-green-600 text-gray-300 hover:text-white px-4 py-2 text-xs font-semibold rounded-full transition-colors">📋 Qualifications &amp; liste des Bleus</a>
    <a href="/ligue-des-nations-2026-2027.php" class="inline-flex items-center gap-1.5 bg-gray-800 border border-gray-700 hover:border-green-600 text-gray-300 hover:text-white px-4 py-2 text-xs font-semibold rounded-full transition-colors">🥇 Ligue des Nations 2026-2027</a>
    <a href="/equipe-france.php" class="inline-flex items-center gap-1.5 bg-gray-800 border border-gray-700 hover:border-green-600 text-gray-300 hover:text-white px-4 py-2 text-xs font-semibold rounded-full transition-colors">🇫🇷 Équipe de France</a>
</nav>

<!-- Chiffres clés -->
<section class="grid grid-cols-3 sm:grid-cols-6 gap-3 mb-10">
    <?php
    $stats = [['4','Hôtes'],['24','Équipes'],['9','Stades'],['8','Villes'],['30','Jours'],['51','Matchs']];
    foreach ($stats as $s): ?>
    <div class="bg-gray-800 border border-gray-700 rounded-xl p-3 text-center">
        <div class="text-xl font-bold text-green-400"><?= $s[0] ?></div>
        <div class="text-gray-500 text-xs mt-1"><?= $s[1] ?></div>
    </div>
    <?php endforeach; ?>
</section>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">

    <!-- Pays hôtes -->
    <section id="pays-hotes" style="scroll-margin-top:5rem">
        <h2 class="text-2xl font-bold text-white mb-4">Quatre nations, une même île</h2>
        <div class="space-y-3">
            <?php
            $pays = [
                ['🏴󠁧󠁢󠁥󠁮󠁧󠁿', 'Angleterre', 'Wembley (finale), Tottenham, Birmingham, Liverpool, Newcastle, Manchester'],
                ['🏴󠁧󠁢󠁳󠁣󠁴󠁿', 'Écosse', 'Hampden Park, Glasgow'],
                ['🏴󠁧󠁢󠁷󠁬󠁳󠁿', 'Pays de Galles', 'Cardiff — match d\'ouverture'],
                ['🇮🇪', 'Irlande', 'Dublin Arena'],
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
        <a href="/euro-2028-les-8-villes-hotes.php" class="inline-flex items-center gap-1 text-green-400 hover:text-green-300 text-xs font-semibold mt-3">
            Découvrir les 8 villes hôtes en détail →
        </a>
        <a href="/euro-2028-les-equipes.php" class="inline-flex items-center gap-1 text-green-400 hover:text-green-300 text-xs font-semibold mt-3 ml-4">
            Voir le statut de toutes les équipes →
        </a>
        <a href="/euro-2028-pays-hotes.php" class="inline-flex items-center gap-1 text-green-400 hover:text-green-300 text-xs font-semibold mt-3 ml-4">
            Les 4 nations hôtes et leurs stades →
        </a>
    </section>

    <!-- Format -->
    <section id="format-qualifications" style="scroll-margin-top:5rem">
        <h2 class="text-2xl font-bold text-white mb-4">Format et qualifications</h2>
        <div class="bg-gray-800 rounded-xl border border-gray-700 p-6 text-sm text-gray-300 leading-relaxed space-y-3">
            <p>
                Le tournoi conserve le format de l'Euro 2024 : <strong class="text-white">24 équipes</strong>
                réparties en 6 groupes de 4. Les deux premiers de chaque poule et les quatre meilleurs
                troisièmes accèdent aux huitièmes de finale, pour un total de 51 matchs sur 30 jours.
            </p>
            <ul class="space-y-1.5 text-gray-400 pt-2 border-t border-gray-700">
                <li>📅 <strong class="text-white">25 mars 2027</strong> — début des qualifications</li>
                <li>📅 <strong class="text-white">28 mars 2028</strong> — fin des qualifications</li>
                <li>🗂️ 12 groupes de 4 ou 5 équipes</li>
                <li>✅ 12 vainqueurs + 8 meilleurs 2es qualifiés d'office</li>
                <li>🔁 Barrages en mars 2028 pour les dernières places (2, 3 ou 4 billets selon le nombre de places réservées aux hôtes)</li>
                <li>🇬🇧 Angleterre, Écosse, Pays de Galles et Irlande jouent aussi les qualifications, dans des groupes différents ; 2 places au maximum leur sont réservées s'ils échouent</li>
                <li>🥇 La Ligue des nations 2026-2027 peut ouvrir l'accès aux barrages, sans remplacer les éliminatoires</li>
                <li>🎟️ <strong class="text-white">6 décembre 2026</strong> — tirage au sort à Belfast</li>
            </ul>
        </div>
    </section>

</div>

<!-- Stades -->
<section id="stades" style="scroll-margin-top:5rem" class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-4">Les 9 stades retenus</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
        <?php
        $stades = [
            ['Wembley Stadium', 'Londres', '90 652', true, 'wembley-stadium', 'euro-2028-wembley-stadium.jpg'],
            ['Principality Stadium', 'Cardiff', '73 952', false, 'principality-stadium', 'euro-2028-principality-stadium-cardiff.jpg'],
            ['Tottenham Hotspur Stadium', 'Londres', '62 322', false, 'tottenham-hotspur-stadium', 'euro-2028-tottenham-hotspur-stadium.jpg'],
            ['Etihad Stadium', 'Manchester', '61 000', false, 'etihad-stadium', 'euro-2028-etihad-stadium-manchester.jpg'],
            ['Everton Stadium', 'Liverpool', '52 679', false, 'everton-stadium', 'euro-2028-everton-stadium-liverpool.jpg'],
            ['St James\' Park', 'Newcastle', '52 305', false, 'st-james-park', 'euro-2028-st-james-park-newcastle.jpg'],
            ['Villa Park', 'Birmingham', '52 190', false, 'villa-park', 'euro-2028-villa-park-birmingham.jpg'],
            ['Hampden Park', 'Glasgow', '52 032', false, 'hampden-park', 'euro-2028-hampden-park-glasgow.jpg'],
            ['Aviva Stadium', 'Dublin', '51 711', false, 'aviva-stadium', 'euro-2028-aviva-stadium-dublin.jpg'],
        ];
        foreach ($stades as [$nom, $ville, $capacite, $finale, $ancre, $image]): ?>
        <a href="/euro-2028-les-9-stades.php#<?= htmlspecialchars($ancre) ?>" class="bg-gray-800 border <?= $finale ? 'border-green-600' : 'border-gray-700' ?> hover:border-green-500 rounded-xl overflow-hidden transition-colors block">
            <img src="/images/stades/<?= htmlspecialchars($image) ?>" alt="<?= htmlspecialchars($nom) ?>" class="w-full h-28 object-cover" loading="lazy" />
            <div class="p-4">
                <?php if ($finale): ?>
                <span class="text-green-400 text-[10px] font-bold uppercase tracking-wider">🏆 Finale</span>
                <?php endif; ?>
                <div class="text-white font-semibold text-sm mt-1"><?= htmlspecialchars($nom) ?></div>
                <div class="text-gray-500 text-xs mt-1"><?= htmlspecialchars($ville) ?> · <?= htmlspecialchars($capacite) ?> places</div>
            </div>
        </a>
        <?php endforeach; ?>
    </div>
    <a href="/euro-2028-les-9-stades.php" class="inline-flex items-center gap-1 text-green-400 hover:text-green-300 text-xs font-semibold mt-4">
        Voir le détail de chaque stade et les matchs accueillis →
    </a>
</section>

<!-- La France de Zidane -->
<section id="france-zidane" style="scroll-margin-top:5rem" class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-4">La France de Zidane — objectif Wembley</h2>
    <div class="bg-gray-800 rounded-xl border border-green-800/40 p-6">
        <p class="text-gray-300 text-sm leading-relaxed mb-5">
            Nommé le 28 juillet 2026, Zinédine Zidane aura deux ans pour préparer son équipe avant
            l'Euro 2028 — son premier grand tournoi international à la tête des Bleus. La France reste
            l'une des meilleures nations mondiales après sa 4e place au Mondial 2026.
        </p>
        <p class="text-gray-300 text-sm leading-relaxed mb-5">
            Premier bilan en Ligue des nations : après quatre matchs sous Zidane, les Bleus comptent trois victoires
            (1-0 en Turquie, 1-0 puis 4-1 contre la Belgique) et un nul (1-1 contre l'Italie), et dominent le groupe A1
            avec 10 points. Un test grandeur nature avant les qualifications, dont le tirage a lieu le 6 décembre 2026.
            <a href="/blog/euro-2028-route-des-bleus-dates-format-qualifications" class="text-green-400 hover:text-green-300">La route des Bleus vers l'Euro →</a>
        </p>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
            <div class="bg-gray-900 border border-gray-700 rounded-lg p-3 text-center">
                <div class="text-xl mb-1">🏆</div>
                <div class="text-green-400 font-semibold text-xs">2 titres européens</div>
                <div class="text-gray-500 text-xs mt-1">1984 · 2000</div>
            </div>
            <div class="bg-gray-900 border border-gray-700 rounded-lg p-3 text-center">
                <div class="text-xl mb-1">🥇</div>
                <div class="text-green-400 font-semibold text-xs">Ligue des Nations</div>
                <div class="text-gray-500 text-xs mt-1">2021</div>
            </div>
            <div class="bg-gray-900 border border-gray-700 rounded-lg p-3 text-center">
                <div class="text-xl mb-1">👨‍💼</div>
                <div class="text-green-400 font-semibold text-xs">Zidane sélectionneur</div>
                <div class="text-gray-500 text-xs mt-1">Contrat jusqu'en 2030</div>
            </div>
        </div>
        <a href="/equipe-france.php" class="inline-flex items-center gap-1 text-green-400 hover:text-green-300 text-xs font-semibold mt-4">
            Voir la fiche complète de l'équipe de France →
        </a>
    </div>
</section>

<!-- Calendrier -->
<section id="calendrier" style="scroll-margin-top:5rem" class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-4">Calendrier</h2>
    <div class="bg-gray-800 rounded-xl border border-gray-700 divide-y divide-gray-700">
        <?php
        $etapes = [
            ['6 décembre 2026', 'Tirage au sort des qualifications', 'Belfast · Irlande du Nord'],
            ['Mars – Novembre 2027', 'Qualifications UEFA', '12 groupes de 4 ou 5 équipes · 54 nations'],
            ['Mars 2028', 'Barrages', 'Pour les dernières places'],
            ['9 juin 2028', 'Match d\'ouverture', 'Cardiff · National Stadium of Wales'],
            ['9–20 juin 2028', 'Phase de groupes', '6 groupes · 36 matchs'],
            ['24–27 juin 2028', 'Huitièmes de finale', '8 matchs'],
            ['1–2 juillet 2028', 'Quarts de finale', '4 matchs'],
            ['5–6 juillet 2028', 'Demi-finales', '2 matchs'],
            ['9 juillet 2028', 'Finale', 'Wembley Stadium · Londres'],
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
        * Calendrier indicatif basé sur les informations officielles UEFA. Les dates exactes des matchs seront confirmées ultérieurement.
    </p>
</section>

<!-- FAQ -->
<section id="faq" style="scroll-margin-top:5rem" class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-5">Foire aux questions : Euro 2028</h2>
    <div class="space-y-3">

        <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
            <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">
                Quand a lieu l'Euro 2028 ?
                <span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span>
            </summary>
            <p class="text-gray-400 text-sm leading-relaxed mt-3">
                L'Euro 2028 (Championnat d'Europe de football) se déroule du 9 juin au 9 juillet 2028. Les qualifications UEFA débutent dès le 25 mars 2027 et se terminent le 28 mars 2028.
            </p>
        </details>

        <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
            <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">
                Où se déroule l'Euro 2028 ?
                <span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span>
            </summary>
            <p class="text-gray-400 text-sm leading-relaxed mt-3">
                L'Euro 2028 se joue au Royaume-Uni et en République d'Irlande, dans 9 stades répartis sur 8 villes : Londres (Wembley, Tottenham Hotspur Stadium), Cardiff, Manchester, Liverpool, Newcastle, Birmingham, Glasgow et Dublin. Le match d'ouverture a lieu à Cardiff, la finale à Wembley.
            </p>
        </details>

        <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
            <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">
                Coupe d'Europe 2028, Euro 2028 : est-ce la même compétition ?
                <span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span>
            </summary>
            <p class="text-gray-400 text-sm leading-relaxed mt-3">
                Oui. « Coupe d'Europe » est une appellation courante pour désigner le Championnat d'Europe de football (UEFA Euro), organisé tous les quatre ans. L'édition 2028 est donc l'Euro 2028, au Royaume-Uni et en Irlande.
            </p>
        </details>

        <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
            <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">
                L'Euro 2028 est-il la Coupe du Monde 2028 ?
                <span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span>
            </summary>
            <p class="text-gray-400 text-sm leading-relaxed mt-3">
                Non, il n'y a pas de Coupe du Monde en 2028 — la Coupe du Monde de football se joue tous les quatre ans, avec une édition en 2026 (États-Unis, Canada, Mexique) puis la suivante en 2030 (Espagne, Maroc, Portugal). En 2028, la seule grande compétition internationale de sélections en Europe est l'Euro, aussi appelé Coupe d'Europe.
            </p>
        </details>

        <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
            <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">
                Comment se qualifier pour l'Euro 2028 ?
                <span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span>
            </summary>
            <p class="text-gray-400 text-sm leading-relaxed mt-3">
                Les qualifications réunissent 12 groupes de 4 ou 5 équipes, de mars à novembre 2027. Les 12 vainqueurs de groupe et les 8 meilleurs deuxièmes se qualifient directement (20 équipes). Les places restantes se jouent en barrages en mars 2028, auxquels la Ligue des nations 2026-2027 peut donner accès. Le tirage au sort a lieu le 6 décembre 2026 à Belfast.
            </p>
        </details>

        <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
            <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">
                Combien d'équipes participent à l'Euro 2028 ?
                <span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span>
            </summary>
            <p class="text-gray-400 text-sm leading-relaxed mt-3">
                24 équipes participent à l'Euro 2028, réparties en 6 groupes de 4. Les deux premiers de chaque groupe et les quatre meilleurs troisièmes se qualifient pour les huitièmes de finale, pour un total de 51 matchs.
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
    <a href="/equipe-france.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">🇫🇷 Équipe de France</a>
    <a href="/coupe-du-monde.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">🏆 Coupe du Monde</a>
    <a href="/calendrier.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">📅 Calendrier</a>
    <a href="/euro-2028-paris-sportifs.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">🎲 Paris sportifs Euro 2028</a>
    <a href="/comment-regarder-euro-2028.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">📺 Où regarder l'Euro 2028</a>
</section>

<?php include __DIR__ . '/templates/footer.php'; ?>
