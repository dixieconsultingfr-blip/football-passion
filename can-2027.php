<?php
require_once __DIR__ . '/blog/helpers.php';
$date_maj_page = '2026-11-18'; // à mettre à jour après chaque journée (résultats, classements)

$articlesAll = load_articles_index(__DIR__);
$articlesCan = array_values(array_filter($articlesAll, fn($a) => ($a['categorie'] ?? '') === 'CAN' || in_array('CAN 2027', $a['etiquettes'] ?? [], true)));
usort($articlesCan, fn($a, $b) => strtotime($b['date']) <=> strtotime($a['date']));

$page_title = 'CAN 2027 : dates, pays hôtes, qualifiés et éliminatoires';
$meta_desc  = "CAN 2027 du 19 juin au 17 juillet 2027 (Kenya, Tanzanie, Ouganda) : qui est qualifié, comment se qualifier, les 12 groupes des éliminatoires, les classements après la journée 4, le programme des journées 5 et 6 et tous nos articles.";
include __DIR__ . '/templates/header.php';

$lk = 'class="text-green-400 underline hover:text-green-300"';

// Classements après la journée 4 (points ; départage : différence de buts puis buts marqués, ordre indicatif). Source : Foot Mercato, calendrier de chaque groupe.
$classements = [
    'A' => [['Maroc', 12], ['Gabon', 6], ['Niger', 3], ['Lesotho', 3]],
    'B' => [['Angola', 10], ['Égypte', 8], ['Malawi', 4], ['Soudan du Sud', 0]],
    'C' => [['Côte d\'Ivoire', 10], ['Gambie', 7], ['Ghana', 6], ['Somalie', 0]],
    'D' => [['Afrique du Sud', 10], ['Guinée', 9], ['Kenya', 2], ['Érythrée', 1]],
    'E' => [['RD Congo', 10], ['Zimbabwe', 7], ['Guinée équatoriale', 4], ['Sierra Leone', 1]],
    'F' => [['Bénin', 10], ['Burkina Faso', 10], ['Mauritanie', 3], ['Centrafrique', 0]],
    'G' => [['Cameroun', 10], ['Comores', 7], ['Namibie', 3], ['Congo', 2]],
    'H' => [['Ouganda', 6], ['Libye', 5], ['Botswana', 4], ['Tunisie', 3]],
    'I' => [['Algérie', 7], ['Togo', 6], ['Zambie', 5], ['Burundi', 3]],
    'J' => [['Sénégal', 10], ['Mozambique', 7], ['Soudan', 3], ['Éthiopie', 3]],
    'K' => [['Mali', 12], ['Rwanda', 6], ['Cap-Vert', 3], ['Liberia', 3]],
    'L' => [['Guinée-Bissau', 10], ['Nigeria', 7], ['Madagascar', 2], ['Tanzanie', 2]],
];
$groupesTitres = [
    'A' => 'Groupe A : Maroc, Gabon, Niger, Lesotho',
    'B' => 'Groupe B : Égypte, Angola, Malawi, Soudan du Sud',
    'C' => 'Groupe C : Côte d\'Ivoire, Gambie, Ghana, Somalie',
    'D' => 'Groupe D : Afrique du Sud, Guinée, Kenya, Érythrée',
    'E' => 'Groupe E : RD Congo, Zimbabwe, Guinée équatoriale, Sierra Leone',
    'F' => 'Groupe F : Bénin, Burkina Faso, Mauritanie, Centrafrique',
    'G' => 'Groupe G : Cameroun, Comores, Namibie, Congo',
    'H' => 'Groupe H : Ouganda, Botswana, Tunisie, Libye',
    'I' => 'Groupe I : Algérie, Zambie, Togo, Burundi',
    'J' => 'Groupe J : Sénégal, Mozambique, Soudan, Éthiopie',
    'K' => 'Groupe K : Mali, Rwanda, Cap-Vert, Liberia',
    'L' => 'Groupe L : Guinée-Bissau, Nigeria, Tanzanie, Madagascar',
];
$groupesIntro = [
    'A' => 'Maroc compte 12 points, devant Gabon (6 points).',
    'B' => 'Angola compte 10 points, devant Égypte (8 points).',
    'C' => 'Côte d\'Ivoire compte 10 points, devant Gambie (7 points).',
    'D' => 'Afrique du Sud compte 10 points, devant Guinée (9 points).',
    'E' => 'RD Congo compte 10 points, devant Zimbabwe (7 points).',
    'F' => 'Bénin et Burkina Faso sont à égalité avec 10 points ; Bénin est devant grâce à la différence de buts (+5 contre +4).',
    'G' => 'Cameroun compte 10 points, devant Comores (7 points).',
    'H' => 'Ouganda compte 6 points, devant Libye (5 points).',
    'I' => 'Algérie compte 7 points, devant Togo (6 points), qui l\'a battue 3-0 à Lomé.',
    'J' => 'Sénégal compte 10 points, devant Mozambique (7 points).',
    'K' => 'Mali compte 12 points, devant Rwanda (6 points).',
    'L' => 'Guinée-Bissau compte 10 points, devant Nigeria (7 points).',
];
// Résultats et calendrier complets par groupe (source : Foot Mercato). [date, match, score ou heure]
$calendriers = [
    'A' => [
        ['Ven. 25 septembre 2026', 'Niger - Lesotho', '2-1'],
        ['Ven. 25 septembre 2026', 'Maroc - Gabon', '2-0'],
        ['Mar. 29 septembre 2026', 'Lesotho - Maroc', '0-2'],
        ['Mar. 29 septembre 2026', 'Gabon - Niger', '2-0'],
        ['Ven. 13 novembre 2026', 'Gabon - Lesotho', '2-0'],
        ['Ven. 13 novembre 2026', 'Maroc - Niger', '5-1'],
        ['Mar. 17 novembre 2026', 'Lesotho - Gabon', '2-1'],
        ['Mar. 17 novembre 2026', 'Niger - Maroc', '0-1'],
        ['Mer. 24 mars 2027', 'Gabon - Maroc', '20h00'],
        ['Mer. 24 mars 2027', 'Lesotho - Niger', '20h00'],
        ['Dim. 28 mars 2027', 'Niger - Gabon', '21h00'],
        ['Dim. 28 mars 2027', 'Maroc - Lesotho', '21h00'],
    ],
    'B' => [
        ['Ven. 25 septembre 2026', 'Malawi - Soudan du Sud', '2-1'],
        ['Ven. 25 septembre 2026', 'Égypte - Angola', '0-0'],
        ['Mar. 29 septembre 2026', 'Soudan du Sud - Égypte', '0-5'],
        ['Mar. 6 octobre 2026', 'Angola - Malawi', '3-1'],
        ['Ven. 13 novembre 2026', 'Égypte - Malawi', '5-0'],
        ['Sam. 14 novembre 2026', 'Angola - Soudan du Sud', '2-0'],
        ['Mar. 17 novembre 2026', 'Malawi - Égypte', '0-0'],
        ['Mar. 17 novembre 2026', 'Soudan du Sud - Angola', '0-1'],
        ['Mer. 24 mars 2027', 'Angola - Égypte', '20h00'],
        ['Mer. 24 mars 2027', 'Soudan du Sud - Malawi', '20h00'],
        ['Dim. 28 mars 2027', 'Égypte - Soudan du Sud', '21h00'],
        ['Dim. 28 mars 2027', 'Malawi - Angola', '21h00'],
    ],
    'C' => [
        ['Jeu. 24 septembre 2026', 'Côte d\'Ivoire - Ghana', '2-0'],
        ['Ven. 25 septembre 2026', 'Gambie - Somalie', '2-1'],
        ['Mar. 29 septembre 2026', 'Ghana - Gambie', '2-4'],
        ['Mar. 29 septembre 2026', 'Somalie - Côte d\'Ivoire', '0-2'],
        ['Jeu. 12 novembre 2026', 'Ghana - Somalie', '2-0'],
        ['Jeu. 12 novembre 2026', 'Côte d\'Ivoire - Gambie', '2-1'],
        ['Lun. 16 novembre 2026', 'Somalie - Ghana', '0-1'],
        ['Mar. 17 novembre 2026', 'Gambie - Côte d\'Ivoire', '2-2'],
        ['Mer. 24 mars 2027', 'Somalie - Gambie', '20h00'],
        ['Mer. 24 mars 2027', 'Ghana - Côte d\'Ivoire', '20h00'],
        ['Dim. 28 mars 2027', 'Côte d\'Ivoire - Somalie', '21h00'],
        ['Dim. 28 mars 2027', 'Gambie - Ghana', '21h00'],
    ],
    'D' => [
        ['Sam. 26 septembre 2026', 'Afrique du Sud - Guinée', '2-1'],
        ['Sam. 26 septembre 2026', 'Kenya - Érythrée', '1-1'],
        ['Mer. 30 septembre 2026', 'Érythrée - Afrique du Sud', '0-5'],
        ['Jeu. 1er octobre 2026', 'Guinée - Kenya', '1-0'],
        ['Jeu. 12 novembre 2026', 'Guinée - Érythrée', '2-1'],
        ['Ven. 13 novembre 2026', 'Afrique du Sud - Kenya', '2-2'],
        ['Lun. 16 novembre 2026', 'Érythrée - Guinée', '1-3'],
        ['Mar. 17 novembre 2026', 'Kenya - Afrique du Sud', '1-2'],
        ['Mer. 24 mars 2027', 'Guinée - Afrique du Sud', '20h00'],
        ['Mer. 24 mars 2027', 'Érythrée - Kenya', '20h00'],
        ['Dim. 28 mars 2027', 'Afrique du Sud - Érythrée', '21h00'],
        ['Dim. 28 mars 2027', 'Kenya - Guinée', '21h00'],
    ],
    'E' => [
        ['Jeu. 24 septembre 2026', 'RD Congo - Guinée équatoriale', '2-0'],
        ['Jeu. 24 septembre 2026', 'Sierra Leone - Zimbabwe', '2-3'],
        ['Lun. 28 septembre 2026', 'Guinée équatoriale - Sierra Leone', '1-0'],
        ['Lun. 28 septembre 2026', 'Zimbabwe - RD Congo', '1-2'],
        ['Jeu. 12 novembre 2026', 'RD Congo - Sierra Leone', '3-1'],
        ['Jeu. 12 novembre 2026', 'Guinée équatoriale - Zimbabwe', '0-0'],
        ['Lun. 16 novembre 2026', 'Zimbabwe - Guinée équatoriale', '3-0'],
        ['Mar. 17 novembre 2026', 'Sierra Leone - RD Congo', '1-1'],
        ['Mer. 24 mars 2027', 'Guinée équatoriale - RD Congo', '20h00'],
        ['Mer. 24 mars 2027', 'Zimbabwe - Sierra Leone', '20h00'],
        ['Dim. 28 mars 2027', 'RD Congo - Zimbabwe', '21h00'],
        ['Dim. 28 mars 2027', 'Sierra Leone - Guinée équatoriale', '21h00'],
    ],
    'F' => [
        ['Jeu. 24 septembre 2026', 'Mauritanie - Centrafrique', '3-1'],
        ['Ven. 25 septembre 2026', 'Burkina Faso - Bénin', '1-1'],
        ['Lun. 28 septembre 2026', 'Centrafrique - Burkina Faso', '0-1'],
        ['Mar. 29 septembre 2026', 'Bénin - Mauritanie', '2-1'],
        ['Jeu. 12 novembre 2026', 'Bénin - Centrafrique', '4-1'],
        ['Ven. 13 novembre 2026', 'Burkina Faso - Mauritanie', '1-0'],
        ['Lun. 16 novembre 2026', 'Centrafrique - Bénin', '0-1'],
        ['Mar. 17 novembre 2026', 'Mauritanie - Burkina Faso', '1-3'],
        ['Mer. 24 mars 2027', 'Centrafrique - Mauritanie', '20h00'],
        ['Mer. 24 mars 2027', 'Bénin - Burkina Faso', '20h00'],
        ['Dim. 28 mars 2027', 'Mauritanie - Bénin', '21h00'],
        ['Dim. 28 mars 2027', 'Burkina Faso - Centrafrique', '21h00'],
    ],
    'G' => [
        ['Jeu. 24 septembre 2026', 'Namibie - Congo', '1-0'],
        ['Jeu. 24 septembre 2026', 'Cameroun - Comores', '3-1'],
        ['Mar. 29 septembre 2026', 'Comores - Namibie', '1-0'],
        ['Mar. 29 septembre 2026', 'Congo - Cameroun', '1-1'],
        ['Jeu. 12 novembre 2026', 'Cameroun - Namibie', '2-0'],
        ['Ven. 13 novembre 2026', 'Comores - Congo', '0-0'],
        ['Lun. 16 novembre 2026', 'Namibie - Cameroun', '0-3'],
        ['Mar. 17 novembre 2026', 'Congo - Comores', '0-1'],
        ['Mer. 24 mars 2027', 'Comores - Cameroun', '20h00'],
        ['Mer. 24 mars 2027', 'Congo - Namibie', '20h00'],
        ['Dim. 28 mars 2027', 'Namibie - Comores', '21h00'],
        ['Dim. 28 mars 2027', 'Cameroun - Congo', '21h00'],
    ],
    'H' => [
        ['Jeu. 24 septembre 2026', 'Libye - Botswana', '2-2'],
        ['Jeu. 24 septembre 2026', 'Tunisie - Ouganda', '1-1'],
        ['Lun. 28 septembre 2026', 'Tunisie - Botswana', '2-2'],
        ['Mar. 29 septembre 2026', 'Ouganda - Libye', '1-0'],
        ['Ven. 13 novembre 2026', 'Tunisie - Libye', '0-2'],
        ['Sam. 14 novembre 2026', 'Ouganda - Botswana', '1-1'],
        ['Mar. 17 novembre 2026', 'Libye - Tunisie', '1-1'],
        ['Mar. 17 novembre 2026', 'Botswana - Ouganda', '1-1'],
        ['Mer. 24 mars 2027', 'Ouganda - Tunisie', '20h00'],
        ['Mer. 24 mars 2027', 'Botswana - Libye', '20h00'],
        ['Dim. 28 mars 2027', 'Botswana - Tunisie', '21h00'],
        ['Dim. 28 mars 2027', 'Libye - Ouganda', '21h00'],
    ],
    'I' => [
        ['Ven. 25 septembre 2026', 'Togo - Burundi', '1-0'],
        ['Ven. 25 septembre 2026', 'Algérie - Zambie', '3-1'],
        ['Mar. 29 septembre 2026', 'Burundi - Algérie', '2-2'],
        ['Mar. 29 septembre 2026', 'Zambie - Togo', '2-0'],
        ['Ven. 13 novembre 2026', 'Zambie - Burundi', '1-1'],
        ['Sam. 14 novembre 2026', 'Algérie - Togo', '1-0'],
        ['Mar. 17 novembre 2026', 'Burundi - Zambie', '1-1'],
        ['Mar. 17 novembre 2026', 'Togo - Algérie', '3-0'],
        ['Mer. 24 mars 2027', 'Zambie - Algérie', '20h00'],
        ['Mer. 24 mars 2027', 'Burundi - Togo', '20h00'],
        ['Dim. 28 mars 2027', 'Algérie - Burundi', '21h00'],
        ['Dim. 28 mars 2027', 'Togo - Zambie', '21h00'],
    ],
    'J' => [
        ['Ven. 25 septembre 2026', 'Soudan - Éthiopie', '1-0'],
        ['Ven. 25 septembre 2026', 'Mozambique - Sénégal', '1-1'],
        ['Mar. 29 septembre 2026', 'Mozambique - Soudan', '4-1'],
        ['Mar. 29 septembre 2026', 'Éthiopie - Sénégal', '0-1'],
        ['Jeu. 12 novembre 2026', 'Sénégal - Soudan', '4-1'],
        ['Ven. 13 novembre 2026', 'Mozambique - Éthiopie', '0-1'],
        ['Lun. 16 novembre 2026', 'Soudan - Sénégal', '2-4'],
        ['Mar. 17 novembre 2026', 'Éthiopie - Mozambique', '0-1'],
        ['Mer. 24 mars 2027', 'Sénégal - Mozambique', '20h00'],
        ['Mer. 24 mars 2027', 'Éthiopie - Soudan', '20h00'],
        ['Dim. 28 mars 2027', 'Soudan - Mozambique', '21h00'],
        ['Dim. 28 mars 2027', 'Sénégal - Éthiopie', '21h00'],
    ],
    'K' => [
        ['Ven. 25 septembre 2026', 'Rwanda - Liberia', '3-1'],
        ['Ven. 25 septembre 2026', 'Mali - Cap-Vert', '3-1'],
        ['Mar. 29 septembre 2026', 'Cap-Vert - Rwanda', '1-2'],
        ['Mar. 29 septembre 2026', 'Liberia - Mali', '0-1'],
        ['Ven. 13 novembre 2026', 'Cap-Vert - Liberia', '4-2'],
        ['Ven. 13 novembre 2026', 'Mali - Rwanda', '3-2'],
        ['Mar. 17 novembre 2026', 'Liberia - Cap-Vert', '2-0'],
        ['Mar. 17 novembre 2026', 'Rwanda - Mali', '0-2'],
        ['Mer. 24 mars 2027', 'Cap-Vert - Mali', '20h00'],
        ['Mer. 24 mars 2027', 'Liberia - Rwanda', '20h00'],
        ['Dim. 28 mars 2027', 'Mali - Liberia', '21h00'],
        ['Dim. 28 mars 2027', 'Rwanda - Cap-Vert', '21h00'],
    ],
    'L' => [
        ['Ven. 25 septembre 2026', 'Tanzanie - Guinée-Bissau', '0-2'],
        ['Ven. 25 septembre 2026', 'Nigeria - Madagascar', '2-1'],
        ['Mar. 29 septembre 2026', 'Madagascar - Tanzanie', '1-1'],
        ['Mar. 29 septembre 2026', 'Guinée-Bissau - Nigeria', '3-0'],
        ['Jeu. 12 novembre 2026', 'Madagascar - Guinée-Bissau', '1-1'],
        ['Ven. 13 novembre 2026', 'Nigeria - Tanzanie', '3-1'],
        ['Mar. 17 novembre 2026', 'Tanzanie - Nigeria', '0-0'],
        ['Mar. 17 novembre 2026', 'Guinée-Bissau - Madagascar', '2-0'],
        ['Mer. 24 mars 2027', 'Guinée-Bissau - Tanzanie', '20h00'],
        ['Mer. 24 mars 2027', 'Madagascar - Nigeria', '20h00'],
        ['Dim. 28 mars 2027', 'Tanzanie - Madagascar', '21h00'],
        ['Dim. 28 mars 2027', 'Nigeria - Guinée-Bissau', '21h00'],
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
      "name": "Qui organise la CAN 2027 ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "La phase finale de la Coupe d'Afrique des Nations 2027 est organisée conjointement par le Kenya, la Tanzanie et l'Ouganda."
      }
    },
    {
      "@type": "Question",
      "name": "Combien de groupes dans les éliminatoires de la CAN 2027 ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Les éliminatoires de la CAN 2027 comptent douze groupes de quatre équipes, de A à L."
      }
    },
    {
      "@type": "Question",
      "name": "Quand se jouent les journées 3 et 4 des éliminatoires de la CAN 2027 ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "La 3e journée s'est jouée du 12 au 14 novembre 2026 et la 4e journée les 16 et 17 novembre 2026 ; les journées 5 et 6 ont lieu les 24 et 28 mars 2027."
      }
    },
    {
      "@type": "Question",
      "name": "Où se joue la CAN 2027 ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "La CAN 2027 est organisée conjointement par le Kenya, la Tanzanie et l'Ouganda, une première en trois pays."
      }
    },
    {
      "@type": "Question",
      "name": "Quand débute la CAN 2027 ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "La phase finale de la CAN 2027 se joue du 19 juin au 17 juillet 2027 : match d'ouverture le samedi 19 juin et finale le samedi 17 juillet, selon la CAF. Le pays hôte du match d'ouverture et celui de la finale n'étaient pas encore désignés dans son annonce."
      }
    },
    {
      "@type": "Question",
      "name": "Qui est qualifié pour la CAN 2027 ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "À ce jour, seuls les trois pays hôtes sont qualifiés d'office : le Kenya, la Tanzanie et l'Ouganda. Les autres places se jouent dans les éliminatoires jusqu'en mars 2027."
      }
    },
    {
      "@type": "Question",
      "name": "Combien d'équipes se qualifient par groupe ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Selon Le360 Afrique, les deux premiers de chaque groupe sans pays hôte se qualifient ; dans les groupes D, H et L, qui comptent un pays hôte, une seule équipe se qualifie en plus de l'hôte."
      }
    },
    {
      "@type": "Question",
      "name": "Quand se jouent les dernières journées des éliminatoires ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "La journée 4 se joue les 16 et 17 novembre 2026, puis les journées 5 et 6 les 24 et 28 mars 2027."
      }
    }
  ]
}
</script>

