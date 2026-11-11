<?php
require_once __DIR__ . '/blog/helpers.php';
$date_maj_page = '2026-11-11'; // à mettre à jour après chaque match des hôtes en Ligue des nations, au tirage du 6 décembre 2026 et à chaque qualification

$articlesAll = load_articles_index(__DIR__);
$articlesEuro = array_values(array_filter($articlesAll, fn($a) => ($a['categorie'] ?? '') === 'Euro'));
usort($articlesEuro, fn($a, $b) => strtotime($b['date']) <=> strtotime($a['date']));

$page_title = 'Euro 2028 : les 4 nations hôtes — Angleterre, Écosse, pays de Galles, Irlande';
$meta_desc  = "Euro 2028 : les 4 nations hôtes (Angleterre, Écosse, pays de Galles, Irlande), leurs 9 stades, leur groupe de Ligue des Nations et leur route vers les qualifications.";
$og_image   = '/images/stades/euro-2028-wembley-stadium.jpg';
include __DIR__ . '/templates/header.php';

$lk = 'class="text-green-400 underline hover:text-green-300"';

// Stades par nation : [nom, ancre sur /euro-2028-les-9-stades.php, ville, capacité indicative, matchs prévus]
$nations = [
    [
        'id' => 'angleterre', 'nom' => 'Angleterre',
        'intro' => "Six des neuf stades du tournoi sont en Angleterre, dont Wembley, qui accueillera la finale du 9 juillet 2028.",
        'stades' => [
            ['Wembley Stadium', 'wembley-stadium', 'Londres', '90 652', 'Groupes, quart de finale, deux demi-finales et finale'],
            ['Tottenham Hotspur Stadium', 'tottenham-hotspur-stadium', 'Londres', '62 322', 'Groupes et huitième de finale'],
            ['Etihad Stadium', 'etihad-stadium', 'Manchester', '61 000', 'Groupes et huitième de finale'],
            ['Everton Stadium', 'everton-stadium', 'Liverpool', '52 679', 'Groupes et huitième de finale'],
            ['St James\' Park', 'st-james-park', 'Newcastle', '52 305', 'Groupes et huitième de finale'],
            ['Villa Park', 'villa-park', 'Birmingham', '52 190', 'Groupes et huitième de finale'],
        ],
        'ldn' => ['Groupe C', '/ligue-des-nations-groupe-c.php', 'Espagne, Croatie, Angleterre, Tchéquie', "2e avec 9 points après un 3-0 contre la Tchéquie le 6 octobre", 'Angleterre - Croatie le jeudi 12 novembre à 20h45, puis Espagne - Angleterre le dimanche 15 novembre à 20h45'],
    ],
    [
        'id' => 'ecosse', 'nom' => 'Écosse',
        'intro' => "L'Écosse accueille l'Euro 2028 à Glasgow, au stade national de Hampden Park.",
        'stades' => [
            ['Hampden Park', 'hampden-park', 'Glasgow', '52 032', 'Groupes, huitième de finale et quart de finale'],
        ],
        'ldn' => ['Groupe E', '/ligue-des-nations-groupe-e.php', 'Suisse, Slovénie, Écosse, Macédoine du Nord', "3e avec 4 points, après une défaite 1-2 contre la Slovénie le 6 octobre", 'Écosse - Macédoine du Nord le vendredi 13 novembre à 20h45, puis Suisse - Écosse le lundi 16 novembre à 20h45'],
    ],
    [
        'id' => 'pays-de-galles', 'nom' => 'Pays de Galles',
        'intro' => "Le pays de Galles aura l'honneur d'ouvrir le tournoi : Cardiff accueille le match d'ouverture le 9 juin 2028.",
        'stades' => [
            ['Principality Stadium', 'principality-stadium', 'Cardiff', '73 952', "Match d'ouverture (9 juin), groupes, huitième de finale et quart de finale"],
        ],
        'ldn' => ['Groupe D', '/ligue-des-nations-groupe-d.php', 'Portugal, Norvège, Danemark, Pays de Galles', "3e avec 3 points, à égalité avec la Norvège, après une défaite 0-1 contre le Danemark le 4 octobre", 'Norvège - Pays de Galles le samedi 14 novembre à 18h00, puis Pays de Galles - Portugal le mardi 17 novembre à 20h45, à Cardiff'],
    ],
    [
        'id' => 'irlande', 'nom' => 'Irlande',
        'intro' => "La République d'Irlande accueille des matchs à Dublin, à l'Aviva Stadium, désigné « Dublin Arena » par l'UEFA.",
        'stades' => [
            ['Aviva Stadium (« Dublin Arena »)', 'aviva-stadium', 'Dublin', '51 711', 'Groupes, huitième de finale et quart de finale'],
        ],
        'ldn' => ['Groupe G', '/ligue-des-nations-groupe-g.php', 'Autriche, Kosovo, Irlande, Israël', "3e avec 5 points, à égalité avec le Kosovo, après un 1-1 contre Israël le 4 octobre", 'Autriche - Irlande le samedi 14 novembre à 20h45, puis Irlande - Kosovo le mardi 17 novembre à 20h45'],
    ],
];
?>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "Quels pays organisent l'Euro 2028 ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "L'Euro 2028 est organisé par quatre nations : l'Angleterre, l'Écosse, le pays de Galles et la République d'Irlande, dans neuf stades répartis sur huit villes."
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
      "name": "Où se jouent les matchs de l'Euro 2028 en Écosse, au pays de Galles et en Irlande ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "L'Écosse accueille des matchs à Hampden Park (Glasgow), le pays de Galles au Principality Stadium (Cardiff), où se joue le match d'ouverture le 9 juin 2028, et l'Irlande à l'Aviva Stadium (Dublin), désigné Dublin Arena par l'UEFA."
      }
    },
    {
      "@type": "Question",
      "name": "Combien de stades l'Angleterre accueille-t-elle à l'Euro 2028 ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Six des neuf stades du tournoi sont en Angleterre : Wembley et le Tottenham Hotspur Stadium à Londres, l'Etihad Stadium à Manchester, l'Everton Stadium à Liverpool, St James' Park à Newcastle et Villa Park à Birmingham."
      }
    },
    {
      "@type": "Question",
      "name": "Où aura lieu la finale de l'Euro 2028 ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "La finale de l'Euro 2028 se jouera à Wembley Stadium, à Londres, le dimanche 9 juillet 2028."
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
    <a href="/euro-2028-les-equipes.php" class="hover:text-green-400 transition-colors">Les équipes</a>
    <span>›</span>
    <span class="text-gray-400">Les 4 nations hôtes</span>
</nav>

<!-- Hero -->
<header class="mb-10">
    <p class="text-green-400 text-xs font-semibold uppercase tracking-widest mb-1">Euro 2028 · Les équipes</p>
    <h1 class="text-4xl font-bold text-white mb-2">Euro 2028 : les 4 nations hôtes</h1>
    <p class="text-gray-400 text-sm mb-1">Angleterre · Écosse · pays de Galles · Irlande — 9 stades, 8 villes</p>
    <p class="text-gray-500 text-xs mb-4">Mis à jour le <time datetime="<?= $date_maj_page ?>"><?= date_fr_long($date_maj_page) ?></time></p>
    <p class="text-gray-300 leading-relaxed max-w-2xl">
        L'Euro 2028 se joue du 9 juin au 9 juillet 2028 dans quatre nations. Pour chacune, cette page présente les stades qui accueilleront
        le tournoi, le groupe de Ligue des Nations de l'équipe et sa route vers les qualifications : les hôtes ne sont pas qualifiés d'office.
    </p>
</header>

<!-- Chiffres clés -->
<section class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-10">
    <div class="bg-gray-800 border border-green-800/40 rounded-xl p-4 text-center">
        <div class="text-2xl font-bold text-green-400">4</div>
        <div class="text-gray-400 text-xs mt-1">nations hôtes</div>
    </div>
    <div class="bg-gray-800 border border-gray-700 rounded-xl p-4 text-center">
        <div class="text-2xl font-bold text-white">9</div>
        <div class="text-gray-400 text-xs mt-1">stades</div>
    </div>
    <div class="bg-gray-800 border border-gray-700 rounded-xl p-4 text-center">
        <div class="text-2xl font-bold text-white">8</div>
        <div class="text-gray-400 text-xs mt-1">villes hôtes</div>
    </div>
    <div class="bg-gray-800 border border-gray-700 rounded-xl p-4 text-center">
        <div class="text-2xl font-bold text-white">2</div>
        <div class="text-gray-400 text-xs mt-1">places réservées<br>au maximum</div>
    </div>
</section>

<!-- Navigation par nation -->
<nav class="flex flex-wrap gap-2 mb-10" aria-label="Les 4 nations hôtes">
    <?php foreach ($nations as $n): ?>
    <a href="#<?= $n['id'] ?>" class="inline-flex items-center gap-1.5 bg-gray-800 border border-gray-700 hover:border-green-600 text-gray-300 hover:text-white px-4 py-2 text-xs font-semibold rounded-full transition-colors"><?= htmlspecialchars($n['nom']) ?></a>
    <?php endforeach; ?>
</nav>

<!-- Les 4 nations -->
<?php foreach ($nations as $n): ?>
<section id="<?= $n['id'] ?>" style="scroll-margin-top:5rem" class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-2"><?= htmlspecialchars($n['nom']) ?> : <?= count($n['stades']) > 1 ? 'les ' . count($n['stades']) . ' stades' : 'le stade' ?> de l'Euro 2028</h2>
    <p class="text-gray-300 text-sm leading-relaxed mb-4"><?= htmlspecialchars($n['intro']) ?></p>

    <div class="bg-gray-800 border border-gray-700 rounded-xl overflow-x-auto mb-4">
        <table class="w-full text-sm">
            <caption class="text-left text-gray-400 text-xs px-4 pt-3 pb-1">Euro 2028 : <?= count($n['stades']) > 1 ? 'les stades' : 'le stade' ?> en <?= htmlspecialchars($n['nom']) ?>, capacités indicatives et matchs prévus</caption>
            <thead>
                <tr class="text-gray-500 uppercase text-xs border-b border-gray-700">
                    <th class="text-left px-4 py-2 font-semibold">Stade</th>
                    <th class="text-left px-4 py-2 font-semibold">Ville</th>
                    <th class="text-left px-4 py-2 font-semibold">Capacité</th>
                    <th class="text-left px-4 py-2 font-semibold">Matchs</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-700/60 text-gray-300">
                <?php foreach ($n['stades'] as $s): ?>
                <tr>
                    <td class="px-4 py-2"><a href="/euro-2028-les-9-stades.php#<?= htmlspecialchars($s[1]) ?>" <?= $lk ?>><?= htmlspecialchars($s[0]) ?></a></td>
                    <td class="px-4 py-2"><?= htmlspecialchars($s[2]) ?></td>
                    <td class="px-4 py-2 whitespace-nowrap"><?= htmlspecialchars($s[3]) ?> places</td>
                    <td class="px-4 py-2"><?= htmlspecialchars($s[4]) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="bg-gray-800 rounded-xl border border-green-800/40 p-5 text-sm text-gray-300 leading-relaxed space-y-2">
        <p>
            <strong class="text-white">En Ligue des Nations 2026-2027 :</strong>
            <a href="<?= htmlspecialchars($n['ldn'][1]) ?>" <?= $lk ?>><?= htmlspecialchars($n['ldn'][0]) ?></a>
            (<?= htmlspecialchars($n['ldn'][2]) ?>) — <?= htmlspecialchars($n['ldn'][3]) ?>.
        </p>
        <p><strong class="text-white">Prochains matchs :</strong> <?= htmlspecialchars($n['ldn'][4]) ?>.</p>
        <p class="text-gray-400 text-xs">Pas encore qualifié pour l'Euro 2028 : <?= htmlspecialchars($n['nom']) ?> joue les qualifications à partir du 25 mars 2027, avec au maximum 2 places réservées aux hôtes qui échoueraient.</p>
    </div>
</section>
<?php endforeach; ?>

<!-- Qualification des hôtes -->
<section id="qualification-hotes" style="scroll-margin-top:5rem" class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-4">Comment les nations hôtes se qualifient-elles ?</h2>
    <div class="bg-gray-800 rounded-xl border border-gray-700 p-6 text-sm text-gray-300 leading-relaxed space-y-3">
        <ul class="space-y-2">
            <li>🎟️ <strong class="text-white">6 décembre 2026</strong> : tirage au sort des qualifications à Belfast.</li>
            <li>📅 <strong class="text-white">Du 25 mars 2027 au 28 mars 2028</strong> : matchs de qualification, les quatre hôtes dans des groupes différents.</li>
            <li>✅ Les 12 vainqueurs de groupe et les 8 meilleurs deuxièmes se qualifient directement.</li>
            <li>🎫 <strong class="text-white">2 places au maximum</strong> sont réservées aux hôtes qui ne se seraient pas qualifiés autrement.</li>
        </ul>
        <p>
            Tout le règlement sur notre page <a href="/euro-2028-qualifications.php" <?= $lk ?>>qualifications de l'Euro 2028</a>
            et dans notre article <a href="/blog/qualifications-euro-2028-mode-emploi-barrages-pays-hotes" <?= $lk ?>>qualifications, barrages et places des pays hôtes</a>.
        </p>
    </div>
</section>

<!-- Liens stades / villes -->
<section id="stades-villes" style="scroll-margin-top:5rem" class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-4">Découvrir les stades et les villes</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <a href="/euro-2028-les-9-stades.php" class="bg-gray-800 border border-gray-700 hover:border-green-600 rounded-xl p-5 transition-colors block">
            <p class="text-green-400 text-xs font-semibold uppercase tracking-wider mb-2">Les 9 stades</p>
            <p class="text-white font-bold text-lg">Capacités, photos et matchs par enceinte</p>
            <p class="text-gray-400 text-sm mt-1">De Wembley (90 652 places) à l'Aviva Stadium (51 711 places) →</p>
        </a>
        <a href="/euro-2028-les-8-villes-hotes.php" class="bg-gray-800 border border-gray-700 hover:border-green-600 rounded-xl p-5 transition-colors block">
            <p class="text-green-400 text-xs font-semibold uppercase tracking-wider mb-2">Les 8 villes hôtes</p>
            <p class="text-white font-bold text-lg">Londres, Cardiff, Manchester, Liverpool, Newcastle, Birmingham, Glasgow, Dublin</p>
            <p class="text-gray-400 text-sm mt-1">Découvrir chaque ville hôte →</p>
        </a>
    </div>
</section>

<!-- FAQ -->
<section id="faq" style="scroll-margin-top:5rem" class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-5">Foire aux questions : les nations hôtes de l'Euro 2028</h2>
    <div class="space-y-3">
        <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
            <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">
                Quels pays organisent l'Euro 2028 ?
                <span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span>
            </summary>
            <p class="text-gray-400 text-sm leading-relaxed mt-3">L'Euro 2028 est organisé par quatre nations : l'Angleterre, l'Écosse, le pays de Galles et la République d'Irlande, dans neuf stades répartis sur huit villes.</p>
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
                Où se jouent les matchs de l'Euro 2028 en Écosse, au pays de Galles et en Irlande ?
                <span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span>
            </summary>
            <p class="text-gray-400 text-sm leading-relaxed mt-3">L'Écosse accueille des matchs à Hampden Park (Glasgow), le pays de Galles au Principality Stadium (Cardiff), où se joue le match d'ouverture le 9 juin 2028, et l'Irlande à l'Aviva Stadium (Dublin), désigné Dublin Arena par l'UEFA.</p>
        </details>
        <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
            <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">
                Combien de stades l'Angleterre accueille-t-elle à l'Euro 2028 ?
                <span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span>
            </summary>
            <p class="text-gray-400 text-sm leading-relaxed mt-3">Six des neuf stades du tournoi sont en Angleterre : Wembley et le Tottenham Hotspur Stadium à Londres, l'Etihad Stadium à Manchester, l'Everton Stadium à Liverpool, St James' Park à Newcastle et Villa Park à Birmingham.</p>
        </details>
        <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
            <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">
                Où aura lieu la finale de l'Euro 2028 ?
                <span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span>
            </summary>
            <p class="text-gray-400 text-sm leading-relaxed mt-3">La finale de l'Euro 2028 se jouera à Wembley Stadium, à Londres, le dimanche 9 juillet 2028.</p>
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
    <a href="/euro-2028-les-equipes.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">🌍 Toutes les équipes</a>
    <a href="/euro-2028-les-9-stades.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">🏟️ Les 9 stades</a>
    <a href="/euro-2028-qualifications.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">📋 Qualifications</a>
    <a href="/euro-2028.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">🏆 Euro 2028</a>
</section>

<?php include __DIR__ . '/templates/footer.php'; ?>
