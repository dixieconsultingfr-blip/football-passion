<?php
require_once __DIR__ . '/blog/helpers.php';
$date_maj_page = '2026-09-18'; // à mettre à jour à chaque résultat ou changement de programme — signal E-E-A-T

// Résultats à renseigner ici après chaque match (score_dom / score_ext, laisser null tant que le match n'est pas joué).
$matchs = [
    ['date' => '2026-09-25', 'heure' => '20h45', 'dom' => 'Turquie',  'ext' => 'France',   'lieu' => 'Kocaeli',                       'score_dom' => null, 'score_ext' => null],
    ['date' => '2026-09-28', 'heure' => '20h45', 'dom' => 'Belgique', 'ext' => 'France',   'lieu' => 'Bruxelles',                     'score_dom' => null, 'score_ext' => null],
    ['date' => '2026-10-02', 'heure' => '20h45', 'dom' => 'France',   'ext' => 'Italie',   'lieu' => 'Stade de France, Saint-Denis',  'score_dom' => null, 'score_ext' => null],
    ['date' => '2026-10-05', 'heure' => '20h45', 'dom' => 'France',   'ext' => 'Belgique', 'lieu' => 'Stade de France, Saint-Denis',  'score_dom' => null, 'score_ext' => null],
    ['date' => '2026-11-12', 'heure' => '20h45', 'dom' => 'Italie',   'ext' => 'France',   'lieu' => 'Italie',                        'score_dom' => null, 'score_ext' => null],
    ['date' => '2026-11-15', 'heure' => '20h45', 'dom' => 'France',   'ext' => 'Turquie',  'lieu' => 'Bordeaux',                      'score_dom' => null, 'score_ext' => null],
];

// Classement du groupe calculé depuis les résultats renseignés (uniquement les matchs des Bleus sont détaillés ici).
$equipes = ['France', 'Italie', 'Belgique', 'Turquie'];
$table = [];
foreach ($equipes as $eq) {
    $table[$eq] = ['club' => $eq, 'MJ' => 0, 'G' => 0, 'N' => 0, 'P' => 0, 'BP' => 0, 'BC' => 0];
}
foreach ($matchs as $m) {
    if ($m['score_dom'] === null || $m['score_ext'] === null) { continue; }
    foreach ([[$m['dom'], $m['score_dom'], $m['score_ext']], [$m['ext'], $m['score_ext'], $m['score_dom']]] as [$eq, $bp, $bc]) {
        $table[$eq]['MJ']++;
        $table[$eq]['BP'] += $bp;
        $table[$eq]['BC'] += $bc;
        if ($bp > $bc)       { $table[$eq]['G']++; }
        elseif ($bp === $bc) { $table[$eq]['N']++; }
        else                 { $table[$eq]['P']++; }
    }
}
foreach ($table as &$t) {
    $t['DB']  = $t['BP'] - $t['BC'];
    $t['Pts'] = $t['G'] * 3 + $t['N'];
}
unset($t);
$classement = array_values($table);
usort($classement, fn($a, $b) => $b['Pts'] <=> $a['Pts'] ?: $b['DB'] <=> $a['DB'] ?: $b['BP'] <=> $a['BP'] ?: strcmp($a['club'], $b['club']));

$articlesAll = load_articles_index(__DIR__);
$articlesFrance = array_values(array_filter($articlesAll, fn($a) => ($a['categorie'] ?? '') === 'France'));
usort($articlesFrance, fn($a, $b) => strtotime($b['date']) <=> strtotime($a['date']));

$slugListe = 'premiere-liste-zidane-23-bleus-ce-quil-faut-retenir';