<?php
$tickerComps = ['CAN']; $tickerLabel = '🌍 CAN 2027 · actus & scores'; $tickerLink = '/can-2027.php#classements'; $tickerLimit = 12; $tickerArticles = 3; $tickerArtCats = ['CAN', 'CAN 2027'];
include __DIR__ . '/templates/ticker-resultats.php';
?>

<nav class="text-xs text-gray-400 mb-8 flex items-center gap-2">
    <a href="/" class="hover:text-green-400 transition-colors">Accueil</a>
    <span>›</span>
    <a href="/blog/?cat=CAN" class="hover:text-green-400 transition-colors">CAN</a>
    <span>›</span>
    <span class="text-gray-400">2027</span>
</nav>

<header class="mb-10">
    <p class="text-green-400 text-xs font-semibold uppercase tracking-widest mb-1">Coupe d'Afrique des Nations · sélections masculines</p>
    <h1 class="text-4xl font-bold text-white mb-2">CAN 2027 : dates, pays hôtes, qualifiés et éliminatoires</h1>
    <p class="text-gray-500 text-xs mb-4">Mis à jour le <time datetime="<?= $date_maj_page ?>"><?= date_fr_long($date_maj_page) ?></time></p>
    <p class="text-gray-300 leading-relaxed max-w-2xl">
        La phase finale de la CAN 2027 est organisée conjointement par le Kenya, la Tanzanie et l'Ouganda, du 19 juin au 17 juillet 2027. Les éliminatoires réunissent douze groupes de quatre équipes :
        retrouvez ici les dates, les qualifiés, les classements, le calendrier et tous nos articles.
    </p>
