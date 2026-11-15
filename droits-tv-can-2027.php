<?php
require_once __DIR__ . '/blog/helpers.php';
$date_maj_page = '2026-11-15'; // à mettre à jour quand beIN Sports publie les chaînes de la journée 4 et des journées 5 et 6

$page_title = 'CAN 2027 à la TV : où voir les qualifications, chaînes et horaires';
$meta_desc  = "Où voir les éliminatoires de la CAN 2027 à la télévision : programme des journées 3 et 4 avec date, heure française et chaîne beIN SPORTS pour chaque match.";
include __DIR__ . '/templates/header.php';

$lk = 'class="text-green-400 underline hover:text-green-300"';
$matchs = [
    ['J3', 'Jeu. 12 novembre 2026', '16h', 'C', 'Ghana - Somalie', '', '2-0'],
    ['J3', 'Jeu. 12 novembre 2026', '17h', 'D', 'Guinée - Érythrée', '', '2-1'],
    ['J3', 'Jeu. 12 novembre 2026', '17h', 'E', 'Guinée équatoriale - Zimbabwe', '', '0-0'],
    ['J3', 'Jeu. 12 novembre 2026', '17h', 'L', 'Madagascar - Guinée-Bissau', '', '1-1'],
    ['J3', 'Jeu. 12 novembre 2026', '17h', 'E', 'RD Congo - Sierra Leone', 'beIN SPORTS 1', '3-1'],
    ['J3', 'Jeu. 12 novembre 2026', '20h', 'F', 'Bénin - Centrafrique', '', '4-1'],
    ['J3', 'Jeu. 12 novembre 2026', '20h', 'G', 'Cameroun - Namibie', 'beIN SPORTS MAX 6', '2-0'],
    ['J3', 'Jeu. 12 novembre 2026', '20h', 'C', 'Côte d\'Ivoire - Gambie', 'beIN SPORTS 1', '2-1'],
    ['J3', 'Jeu. 12 novembre 2026', '20h', 'J', 'Sénégal - Soudan', 'beIN SPORTS MAX 5', '4-1'],
    ['J3', 'Ven. 13 novembre 2026', '14h', 'G', 'Comores - Congo', 'beIN SPORTS 2', '0-0'],
    ['J3', 'Ven. 13 novembre 2026', '14h', 'J', 'Mozambique - Éthiopie', '', '0-1'],
    ['J3', 'Ven. 13 novembre 2026', '14h', 'I', 'Zambie - Burundi', '', '1-1'],
    ['J3', 'Ven. 13 novembre 2026', '17h', 'H', 'Tunisie - Libye', 'beIN SPORTS 1', '0-2'],
    ['J3', 'Ven. 13 novembre 2026', '17h', 'L', 'Nigeria - Tanzanie', 'beIN SPORTS 2', '3-1'],
    ['J3', 'Ven. 13 novembre 2026', '17h', 'D', 'Afrique du Sud - Kenya', '', '2-2'],
    ['J3', 'Ven. 13 novembre 2026', '17h', 'F', 'Burkina Faso - Mauritanie', '', '1-0'],
    ['J3', 'Ven. 13 novembre 2026', '17h', 'K', 'Cap-Vert - Liberia', '', '4-2'],
    ['J3', 'Ven. 13 novembre 2026', '17h', 'A', 'Gabon - Lesotho', '', '2-0'],
    ['J3', 'Ven. 13 novembre 2026', '20h', 'B', 'Égypte - Malawi', 'beIN SPORTS MAX 6', '5-0'],
    ['J3', 'Ven. 13 novembre 2026', '20h', 'K', 'Mali - Rwanda', 'beIN SPORTS MAX 5', '3-2'],
    ['J3', 'Ven. 13 novembre 2026', '21h', 'A', 'Maroc - Niger', 'beIN SPORTS 1', '5-1'],
    ['J3', 'Sam. 14 novembre 2026', '17h', 'H', 'Ouganda - Botswana', '', '1-1'],
    ['J3', 'Sam. 14 novembre 2026', '20h', 'B', 'Angola - Soudan du Sud', '', '2-0'],
    ['J3', 'Sam. 14 novembre 2026', '20h', 'I', 'Algérie - Togo', 'beIN SPORTS 1', '1-0'],
    ['J4', 'Lun. 16 novembre 2026', '14h', 'E', 'Zimbabwe - Guinée équatoriale', '', ''],
    ['J4', 'Lun. 16 novembre 2026', '14h', 'G', 'Namibie - Cameroun', '', ''],
    ['J4', 'Lun. 16 novembre 2026', '14h', 'J', 'Soudan - Sénégal', '', ''],
    ['J4', 'Lun. 16 novembre 2026', '16h', 'C', 'Somalie - Ghana', '', ''],
    ['J4', 'Lun. 16 novembre 2026', '17h', 'D', 'Érythrée - Guinée', '', ''],
    ['J4', 'Lun. 16 novembre 2026', '17h', 'F', 'Centrafrique - Bénin', '', ''],
    ['J4', 'Mar. 17 novembre 2026', '14h', 'A', 'Lesotho - Gabon', '', ''],
    ['J4', 'Mar. 17 novembre 2026', '14h', 'B', 'Malawi - Égypte', '', ''],
    ['J4', 'Mar. 17 novembre 2026', '14h', 'B', 'Soudan du Sud - Angola', '', ''],
    ['J4', 'Mar. 17 novembre 2026', '14h', 'I', 'Burundi - Zambie', '', ''],
    ['J4', 'Mar. 17 novembre 2026', '14h', 'J', 'Éthiopie - Mozambique', '', ''],
    ['J4', 'Mar. 17 novembre 2026', '14h', 'L', 'Tanzanie - Nigeria', '', ''],
    ['J4', 'Mar. 17 novembre 2026', '17h', 'C', 'Gambie - Côte d\'Ivoire', '', ''],
    ['J4', 'Mar. 17 novembre 2026', '17h', 'E', 'Sierra Leone - RD Congo', '', ''],
    ['J4', 'Mar. 17 novembre 2026', '17h', 'I', 'Togo - Algérie', '', ''],
    ['J4', 'Mar. 17 novembre 2026', '17h', 'H', 'Libye - Tunisie', '', ''],
    ['J4', 'Mar. 17 novembre 2026', '17h', 'L', 'Guinée-Bissau - Madagascar', '', ''],
    ['J4', 'Mar. 17 novembre 2026', '17h', 'D', 'Kenya - Afrique du Sud', '', ''],
    ['J4', 'Mar. 17 novembre 2026', '20h', 'F', 'Mauritanie - Burkina Faso', '', ''],
    ['J4', 'Mar. 17 novembre 2026', '20h', 'G', 'Congo - Comores', '', ''],
    ['J4', 'Mar. 17 novembre 2026', '20h', 'H', 'Botswana - Ouganda', '', ''],
    ['J4', 'Mar. 17 novembre 2026', '20h', 'K', 'Rwanda - Mali', '', ''],
    ['J4', 'Mar. 17 novembre 2026', '20h', 'K', 'Liberia - Cap-Vert', '', ''],
    ['J4', 'Mar. 17 novembre 2026', '21h', 'A', 'Niger - Maroc', '', ''],
];

