<?php
require_once __DIR__ . '/blog/helpers.php';
$date_maj_page = '2026-11-15'; // à mettre à jour après chaque journée (résultats, classements)

$articlesAll = load_articles_index(__DIR__);
$articlesCan = array_values(array_filter($articlesAll, fn($a) => ($a['categorie'] ?? '') === 'CAN' || in_array('CAN 2027', $a['etiquettes'] ?? [], true)));
usort($articlesCan, fn($a, $b) => strtotime($b['date']) <=> strtotime($a['date']));

$page_title = 'CAN 2027 : éliminatoires, groupes, classements et calendrier';
$meta_desc  = "CAN 2027 (Kenya, Tanzanie, Ouganda) : les 12 groupes des éliminatoires, les classements après la journée 2, le programme des journées 3 et 4 et tous nos articles.";
include __DIR__ . '/templates/header.php';

$lk = 'class="text-green-400 underline hover:text-green-300"';

// Classements après la journée 2 (source : Africa Top Sports, « le classement des 12 groupes avant la 3e journée »). Points uniquement.
$classements = [
    'A' => [['Maroc', 6], ['Gabon', 3], ['Niger', 3], ['Lesotho', 0]],
    'B' => [['Égypte', 4], ['Angola', 4], ['Malawi', 3], ['Soudan du Sud', 0]],
    'C' => [["Côte d'Ivoire", 6], ['Gambie', 6], ['Somalie', 0], ['Ghana', 0]],
    'D' => [['Afrique du Sud', 6], ['Guinée', 3], ['Érythrée', 1], ['Kenya', 1]],
    'E' => [['RD Congo', 6], ['Zimbabwe', 3], ['Guinée équatoriale', 3], ['Sierra Leone', 0]],
    'F' => [['Bénin', 4], ['Burkina Faso', 4], ['Mauritanie', 3], ['Centrafrique', 0]],
    'G' => [['Cameroun', 4], ['Comores', 3], ['Namibie', 3], ['Congo', 1]],
    'H' => [['Ouganda', 4], ['Botswana', 2], ['Tunisie', 2], ['Libye', 1]],
    'I' => [['Algérie', 4], ['Zambie', 3], ['Togo', 3], ['Burundi', 1]],
    'J' => [['Sénégal', 4], ['Mozambique', 4], ['Soudan', 3], ['Éthiopie', 0]],
    'K' => [['Rwanda', 6], ['Mali', 6], ['Cap-Vert', 0], ['Liberia', 0]],
    'L' => [['Guinée-Bissau', 6], ['Nigeria', 3], ['Tanzanie', 1], ['Madagascar', 1]],
];
// Programme des journées 3 et 4 (source : Le360 Afrique). [journée, date, heure, groupe, match]
$programme = [
    [3, '12/11', '15h00', 'C', 'Ghana - Somalie'], [3, '12/11', '16h00', 'D', 'Guinée - Érythrée'], [3, '12/11', '16h00', 'E', 'RD Congo - Sierra Leone'],
    [3, '12/11', '16h00', 'E', 'Guinée équatoriale - Zimbabwe'], [3, '12/11', '16h00', 'L', 'Madagascar - Guinée-Bissau'], [3, '12/11', '19h00', 'C', "Côte d'Ivoire - Gambie"],
    [3, '12/11', '19h00', 'F', 'Bénin - Centrafrique'], [3, '12/11', '19h00', 'G', 'Cameroun - Namibie'], [3, '12/11', '19h00', 'J', 'Sénégal - Soudan'],
    [3, '13/11', '13h00', 'G', 'Comores - Congo'], [3, '13/11', '13h00', 'I', 'Zambie - Burundi'], [3, '13/11', '13h00', 'J', 'Mozambique - Éthiopie'],
    [3, '13/11', '16h00', 'A', 'Gabon - Lesotho'], [3, '13/11', '16h00', 'D', 'Afrique du Sud - Kenya'], [3, '13/11', '16h00', 'F', 'Burkina Faso - Mauritanie'],
    [3, '13/11', '16h00', 'H', 'Tunisie - Libye'], [3, '13/11', '16h00', 'K', 'Cap-Vert - Liberia'], [3, '13/11', '16h00', 'L', 'Nigeria - Tanzanie'],
    [3, '13/11', '19h00', 'B', 'Égypte - Malawi'], [3, '13/11', '19h00', 'K', 'Mali - Rwanda'], [3, '13/11', '20h00', 'A', 'Maroc - Niger'],
    [3, '14/11', '16h00', 'H', 'Ouganda - Botswana'], [3, '14/11', '19h00', 'B', 'Angola - Soudan du Sud'], [3, '14/11', '19h00', 'I', 'Algérie - Togo'],
    [4, '16/11', '13h00', 'G', 'Namibie - Cameroun'], [4, '16/11', '13h00', 'J', 'Soudan - Sénégal'], [4, '16/11', '13h00', 'E', 'Zimbabwe - Guinée équatoriale'],
    [4, '16/11', '15h00', 'C', 'Somalie - Ghana'], [4, '16/11', '16h00', 'D', 'Érythrée - Guinée'], [4, '16/11', '16h00', 'F', 'Centrafrique - Bénin'],
    [4, '17/11', '13h00', 'A', 'Lesotho - Gabon'], [4, '17/11', '13h00', 'B', 'Malawi - Égypte'], [4, '17/11', '13h00', 'B', 'Soudan du Sud - Angola'],
    [4, '17/11', '13h00', 'I', 'Burundi - Zambie'], [4, '17/11', '13h00', 'J', 'Éthiopie - Mozambique'], [4, '17/11', '13h00', 'L', 'Tanzanie - Nigeria'],
    [4, '17/11', '16h00', 'C', "Gambie - Côte d'Ivoire"], [4, '17/11', '16h00', 'D', 'Kenya - Afrique du Sud'], [4, '17/11', '16h00', 'E', 'Sierra Leone - RD Congo'],
    [4, '17/11', '16h00', 'H', 'Libye - Tunisie'], [4, '17/11', '16h00', 'I', 'Togo - Algérie'], [4, '17/11', '16h00', 'L', 'Guinée-Bissau - Madagascar'],
    [4, '17/11', '19h00', 'F', 'Mauritanie - Burkina Faso'], [4, '17/11', '19h00', 'G', 'Congo - Comores'], [4, '17/11', '19h00', 'H', 'Botswana - Ouganda'],
    [4, '17/11', '19h00', 'K', 'Rwanda - Mali'], [4, '17/11', '19h00', 'K', 'Liberia - Cap-Vert'], [4, '17/11', '20h00', 'A', 'Niger - Maroc'],
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
        "text": "La 3e journée se joue du 12 au 14 novembre 2026 et la 4e journée du 16 au 17 novembre 2026, selon le programme publié par Le360 Afrique."
      }
    }
  ]
}
</script>