</header>

<section id="en-bref" style="scroll-margin-top:5rem" class="mb-12 bg-gray-800 border border-green-800/40 rounded-xl p-6">
    <h2 class="text-xl font-bold text-white mb-3">CAN 2027 en bref</h2>
    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-3 text-sm">
        <div><dt class="text-green-400 font-semibold">Quand ?</dt><dd class="text-gray-300">Du 19 juin au 17 juillet 2027 (dates officielles CAF)</dd></div>
        <div><dt class="text-green-400 font-semibold">Où ?</dt><dd class="text-gray-300">Kenya, Tanzanie et Ouganda, une première en trois pays</dd></div>
        <div><dt class="text-green-400 font-semibold">Format</dt><dd class="text-gray-300">24 équipes, 52 matchs</dd></div>
        <div><dt class="text-green-400 font-semibold">Qualifiés à ce jour</dt><dd class="text-gray-300">Kenya, Tanzanie et Ouganda, d'office comme pays hôtes</dd></div>
        <div><dt class="text-green-400 font-semibold">Éliminatoires</dt><dd class="text-gray-300">12 groupes de 4 équipes (A à L), 6 journées, de septembre 2026 à mars 2027</dd></div>
        <div><dt class="text-green-400 font-semibold">Prochaines journées</dt><dd class="text-gray-300">Journées 5 et 6 les 24 et 28 mars 2027 (journée 4 jouée les 16 et 17 novembre 2026)</dd></div>
    </dl>