$anciens = [
    ['Jeu. 24 septembre 2026', '18h', 'E', 'RD Congo - Guinée équatoriale', '2-0', 'beIN SPORTS 4'],
    ['Jeu. 24 septembre 2026', '21h', 'C', 'Côte d\'Ivoire - Ghana', '2-0', 'beIN SPORTS 2'],
    ['Jeu. 24 septembre 2026', '21h', 'G', 'Cameroun - Comores', '3-1', 'beIN SPORTS 4'],
    ['Jeu. 24 septembre 2026', '21h', 'H', 'Tunisie - Ouganda', '1-1', 'beIN SPORTS 5'],
    ['Ven. 25 septembre 2026', '18h', 'L', 'Nigeria - Madagascar', '2-1', 'beIN SPORTS 6'],
    ['Ven. 25 septembre 2026', '21h', 'A', 'Maroc - Gabon', '2-0', 'beIN SPORTS 1'],
    ['Ven. 25 septembre 2026', '21h', 'I', 'Algérie - Zambie', '3-1', 'beIN SPORTS 2'],
    ['Ven. 25 septembre 2026', '21h', 'J', 'Mozambique - Sénégal', '1-1', 'beIN SPORTS 4'],
    ['Ven. 25 septembre 2026', '21h', 'K', 'Mali - Cap-Vert', '3-1', 'beIN SPORTS 5'],
    ['Ven. 25 septembre 2026', '21h', 'B', 'Égypte - Angola', '0-0', 'beIN SPORTS 7'],
    ['Lun. 28 septembre 2026', '18h', 'E', 'Zimbabwe - RD Congo', '1-2', 'beIN SPORTS 1'],
    ['Lun. 28 septembre 2026', '21h', 'H', 'Tunisie - Botswana', '2-2', 'beIN SPORTS 1'],
    ['Mar. 29 septembre 2026', '15h', 'A', 'Lesotho - Maroc', '0-2', 'beIN SPORTS 1'],
    ['Mar. 29 septembre 2026', '15h', 'I', 'Burundi - Algérie', '2-2', 'beIN SPORTS 2'],
    ['Mar. 29 septembre 2026', '18h', 'L', 'Guinée-Bissau - Nigeria', '3-0', 'beIN SPORTS 1'],
    ['Mar. 29 septembre 2026', '21h', 'C', 'Somalie - Côte d\'Ivoire', '0-2', 'beIN SPORTS 1'],
    ['Mar. 29 septembre 2026', '21h', 'G', 'Congo - Cameroun', '1-1', 'beIN SPORTS 2'],
];