$page_title = 'Ligue des Nations 2026-2027, Groupe A1 : calendrier et diffusion des Bleus';
$meta_desc  = "Groupe A1 de la Ligue des Nations 2026-2027 : France, Italie, Belgique, Turquie. Calendrier des 6 matchs des Bleus de Zidane, classement et diffusion sur TF1.";
include __DIR__ . '/templates/header.php';
?>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "datePublished": "2026-09-18T08:00:00+02:00",
  "dateModified": "<?= $date_maj_page ?>T08:00:00+02:00",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "Contre qui joue la France dans le groupe A1 de la Ligue des Nations 2026-2027 ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Le groupe A1 réunit la France, l'Italie, la Belgique et la Turquie. Les Bleus jouent six matchs : Turquie - France (25 septembre 2026), Belgique - France (28 septembre), France - Italie (2 octobre), France - Belgique (5 octobre), Italie - France (12 novembre) et France - Turquie (15 novembre)."
      }
    },
    {
      "@type": "Question",
      "name": "Sur quelle chaîne voir les matchs de la France en Ligue des Nations ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Les matchs de l'équipe de France en Ligue des Nations 2026-2027 sont diffusés en exclusivité et en clair sur TF1 et TF1+, sans abonnement."
      }
    },
    {
      "@type": "Question",
      "name": "Que se passe-t-il après la phase de groupes ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "En cas de qualification, les quarts de finale de la Ligue des Nations se jouent du 25 au 30 mars 2027. Le tirage au sort des qualifications à l'Euro 2028 a lieu le 6 décembre 2026 à Belfast, avec des matchs aller-retour entre mars et novembre 2027."
      }
    }
  ]
}
</script>

<!-- Breadcrumb -->
<nav class="text-xs text-gray-400 mb-8 flex items-center gap-2 flex-wrap">
    <a href="/" class="hover:text-green-400 transition-colors">Accueil</a>
    <span>›</span>
    <a href="/euro.php" class="hover:text-green-400 transition-colors">Euro</a>
    <span>›</span>
    <a href="/ligue-des-nations-2026-2027.php" class="hover:text-green-400 transition-colors">Ligue des Nations 2026-2027</a>
    <span>›</span>
    <span class="text-gray-400">Groupe A1</span>
</nav>

<!-- Hero -->
<header class="mb-10">
    <div class="flex items-center gap-3 mb-1">
        <p class="text-green-400 text-xs font-semibold uppercase tracking-widest">En attendant l'Euro 2028</p>
        <span class="text-gray-600 text-xs">· mis à jour le <?= date_fr_long($date_maj_page) ?></span>
    </div>
    <h1 class="text-4xl font-bold text-white mb-2">Ligue des Nations — Groupe A1</h1>
    <p class="text-gray-400 text-sm mb-4">Saison 2026-2027 · France, Italie, Belgique, Turquie</p>
    <p class="text-gray-300 leading-relaxed max-w-2xl">
        Premier rendez-vous de l'ère Zidane, la phase de ligue de la Ligue des Nations occupe les Bleus jusqu'à la mi-novembre,
        avant le tirage des qualifications à l'Euro 2028. Retrouvez ici le calendrier des six matchs, le classement du groupe et la diffusion.
    </p>
</header>

<!-- Article liste Zidane -->
<section class="mb-10">
    <a href="/blog/<?= htmlspecialchars($slugListe) ?>" class="flex flex-col sm:flex-row sm:items-center gap-3 bg-green-900/10 border border-green-800 hover:border-green-600 rounded-xl p-5 transition-colors">
        <div class="flex-1">
            <p class="text-green-400 text-xs font-semibold uppercase tracking-wider mb-1">À lire avant le coup d'envoi</p>
            <p class="text-white font-bold">Liste de Zidane : 23 Bleus, cinq nouveaux visages et l'absence de Tchouaméni</p>
            <p class="text-gray-400 text-sm mt-1">Les 23 joueurs retenus, les absents, le rôle de Mbappé et les premières explications du sélectionneur.</p>
        </div>
        <span class="text-green-400 text-xs font-semibold shrink-0">Lire l'article →</span>
    </a>
</section>