<nav class="text-xs text-gray-400 mb-8 flex items-center gap-2">
    <a href="/" class="hover:text-green-400 transition-colors">Accueil</a>
    <span>›</span>
    <a href="/blog/?cat=CAN" class="hover:text-green-400 transition-colors">CAN</a>
    <span>›</span>
    <span class="text-gray-400">2027</span>
</nav>

<header class="mb-10">
    <p class="text-green-400 text-xs font-semibold uppercase tracking-widest mb-1">Coupe d'Afrique des Nations · sélections masculines</p>
    <h1 class="text-4xl font-bold text-white mb-2">CAN 2027 : éliminatoires, groupes, classements et calendrier</h1>
    <p class="text-gray-500 text-xs mb-4">Mis à jour le <time datetime="<?= $date_maj_page ?>"><?= date_fr_long($date_maj_page) ?></time></p>
    <p class="text-gray-300 leading-relaxed max-w-2xl">
        La phase finale de la CAN 2027 est organisée conjointement par le Kenya, la Tanzanie et l'Ouganda. Les éliminatoires réunissent douze groupes de quatre équipes :
        retrouvez ici les classements, le programme des journées 3 et 4 et tous nos articles.
    </p>
</header>

<section id="en-bref" style="scroll-margin-top:5rem" class="mb-12 bg-gray-800 border border-green-800/40 rounded-xl p-6">
    <h2 class="text-xl font-bold text-white mb-3">CAN 2027 en bref</h2>
    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-3 text-sm">
        <div><dt class="text-green-400 font-semibold">Pays hôtes</dt><dd class="text-gray-300">Kenya, Tanzanie et Ouganda (organisation conjointe)</dd></div>
        <div><dt class="text-green-400 font-semibold">Éliminatoires</dt><dd class="text-gray-300">12 groupes de 4 équipes (A à L)</dd></div>
        <div><dt class="text-green-400 font-semibold">Journées 3 et 4</dt><dd class="text-gray-300">12 au 14 novembre, puis 16 et 17 novembre 2026</dd></div>
        <div><dt class="text-green-400 font-semibold">Co-organisateurs</dt><dd class="text-gray-300">Kenya, Tanzanie et Ouganda sont déjà qualifiés ; ils jouent aussi les éliminatoires</dd></div>
    </dl>
</section>