$jours = [];
foreach ($matchs as $m) { $jours[$m[0] . '|' . $m[1]][] = $m; }
?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "dateModified": "<?= $date_maj_page ?>T08:00:00+01:00",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "Peut-on regarder gratuitement les éliminatoires de la CAN 2027 en France ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Non. Selon Afrik-Foot, les éliminatoires de la CAN 2027 sont diffusés en France exclusivement par beIN SPORTS, accessible uniquement par abonnement."
      }
    },
    {
      "@type": "Question",
      "name": "Tous les matchs des éliminatoires de la CAN 2027 sont-ils diffusés en France ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Non. beIN SPORTS ne diffuse qu'une sélection de matchs à chaque journée : 17 matchs sur 48 pour les deux premières journées, selon Afrik-Foot."
      }
    },
    {
      "@type": "Question",
      "name": "Sur quelle chaîne voir les éliminatoires de la CAN 2027 ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Selon le programme publié par beIN SPORTS le 9 novembre 2026, une partie des matchs des éliminatoires de la CAN 2027 est diffusée sur beIN SPORTS 1, beIN SPORTS 2, beIN SPORTS MAX 5 et beIN SPORTS MAX 6. Pour les autres matchs, la chaîne n'est pas indiquée."
      }
    },
    {
      "@type": "Question",
      "name": "À quelle heure sont les matchs des éliminatoires de la CAN 2027 ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Les journées 3 et 4 se jouent du 12 au 17 novembre 2026, avec des coups d'envoi entre 14h et 21h, heure française, selon beIN SPORTS."
      }
    },
    {
      "@type": "Question",
      "name": "Quand sont les prochains matchs des éliminatoires de la CAN 2027 ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Après la journée 4 des 16 et 17 novembre 2026, les journées 5 et 6 se jouent les 24 et 28 mars 2027."
      }
    }
  ]
}
</script>

<?php
$tickerComps = ['CAN']; $tickerLabel = '🌍 CAN 2027 · actus & scores'; $tickerLink = '/can-2027.php#classements'; $tickerLimit = 12; $tickerArticles = 3; $tickerArtCats = ['CAN', 'CAN 2027'];
include __DIR__ . '/templates/ticker-resultats.php';
?>

<nav class="text-xs text-gray-400 mb-8 flex items-center gap-2 flex-wrap">
    <a href="/" class="hover:text-green-400 transition-colors">Accueil</a>
    <span>›</span>
    <a href="/can-2027.php" class="hover:text-green-400 transition-colors">CAN 2027</a>
    <span>›</span>
    <span class="text-gray-400">Diffusion TV</span>
</nav>

<header class="mb-10">
    <p class="text-green-400 text-xs font-semibold uppercase tracking-widest mb-1">Éliminatoires · diffusion télévisée</p>
    <h1 class="text-4xl font-bold text-white mb-2">CAN 2027 à la TV : où voir les qualifications, chaînes et horaires</h1>
    <p class="text-gray-500 text-xs mb-4">Mis à jour le <time datetime="<?= $date_maj_page ?>"><?= date_fr_long($date_maj_page) ?></time></p>
    <p class="text-gray-300 leading-relaxed max-w-2xl">
        Les éliminatoires de la <a href="/can-2027.php" <?= $lk ?>>CAN 2027</a> reprennent du 12 au 17 novembre 2026 pour les journées 3 et 4.
        Voici chaque match avec sa date, son heure française et, quand elle est connue, sa chaîne.
    </p>
