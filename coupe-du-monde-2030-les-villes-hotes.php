<?php
$page_title = 'Coupe du Monde 2030 : les villes hôtes sur 3 continents';
$meta_desc  = "Madrid, Barcelone, Lisbonne, Porto, Casablanca, Montevideo... Découvrez les villes hôtes de la Coupe du Monde 2030, répartie entre l'Europe, l'Afrique et l'Amérique du Sud.";
include __DIR__ . '/templates/header.php';
?>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "Où aura lieu la Coupe du Monde 2030 ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "La Coupe du Monde 2030 se déroulera principalement en Espagne, au Portugal et au Maroc. Pour célébrer le centenaire de la compétition, trois matchs d'ouverture se joueront aussi en Uruguay, en Argentine et au Paraguay — une première dans l'histoire du tournoi, disputé sur trois continents."
      }
    },
    {
      "@type": "Question",
      "name": "Pourquoi des matchs se jouent-ils en Amérique du Sud alors que le tournoi principal est en Europe et en Afrique ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "La Coupe du Monde 2030 fête les 100 ans de la compétition, dont la toute première édition s'est déroulée en Uruguay en 1930. La FIFA a choisi d'organiser trois matchs symboliques du centenaire à Montevideo, Buenos Aires et Asunción avant le début du tournoi principal."
      }
    }
  ]
}
</script>

<!-- Breadcrumb -->
<nav class="text-xs text-gray-500 mb-8 flex items-center gap-2">
    <a href="/" class="hover:text-green-400 transition-colors">Accueil</a>
    <span>›</span>
    <a href="/coupe-du-monde-2030.php" class="hover:text-green-400 transition-colors">Coupe du Monde 2030</a>
    <span>›</span>
    <span class="text-gray-400">Les villes hôtes</span>
</nav>

<div class="max-w-3xl mx-auto">

    <header class="mb-10">
        <p class="text-green-400 text-xs font-semibold uppercase tracking-widest mb-2">Guide des villes hôtes</p>
        <h1 class="text-4xl font-bold text-white mb-4 leading-tight">Coupe du Monde 2030 : les villes hôtes</h1>
        <p class="text-gray-300 text-lg leading-relaxed border-l-4 border-green-500 pl-4">
            Une Coupe du Monde comme jamais organisée : six pays, trois continents. Le tournoi principal se joue en Espagne, au Portugal et au Maroc, précédé d'une parenthèse sud-américaine pour le centenaire de la compétition.
        </p>
    </header>

    <!-- TODO vignettes des villes à venir : images/cdm-2030-{ville}.webp -->

    <section class="mb-10">
        <h2 class="text-2xl font-bold text-white mb-5">Les 3 nations du tournoi principal</h2>

        <div class="space-y-6">
            <div>
                <h3 class="text-xl font-bold text-white mb-2">🇪🇸 Espagne</h3>
                <p class="text-gray-300 leading-relaxed">
                    Le pays hôte le plus représenté, avec des matchs à Madrid, Barcelone, Séville, Bilbao, Saint-Sébastien, La Corogne, Saragosse et Las Palmas. Madrid et Barcelone concentrent chacune deux stades.
                </p>
            </div>
            <div>
                <h3 class="text-xl font-bold text-white mb-2">🇵🇹 Portugal</h3>
                <p class="text-gray-300 leading-relaxed">
                    Lisbonne (deux stades) et Porto accueilleront les matchs portugais. L'Estádio da Luz de Lisbonne a été confirmé pour l'une des demi-finales.
                </p>
            </div>
            <div>
                <h3 class="text-xl font-bold text-white mb-2">🇲🇦 Maroc</h3>
                <p class="text-gray-300 leading-relaxed">
                    Six villes marocaines participeront au tournoi : Casablanca, Rabat, Fès, Marrakech, Agadir et Tanger — la première Coupe du Monde disputée sur le sol africain depuis l'Afrique du Sud 2010.
                </p>
            </div>
        </div>

        <a href="/coupe-du-monde-2030-les-stades.php" class="inline-flex items-center gap-1 text-green-400 hover:text-green-300 text-xs font-semibold mt-4">
            Voir le détail de chaque stade →
        </a>
    </section>

    <section class="mb-10">
        <h2 class="text-2xl font-bold text-white mb-4">Le centenaire en Amérique du Sud</h2>
        <p class="text-gray-300 leading-relaxed mb-5">
            La première Coupe du Monde de l'histoire s'est jouée en 1930 en Uruguay. Pour marquer les 100 ans de la compétition, la FIFA a choisi d'ouvrir le tournoi 2030 par trois matchs symboliques, une semaine avant le début du tournoi principal :
        </p>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
            <div class="bg-gray-800 border border-green-600 rounded-lg p-4">
                <span class="text-green-400 text-[10px] font-bold uppercase tracking-wider">🏆 Cérémonie du centenaire</span>
                <div class="text-white font-semibold mt-1">🇺🇾 Montevideo</div>
                <div class="text-gray-500 text-xs mt-1">8 juin 2030 — Estadio Centenario</div>
            </div>
            <div class="bg-gray-800 border border-gray-700 rounded-lg p-4">
                <div class="text-white font-semibold">🇦🇷 Buenos Aires</div>
                <div class="text-gray-500 text-xs mt-1">8 juin 2030 — Estadio Más Monumental</div>
            </div>
            <div class="bg-gray-800 border border-gray-700 rounded-lg p-4">
                <div class="text-white font-semibold">🇵🇾 Asunción</div>
                <div class="text-gray-500 text-xs mt-1">9 juin 2030 — Estadio CONMEBOL</div>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section class="mb-10">
        <h2 class="text-2xl font-bold text-white mb-5">Foire aux questions : les villes hôtes de la Coupe du Monde 2030</h2>
        <div class="space-y-3">

            <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
                <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">
                    Où aura lieu la Coupe du Monde 2030 ?
                    <span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span>
                </summary>
                <p class="text-gray-400 text-sm leading-relaxed mt-3">
                    La Coupe du Monde 2030 se déroulera principalement en Espagne, au Portugal et au Maroc. Pour célébrer le centenaire de la compétition, trois matchs d'ouverture se joueront aussi en Uruguay, en Argentine et au Paraguay — une première dans l'histoire du tournoi, disputé sur trois continents.
                </p>
            </details>

            <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
                <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">
                    Pourquoi des matchs en Amérique du Sud ?
                    <span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span>
                </summary>
                <p class="text-gray-400 text-sm leading-relaxed mt-3">
                    La Coupe du Monde 2030 fête les 100 ans de la compétition, dont la toute première édition s'est déroulée en Uruguay en 1930. La FIFA a choisi d'organiser trois matchs symboliques du centenaire à Montevideo, Buenos Aires et Asunción avant le début du tournoi principal.
                </p>
            </details>

        </div>
    </section>

    <!-- Liens internes -->
    <section class="flex flex-wrap gap-4 justify-center pt-4 pb-4">
        <a href="/coupe-du-monde-2030-les-stades.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">🏟️ Les stades</a>
        <a href="/coupe-du-monde-2030.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">🏆 Retour à la Coupe du Monde 2030</a>
    </section>

</div>

<?php include __DIR__ . '/templates/footer.php'; ?>
