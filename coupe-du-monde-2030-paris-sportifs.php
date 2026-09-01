<?php
require_once __DIR__ . '/blog/helpers.php';
$articlesAll = load_articles_index(__DIR__);
$articlesCdm = array_values(array_filter($articlesAll, fn($a) => ($a['categorie'] ?? '') === 'CDM'));
usort($articlesCdm, fn($a, $b) => strtotime($b['date']) <=> strtotime($a['date']));

$page_title = 'Paris sportifs Coupe du Monde 2030 — Cotes, pronostics et guide';
$meta_desc  = "Tout savoir sur les paris sportifs pour la Coupe du Monde 2030 (Espagne, Portugal, Maroc) : quand les cotes seront disponibles, comment parier légalement en France. Jouer comporte des risques.";
include __DIR__ . '/templates/header.php';
?>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "Quand pourra-t-on parier sur la Coupe du Monde 2030 ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Les opérateurs agréés par l'ANJ ouvrent généralement leurs premiers marchés (vainqueur final) plusieurs mois voire plus d'un an avant la compétition. Les cotes détaillées par match n'apparaissent qu'à l'approche immédiate du tournoi, une fois les groupes connus."
      }
    },
    {
      "@type": "Question",
      "name": "Comment parier légalement sur le football en France ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "En France, seuls les opérateurs de paris sportifs agréés par l'Autorité Nationale des Jeux (ANJ) sont autorisés à proposer des paris en ligne. La liste des opérateurs agréés est publiée sur le site officiel anj.fr."
      }
    },
    {
      "@type": "Question",
      "name": "Quels types de paris existent pour une Coupe du Monde ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Les formats les plus courants sont le pari sur le vainqueur final, le meilleur buteur du tournoi, le vainqueur de groupe, le nombre total de buts d'un match, ou encore les qualifications directes. Chaque opérateur agréé propose ses propres cotes et marchés."
      }
    }
  ]
}
</script>

<!-- Breadcrumb -->
<nav class="text-xs text-gray-400 mb-8 flex items-center gap-2">
    <a href="/" class="hover:text-green-400 transition-colors">Accueil</a>
    <span>›</span>
    <a href="/coupe-du-monde.php" class="hover:text-green-400 transition-colors">Coupe du Monde</a>
    <span>›</span>
    <a href="/coupe-du-monde-2030.php" class="hover:text-green-400 transition-colors">2030</a>
    <span>›</span>
    <span class="text-gray-400">Paris sportifs</span>
</nav>

<!-- Hero -->
<header class="mb-8">
    <p class="text-green-400 text-xs font-semibold uppercase tracking-widest mb-1">Guide paris sportifs</p>
    <h1 class="text-4xl font-bold text-white mb-2">Paris sportifs Coupe du Monde 2030</h1>
    <p class="text-gray-400 text-sm mb-4">Cotes, pronostics et guide complet — Espagne, Portugal, Maroc, 8 juin – 21 juillet 2030</p>
    <p class="text-gray-300 leading-relaxed max-w-2xl">
        À plus de trois ans du coup d'envoi, les cotes détaillées de la Coupe du Monde 2030 ne sont pas encore publiées
        par les opérateurs. Cette page évolutive rassemble déjà ce qu'il faut savoir : quand les premiers marchés
        ouvriront, comment parier légalement en France, et les types de paris à connaître pour ce tournoi du centenaire.
        Elle sera mise à jour au fil des qualifications et à l'approche de la compétition.
    </p>
</header>

<!-- Bandeau jeu responsable (haut de page) -->
<div class="bg-gray-900 border border-yellow-700/40 rounded-xl px-5 py-4 mb-10 flex flex-col sm:flex-row sm:items-center gap-3">
    <span class="text-2xl shrink-0">🔞</span>
    <p class="text-gray-300 text-xs leading-relaxed">
        <strong class="text-white">Jouer comporte des risques : endettement, isolement, dépendance.</strong>
        Pour être aidé, appelez le <a href="tel:0974751313" class="text-green-400 underline">09 74 75 13 13</a> (appel non surtaxé).
        Jeu interdit aux mineurs. Seuls les opérateurs agréés par l'<a href="https://anj.fr" target="_blank" rel="nofollow noopener noreferrer" class="text-green-400 underline">Autorité Nationale des Jeux (ANJ)</a> sont autorisés à proposer des paris sportifs en ligne en France.
    </p>
</div>

