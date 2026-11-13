<?php
require_once __DIR__ . '/blog/helpers.php';
$date_maj_page = '2026-11-11'; // à mettre à jour après le tirage du 6 décembre 2026 et à chaque changement — signal E-E-A-T
$articlesAll = load_articles_index(__DIR__);
$articlesFrance = array_values(array_filter($articlesAll, fn($a) => ($a['categorie'] ?? '') === 'France'));
usort($articlesFrance, fn($a, $b) => strtotime($b['date']) <=> strtotime($a['date']));

$page_title = 'Qualifications Euro 2028 : dates, tirage au sort et équipes';
$meta_desc  = "Qualifications Euro 2028 : tirage au sort le 6 décembre 2026 à Belfast, matchs du 25 mars 2027 au 28 mars 2028, format, équipes à suivre (France, Portugal, Turquie) et pays hôtes.";
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
      "name": "Quand ont lieu les qualifications de l'Euro 2028 ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Le tirage au sort des qualifications a lieu le dimanche 6 décembre 2026 à Belfast, en Irlande du Nord. Les matchs de qualification se déroulent du 25 mars 2027 au 28 mars 2028."
      }
    },
    {
      "@type": "Question",
      "name": "Comment fonctionne le format des qualifications de l'Euro 2028 ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Les 54 nations membres de l'UEFA sont réparties en 12 groupes (6 groupes de 4 équipes, 6 groupes de 5). Les 12 vainqueurs de groupe et les 8 meilleurs deuxièmes se qualifient directement, soit 20 nations. Les 4 pays hôtes (Angleterre, Écosse, Pays de Galles, République d'Irlande) participent aussi aux qualifications ; si l'un d'eux ne se qualifie pas autrement, 2 places supplémentaires leur sont réservées."
      }
    },
    {
      "@type": "Question",
      "name": "Où en est l'équipe de France avant les qualifications de l'Euro 2028 ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Les Bleus de Zinédine Zidane, nommé le 28 juillet 2026, sont en tête du groupe A1 de la Ligue des Nations avec 10 points après quatre matchs. Ils jouent en Italie le 12 novembre 2026, puis reçoivent la Turquie à Bordeaux le 15 novembre."
      }
    },
    {
      "@type": "Question",
      "name": "Quelles équipes sont qualifiées pour l'Euro 2028 ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Aucune équipe n'est qualifiée au 11 novembre 2026 : les qualifications débutent le 25 mars 2027, après le tirage au sort du 6 décembre 2026 à Belfast."
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
    <span class="text-gray-400">Qualifications</span>
</nav>

<!-- Bandeau de navigation — sous-pages Euro 2028 -->
<nav class="flex flex-wrap gap-2 mb-8" aria-label="Pages Euro 2028">
    <a href="/euro-2028.php" class="inline-flex items-center gap-1.5 bg-gray-800 border border-gray-700 hover:border-green-600 text-gray-300 hover:text-white px-4 py-2 text-xs font-semibold rounded-full transition-colors">🏆 Vue d'ensemble</a>
    <a href="/euro-2028-les-8-villes-hotes.php" class="inline-flex items-center gap-1.5 bg-gray-800 border border-gray-700 hover:border-green-600 text-gray-300 hover:text-white px-4 py-2 text-xs font-semibold rounded-full transition-colors">🏙️ Les 8 villes hôtes</a>
    <a href="/euro-2028-les-9-stades.php" class="inline-flex items-center gap-1.5 bg-gray-800 border border-gray-700 hover:border-green-600 text-gray-300 hover:text-white px-4 py-2 text-xs font-semibold rounded-full transition-colors">🏟️ Les 9 stades</a>
    <a href="/euro-2028-les-equipes.php" class="inline-flex items-center gap-1.5 bg-gray-800 border border-gray-700 hover:border-green-600 text-gray-300 hover:text-white px-4 py-2 text-xs font-semibold rounded-full transition-colors">🌍 Les équipes</a>
    <a href="/euro-2028-pays-hotes.php" class="inline-flex items-center gap-1.5 bg-gray-800 border border-gray-700 hover:border-green-600 text-gray-300 hover:text-white px-4 py-2 text-xs font-semibold rounded-full transition-colors">🇬🇧 Les 4 nations hôtes</a>
    <a href="/comment-regarder-euro-2028.php" class="inline-flex items-center gap-1.5 bg-gray-800 border border-gray-700 hover:border-green-600 text-gray-300 hover:text-white px-4 py-2 text-xs font-semibold rounded-full transition-colors">📺 Où regarder</a>
    <a href="/euro-2028-paris-sportifs.php" class="inline-flex items-center gap-1.5 bg-gray-800 border border-gray-700 hover:border-green-600 text-gray-300 hover:text-white px-4 py-2 text-xs font-semibold rounded-full transition-colors">🎲 Paris sportifs</a>
    <a href="/ligue-des-nations-2026-2027.php" class="inline-flex items-center gap-1.5 bg-gray-800 border border-gray-700 hover:border-green-600 text-gray-300 hover:text-white px-4 py-2 text-xs font-semibold rounded-full transition-colors">🥇 Ligue des Nations 2026-2027</a>
</nav>

<!-- Hero -->
<header class="mb-10">
    <p class="text-green-400 text-xs font-semibold uppercase tracking-widest mb-1">Route vers l'Euro 2028</p>
    <h1 class="text-4xl font-bold text-white mb-2">Qualifications Euro 2028 et liste des Bleus</h1>
    <p class="text-gray-400 text-sm mb-1">Tirage au sort le 6 décembre 2026 · Matchs du 25 mars 2027 au 28 mars 2028</p>
    <p class="text-gray-500 text-xs mb-4">Mis à jour le <time datetime="<?= $date_maj_page ?>"><?= date_fr_long($date_maj_page) ?></time></p>
    <p class="text-gray-300 leading-relaxed max-w-2xl">
        Avant de retrouver le Royaume-Uni et l'Irlande à l'été 2028, chaque nation européenne doit passer par la case
        qualifications. Cette page fait le point sur le calendrier officiel des qualifications, sur la situation de l'équipe de France
        sous la houlette de Zinédine Zidane et sur les autres équipes à suivre. Aucune équipe n'est qualifiée à ce jour.
    </p>
</header>

<!-- Format des qualifications -->
<section class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-4">Le format des qualifications</h2>
    <div class="bg-gray-800 rounded-xl border border-gray-700 p-6 text-sm text-gray-300 leading-relaxed space-y-3">
        <p>
            Les <strong class="text-white">54 nations membres de l'UEFA</strong> sont réparties en
            <strong class="text-white">12 groupes</strong> : 6 groupes de 4 équipes et 6 groupes de 5. Le tirage au sort
            a lieu le <strong class="text-white">dimanche 6 décembre 2026 à Belfast</strong>, en Irlande du Nord.
        </p>
        <ul class="space-y-1.5 text-gray-400 pt-2 border-t border-gray-700">
            <li>🎟️ <strong class="text-white">6 décembre 2026</strong> — tirage au sort des groupes, à Belfast</li>
            <li>📅 <strong class="text-white">25 mars 2027</strong> — coup d'envoi des qualifications</li>
            <li>🏆 12 vainqueurs de groupe + 8 meilleurs deuxièmes = 20 nations qualifiées directement</li>
            <li>🇬🇧 Les 4 pays hôtes (Angleterre, Écosse, Pays de Galles, République d'Irlande) participent aussi aux qualifications, répartis dans des groupes différents</li>
            <li>🎫 2 places supplémentaires réservées aux meilleurs pays hôtes qui ne se seraient pas qualifiés autrement</li>
            <li>🏁 <strong class="text-white">28 mars 2028</strong> — fin des qualifications, les 24 nations qualifiées sont connues</li>
        </ul>
    </div>
</section>

<!-- Zidane et la liste des Bleus -->
<section id="bleus" style="scroll-margin-top:5rem" class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-4">L'équipe de France avant les qualifications</h2>
    <div class="bg-gray-800 rounded-xl border border-green-800/40 p-6 text-sm text-gray-300 leading-relaxed space-y-3">
        <p>
            Nommé sélectionneur de l'équipe de France le 28 juillet 2026, avec un contrat jusqu'en 2030, <strong class="text-white">Zinédine Zidane</strong>
            prépare l'Euro 2028 en Ligue des Nations. Après quatre matchs du <a href="/ligue-des-nations-groupe-a1.php" class="text-green-400 underline hover:text-green-300">groupe A1</a>,
            les Bleus sont en tête avec <strong class="text-white">10 points</strong> (3 victoires, 1 nul), devant l'Italie (7 points), la Belgique (6) et la Turquie (0).
        </p>
        <p>
            Les deux derniers matchs du groupe : <a href="/blog/italie-france-heure-chaine-composition-ligue-des-nations-12-novembre-2026" class="text-green-400 underline hover:text-green-300">Italie - France</a>
            le <strong class="text-white">jeudi 12 novembre à 20h45</strong>, puis
            <a href="/blog/france-turquie-heure-chaine-composition-ligue-des-nations-15-novembre-2026" class="text-green-400 underline hover:text-green-300">France - Turquie</a>
            le <strong class="text-white">dimanche 15 novembre à 20h45</strong>, à Bordeaux, tous deux sur TF1 et TF1+.
        </p>
        <p>
            Les listes de Zidane : <a href="/blog/premiere-liste-zidane-23-bleus-ce-quil-faut-retenir" class="text-green-400 underline hover:text-green-300">la première liste</a>
            (18 septembre) et <a href="/blog/zidane-deuxieme-liste-bleus-forfaits-attaque-thauvin-2026" class="text-green-400 underline hover:text-green-300">la deuxième liste</a> pour le rassemblement de novembre.
            Toute l'actualité des Bleus est sur la page <a href="/equipe-france.php#ligue-des-nations" class="text-green-400 underline hover:text-green-300">Équipe de France</a>.
        </p>
    </div>
</section>

<!-- Autres équipes -->
<section id="autres-equipes" style="scroll-margin-top:5rem" class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-4">Les autres équipes à suivre</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <a href="/euro-2028-les-equipes.php" class="bg-gray-800 border border-gray-700 hover:border-green-600 rounded-xl p-5 transition-colors block">
            <p class="text-green-400 text-xs font-semibold uppercase tracking-wider mb-2">Toutes les équipes</p>
            <p class="text-white font-bold text-lg">Statut des 24 places et nations hôtes</p>
            <p class="text-gray-400 text-sm mt-1">Angleterre, Écosse, pays de Galles et Irlande doivent aussi se qualifier. Voir le statut de chaque équipe →</p>
        </a>
        <a href="/euro-2028-portugal.php" class="bg-gray-800 border border-gray-700 hover:border-green-600 rounded-xl p-5 transition-colors block">
            <p class="text-green-400 text-xs font-semibold uppercase tracking-wider mb-2">Portugal</p>
            <p class="text-white font-bold text-lg">L'après-Cristiano Ronaldo</p>
            <p class="text-gray-400 text-sm mt-1">Retraite internationale annoncée le 5 novembre 2026, Jorge Jesus, groupe D de la Ligue des Nations →</p>
        </a>
        <a href="/blog/turquie-equipe-nationale-yalcin-ligue-des-nations-euro-2028" class="bg-gray-800 border border-gray-700 hover:border-green-600 rounded-xl p-5 transition-colors block">
            <p class="text-green-400 text-xs font-semibold uppercase tracking-wider mb-2">Turquie</p>
            <p class="text-white font-bold text-lg">Sergen Yalçın, nouveau sélectionneur</p>
            <p class="text-gray-400 text-sm mt-1">Dernière du groupe A1, la Turquie joue en France le 15 novembre →</p>
        </a>
        <a href="/ligue-des-nations-2026-2027.php#classements-groupes" class="bg-gray-800 border border-gray-700 hover:border-green-600 rounded-xl p-5 transition-colors block">
            <p class="text-green-400 text-xs font-semibold uppercase tracking-wider mb-2">Ligue des Nations</p>
            <p class="text-white font-bold text-lg">Les classements des 14 groupes</p>
            <p class="text-gray-400 text-sm mt-1">Phase de groupes jusqu'au 17 novembre, quarts de finale en mars 2027 →</p>
        </a>
    </div>
</section>

<!-- FAQ -->
<section class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-5">Foire aux questions : qualifications Euro 2028</h2>
    <div class="space-y-3">

        <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
            <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">
                Quand ont lieu les qualifications de l'Euro 2028 ?
                <span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span>
            </summary>
            <p class="text-gray-400 text-sm leading-relaxed mt-3">
                Le tirage au sort des qualifications a lieu le dimanche 6 décembre 2026 à Belfast, en Irlande du Nord. Les matchs de qualification se déroulent du 25 mars 2027 au 28 mars 2028.
            </p>
        </details>

        <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
            <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">
                Comment fonctionne le format des qualifications de l'Euro 2028 ?
                <span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span>
            </summary>
            <p class="text-gray-400 text-sm leading-relaxed mt-3">
                Les 54 nations membres de l'UEFA sont réparties en 12 groupes (6 groupes de 4 équipes, 6 groupes de 5). Les 12 vainqueurs de groupe et les 8 meilleurs deuxièmes se qualifient directement, soit 20 nations. Les 4 pays hôtes participent aussi aux qualifications ; si l'un d'eux ne se qualifie pas autrement, 2 places supplémentaires leur sont réservées.
            </p>
        </details>

        <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
            <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">
                Où en est l'équipe de France avant les qualifications de l'Euro 2028 ?
                <span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span>
            </summary>
            <p class="text-gray-400 text-sm leading-relaxed mt-3">
                Les Bleus de Zinédine Zidane, nommé le 28 juillet 2026, sont en tête du groupe A1 de la Ligue des Nations avec 10 points après quatre matchs. Ils jouent en Italie le 12 novembre 2026, puis reçoivent la Turquie à Bordeaux le 15 novembre.
            </p>
        </details>

        <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
            <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">
                Quelles équipes sont qualifiées pour l'Euro 2028 ?
                <span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span>
            </summary>
            <p class="text-gray-400 text-sm leading-relaxed mt-3">
                Aucune équipe n'est qualifiée au 11 novembre 2026 : les qualifications débutent le 25 mars 2027, après le tirage au sort du 6 décembre 2026 à Belfast.
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
        <a href="/blog/" class="text-green-400 hover:text-green-300 ml-1">Voir tous les articles →</a>
    </div>
    <?php else: ?>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
        <?php foreach (array_slice($articlesFrance, 0, 3) as $a): ?>
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
    <a href="/equipe-france.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">🇫🇷 Équipe de France</a>
</section>

<?php include __DIR__ . '/templates/footer.php'; ?>
