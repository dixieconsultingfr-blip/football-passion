<?php
$page_title = 'Coupe du Monde 2030 : les stades — Espagne, Portugal, Maroc';
$meta_desc  = "Les 23 stades de la Coupe du Monde 2030 : Camp Nou, Bernabéu, Estádio da Luz, Grand Stade Hassan II et les 3 enceintes du centenaire en Amérique du Sud.";
include __DIR__ . '/templates/header.php';
?>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "Combien de stades accueilleront la Coupe du Monde 2030 ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "23 stades sont annoncés à ce jour : environ 10-11 en Espagne, 6 au Maroc, 3 au Portugal, et 3 en Amérique du Sud (Uruguay, Argentine, Paraguay) pour les matchs du centenaire. Cette liste reste susceptible d'évoluer d'ici 2030 — un stade espagnol (Malaga) s'est déjà retiré du projet."
      }
    },
    {
      "@type": "Question",
      "name": "Quel sera le plus grand stade de la Coupe du Monde 2030 ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Le Grand Stade Hassan II, en cours de construction à Casablanca au Maroc, est annoncé pour environ 115 000 places — il serait le plus grand stade du tournoi, et l'un des plus grands au monde."
      }
    },
    {
      "@type": "Question",
      "name": "Où se jouera la finale de la Coupe du Monde 2030 ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Le lieu de la finale n'est pas encore officiellement confirmé à ce jour. L'Estádio da Luz de Lisbonne a été confirmé comme site de l'une des demi-finales."
      }
    }
  ]
}
</script>

<!-- Breadcrumb -->
<nav class="text-xs text-gray-400 mb-8 flex items-center gap-2">
    <a href="/" class="hover:text-green-400 transition-colors">Accueil</a>
    <span>›</span>
    <a href="/coupe-du-monde-2030.php" class="hover:text-green-400 transition-colors">Coupe du Monde 2030</a>
    <span>›</span>
    <span class="text-gray-400">Les stades</span>
</nav>