</section>

<nav class="flex flex-wrap gap-2 mb-10" aria-label="Sections CAN 2027">
    <a href="#qualification" class="inline-flex bg-gray-800 border border-gray-700 hover:border-green-600 text-gray-300 hover:text-white px-4 py-2 text-xs font-semibold rounded-full transition-colors">✅ Qualifiés</a>
    <a href="#classements" class="inline-flex bg-gray-800 border border-gray-700 hover:border-green-600 text-gray-300 hover:text-white px-4 py-2 text-xs font-semibold rounded-full transition-colors">📊 Classements</a>
    <a href="#groupe-a" class="inline-flex bg-gray-800 border border-gray-700 hover:border-green-600 text-gray-300 hover:text-white px-4 py-2 text-xs font-semibold rounded-full transition-colors">🗂️ Les 12 groupes</a>
    <a href="#programme" class="inline-flex bg-gray-800 border border-gray-700 hover:border-green-600 text-gray-300 hover:text-white px-4 py-2 text-xs font-semibold rounded-full transition-colors">📺 Programme TV</a>
    <a href="#articles" class="inline-flex bg-gray-800 border border-gray-700 hover:border-green-600 text-gray-300 hover:text-white px-4 py-2 text-xs font-semibold rounded-full transition-colors">📰 Nos articles</a>
    <a href="#faq" class="inline-flex bg-gray-800 border border-gray-700 hover:border-green-600 text-gray-300 hover:text-white px-4 py-2 text-xs font-semibold rounded-full transition-colors">❓ FAQ</a>