<nav class="flex flex-wrap gap-2 mb-10" aria-label="Sections CAN 2027">
    <a href="#classements" class="inline-flex bg-gray-800 border border-gray-700 hover:border-green-600 text-gray-300 hover:text-white px-4 py-2 text-xs font-semibold rounded-full transition-colors">📊 Classements</a>
    <a href="#programme" class="inline-flex bg-gray-800 border border-gray-700 hover:border-green-600 text-gray-300 hover:text-white px-4 py-2 text-xs font-semibold rounded-full transition-colors">📅 Programme J3 et J4</a>
    <a href="#articles" class="inline-flex bg-gray-800 border border-gray-700 hover:border-green-600 text-gray-300 hover:text-white px-4 py-2 text-xs font-semibold rounded-full transition-colors">📰 Nos articles</a>
    <a href="#faq" class="inline-flex bg-gray-800 border border-gray-700 hover:border-green-600 text-gray-300 hover:text-white px-4 py-2 text-xs font-semibold rounded-full transition-colors">❓ FAQ</a>
</nav>

<section id="classements" style="scroll-margin-top:5rem" class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-2">Classements des 12 groupes après la journée 2</h2>
    <p class="text-gray-300 text-sm leading-relaxed mb-4">Éliminatoires de la CAN 2027, phase de groupes, situation avant la 3e journée (deux matchs joués par équipe). Le détail de chaque journée est dans nos articles : <a href="/blog/eliminatoires-can-2027-classements-journee-1" <?= $lk ?>>classements après la journée 1</a> et <a href="/blog/eliminatoires-can-2027-algerie-egypte-senegal-vieira" <?= $lk ?>>résultats de la journée 2</a>.</p>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        <?php foreach ($classements as $g => $eq): ?>
        <div class="bg-gray-800 border border-gray-700 rounded-xl overflow-hidden">
            <table class="w-full text-sm">
                <caption class="text-left text-green-400 text-xs font-semibold uppercase tracking-wider px-4 pt-3 pb-1">Groupe <?= $g ?> · éliminatoires CAN 2027, après la journée 2</caption>
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
    <p class="text-gray-600 text-xs mt-3">Source : Africa Top Sports (« le classement des 12 groupes avant la 3e journée »), croisée avec Le360 Afrique. Seuls les points sont indiqués ; à égalité, l'ordre suit la source. Les résultats des 12 au 14 novembre seront ajoutés dès confirmation.</p>
</section>

<section id="programme" style="scroll-margin-top:5rem" class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-2">Programme des journées 3 et 4 (12 au 17 novembre 2026)</h2>
    <p class="text-gray-300 text-sm leading-relaxed mb-4">Éliminatoires de la CAN 2027, phase de groupes : les 24 matchs de la journée 3 (du 12 au 14 novembre) puis les 24 matchs de la journée 4 (16 et 17 novembre). Les horaires sont ceux publiés par la source : vérifiez le fuseau horaire et le programme officiel de la CAF avant chaque match.</p>
    <div class="bg-gray-800 border border-gray-700 rounded-xl overflow-x-auto">
        <table class="w-full text-sm">
            <caption class="text-left text-gray-400 text-xs px-4 pt-3 pb-1">Éliminatoires de la CAN 2027, journées 3 et 4 : date, heure, groupe et rencontre</caption>
            <thead><tr class="text-gray-500 uppercase text-xs border-b border-gray-700"><th class="text-left px-4 py-2 font-semibold">J.</th><th class="text-left px-4 py-2 font-semibold">Date</th><th class="text-left px-4 py-2 font-semibold">Heure</th><th class="text-left px-4 py-2 font-semibold">Gr.</th><th class="text-left px-4 py-2 font-semibold">Rencontre</th></tr></thead>
            <tbody class="divide-y divide-gray-700/60 text-gray-300">
                <?php foreach ($programme as $p): ?>
                <tr><td class="px-4 py-1.5 text-gray-500">J<?= $p[0] ?></td><td class="px-4 py-1.5 whitespace-nowrap"><?= $p[1] ?></td><td class="px-4 py-1.5 whitespace-nowrap"><?= $p[2] ?></td><td class="px-4 py-1.5"><?= $p[3] ?></td><td class="px-4 py-1.5 text-white"><?= htmlspecialchars($p[4]) ?></td></tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <p class="text-gray-600 text-xs mt-3">Source : Le360 Afrique, « les programmes et les enjeux des 3e et 4e journées ». Programme du 28 septembre au 1er octobre (journée 2) : <a href="/blog/eliminatoires-can-2027-journee-2-programme-chaines" <?= $lk ?>>horaires, stades et chaînes</a>.</p>
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
            <p class="text-gray-400 text-sm leading-relaxed mt-3">La 3e journée se joue du 12 au 14 novembre 2026 et la 4e journée du 16 au 17 novembre 2026, selon le programme publié par Le360 Afrique.</p>
        </details>
    </div>
</section>

<section class="flex flex-wrap gap-4 justify-center pb-4">
    <a href="/blog/?cat=CAN" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">📰 Articles CAN</a>
    <a href="/calendrier.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">📅 Calendrier</a>
    <a href="/droits-tv-football.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">📺 Guide droits TV</a>
</section>

<?php include __DIR__ . '/templates/footer.php'; ?>
