<?php
$page_title = 'À propos — Football Passion';
$meta_desc  = 'Football Passion est un média football evergreen fondé par Jérôme Henry, consultant et formateur en IA. L1, L2, Champions League, Équipe de France, Euro, CDM, CAN.';
include __DIR__ . '/templates/header.php';
?>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Person",
  "name": "Jérôme Henry",
  "jobTitle": "Consultant et formateur en IA",
  "worksFor": {
    "@type": "Organization",
    "name": "Dixie Consulting",
    "url": "https://www.dixie.consulting"
  },
  "url": "https://football-passion.fr/a-propos.php",
  "sameAs": [
    "https://www.linkedin.com/in/jerome13henry/",
    "https://www.dixie.consulting"
  ],
  "address": {
    "@type": "PostalAddress",
    "addressLocality": "Aubagne",
    "addressCountry": "FR"
  },
  "description": "Passionné de football et expert en IA et automatisation. Fondateur de Football Passion, hub evergreen dédié au football français et européen."
}
</script>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebSite",
  "name": "Football Passion",
  "url": "https://football-passion.fr",
  "description": "Hub evergreen football : L1, L2, Champions League, Europa League, Équipe de France, Euro, Coupe du Monde, CAN.",
  "author": {
    "@type": "Person",
    "name": "Jérôme Henry"
  }
}
</script>

<!-- Breadcrumb -->
<nav class="text-xs text-gray-400 mb-8 flex items-center gap-2">
    <a href="/" class="hover:text-green-400 transition-colors">Accueil</a>
    <span>›</span>
    <span class="text-gray-400">À propos</span>
</nav>

<div class="max-w-3xl mx-auto">

    <header class="mb-10">
        <h1 class="text-4xl font-bold text-white mb-4">À propos de Football Passion</h1>
        <p class="text-gray-300 text-lg leading-relaxed border-l-4 border-green-500 pl-4">
            Un média football indépendant, passionné, sans publicité intrusive — construit pour durer.
        </p>
    </header>

    <section class="bg-gray-800 rounded-xl border border-gray-700 p-8 mb-8">
        <div class="flex items-start gap-6">
            <div class="flex-shrink-0 w-16 h-16 bg-green-900 rounded-full flex items-center justify-center text-3xl">⚽</div>
            <div>
                <h2 class="text-xl font-bold text-white mb-1">Jérôme Henry</h2>
                <p class="text-green-400 text-sm font-semibold mb-3">Consultant et formateur en IA · Dixie Consulting · Aubagne</p>
                <p class="text-gray-300 leading-relaxed mb-4">
                    Passionné de football depuis l'enfance, j'ai grandi avec les Bleus de 98 et je suis le championnat de France depuis des décennies.
                    En parallèle de mon activité de consultant et formateur en intelligence artificielle chez
                    <a href="https://www.dixie.consulting" target="_blank" rel="noopener noreferrer" class="text-green-400 hover:text-green-300 underline">Dixie Consulting</a>,
                    j'ai fondé Football Passion pour partager cette passion avec rigueur et enthousiasme.
                </p>
                <p class="text-gray-300 leading-relaxed">
                    Mon double profil — fan de longue date et expert en automatisation IA — me permet de combiner une vraie culture football
                    avec des outils modernes pour couvrir L1, L2, Champions League, Europa League, l'Équipe de France, la CAN, l'Euro et la Coupe du Monde.
                </p>
                <div class="flex gap-4 mt-5">
                    <a href="https://www.linkedin.com/in/jerome13henry/" target="_blank" rel="noopener noreferrer"
                       class="text-xs font-semibold border border-gray-600 text-gray-300 hover:border-green-500 hover:text-green-400 px-4 py-2 rounded transition-colors">
                        LinkedIn →
                    </a>
                    <a href="https://www.dixie.consulting" target="_blank" rel="noopener noreferrer"
                       class="text-xs font-semibold border border-gray-600 text-gray-300 hover:border-green-500 hover:text-green-400 px-4 py-2 rounded transition-colors">
                        Dixie Consulting →
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="mb-8">
        <h2 class="text-2xl font-bold text-white mb-4">Le projet Football Passion</h2>
        <div class="space-y-4 text-gray-300 leading-relaxed">
            <p>
                Football Passion est né d'un constat simple : il n'existait pas de hub football evergreen en français qui couvre
                à la fois les clubs (L1, L2, Coupes d'Europe) et les sélections (France, CAN, Euro, CDM) avec la même qualité éditoriale,
                sans être limité à une seule compétition ou une seule période.
            </p>
            <p>
                Le site couvre l'intégralité de la saison football — de août à mai avec la L1/L2 et les Coupes d'Europe,
                la CAN en janvier-février, les Qualifications France au printemps et en automne, et les grands tournois d'été (Euro, Coupe du Monde).
                Pas de trou dans l'année. Pas de hors-saison.
            </p>
        </div>
    </section>

    <section class="mb-8">
        <h2 class="text-2xl font-bold text-white mb-5">Ligne éditoriale</h2>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="bg-gray-800 rounded-xl border border-green-800 p-5 text-center">
                <div class="text-3xl mb-3">🔥</div>
                <h3 class="text-green-400 font-bold mb-2">Passion</h3>
                <p class="text-gray-400 text-sm">Le football est une émotion. On l'écrit avec les tripes, pas avec des communiqués de presse.</p>
            </div>
            <div class="bg-gray-800 rounded-xl border border-green-800 p-5 text-center">
                <div class="text-3xl mb-3">🤝</div>
                <h3 class="text-green-400 font-bold mb-2">Fair play</h3>
                <p class="text-gray-400 text-sm">Respect de l'adversaire après chaque résultat. Neutralité entre les clubs. Que le meilleur gagne.</p>
            </div>
            <div class="bg-gray-800 rounded-xl border border-green-800 p-5 text-center">
                <div class="text-3xl mb-3">✅</div>
                <h3 class="text-green-400 font-bold mb-2">Fiabilité</h3>
                <p class="text-gray-400 text-sm">Aucun fait inventé. Chaque information est sourcée. Si ce n'est pas certain, on le dit clairement.</p>
            </div>
        </div>
    </section>

    <section class="mb-8">
        <h2 class="text-2xl font-bold text-white mb-4">Compétitions couvertes</h2>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
            <?php
            $comps = [
                ['🇫🇷', 'Ligue 1'],
                ['🥈', 'Ligue 2'],
                ['⭐', 'Champions League'],
                ['🌍', 'Europa League'],
                ['🔵', 'Équipe de France'],
                ['🏆', 'Coupe du Monde'],
                ['🇪🇺', 'Euro'],
                ['🌍', 'CAN'],
            ];
            foreach ($comps as [$icon, $name]): ?>
            <div class="bg-gray-800 border border-gray-700 rounded-lg p-3 text-center">
                <div class="text-xl mb-1"><?= $icon ?></div>
                <div class="text-gray-300 text-xs font-semibold"><?= $name ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="bg-gray-800 rounded-xl border border-gray-700 p-6">
        <h2 class="text-lg font-bold text-white mb-3">Contact</h2>
        <p class="text-gray-400 text-sm leading-relaxed">
            Pour toute question ou suggestion éditoriale, utilisez le
            <a href="/contact.php" class="text-green-400 hover:text-green-300 underline">formulaire de contact →</a>
        </p>
    </section>

</div>

<?php include __DIR__ . '/templates/footer.php'; ?>