</header>

<section id="en-bref" style="scroll-margin-top:5rem" class="mb-10 bg-gray-800 border border-green-800/40 rounded-xl p-6">
    <h2 class="text-xl font-bold text-white mb-3">Où voir les éliminatoires de la CAN 2027 ?</h2>
    <p class="text-gray-300 text-sm leading-relaxed mb-2">
        <strong class="text-white">beIN SPORTS</strong> détient les droits des éliminatoires et de la phase finale de la CAN 2027 en France, uniquement par abonnement. D'après son programme du 9 novembre 2026, une partie des matchs passe sur
        <strong class="text-white">beIN SPORTS 1, beIN SPORTS 2, beIN SPORTS MAX 5 et beIN SPORTS MAX 6</strong>.
        Pour les autres rencontres, aucune chaîne n'est indiquée à ce jour : nous complèterons ce tableau dès qu'elle sera connue.
    </p>
    <p class="text-gray-400 text-xs">Les chaînes de la journée 4 (16 et 17 novembre) n'étaient pas encore communiquées. Les journées 5 et 6 se jouent les 24 et 28 mars 2027.</p>
</section>

<nav class="flex flex-wrap gap-2 mb-10" aria-label="Sections de la page">
    <a href="#programme" class="inline-flex bg-gray-800 border border-gray-700 hover:border-green-600 text-gray-300 hover:text-white px-4 py-2 text-xs font-semibold rounded-full transition-colors">📅 Programme des matchs</a>
    <a href="#droits" class="inline-flex bg-gray-800 border border-gray-700 hover:border-green-600 text-gray-300 hover:text-white px-4 py-2 text-xs font-semibold rounded-full transition-colors">🔒 Qui diffuse ?</a>
    <a href="#chaines" class="inline-flex bg-gray-800 border border-gray-700 hover:border-green-600 text-gray-300 hover:text-white px-4 py-2 text-xs font-semibold rounded-full transition-colors">📺 Matchs avec chaîne</a>
    <a href="#faq" class="inline-flex bg-gray-800 border border-gray-700 hover:border-green-600 text-gray-300 hover:text-white px-4 py-2 text-xs font-semibold rounded-full transition-colors">❓ FAQ</a>
    <a href="/can-2027.php" class="inline-flex bg-gray-800 border border-gray-700 hover:border-green-600 text-gray-300 hover:text-white px-4 py-2 text-xs font-semibold rounded-full transition-colors">🌍 CAN 2027 : groupes et classements</a>
</nav>

<section id="droits" style="scroll-margin-top:5rem" class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-4">Qui diffuse la CAN 2027 en France et en Afrique ?</h2>
    <div class="bg-gray-800 rounded-xl border border-gray-700 p-6 text-sm text-gray-300 leading-relaxed space-y-3">
        <p><strong class="text-white">En France :</strong> beIN SPORTS détient les droits de la prochaine CAN et de ses éliminatoires, qui ne sont pas accessibles gratuitement. La chaîne ne diffuse qu'une sélection de matchs à chaque journée : environ un tiers pour les deux premières journées (17 matchs sur 48). Selon Afrik-Foot, tous les matchs du Maroc, de l'Algérie, de la Tunisie, du Sénégal, de la Côte d'Ivoire, du Cameroun et de la RD Congo devraient être diffusés.</p>
        <p><strong class="text-white">En Afrique :</strong> beIN SPORTS (version Mena) détient les droits en Afrique du Nord ; en Afrique subsaharienne francophone, c'est Canal+. Dans la plupart des cas, les chaînes nationales publiques peuvent diffuser gratuitement les matchs de leur équipe nationale.</p>
    </div>
    <p class="text-gray-600 text-xs mt-3">Source : Afrik-Foot (« Éliminatoires CAN 2027 : quelle chaîne TV les diffuse en France ? », 23 septembre 2026). Calendrier et informations officielles : <a href="https://www.cafonline.com/fr" target="_blank" rel="nofollow noopener noreferrer" class="text-green-400 underline hover:text-green-300">site officiel de la CAF</a>.</p>
</section>