<!-- Calendrier -->
<section class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-4">Calendrier et diffusion des matchs des Bleus</h2>
    <p class="text-gray-300 text-sm leading-relaxed mb-4">
        Ligue des Nations UEFA 2026-2027, Ligue A, groupe A1 : six rencontres pour l'équipe de France, toutes diffusées sur TF1 et TF1+.
    </p>
    <div class="bg-gray-800 border border-gray-700 rounded-xl overflow-x-auto">
        <table class="w-full text-sm">
            <caption class="text-left text-gray-400 text-xs px-4 pt-3 pb-1">Calendrier de l'équipe de France, Ligue des Nations 2026-2027, groupe A1</caption>
            <thead>
                <tr class="text-gray-500 uppercase text-xs border-b border-gray-700">
                    <th class="text-left px-4 py-2 font-semibold">Date</th>
                    <th class="text-left px-4 py-2 font-semibold">Match</th>
                    <th class="text-left px-4 py-2 font-semibold">Lieu</th>
                    <th class="text-left px-4 py-2 font-semibold text-green-400">Diffusion</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-700/60 text-gray-300">
                <?php foreach ($matchs as $m): $joue = $m['score_dom'] !== null && $m['score_ext'] !== null; ?>
                <tr>
                    <td class="px-4 py-2 whitespace-nowrap"><?= htmlspecialchars(date_fr_jour($m['date'])) ?>, <?= htmlspecialchars($m['heure']) ?></td>
                    <td class="px-4 py-2 text-white font-medium">
                        <?= htmlspecialchars($m['dom']) ?>
                        <?php if ($joue): ?><span class="text-green-400 font-bold mx-1"><?= (int)$m['score_dom'] ?> - <?= (int)$m['score_ext'] ?></span><?php else: ?><span class="text-gray-600 mx-1">-</span><?php endif; ?>
                        <?= htmlspecialchars($m['ext']) ?>
                    </td>
                    <td class="px-4 py-2"><?= htmlspecialchars($m['lieu']) ?></td>
                    <td class="px-4 py-2 text-green-400 whitespace-nowrap">TF1 / TF1+</td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <p class="text-gray-600 text-xs mt-3">
        ⚠️ Calendrier et diffuseur susceptibles d'évoluer : vérifiez la programmation sur
        <a href="https://www.tf1.fr" target="_blank" rel="nofollow noopener noreferrer" class="underline hover:text-gray-400">tf1.fr</a> avant chaque match.
        Pour tous les autres championnats, consultez notre <a href="/droits-tv-football.php" class="underline hover:text-gray-400">guide des droits TV</a>.
    </p>
</section>

<!-- Classement -->
<section class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-4">Classement du groupe A1</h2>
    <div class="bg-gray-800 border border-gray-700 rounded-xl overflow-x-auto">
        <table class="w-full text-sm">
            <caption class="text-left text-gray-400 text-xs px-4 pt-3 pb-1">Classement du groupe A1, Ligue des Nations 2026-2027</caption>
            <thead>
                <tr class="text-gray-500 uppercase text-xs border-b border-gray-700">
                    <th class="text-left px-4 py-2 font-semibold">Équipe</th>
                    <th class="text-center px-2 py-2 font-semibold">MJ</th>
                    <th class="text-center px-2 py-2 font-semibold">G</th>
                    <th class="text-center px-2 py-2 font-semibold">N</th>
                    <th class="text-center px-2 py-2 font-semibold">P</th>
                    <th class="text-center px-2 py-2 font-semibold">DB</th>
                    <th class="text-center px-4 py-2 font-semibold text-green-400">Pts</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-700/60">
                <?php foreach ($classement as $i => $c): ?>
                <tr class="<?= $i < 2 ? 'bg-green-900/10' : '' ?>">
                    <td class="px-4 py-2 text-white font-medium"><span class="text-gray-500 font-normal mr-2"><?= $i + 1 ?></span><?= htmlspecialchars($c['club']) ?></td>
                    <td class="px-2 py-2 text-center text-gray-400"><?= $c['MJ'] ?></td>
                    <td class="px-2 py-2 text-center text-gray-400"><?= $c['G'] ?></td>
                    <td class="px-2 py-2 text-center text-gray-400"><?= $c['N'] ?></td>
                    <td class="px-2 py-2 text-center text-gray-400"><?= $c['P'] ?></td>
                    <td class="px-2 py-2 text-center text-gray-400"><?= $c['DB'] > 0 ? '+' . $c['DB'] : $c['DB'] ?></td>
                    <td class="px-4 py-2 text-center text-green-400 font-bold"><?= $c['Pts'] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <p class="text-gray-600 text-xs mt-2 italic">Classement calculé à partir des seuls matchs de la France renseignés ci-dessus : il sera complété au fil de la phase de ligue.</p>