<!-- Quand parier -->
<section class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-4">Quand les cotes de la Coupe du Monde 2030 seront-elles disponibles ?</h2>
    <div class="bg-gray-800 rounded-xl border border-gray-700 p-6 text-sm text-gray-300 leading-relaxed space-y-3">
        <p>
            À ce stade, à plus de trois ans du tournoi, aucun opérateur agréé ne propose encore de cotes détaillées pour
            la Coupe du Monde 2030. Les grands opérateurs français attendent généralement que le format des qualifications
            continentales soit fixé pour ouvrir leurs premiers marchés, le plus souvent un « vainqueur final » à long terme.
        </p>
        <ul class="space-y-1.5 text-gray-400 pt-2 border-t border-gray-700">
            <li>📅 <strong class="text-white">2028-2029</strong> — qualifications continentales (zones UEFA, CAF, CONMEBOL...) : premiers marchés « vainqueur » possibles chez certains opérateurs</li>
            <li>📅 <strong class="text-white">Fin 2029 / début 2030</strong> — nations qualifiées connues</li>
            <li>📅 <strong class="text-white">Printemps 2030</strong> — tirage au sort des groupes : ouverture des cotes détaillées par match</li>
            <li>📅 <strong class="text-white">Juin-juillet 2030</strong> — cotes complètes pour chaque match du tournoi, y compris les matchs du centenaire en Amérique du Sud (Uruguay, Argentine, Paraguay)</li>
        </ul>
        <p class="text-gray-500 text-xs pt-2">
            Cette page sera mise à jour à chaque étape clé, avec les informations vérifiées sur les marchés qui s'ouvrent réellement.
        </p>
    </div>
</section>

<!-- Comment parier légalement -->
<section class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-4">Comment parier légalement en France</h2>
    <div class="bg-gray-800 rounded-xl border border-gray-700 p-6 text-sm text-gray-300 leading-relaxed space-y-3">
        <p>
            En France, l'activité de paris sportifs en ligne est strictement encadrée. Seuls les opérateurs disposant
            d'un agrément délivré par l'<strong class="text-white">Autorité Nationale des Jeux (ANJ)</strong>, l'organisme
            public qui régule et contrôle le secteur des jeux d'argent, sont autorisés à proposer des paris sportifs
            aux résidents français.
        </p>
        <p>
            La liste actualisée des opérateurs agréés est publiée sur le site officiel
            <a href="https://anj.fr" target="_blank" rel="nofollow noopener noreferrer" class="text-green-400 hover:text-green-300 underline">anj.fr</a>.
            Parier sur un site non agréé n'offre aucune protection légale en cas de litige et expose à des risques
            financiers et de sécurité des données.
        </p>
        <p class="text-gray-500 text-xs pt-2 border-t border-gray-700">
            Football Passion ne propose ni ne facilite aucune prise de pari sur ce site et ne perçoit à ce jour aucune
            commission d'affiliation. Cette page a une vocation purement informative.
        </p>
    </div>
</section>

<!-- Types de paris -->
<section class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-4">Les types de paris possibles pour une Coupe du Monde</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
        <?php
        $typesParis = [
            ['🏆', 'Vainqueur final', 'Le pari le plus simple : désigner l\'équipe qui remportera le tournoi. Cote disponible dès l\'ouverture des premiers marchés.'],
            ['⚽', 'Meilleur buteur', 'Parier sur le joueur qui terminera meilleur buteur de la compétition — généralement ouvert une fois les équipes qualifiées connues.'],
            ['🥇', 'Vainqueur de groupe', 'Désigner l\'équipe qui terminera première de son groupe, disponible dès le tirage au sort des poules.'],
            ['📊', 'Nombre de buts', 'Parier sur le nombre total de buts d\'un match (plus/moins de 2,5 buts, par exemple), disponible match par match.'],
            ['🎯', 'Qualification directe', 'Parier sur la qualification d\'une équipe pour un tour donné (huitièmes, quarts, demi-finales).'],
            ['🇫🇷', 'Parcours de la France', 'Marché spécifique sur le parcours des Bleus de Zidane, généralement très suivi par les parieurs français.'],
        ];
        foreach ($typesParis as $t): ?>
        <div class="bg-gray-800 border border-gray-700 rounded-xl p-4 flex items-start gap-3">
            <span class="text-2xl shrink-0"><?= $t[0] ?></span>
            <div>
                <div class="text-white font-semibold text-sm"><?= $t[1] ?></div>
                <div class="text-gray-500 text-xs mt-1 leading-relaxed"><?= $t[2] ?></div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- Jouer de manière responsable -->