</nav>

<section id="qualification" style="scroll-margin-top:5rem" class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-4">Qui est qualifié pour la CAN 2027 ? Comment se qualifier ?</h2>
    <div class="bg-gray-800 rounded-xl border border-gray-700 p-6 text-sm text-gray-300 leading-relaxed space-y-3">
        <p><strong class="text-white">À ce jour, seuls les trois pays hôtes sont qualifiés :</strong> le Kenya, la Tanzanie et l'Ouganda, d'office. Les 21 autres places se jouent dans les éliminatoires.</p>
        <p><strong class="text-white">Les règles, d'après Le360 Afrique :</strong> dans les groupes sans pays hôte, les deux premiers se qualifient. Dans les trois groupes qui comptent un pays hôte (<a href="#groupe-d" <?= $lk ?>>groupe D</a> avec le Kenya, <a href="#groupe-h" <?= $lk ?>>groupe H</a> avec l'Ouganda et <a href="#groupe-l" <?= $lk ?>>groupe L</a> avec la Tanzanie), une seule équipe se qualifie en plus de l'hôte. Le compte est cohérent : 9 groupes à deux qualifiés, 3 groupes à un qualifié et 3 hôtes font bien 24 équipes.</p>
        <p><strong class="text-white">Le calendrier :</strong> la journée 4 s'est jouée les 16 et 17 novembre 2026, les journées 5 et 6 se jouent les 24 et 28 mars 2027, avant la phase finale du 19 juin au 17 juillet 2027 (52 matchs, 24 équipes). Le nom de la compétition, « Pamoja », signifie « ensemble » en swahili. Les stades et les dates précises des matchs de la phase finale ne sont pas encore confirmés : nous les ajouterons dès l'annonce de la CAF.</p>
    </div>
    <p class="text-gray-600 text-xs mt-3">Sources : CAF (annonce du 2 mai 2026 : ouverture le 19 juin 2027, finale le 17 juillet 2027), Wikipédia, Le360 Afrique. Informations officielles sur le <a href="https://www.cafonline.com/fr" target="_blank" rel="nofollow noopener noreferrer" class="text-green-400 underline hover:text-green-300">site officiel de la CAF</a>.</p>