</section>

<!-- Après la phase de groupes -->
<section class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-4">Après le groupe : quarts de finale et route vers l'Euro 2028</h2>
    <div class="bg-gray-800 rounded-xl border border-gray-700 divide-y divide-gray-700">
        <div class="flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-4 px-4 py-3">
            <span class="text-green-400 text-xs font-semibold sm:w-48 shrink-0">25-30 mars 2027</span>
            <span class="text-white text-sm font-semibold">Quarts de finale de la Ligue des Nations <span class="text-gray-500 text-xs font-normal ml-1">en cas de qualification</span></span>
        </div>
        <div class="flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-4 px-4 py-3">
            <span class="text-green-400 text-xs font-semibold sm:w-48 shrink-0">6 décembre 2026</span>
            <span class="text-white text-sm font-semibold">Tirage au sort des qualifications à l'Euro 2028 <span class="text-gray-500 text-xs font-normal ml-1">Belfast, Irlande du Nord</span></span>
        </div>
        <div class="flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-4 px-4 py-3">
            <span class="text-green-400 text-xs font-semibold sm:w-48 shrink-0">Mars - novembre 2027</span>
            <span class="text-white text-sm font-semibold">Matchs aller-retour des qualifications à l'Euro 2028</span>
        </div>
    </div>
    <a href="/euro-2028-qualifications.php" class="inline-flex items-center gap-1 text-green-400 hover:text-green-300 text-xs font-semibold mt-3">Voir le détail des qualifications Euro 2028 →</a>
</section>

<!-- FAQ -->
<section class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-5">Foire aux questions : groupe A1</h2>
    <div class="space-y-3">
        <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
            <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">
                Contre qui joue la France dans le groupe A1 de la Ligue des Nations 2026-2027 ?
                <span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span>
            </summary>
            <p class="text-gray-400 text-sm leading-relaxed mt-3">
                Le groupe A1 réunit la France, l'Italie, la Belgique et la Turquie. Les Bleus jouent six matchs : Turquie - France (25 septembre 2026), Belgique - France (28 septembre), France - Italie (2 octobre), France - Belgique (5 octobre), Italie - France (12 novembre) et France - Turquie (15 novembre).
            </p>
        </details>
        <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
            <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">
                Sur quelle chaîne voir les matchs de la France en Ligue des Nations ?
                <span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span>
            </summary>
            <p class="text-gray-400 text-sm leading-relaxed mt-3">
                Les matchs de l'équipe de France en Ligue des Nations 2026-2027 sont diffusés en exclusivité et en clair sur TF1 et TF1+, sans abonnement.
            </p>
        </details>
        <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
            <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">
                Que se passe-t-il après la phase de groupes ?
                <span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span>
            </summary>
            <p class="text-gray-400 text-sm leading-relaxed mt-3">
                En cas de qualification, les quarts de finale de la Ligue des Nations se jouent du 25 au 30 mars 2027. Le tirage au sort des qualifications à l'Euro 2028 a lieu le 6 décembre 2026 à Belfast, avec des matchs aller-retour entre mars et novembre 2027.
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
    <a href="/ligue-des-nations-2026-2027.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">🥇 Ligue des Nations 2026-2027</a>
    <a href="/euro-2028-qualifications.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">📋 Qualifications Euro 2028</a>
    <a href="/equipe-france.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">🇫🇷 Équipe de France</a>
</section>

<?php include __DIR__ . '/templates/footer.php'; ?>