<section class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-4">Jouer de manière responsable</h2>
    <div class="bg-gray-900 border border-yellow-700/40 rounded-xl p-6 text-sm text-gray-300 leading-relaxed space-y-3">
        <p>
            <strong class="text-white">Le jeu doit rester un divertissement, pas une source de revenus.</strong>
            Fixez-vous un budget avant de jouer et ne le dépassez jamais, ne cherchez pas à « se refaire » après une perte,
            et ne jouez jamais sous l'emprise de l'alcool ou pour échapper à des difficultés personnelles.
        </p>
        <p>
            <strong class="text-white">Jouer comporte des risques : endettement, isolement, dépendance.</strong>
            Si vous ressentez une perte de contrôle sur votre pratique de jeu, ou si vous vous inquiétez pour un proche,
            <strong class="text-white">Joueurs Info Service</strong> propose une écoute gratuite et anonyme, 7 jours sur 7,
            au <a href="tel:0974751313" class="text-green-400 underline">09 74 75 13 13</a> (appel non surtaxé), ou sur
            <a href="https://www.joueurs-info-service.fr" target="_blank" rel="nofollow noopener noreferrer" class="text-green-400 hover:text-green-300 underline">joueurs-info-service.fr</a>.
        </p>
        <p class="text-gray-500 text-xs pt-2 border-t border-gray-700/60">
            Les jeux d'argent et de hasard sont interdits aux mineurs. Seuls les opérateurs agréés par l'ANJ sont autorisés en France.
        </p>
    </div>
</section>

<!-- FAQ -->
<section class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-5">Foire aux questions : paris sportifs Coupe du Monde 2030</h2>
    <div class="space-y-3">

        <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
            <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">
                Quand pourra-t-on parier sur la Coupe du Monde 2030 ?
                <span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span>
            </summary>
            <p class="text-gray-400 text-sm leading-relaxed mt-3">
                Les opérateurs agréés par l'ANJ ouvrent généralement leurs premiers marchés (vainqueur final) plusieurs mois voire plus d'un an avant la compétition. Les cotes détaillées par match n'apparaissent qu'à l'approche immédiate du tournoi, une fois les groupes connus.
            </p>
        </details>

        <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
            <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">
                Comment parier légalement sur le football en France ?
                <span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span>
            </summary>
            <p class="text-gray-400 text-sm leading-relaxed mt-3">
                Seuls les opérateurs de paris sportifs agréés par l'Autorité Nationale des Jeux (ANJ) sont autorisés à proposer des paris en ligne en France. La liste des opérateurs agréés est publiée sur anj.fr.
            </p>
        </details>

        <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
            <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">
                Quels types de paris existent pour une Coupe du Monde ?
                <span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span>
            </summary>
            <p class="text-gray-400 text-sm leading-relaxed mt-3">
                Les formats les plus courants sont le pari sur le vainqueur final, le meilleur buteur du tournoi, le vainqueur de groupe, le nombre total de buts d'un match, ou encore les qualifications directes. Chaque opérateur agréé propose ses propres cotes et marchés.
            </p>
        </details>

    </div>
</section>

<!-- Actualités liées -->
<section class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-5">Actualités — Coupe du Monde 2030</h2>
    <?php if (empty($articlesCdm)): ?>
    <div class="bg-gray-800 rounded-xl border border-gray-700 p-6 text-center text-gray-500 text-sm">
        Aucun article publié pour le moment dans cette catégorie.
        <a href="/blog" class="text-green-400 hover:text-green-300 ml-1">Voir tous les articles →</a>
    </div>
    <?php else: ?>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
        <?php foreach (array_slice($articlesCdm, 0, 3) as $a): ?>
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

<!-- Bandeau jeu responsable (bas de page) -->
<div class="bg-gray-900 border border-yellow-700/40 rounded-xl px-5 py-4 mb-8 text-center">
    <p class="text-gray-400 text-xs leading-relaxed">
        🔞 Jeu interdit aux mineurs. Jouer comporte des risques : endettement, isolement, dépendance.
        Pour être aidé, appelez le <a href="tel:0974751313" class="text-green-400 underline">09 74 75 13 13</a> (appel non surtaxé) —
        <a href="https://www.joueurs-info-service.fr" target="_blank" rel="nofollow noopener noreferrer" class="text-green-400 underline">joueurs-info-service.fr</a>
    </p>
</div>

<!-- Liens internes -->
<section class="flex flex-wrap gap-4 justify-center pb-4">
    <a href="/coupe-du-monde-2030.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">🏆 Coupe du Monde 2030</a>
    <a href="/equipe-france.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">🇫🇷 Équipe de France</a>
</section>

<?php include __DIR__ . '/templates/footer.php'; ?>