</section>

<section id="classements" style="scroll-margin-top:5rem" class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-2">Classements des 12 groupes après la journée 4</h2>
    <p class="text-gray-300 text-sm leading-relaxed mb-4">Éliminatoires de la CAN 2027, phase de groupes, situation à l'issue de la 4e journée (16 et 17 novembre 2026, quatre matchs joués par équipe). Le détail de chaque groupe est plus bas ; voir aussi nos articles sur la <a href="/blog/eliminatoires-can-2027-classements-journee-1" <?= $lk ?>>journée 1</a> et la <a href="/blog/eliminatoires-can-2027-algerie-egypte-senegal-vieira" <?= $lk ?>>journée 2</a>.</p>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        <?php foreach ($classements as $g => $eq): ?>
        <div class="bg-gray-800 border border-gray-700 rounded-xl overflow-hidden">
            <table class="w-full text-sm">
                <caption class="text-left text-green-400 text-xs font-semibold uppercase tracking-wider px-4 pt-3 pb-1">Groupe <?= $g ?> · éliminatoires CAN 2027, après la journée 4</caption>
                <thead><tr class="text-gray-500 uppercase text-xs border-b border-gray-700"><th class="text-left px-4 py-1 font-semibold">Équipe</th><th class="text-right px-4 py-1 font-semibold">Pts</th></tr></thead>
                <tbody class="divide-y divide-gray-700/60 text-gray-300">
                    <?php foreach ($eq as $i => $e): ?>
                    <tr><td class="px-4 py-1.5"><span class="text-gray-500 mr-2"><?= $i + 1 ?></span><?= htmlspecialchars($e[0]) ?></td><td class="px-4 py-1.5 text-right <?= $i === 0 ? 'text-white font-bold' : '' ?>"><?= $e[1] ?></td></tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php endforeach; ?>
    </div>
    <p class="text-gray-600 text-xs mt-3">Source : Foot Mercato (calendrier et résultats de chaque groupe) ; à vérifier sur le <a href="https://www.cafonline.com/fr" target="_blank" rel="nofollow noopener noreferrer" class="text-green-400 underline hover:text-green-300">site officiel de la CAF</a>. Seuls les points sont indiqués ; à égalité, le départage retenu est la différence de buts puis les buts marqués, à vérifier avec le règlement officiel de la CAF.</p>