<section id="programme" style="scroll-margin-top:5rem" class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-2">Programme des journées 3 et 4, jour par jour</h2>
    <p class="text-gray-300 text-sm leading-relaxed mb-5">Éliminatoires de la CAN 2027, phase de groupes, journées 3 (12 au 14 novembre) et 4 (16 et 17 novembre 2026) : 48 matchs, heures françaises. Pour les matchs déjà joués, le score est indiqué.</p>
    <?php foreach ($jours as $cle => $liste): [$j, $jour] = explode('|', $cle); ?>
    <div class="bg-gray-800 border border-gray-700 rounded-xl overflow-x-auto mb-4">
        <table class="w-full text-sm">
            <caption class="text-left text-green-400 text-xs font-semibold uppercase tracking-wider px-4 pt-3 pb-1"><?= htmlspecialchars($jour) ?> · journée <?= substr($j, 1) ?> des éliminatoires de la CAN 2027</caption>
            <thead><tr class="text-gray-500 uppercase text-xs border-b border-gray-700"><th class="text-left px-4 py-1 font-semibold">Heure</th><th class="text-left px-4 py-1 font-semibold">Gr.</th><th class="text-left px-4 py-1 font-semibold">Rencontre</th><th class="text-center px-4 py-1 font-semibold">Score</th><th class="text-left px-4 py-1 font-semibold">Chaîne</th></tr></thead>
            <tbody class="divide-y divide-gray-700/60 text-gray-300">
                <?php foreach ($liste as $m): ?>
                <tr>
                    <td class="px-4 py-1.5 whitespace-nowrap"><?= $m[2] ?></td>
                    <td class="px-4 py-1.5"><a href="/can-2027.php#groupe-<?= strtolower($m[3]) ?>" <?= $lk ?>><?= $m[3] ?></a></td>
                    <td class="px-4 py-1.5 text-white"><?= htmlspecialchars($m[4]) ?></td>
                    <td class="px-4 py-1.5 text-center <?= $m[6] ? 'text-white font-bold' : 'text-gray-600' ?>"><?= $m[6] ?: '–' ?></td>
                    <td class="px-4 py-1.5 <?= $m[5] ? 'text-green-400 font-semibold whitespace-nowrap' : 'text-gray-600' ?>"><?= $m[5] ? htmlspecialchars($m[5]) : 'non précisée' ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endforeach; ?>
    <p class="text-gray-600 text-xs mt-3">Sources : programme beIN SPORTS du 9 novembre 2026 (dates, heures françaises, chaînes) ; Kenya - Afrique du Sud (17 novembre, 17h) d'après Foot Mercato, absent de la liste beIN ; scores d'après Foot Mercato. Vérifiez le programme avant chaque match : il peut évoluer (informations officielles : <a href="https://www.cafonline.com/fr" target="_blank" rel="nofollow noopener noreferrer" class="text-green-400 underline hover:text-green-300">site officiel de la CAF</a>).</p>
</section>

<section id="chaines" style="scroll-margin-top:5rem" class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-4">Les matchs diffusés sur beIN SPORTS (journée 3)</h2>
    <div class="bg-gray-800 border border-gray-700 rounded-xl overflow-x-auto">
        <table class="w-full text-sm">
            <caption class="text-left text-gray-400 text-xs px-4 pt-3 pb-1">Éliminatoires de la CAN 2027, journée 3 : les 9 matchs avec une chaîne beIN SPORTS indiquée</caption>
            <thead><tr class="text-gray-500 uppercase text-xs border-b border-gray-700"><th class="text-left px-4 py-2 font-semibold">Chaîne</th><th class="text-left px-4 py-2 font-semibold">Date et heure</th><th class="text-left px-4 py-2 font-semibold">Rencontre</th></tr></thead>
            <tbody class="divide-y divide-gray-700/60 text-gray-300">
                <?php foreach ($matchs as $m): if (!$m[5]) continue; ?>
                <tr><td class="px-4 py-1.5 text-green-400 font-semibold whitespace-nowrap"><?= htmlspecialchars($m[5]) ?></td><td class="px-4 py-1.5 whitespace-nowrap"><?= htmlspecialchars(preg_replace('/ 2026$/', '', $m[1])) ?>, <?= $m[2] ?></td><td class="px-4 py-1.5 text-white"><?= htmlspecialchars($m[4]) ?></td></tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>

