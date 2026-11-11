<?php
require_once __DIR__ . '/blog/helpers.php';
$date_maj_page = '2026-11-11'; // à mettre à jour après chaque match du Portugal, tirage et qualification — signal E-E-A-T

$articlesAll = load_articles_index(__DIR__);
$articlesPortugal = array_values(array_filter($articlesAll, fn($a) => in_array('Portugal', $a['etiquettes'] ?? [], true)));
usort($articlesPortugal, fn($a, $b) => strtotime($b['date']) <=> strtotime($a['date']));

$page_title = 'Équipe du Portugal : Euro 2028, Ligue des Nations et après Ronaldo';
$meta_desc  = "Équipe du Portugal : sélectionneur Jorge Jesus, retraite internationale de Cristiano Ronaldo, groupe D de la Ligue des Nations, palmarès (Euro 2016) et route vers l'Euro 2028.";
$og_image   = '/images/stades/euro-2028-wembley-stadium.jpg';
include __DIR__ . '/templates/header.php';

$classementD = [
    ['Portugal', 12],
    ['Danemark', 6],
    ['Pays de Galles', 3],
    ['Norvège', 3],
];
?>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "SportsTeam",
  "name": "Équipe du Portugal de football",
  "sport": "Football",
  "url": "https://football-passion.fr/euro-2028-portugal.php",
  "memberOf": { "@type": "SportsOrganization", "name": "Fédération portugaise de football" },
  "description": "Équipe nationale masculine de football du Portugal, championne d'Europe en 2016 et vainqueur de la Ligue des nations en 2019 et en 2025."
}
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "Qui est le sélectionneur du Portugal ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Le sélectionneur du Portugal est Jorge Jesus, en poste depuis 2026. Le capitaine est Bruno Fernandes."
      }
    },
    {
      "@type": "Question",
      "name": "Cristiano Ronaldo a-t-il pris sa retraite internationale ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Oui. Cristiano Ronaldo a annoncé sa retraite internationale le jeudi 5 novembre 2026, après 23 ans avec le Portugal, 234 sélections et 146 buts, deux records."
      }
    },
    {
      "@type": "Question",
      "name": "Le Portugal est-il qualifié pour l'Euro 2028 ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Pas encore. Le Portugal n'est pas pays hôte et doit se qualifier comme les autres sélections : les qualifications se jouent du 25 mars 2027 au 28 mars 2028, après le tirage au sort du 6 décembre 2026 à Belfast."
      }
    },
    {
      "@type": "Question",
      "name": "Quand joue le Portugal en Ligue des nations ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Le Portugal reçoit le Danemark le samedi 14 novembre 2026 à 20h45, puis se déplace au pays de Galles, à Cardiff, le mardi 17 novembre à 20h45, pour les deux dernières journées du groupe D."
      }
    },
    {
      "@type": "Question",
      "name": "Quel est le palmarès du Portugal ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Le Portugal a remporté l'Euro 2016 et la Ligue des nations en 2019 et en 2025. Son meilleur résultat en Coupe du monde est une 3e place en 1966."
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
    <span class="text-gray-400">Portugal</span>
</nav>

<!-- Hero -->
<header class="mb-10">
    <p class="text-green-400 text-xs font-semibold uppercase tracking-widest mb-1">Euro 2028 · Les équipes</p>
    <h1 class="text-4xl font-bold text-white mb-2">Équipe du Portugal : l'après-Ronaldo</h1>
    <p class="text-gray-400 text-sm mb-1">Euro 2028 · Ligue des Nations 2026-2027 · Seleção das Quinas</p>
    <p class="text-gray-500 text-xs mb-4">Mis à jour le <time datetime="<?= $date_maj_page ?>"><?= date_fr_long($date_maj_page) ?></time></p>
    <p class="text-gray-300 leading-relaxed max-w-2xl">
        Championne d'Europe en 2016 et double vainqueur de la Ligue des Nations, la sélection portugaise entre dans une nouvelle ère :
        Cristiano Ronaldo a annoncé sa retraite internationale le 5 novembre 2026. Cette page fait le point sur le sélectionneur,
        le groupe de Ligue des Nations, le palmarès et la route vers l'Euro 2028.
    </p>
</header>

<!-- Chiffres clés -->
<section class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-10">
    <div class="bg-gray-800 border border-yellow-800/40 rounded-xl p-4 text-center">
        <div class="text-2xl font-bold text-yellow-400">2016</div>
        <div class="text-gray-400 text-xs mt-1">Championne<br>d'Europe</div>
    </div>
    <div class="bg-gray-800 border border-gray-700 rounded-xl p-4 text-center">
        <div class="text-2xl font-bold text-white">2</div>
        <div class="text-gray-400 text-xs mt-1">Ligues des nations<br>2019 · 2025</div>
    </div>
    <div class="bg-gray-800 border border-gray-700 rounded-xl p-4 text-center">
        <div class="text-2xl font-bold text-white">12</div>
        <div class="text-gray-400 text-xs mt-1">points en 4 matchs<br>groupe D</div>
    </div>
    <div class="bg-gray-800 border border-green-800/40 rounded-xl p-4 text-center">
        <div class="text-2xl font-bold text-green-400">5e</div>
        <div class="text-gray-400 text-xs mt-1">classement FIFA<br>au 7 octobre 2026</div>
    </div>
</section>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">

    <!-- La sélection aujourd'hui -->
    <section id="selection" style="scroll-margin-top:5rem">
        <h2 class="text-2xl font-bold text-white mb-4">La sélection aujourd'hui</h2>
        <div class="bg-gray-800 rounded-xl border border-gray-700 p-6 text-sm text-gray-300 leading-relaxed space-y-3">
            <p>
                Le Portugal est dirigé par <strong class="text-white">Jorge Jesus</strong>, sélectionneur en poste depuis 2026,
                et son capitaine est <strong class="text-white">Bruno Fernandes</strong>. La sélection, surnommée la
                « Seleção das Quinas », dépend de la Fédération portugaise de football (FPF).
            </p>
            <p>
                Au Mondial 2026, le Portugal a été éliminé en huitièmes de finale par l'Espagne (1-0). En Ligue des Nations,
                il reste sur quatre victoires en quatre matchs dans le groupe D.
            </p>
        </div>
    </section>

    <!-- Après Ronaldo -->
    <section id="apres-ronaldo" style="scroll-margin-top:5rem">
        <h2 class="text-2xl font-bold text-white mb-4">L'après-Cristiano Ronaldo</h2>
        <div class="bg-gray-800 rounded-xl border border-gray-700 p-6 text-sm text-gray-300 leading-relaxed space-y-3">
            <p>
                Le <strong class="text-white">jeudi 5 novembre 2026</strong>, Cristiano Ronaldo a annoncé sa retraite internationale
                dans une vidéo publiée sur Instagram, après 23 ans avec le Portugal : <strong class="text-white">234 sélections</strong>
                et <strong class="text-white">146 buts</strong>, deux records. Il a disputé six Coupes du monde et six Euros, et remporté
                l'Euro 2016 et deux Ligues des nations.
            </p>
            <a href="/blog/cristiano-ronaldo-retraite-internationale-portugal-euro-2028" class="inline-flex items-center gap-1 text-green-400 hover:text-green-300 text-xs font-semibold">
                Lire l'article complet →
            </a>
        </div>
    </section>

</div>

<!-- Ligue des nations -->
<section id="ligue-des-nations" style="scroll-margin-top:5rem" class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-2">Le Portugal en Ligue des Nations 2026-2027 (groupe D)</h2>
    <p class="text-gray-300 text-sm leading-relaxed mb-4">
        Le Portugal est en tête du groupe D avec quatre victoires en quatre matchs, dont un 2-1 contre la Norvège le 4 octobre.
        Il joue ses deux derniers matchs de la phase de groupes à domicile contre le Danemark, puis au pays de Galles, à Cardiff,
        ville du match d'ouverture de l'<a href="/euro-2028.php#stades" class="text-green-400 underline hover:text-green-300">Euro 2028</a>.
    </p>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-5">
        <div class="bg-gray-800 border border-green-800/60 rounded-xl p-5">
            <p class="text-green-400 text-xs font-semibold uppercase tracking-wider mb-2">Samedi 14 novembre, 20h45</p>
            <p class="text-white font-bold text-lg">Portugal - Danemark</p>
            <p class="text-gray-400 text-sm mt-1">5e journée du groupe D, à Braga. Premier match du Portugal depuis la retraite de Ronaldo.</p>
        </div>
        <div class="bg-gray-800 border border-green-800/60 rounded-xl p-5">
            <p class="text-green-400 text-xs font-semibold uppercase tracking-wider mb-2">Mardi 17 novembre, 20h45</p>
            <p class="text-white font-bold text-lg">Pays de Galles - Portugal</p>
            <p class="text-gray-400 text-sm mt-1">6e et dernière journée du groupe D, à Cardiff.</p>
        </div>
    </div>
    <div class="bg-gray-800 border border-gray-700 rounded-xl overflow-x-auto">
        <table class="w-full text-sm">
            <caption class="text-left text-gray-400 text-xs px-4 pt-3 pb-1">Ligue des Nations 2026-2027, groupe D : classement après la journée 4 sur 6</caption>
            <thead>
                <tr class="text-gray-500 uppercase text-xs border-b border-gray-700">
                    <th class="text-left px-4 py-2 font-semibold">Rang</th>
                    <th class="text-left px-4 py-2 font-semibold">Équipe</th>
                    <th class="text-center px-4 py-2 font-semibold">Pts</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-700/60 text-gray-300">
                <?php foreach ($classementD as $i => $r): ?>
                <tr>
                    <td class="px-4 py-2"><?= $i + 1 ?></td>
                    <td class="px-4 py-2 <?= $i === 0 ? 'text-white font-bold' : '' ?>"><?= htmlspecialchars($r[0]) ?></td>
                    <td class="px-4 py-2 text-center font-bold text-white"><?= (int)$r[1] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <p class="text-gray-400 text-sm mt-4">
        Classement complet et résultats sur la page <a href="/ligue-des-nations-groupe-d.php" class="text-green-400 underline hover:text-green-300">groupe D de la Ligue des nations</a>,
        et le <a href="/blog/ligue-des-nations-2026-2027-programme-journees-5-et-6" class="text-green-400 underline hover:text-green-300">programme complet des journées 5 et 6</a>.
    </p>
</section>

<!-- Palmarès -->
<section id="palmares" style="scroll-margin-top:5rem" class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-4">Palmarès du Portugal</h2>
    <div class="bg-gray-800 border border-gray-700 rounded-xl overflow-x-auto">
        <table class="w-full text-sm">
            <caption class="text-left text-gray-400 text-xs px-4 pt-3 pb-1">Équipe du Portugal : principaux résultats en compétitions internationales</caption>
            <thead>
                <tr class="text-gray-500 uppercase text-xs border-b border-gray-700">
                    <th class="text-left px-4 py-2 font-semibold">Compétition</th>
                    <th class="text-left px-4 py-2 font-semibold">Meilleur résultat</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-700/60 text-gray-300">
                <tr><td class="px-4 py-2 text-white font-medium">Championnat d'Europe</td><td class="px-4 py-2">Vainqueur en 2016 (1-0 contre la France en finale) ; finaliste en 2004</td></tr>
                <tr><td class="px-4 py-2 text-white font-medium">Ligue des nations</td><td class="px-4 py-2">Vainqueur en 2019 et en 2025</td></tr>
                <tr><td class="px-4 py-2 text-white font-medium">Coupe du monde</td><td class="px-4 py-2">3e en 1966 ; huitièmes de finale en 2026 (éliminé par l'Espagne, 1-0)</td></tr>
                <tr><td class="px-4 py-2 text-white font-medium">Coupe des confédérations</td><td class="px-4 py-2">3e en 2017</td></tr>
            </tbody>
        </table>
    </div>
    <p class="text-gray-600 text-xs mt-3">Sources : Wikipédia (équipe du Portugal de football), franceinfo et Le Journal du Real.</p>
</section>

<!-- Euro 2028 -->
<section id="euro-2028" style="scroll-margin-top:5rem" class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-4">Le Portugal et l'Euro 2028</h2>
    <div class="bg-gray-800 rounded-xl border border-gray-700 p-6 text-sm text-gray-300 leading-relaxed space-y-3">
        <p>
            Le Portugal n'est pas pays hôte de l'Euro 2028 (9 juin - 9 juillet 2028, Royaume-Uni et Irlande) : il doit se qualifier comme les autres sélections.
            Les <a href="/euro-2028-qualifications.php" class="text-green-400 underline hover:text-green-300">qualifications de l'Euro 2028</a> se jouent du 25 mars 2027 au 28 mars 2028,
            après le tirage au sort du 6 décembre 2026 à Belfast. Ce sera le premier Euro sans Cristiano Ronaldo depuis l'édition 2000.
        </p>
        <p>
            Retrouvez le <a href="/euro-2028-les-equipes.php#statut" class="text-green-400 underline hover:text-green-300">statut de toutes les équipes</a>
            (aucune n'est qualifiée à ce jour) et notre dossier <a href="/euro-2028.php" class="text-green-400 underline hover:text-green-300">Euro 2028</a>.
        </p>
    </div>
</section>

<!-- FAQ -->
<section id="faq" style="scroll-margin-top:5rem" class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-5">Foire aux questions : équipe du Portugal</h2>
    <div class="space-y-3">
        <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
            <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">
                Qui est le sélectionneur du Portugal ?
                <span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span>
            </summary>
            <p class="text-gray-400 text-sm leading-relaxed mt-3">Le sélectionneur du Portugal est Jorge Jesus, en poste depuis 2026. Le capitaine est Bruno Fernandes.</p>
        </details>
        <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
            <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">
                Cristiano Ronaldo a-t-il pris sa retraite internationale ?
                <span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span>
            </summary>
            <p class="text-gray-400 text-sm leading-relaxed mt-3">Oui. Cristiano Ronaldo a annoncé sa retraite internationale le jeudi 5 novembre 2026, après 23 ans avec le Portugal, 234 sélections et 146 buts, deux records.</p>
        </details>
        <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
            <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">
                Le Portugal est-il qualifié pour l'Euro 2028 ?
                <span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span>
            </summary>
            <p class="text-gray-400 text-sm leading-relaxed mt-3">Pas encore. Le Portugal n'est pas pays hôte et doit se qualifier comme les autres sélections : les qualifications se jouent du 25 mars 2027 au 28 mars 2028, après le tirage au sort du 6 décembre 2026 à Belfast.</p>
        </details>
        <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
            <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">
                Quand joue le Portugal en Ligue des nations ?
                <span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span>
            </summary>
            <p class="text-gray-400 text-sm leading-relaxed mt-3">Le Portugal reçoit le Danemark le samedi 14 novembre 2026 à 20h45, puis se déplace au pays de Galles, à Cardiff, le mardi 17 novembre à 20h45, pour les deux dernières journées du groupe D.</p>
        </details>
        <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
            <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">
                Quel est le palmarès du Portugal ?
                <span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span>
            </summary>
            <p class="text-gray-400 text-sm leading-relaxed mt-3">Le Portugal a remporté l'Euro 2016 et la Ligue des nations en 2019 et en 2025. Son meilleur résultat en Coupe du monde est une 3e place en 1966.</p>
        </details>
    </div>
</section>

<!-- Actualités liées -->
<section class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-5">Actualités — Portugal</h2>
    <?php if (empty($articlesPortugal)): ?>
    <div class="bg-gray-800 rounded-xl border border-gray-700 p-6 text-center text-gray-500 text-sm">
        Aucun article publié pour le moment sur le Portugal.
        <a href="/blog/" class="text-green-400 hover:text-green-300 ml-1">Voir tous les articles →</a>
    </div>
    <?php else: ?>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
        <?php foreach (array_slice($articlesPortugal, 0, 6) as $a): ?>
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
    <a href="/euro-2028-qualifications.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">📋 Qualifications</a>
    <a href="/ligue-des-nations-2026-2027.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">🥇 Ligue des Nations</a>
    <a href="/equipe-france.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">🇫🇷 Équipe de France</a>
</section>

<?php include __DIR__ . '/templates/footer.php'; ?>