</section>

<h2 class="sr-only">Résultats et calendrier groupe par groupe</h2>
<?php foreach ($calendriers as $g => $cal): ?>
<section id="groupe-<?= strtolower($g) ?>" style="scroll-margin-top:5rem" class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-2"><?= htmlspecialchars($groupesTitres[$g]) ?></h2>
    <p class="text-gray-300 text-sm leading-relaxed mb-4">Éliminatoires de la CAN 2027, groupe <?= $g ?> : résultats des journées 1 à 3 et calendrier des journées 4 à 6. <?= htmlspecialchars($groupesIntro[$g]) ?></p>
    <div class="bg-gray-800 border border-gray-700 rounded-xl overflow-x-auto">
        <table class="w-full text-sm">
            <caption class="text-left text-gray-400 text-xs px-4 pt-3 pb-1">Groupe <?= $g ?> des éliminatoires de la CAN 2027 : résultats et calendrier, de septembre 2026 à mars 2027</caption>
            <thead><tr class="text-gray-500 uppercase text-xs border-b border-gray-700"><th class="text-left px-4 py-2 font-semibold">Date</th><th class="text-left px-4 py-2 font-semibold">Rencontre</th><th class="text-center px-4 py-2 font-semibold">Score / heure</th></tr></thead>
            <tbody class="divide-y divide-gray-700/60 text-gray-300">
                <?php foreach ($cal as $m): ?>
                <tr><td class="px-4 py-1.5 whitespace-nowrap"><?= $m[0] ?></td><td class="px-4 py-1.5 text-white"><?= htmlspecialchars($m[1]) ?></td><td class="px-4 py-1.5 text-center <?= str_contains($m[2], '-') ? 'text-white font-bold' : 'text-gray-400' ?>"><?= $m[2] ?></td></tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <p class="text-gray-600 text-xs mt-3">Source : Foot Mercato (éliminatoires de la CAN, groupe <?= $g ?>). Les horaires sont ceux de cette source, en heure française (identiques à ceux de beIN SPORTS).</p>
</section>
<?php endforeach; ?>

<section id="programme" style="scroll-margin-top:5rem" class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-2">Programme TV des journées 3 et 4 (12 au 17 novembre 2026)</h2>
    <p class="text-gray-300 text-sm leading-relaxed mb-4">Date, heure française et chaîne beIN SPORTS de chacun des 48 matchs des journées 3 et 4 : consultez notre page dédiée.</p>
    <a href="/droits-tv-can-2027.php" class="inline-flex bg-gray-800 border border-green-800/60 hover:border-green-600 rounded-xl px-5 py-4 text-sm font-semibold text-green-400 transition-colors">📺 CAN 2027 à la TV : chaînes, horaires et programme →</a>
</section>

