<?php
$page_title = 'Euro 2028 : les 8 villes hôtes du Royaume-Uni et d\'Irlande';
$meta_desc  = "Londres, Cardiff, Manchester, Liverpool, Newcastle, Birmingham, Glasgow, Dublin : découvrez les 8 villes hôtes de l'Euro 2028 et les 4 nations qui accueillent le tournoi.";
$og_image   = '/images/stades/carte-stades-euro-2028.jpg';
include __DIR__ . '/templates/header.php';
?>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "Où aura lieu l'Euro 2028 ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "L'Euro 2028 sera organisé en Angleterre, en Écosse, au pays de Galles et en République d'Irlande. Les matchs se dérouleront dans neuf stades répartis entre huit villes : Londres, Cardiff, Manchester, Liverpool, Newcastle, Birmingham, Glasgow et Dublin."
      }
    },
    {
      "@type": "Question",
      "name": "Belfast accueillera-t-elle des matchs de l'Euro 2028 ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Non. Belfast figurait initialement dans le projet avec Casement Park, mais la ville n'accueillera finalement pas de rencontre de la phase finale. L'Irlande du Nord reste toutefois associée à l'événement : le tirage au sort des qualifications doit se tenir à Belfast le 6 décembre 2026."
      }
    },
    {
      "@type": "Question",
      "name": "Quelle ville accueille le match d'ouverture de l'Euro 2028 ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Cardiff, au pays de Galles, accueille le match d'ouverture de l'Euro 2028 le 9 juin 2028 au Principality Stadium."
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
    <span class="text-gray-400">Les 8 villes hôtes</span>
</nav>

<div class="max-w-3xl mx-auto">

    <header class="mb-10">
        <p class="text-green-400 text-xs font-semibold uppercase tracking-widest mb-2">Guide des villes hôtes</p>
        <h1 class="text-4xl font-bold text-white mb-4 leading-tight">Euro 2028 : les 8 villes hôtes</h1>
        <p class="text-gray-300 text-lg leading-relaxed border-l-4 border-green-500 pl-4">
            Pour la cinquième fois dans l'histoire du Championnat d'Europe, la compétition sera organisée par plusieurs pays. Le Royaume-Uni et la République d'Irlande accueillent l'Euro 2028 à travers quatre nations et huit villes aux identités très différentes.
        </p>
    </header>

    <!-- TODO vignettes des villes à venir : images/euro-2028-{ville}.webp -->

    <section class="mb-10">
        <h2 class="text-2xl font-bold text-white mb-5">Les 4 nations hôtes</h2>

        <div class="space-y-6">
            <div>
                <h3 class="text-xl font-bold text-white mb-2">🏴 Angleterre — 6 stades</h3>
                <p class="text-gray-300 leading-relaxed">
                    L'Angleterre dispose du plus grand nombre de villes hôtes : Londres (Wembley et Tottenham Hotspur Stadium), Manchester, Liverpool, Newcastle et Birmingham. Londres est la seule ville de tout le tournoi à proposer deux enceintes.
                </p>
            </div>
            <div>
                <h3 class="text-xl font-bold text-white mb-2">🏴 Écosse — Glasgow</h3>
                <p class="text-gray-300 leading-relaxed">
                    Glasgow accueillera les rencontres écossaises au mythique Hampden Park, stade national et enceinte traditionnelle des grands rendez-vous du football écossais.
                </p>
            </div>
            <div>
                <h3 class="text-xl font-bold text-white mb-2">🏴 Pays de Galles — Cardiff</h3>
                <p class="text-gray-300 leading-relaxed">
                    Cardiff sera la ville hôte galloise, avec le Principality Stadium — connu de l'UEFA sous le nom de National Stadium of Wales — qui accueillera le match inaugural de l'Euro 2028.
                </p>
            </div>
            <div>
                <h3 class="text-xl font-bold text-white mb-2">🇮🇪 République d'Irlande — Dublin</h3>
                <p class="text-gray-300 leading-relaxed">
                    Dublin sera la seule ville hôte située en dehors du Royaume-Uni. Les matchs irlandais se joueront à l'Aviva Stadium, désigné « Dublin Arena » par l'UEFA.
                </p>
            </div>
        </div>
    </section>

    <section class="mb-10">
        <h2 class="text-2xl font-bold text-white mb-4">Pourquoi Belfast n'accueillera-t-elle pas de match ?</h2>
        <p class="text-gray-300 leading-relaxed">
            Belfast figurait initialement dans le projet de candidature, avec le stade de Casement Park. La ville ne fait finalement pas partie des sites de compétition. L'Irlande du Nord reste néanmoins associée à l'événement : le tirage au sort des qualifications doit se tenir à Belfast le 6 décembre 2026.
        </p>
    </section>

    <section class="mb-10">
        <h2 class="text-2xl font-bold text-white mb-5">Une compétition répartie sur huit villes</h2>
        <p class="text-gray-300 leading-relaxed mb-5">
            Les supporters pourront suivre la compétition dans quatre nations et découvrir des villes aux identités très différentes :
        </p>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            <div class="bg-gray-800 border border-green-700 rounded-lg p-4"><span class="text-white font-semibold">Londres</span><p class="text-gray-500 text-xs mt-1">Deux stades, dont Wembley, centre de la dernière semaine.</p></div>
            <div class="bg-gray-800 border border-gray-700 rounded-lg p-4"><span class="text-white font-semibold">Cardiff</span><p class="text-gray-500 text-xs mt-1">Ville du match d'ouverture, porte d'entrée du tournoi gallois.</p></div>
            <div class="bg-gray-800 border border-gray-700 rounded-lg p-4"><span class="text-white font-semibold">Manchester</span><p class="text-gray-500 text-xs mt-1">Grande destination sportive du nord-ouest de l'Angleterre.</p></div>
            <div class="bg-gray-800 border border-gray-700 rounded-lg p-4"><span class="text-white font-semibold">Liverpool</span><p class="text-gray-500 text-xs mt-1">Nouvelle enceinte d'Everton au bord de la Mersey.</p></div>
            <div class="bg-gray-800 border border-gray-700 rounded-lg p-4"><span class="text-white font-semibold">Newcastle</span><p class="text-gray-500 text-xs mt-1">Football populaire et ambiance de Premier League.</p></div>
            <div class="bg-gray-800 border border-gray-700 rounded-lg p-4"><span class="text-white font-semibold">Birmingham</span><p class="text-gray-500 text-xs mt-1">Villa Park et l'histoire d'Aston Villa.</p></div>
            <div class="bg-gray-800 border border-gray-700 rounded-lg p-4"><span class="text-white font-semibold">Glasgow</span><p class="text-gray-500 text-xs mt-1">Hampden Park et la tradition du football écossais.</p></div>
            <div class="bg-gray-800 border border-gray-700 rounded-lg p-4"><span class="text-white font-semibold">Dublin</span><p class="text-gray-500 text-xs mt-1">Seul site de la compétition situé en République d'Irlande.</p></div>
        </div>
        <p class="text-gray-400 text-sm leading-relaxed mt-5">
            Cette répartition met en avant la diversité culturelle et sportive du Royaume-Uni et de l'Irlande, tout en offrant aux visiteurs des expériences très différentes d'une ville à l'autre. Pour le détail de chaque stade (capacité, matchs accueillis), direction notre <a href="/euro-2028-les-9-stades.php" class="text-green-400 hover:text-green-300 underline">guide des 9 stades de l'Euro 2028</a>.
        </p>
    </section>

    <!-- FAQ -->
    <section class="mb-10">
        <h2 class="text-2xl font-bold text-white mb-5">Foire aux questions : les villes hôtes de l'Euro 2028</h2>
        <div class="space-y-3">

            <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
                <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">
                    Où aura lieu l'Euro 2028 ?
                    <span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span>
                </summary>
                <p class="text-gray-400 text-sm leading-relaxed mt-3">
                    L'Euro 2028 sera organisé en Angleterre, en Écosse, au pays de Galles et en République d'Irlande. Les matchs se dérouleront dans neuf stades répartis entre huit villes : Londres, Cardiff, Manchester, Liverpool, Newcastle, Birmingham, Glasgow et Dublin.
                </p>
            </details>

            <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
                <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">
                    Belfast accueillera-t-elle des matchs ?
                    <span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span>
                </summary>
                <p class="text-gray-400 text-sm leading-relaxed mt-3">
                    Non. Belfast n'accueillera pas de rencontre de la phase finale, mais la ville reste impliquée dans l'organisation puisque le tirage au sort des qualifications doit s'y dérouler le 6 décembre 2026.
                </p>
            </details>

            <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
                <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">
                    Quelle ville accueille le match d'ouverture ?
                    <span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span>
                </summary>
                <p class="text-gray-400 text-sm leading-relaxed mt-3">
                    Cardiff, au pays de Galles, accueille le match d'ouverture de l'Euro 2028 le 9 juin 2028 au Principality Stadium.
                </p>
            </details>

        </div>
    </section>

    <!-- Liens internes -->
    <section class="flex flex-wrap gap-4 justify-center pt-4 pb-4">
        <a href="/euro-2028-les-9-stades.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">🏟️ Les 9 stades</a>
        <a href="/euro-2028.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">🏆 Retour à l'Euro 2028</a>
    </section>

</div>

<?php include __DIR__ . '/templates/footer.php'; ?>