<section id="journees-1-2" style="scroll-margin-top:5rem" class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-2">Journées 1 et 2 : les 17 matchs diffusés sur beIN SPORTS</h2>
    <p class="text-gray-300 text-sm leading-relaxed mb-4">Éliminatoires de la CAN 2027, journées 1 et 2 (24 septembre au 6 octobre 2026) : les matchs retransmis en France, avec leur chaîne et leur score.</p>
    <div class="bg-gray-800 border border-gray-700 rounded-xl overflow-x-auto">
        <table class="w-full text-sm">
            <caption class="text-left text-gray-400 text-xs px-4 pt-3 pb-1">Éliminatoires de la CAN 2027, journées 1 et 2 : matchs diffusés sur beIN SPORTS, avec date, heure, groupe, score et chaîne</caption>
            <thead><tr class="text-gray-500 uppercase text-xs border-b border-gray-700"><th class="text-left px-4 py-2 font-semibold">Date</th><th class="text-left px-4 py-2 font-semibold">Heure</th><th class="text-left px-4 py-2 font-semibold">Gr.</th><th class="text-left px-4 py-2 font-semibold">Rencontre</th><th class="text-center px-4 py-2 font-semibold">Score</th><th class="text-left px-4 py-2 font-semibold">Chaîne</th></tr></thead>
            <tbody class="divide-y divide-gray-700/60 text-gray-300">
                <?php foreach ($anciens as $m): ?>
                <tr><td class="px-4 py-1.5 whitespace-nowrap"><?= htmlspecialchars($m[0]) ?></td><td class="px-4 py-1.5"><?= $m[1] ?></td><td class="px-4 py-1.5"><a href="/can-2027.php#groupe-<?= strtolower($m[2]) ?>" <?= $lk ?>><?= $m[2] ?></a></td><td class="px-4 py-1.5 text-white"><?= htmlspecialchars($m[3]) ?></td><td class="px-4 py-1.5 text-center text-white font-bold"><?= $m[4] ?></td><td class="px-4 py-1.5 text-green-400 font-semibold whitespace-nowrap"><?= $m[5] ?></td></tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <p class="text-gray-600 text-xs mt-3">Source : Afrik-Foot (programme beIN SPORTS des journées 1 et 2) ; scores d'après Foot Mercato.</p>
</section>

<section id="faq" style="scroll-margin-top:5rem" class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-5">Foire aux questions : CAN 2027 à la TV</h2>
    <div class="space-y-3">
        <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
            <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">Peut-on regarder gratuitement les éliminatoires de la CAN 2027 en France ?<span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span></summary>
            <p class="text-gray-400 text-sm leading-relaxed mt-3">Non. Selon Afrik-Foot, les éliminatoires de la CAN 2027 sont diffusés en France exclusivement par beIN SPORTS, accessible uniquement par abonnement.</p>
        </details>
        <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
            <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">Tous les matchs des éliminatoires de la CAN 2027 sont-ils diffusés en France ?<span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span></summary>
            <p class="text-gray-400 text-sm leading-relaxed mt-3">Non. beIN SPORTS ne diffuse qu'une sélection de matchs à chaque journée : 17 matchs sur 48 pour les deux premières journées, selon Afrik-Foot.</p>
        </details>
        <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
            <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">Sur quelle chaîne voir les éliminatoires de la CAN 2027 ?<span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span></summary>
            <p class="text-gray-400 text-sm leading-relaxed mt-3">Selon le programme publié par beIN SPORTS le 9 novembre 2026, une partie des matchs est diffusée sur beIN SPORTS 1, beIN SPORTS 2, beIN SPORTS MAX 5 et beIN SPORTS MAX 6. Pour les autres matchs, la chaîne n'est pas indiquée.</p>
        </details>
        <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
            <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">À quelle heure sont les matchs des éliminatoires de la CAN 2027 ?<span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span></summary>
            <p class="text-gray-400 text-sm leading-relaxed mt-3">Les journées 3 et 4 se jouent du 12 au 17 novembre 2026, avec des coups d'envoi entre 14h et 21h, heure française, selon beIN SPORTS.</p>
        </details>
        <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
            <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">Quand sont les prochains matchs des éliminatoires de la CAN 2027 ?<span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span></summary>
            <p class="text-gray-400 text-sm leading-relaxed mt-3">Après la journée 4 des 16 et 17 novembre 2026, les journées 5 et 6 se jouent les 24 et 28 mars 2027.</p>
        </details>
    </div>
</section>

<section class="flex flex-wrap gap-4 justify-center pb-4">
    <a href="/can-2027.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">🌍 CAN 2027</a>
    <a href="/droits-tv-football.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">📺 Guide droits TV</a>
    <a href="/blog/?cat=CAN" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">📰 Articles CAN</a>
</section>

<?php include __DIR__ . '/templates/footer.php'; ?>