<section id="articles" style="scroll-margin-top:5rem" class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-5">Nos articles sur la CAN 2027</h2>
    <?php if (empty($articlesCan)): ?>
    <div class="bg-gray-800 rounded-xl border border-gray-700 p-6 text-center text-gray-500 text-sm">Aucun article pour le moment. <a href="/blog/" <?= $lk ?>>Voir tous les articles →</a></div>
    <?php else: ?>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
        <?php foreach (array_slice($articlesCan, 0, 6) as $a): ?>
        <a href="/blog/<?= urlencode($a['slug']) ?>" class="flex flex-col bg-gray-800 border border-gray-700 hover:border-green-600 rounded-xl overflow-hidden transition-colors">
            <div class="p-4 flex flex-col gap-2 flex-1">
                <p class="text-gray-500 text-xs"><?= !empty($a['date_maj']) ? 'Maj ' : '' ?><?= date('d/m/Y', strtotime($a['date_maj'] ?? $a['date'])) ?></p>
                <h3 class="text-white font-semibold text-sm leading-snug"><?= htmlspecialchars($a['titre']) ?></h3>
                <p class="text-gray-400 text-xs leading-relaxed flex-1"><?= htmlspecialchars($a['extrait']) ?></p>
            </div>
        </a>
        <?php endforeach; ?>
    </div>
    <p class="mt-4 text-sm"><a href="/blog/?cat=CAN" <?= $lk ?>>Tous les articles CAN →</a></p>
    <?php endif; ?>
</section>

<section id="faq" style="scroll-margin-top:5rem" class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-5">Foire aux questions : CAN 2027</h2>
    <div class="space-y-3">
        <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
            <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">Qui organise la CAN 2027 ?<span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span></summary>
            <p class="text-gray-400 text-sm leading-relaxed mt-3">La phase finale de la Coupe d'Afrique des Nations 2027 est organisée conjointement par le Kenya, la Tanzanie et l'Ouganda.</p>
        </details>
        <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
            <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">Combien de groupes dans les éliminatoires de la CAN 2027 ?<span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span></summary>
            <p class="text-gray-400 text-sm leading-relaxed mt-3">Les éliminatoires de la CAN 2027 comptent douze groupes de quatre équipes, de A à L.</p>
        </details>
        <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
            <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">Quand se jouent les journées 3 et 4 des éliminatoires de la CAN 2027 ?<span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span></summary>
            <p class="text-gray-400 text-sm leading-relaxed mt-3">La 3e journée s'est jouée du 12 au 14 novembre 2026 et la 4e journée les 16 et 17 novembre 2026 ; les journées 5 et 6 ont lieu les 24 et 28 mars 2027.</p>
        </details>
        <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
            <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">Où se joue la CAN 2027 ?<span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span></summary>
            <p class="text-gray-400 text-sm leading-relaxed mt-3">La CAN 2027 est organisée conjointement par le Kenya, la Tanzanie et l'Ouganda, une première en trois pays.</p>
        </details>
        <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
            <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">Quand débute la CAN 2027 ?<span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span></summary>
            <p class="text-gray-400 text-sm leading-relaxed mt-3">La phase finale de la CAN 2027 se joue du 19 juin au 17 juillet 2027 : match d'ouverture le samedi 19 juin et finale le samedi 17 juillet, selon la CAF. Le pays hôte du match d'ouverture et celui de la finale n'étaient pas encore désignés dans son annonce.</p>
        </details>
        <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
            <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">Qui est qualifié pour la CAN 2027 ?<span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span></summary>
            <p class="text-gray-400 text-sm leading-relaxed mt-3">À ce jour, seuls les trois pays hôtes sont qualifiés d'office : le Kenya, la Tanzanie et l'Ouganda. Les autres places se jouent dans les éliminatoires jusqu'en mars 2027.</p>
        </details>
        <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
            <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">Combien d'équipes se qualifient par groupe ?<span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span></summary>
            <p class="text-gray-400 text-sm leading-relaxed mt-3">Selon Le360 Afrique, les deux premiers de chaque groupe sans pays hôte se qualifient ; dans les groupes D, H et L, qui comptent un pays hôte, une seule équipe se qualifie en plus de l'hôte.</p>
        </details>
        <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
            <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">Quand se jouent les dernières journées des éliminatoires ?<span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span></summary>
            <p class="text-gray-400 text-sm leading-relaxed mt-3">La journée 4 se joue les 16 et 17 novembre 2026, puis les journées 5 et 6 les 24 et 28 mars 2027.</p>
        </details>
    </div>
</section>

<section class="flex flex-wrap gap-4 justify-center pb-4">
    <a href="/blog/?cat=CAN" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">📰 Articles CAN</a>
    <a href="/calendrier.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">📅 Calendrier</a>
    <a href="/droits-tv-football.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">📺 Guide droits TV</a>
</section>

<?php include __DIR__ . '/templates/footer.php'; ?>