<div class="max-w-3xl mx-auto">

    <header class="mb-10">
        <p class="text-green-400 text-xs font-semibold uppercase tracking-widest mb-2">Guide des enceintes</p>
        <h1 class="text-4xl font-bold text-white mb-4 leading-tight">Coupe du Monde 2030 : les stades</h1>
        <p class="text-gray-300 text-lg leading-relaxed border-l-4 border-green-500 pl-4">
            23 stades répartis sur trois continents accueilleront la Coupe du Monde 2030 : le tournoi principal en Espagne, au Portugal et au Maroc, précédé de trois matchs du centenaire en Amérique du Sud. Une organisation inédite dans l'histoire de la compétition.
        </p>
        <p class="text-gray-600 text-xs mt-3 italic">
            ⚠️ Le tournoi est encore à 4 ans de son coup d'envoi : plusieurs stades sont en construction ou en rénovation, et la liste ci-dessous peut évoluer. Un stade espagnol (Malaga) s'est déjà retiré du projet en juillet 2025.
        </p>
    </header>

    <!-- TODO vignettes des stades à venir : images/cdm-2030-{stade}.webp -->

    <section class="mb-10">
        <h2 class="text-2xl font-bold text-white mb-2">Les matchs du centenaire — Amérique du Sud</h2>
        <p class="text-gray-300 leading-relaxed mb-4">
            Pour célébrer les 100 ans de la compétition, dont la première édition s'est jouée en Uruguay en 1930, trois matchs d'ouverture symboliques se disputeront en Amérique du Sud, une semaine avant le début du tournoi principal.
        </p>

        <h3 class="text-xl font-bold text-white mt-5 mb-2">Estadio Centenario — Montevideo (Uruguay)</h3>
        <p class="text-gray-500 text-sm mb-3">Capacité indicative : 60 235 places</p>
        <p class="text-gray-300 leading-relaxed">
            Le stade mythique où est née la Coupe du Monde en 1930. FIFA a confirmé l'Estadio Centenario comme site du match d'ouverture du centenaire, le 8 juin 2030, avec une cérémonie symbolique « là où tout a commencé ».
        </p>

        <h3 class="text-xl font-bold text-white mt-5 mb-2">Estadio Más Monumental — Buenos Aires (Argentine)</h3>
        <p class="text-gray-500 text-sm mb-3">Capacité indicative : 84 567 places</p>
        <p class="text-gray-300 leading-relaxed">
            Antre historique de River Plate, le plus grand stade d'Argentine accueillera l'un des matchs du centenaire le 8 juin 2030.
        </p>

        <h3 class="text-xl font-bold text-white mt-5 mb-2">Estadio CONMEBOL — Asunción (Paraguay)</h3>
        <p class="text-gray-500 text-sm mb-3">Capacité indicative : 47 000 places (en construction)</p>
        <p class="text-gray-300 leading-relaxed">
            Le siège administratif du football sud-américain accueillera le troisième match du centenaire, le 9 juin 2030 — le stade est encore en construction à ce jour.
        </p>
    </section>

    <section class="mb-10">
        <h2 class="text-2xl font-bold text-white mb-4">Les stades au Maroc (6)</h2>
        <p class="text-gray-300 leading-relaxed mb-4">
            Tous les stades marocains sont en rénovation ou en construction pour l'occasion, à l'exception du futur Grand Stade Hassan II.
        </p>
        <div class="space-y-3">
            <div class="bg-gray-800 border border-green-600 rounded-lg p-4">
                <span class="text-green-400 text-[10px] font-bold uppercase tracking-wider">Le plus grand du tournoi (projet)</span>
                <div class="text-white font-semibold mt-1">Grand Stade Hassan II — Casablanca</div>
                <div class="text-gray-500 text-xs mt-1">Environ 115 000 places · en construction</div>
            </div>
            <div class="bg-gray-800 border border-gray-700 rounded-lg p-4"><div class="text-white font-semibold">Stade de Tanger</div><div class="text-gray-500 text-xs mt-1">Environ 75 600 places</div></div>
            <div class="bg-gray-800 border border-gray-700 rounded-lg p-4"><div class="text-white font-semibold">Complexe Moulay Abdellah — Rabat</div><div class="text-gray-500 text-xs mt-1">Environ 68 700 places</div></div>
            <div class="bg-gray-800 border border-gray-700 rounded-lg p-4"><div class="text-white font-semibold">Stade de Fès</div><div class="text-gray-500 text-xs mt-1">Environ 55 800 places</div></div>
            <div class="bg-gray-800 border border-gray-700 rounded-lg p-4"><div class="text-white font-semibold">Grand Stade d'Agadir</div><div class="text-gray-500 text-xs mt-1">Environ 46 000 places</div></div>
            <div class="bg-gray-800 border border-gray-700 rounded-lg p-4"><div class="text-white font-semibold">Stade de Marrakech</div><div class="text-gray-500 text-xs mt-1">Environ 45 860 places</div></div>
        </div>
    </section>

    <section class="mb-10">
        <h2 class="text-2xl font-bold text-white mb-4">Les stades au Portugal (3)</h2>
        <div class="space-y-3">
            <div class="bg-gray-800 border border-green-600 rounded-lg p-4">
                <span class="text-green-400 text-[10px] font-bold uppercase tracking-wider">Demi-finale confirmée</span>
                <div class="text-white font-semibold mt-1">Estádio da Luz — Lisbonne (Benfica)</div>
                <div class="text-gray-500 text-xs mt-1">Environ 66 000 places, le plus grand du pays</div>
            </div>
            <div class="bg-gray-800 border border-gray-700 rounded-lg p-4"><div class="text-white font-semibold">Estádio José Alvalade — Lisbonne (Sporting)</div><div class="text-gray-500 text-xs mt-1">Environ 50 000 places</div></div>
            <div class="bg-gray-800 border border-gray-700 rounded-lg p-4"><div class="text-white font-semibold">Estádio do Dragão — Porto (FC Porto)</div><div class="text-gray-500 text-xs mt-1">Environ 50 000 places</div></div>
        </div>
        <p class="text-gray-300 leading-relaxed mt-4">
            L'Estádio da Luz a déjà été confirmé par la FIFA comme site de l'une des demi-finales du tournoi, en raison de sa capacité — la plus grande des trois enceintes portugaises.
        </p>
    </section>

    <section class="mb-10">
        <h2 class="text-2xl font-bold text-white mb-4">Les stades en Espagne (10-11)</h2>
        <p class="text-gray-300 leading-relaxed mb-4">
            L'Espagne concentre le plus grand nombre d'enceintes, avec Madrid et Barcelone en têtes d'affiche. Málaga, initialement retenue, s'est retirée du projet en juillet 2025 en raison du coût de délocalisation temporaire de son club résident — un stade de remplacement (Valence ou Vigo évoqués) restait à confirmer au moment de la rédaction.
        </p>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            <div class="bg-gray-800 border border-gray-700 rounded-lg p-4"><div class="text-white font-semibold">Santiago-Bernabéu — Madrid (Real Madrid)</div><div class="text-gray-500 text-xs mt-1">Environ 80 000 places</div></div>
            <div class="bg-gray-800 border border-gray-700 rounded-lg p-4"><div class="text-white font-semibold">Camp Nou — Barcelone (FC Barcelone)</div><div class="text-gray-500 text-xs mt-1">Environ 105 000 places</div></div>
            <div class="bg-gray-800 border border-gray-700 rounded-lg p-4"><div class="text-white font-semibold">Estadio Metropolitano — Madrid (Atlético)</div><div class="text-gray-500 text-xs mt-1">Enceinte de l'Atlético de Madrid</div></div>
            <div class="bg-gray-800 border border-gray-700 rounded-lg p-4"><div class="text-white font-semibold">Stade RCDE — Barcelone (Espanyol)</div><div class="text-gray-500 text-xs mt-1">Enceinte du RCD Espanyol</div></div>
            <div class="bg-gray-800 border border-gray-700 rounded-lg p-4"><div class="text-white font-semibold">La Cartuja — Séville</div><div class="text-gray-500 text-xs mt-1">Stade national espagnol</div></div>
            <div class="bg-gray-800 border border-gray-700 rounded-lg p-4"><div class="text-white font-semibold">San Mamés — Bilbao (Athletic Bilbao)</div><div class="text-gray-500 text-xs mt-1">—</div></div>
            <div class="bg-gray-800 border border-gray-700 rounded-lg p-4"><div class="text-white font-semibold">Reale Arena — Saint-Sébastien</div><div class="text-gray-500 text-xs mt-1">—</div></div>
            <div class="bg-gray-800 border border-gray-700 rounded-lg p-4"><div class="text-white font-semibold">Riazor — La Corogne</div><div class="text-gray-500 text-xs mt-1">—</div></div>
            <div class="bg-gray-800 border border-gray-700 rounded-lg p-4"><div class="text-white font-semibold">La Romareda — Saragosse</div><div class="text-gray-500 text-xs mt-1">—</div></div>
            <div class="bg-gray-800 border border-gray-700 rounded-lg p-4"><div class="text-white font-semibold">Gran Canaria Arena — Las Palmas</div><div class="text-gray-500 text-xs mt-1">—</div></div>
        </div>
    </section>

    <!-- FAQ -->
    <section class="mb-10">
        <h2 class="text-2xl font-bold text-white mb-5">Foire aux questions : les stades de la Coupe du Monde 2030</h2>
        <div class="space-y-3">

            <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
                <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">
                    Combien de stades accueilleront la Coupe du Monde 2030 ?
                    <span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span>
                </summary>
                <p class="text-gray-400 text-sm leading-relaxed mt-3">
                    23 stades sont annoncés à ce jour : environ 10-11 en Espagne, 6 au Maroc, 3 au Portugal, et 3 en Amérique du Sud (Uruguay, Argentine, Paraguay) pour les matchs du centenaire. Cette liste reste susceptible d'évoluer d'ici 2030 — un stade espagnol (Malaga) s'est déjà retiré du projet.
                </p>
            </details>

            <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
                <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">
                    Quel sera le plus grand stade du tournoi ?
                    <span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span>
                </summary>
                <p class="text-gray-400 text-sm leading-relaxed mt-3">
                    Le Grand Stade Hassan II, en construction à Casablanca au Maroc, est annoncé pour environ 115 000 places — il serait le plus grand stade du tournoi, et l'un des plus grands au monde.
                </p>
            </details>

            <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
                <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">
                    Où se jouera la finale ?
                    <span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span>
                </summary>
                <p class="text-gray-400 text-sm leading-relaxed mt-3">
                    Le lieu de la finale n'est pas encore officiellement confirmé à ce jour. L'Estádio da Luz de Lisbonne a en revanche été confirmé comme site de l'une des demi-finales.
                </p>
            </details>

        </div>
    </section>

    <!-- Liens internes -->
    <section class="flex flex-wrap gap-4 justify-center pt-4 pb-4">
        <a href="/coupe-du-monde-2030-les-villes-hotes.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">🏙️ Les villes hôtes</a>
        <a href="/coupe-du-monde-2030.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">🏆 Retour à la Coupe du Monde 2030</a>
    </section>

</div>

<?php include __DIR__ . '/templates/footer.php'; ?>
