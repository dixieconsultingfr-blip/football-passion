<?php
require_once __DIR__ . '/blog/helpers.php';
$date_maj_page = '2026-11-24'; // à mettre à jour dès que la FIFA publie la répartition des places, le format définitif (48 ou 64 équipes) ou le calendrier — signal E-E-A-T
$articlesAll = load_articles_index(__DIR__);
$articlesFrance = array_values(array_filter($articlesAll, fn($a) => ($a['categorie'] ?? '') === 'France'));
usort($articlesFrance, fn($a, $b) => strtotime($b['date']) <=> strtotime($a['date']));

$page_title = 'Qualifications Coupe du Monde 2030 : places, format et calendrier';
$meta_desc  = "Qualifications Coupe du Monde 2030 : 6 pays hôtes déjà qualifiés, 42 places à jouer sur la base de 48 équipes, format et calendrier encore à confirmer par la FIFA.";
include __DIR__ . '/templates/header.php';
?>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "Quelles équipes sont qualifiées pour la Coupe du Monde 2030 ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Six pays sont qualifiés d'office en tant qu'hôtes : l'Espagne, le Portugal et le Maroc pour le tournoi principal, ainsi que l'Argentine, l'Uruguay et le Paraguay pour les matchs du centenaire. Aucune autre équipe n'est qualifiée au 24 novembre 2026 : les éliminatoires n'ont pas commencé."
      }
    },
    {
      "@type": "Question",
      "name": "Combien d'équipes participeront à la Coupe du Monde 2030 ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Le format retenu à ce jour est celui de 2026, avec 48 équipes. Une extension à 64 équipes a été proposée, mais elle est contestée, notamment par l'UEFA, l'AFC et les pays hôtes du tournoi principal. Avec 48 équipes et 6 hôtes qualifiés, il resterait 42 places à attribuer."
      }
    },
    {
      "@type": "Question",
      "name": "Quand commencent les qualifications de la Coupe du Monde 2030 ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "La FIFA n'a pas encore publié le calendrier officiel. Les éliminatoires se disputeraient environ de 2027 à 2029, selon les sources, et ces dates restent provisoires."
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
    <span class="text-gray-400">Qualifications</span>
</nav>

<!-- Hero -->
<header class="mb-10">
    <p class="text-green-400 text-xs font-semibold uppercase tracking-widest mb-1">Route vers la Coupe du Monde 2030</p>
    <h1 class="text-4xl font-bold text-white mb-2">Qualifications Coupe du Monde 2030 : places, format et calendrier</h1>
    <p class="text-gray-400 text-sm mb-1">6 hôtes déjà qualifiés · Format à 48 équipes à ce jour · Calendrier à confirmer</p>
    <p class="text-gray-500 text-xs mb-4">Mis à jour le <time datetime="<?= $date_maj_page ?>"><?= date_fr_long($date_maj_page) ?></time></p>
    <p class="text-gray-300 leading-relaxed max-w-2xl">
        La Coupe du Monde 2030 se jouera en Espagne, au Portugal et au Maroc, avec trois matchs d'ouverture du centenaire en Amérique du Sud.
        Les éliminatoires n'ont pas commencé et la FIFA n'a pas encore tout tranché : cette page distingue ce qui est acquis de ce qui reste à confirmer,
        et sera complétée au fil des annonces officielles.
    </p>
</header>

<!-- Ce qui est acquis -->
<section class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-4">Les six nations déjà qualifiées</h2>
    <div class="bg-gray-800 border border-gray-700 rounded-xl overflow-x-auto">
        <table class="w-full text-sm">
            <caption class="text-left text-gray-400 text-xs px-4 pt-3 pb-1">Les six nations hôtes qualifiées d'office pour la Coupe du Monde 2030, avec leur rôle dans le tournoi</caption>
            <thead>
                <tr class="text-gray-500 uppercase text-xs border-b border-gray-700">
                    <th class="text-left px-4 py-2 font-semibold">Pays</th>
                    <th class="text-left px-4 py-2 font-semibold">Confédération</th>
                    <th class="text-left px-4 py-2 font-semibold">Rôle</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-700/60 text-gray-300">
                <tr><td class="px-4 py-2 text-white font-medium">Espagne</td><td class="px-4 py-2">UEFA</td><td class="px-4 py-2">Tournoi principal, du 13 juin au 21 juillet 2030</td></tr>
                <tr><td class="px-4 py-2 text-white font-medium">Portugal</td><td class="px-4 py-2">UEFA</td><td class="px-4 py-2">Tournoi principal</td></tr>
                <tr><td class="px-4 py-2 text-white font-medium">Maroc</td><td class="px-4 py-2">CAF</td><td class="px-4 py-2">Tournoi principal</td></tr>
                <tr><td class="px-4 py-2 text-white font-medium">Uruguay</td><td class="px-4 py-2">CONMEBOL</td><td class="px-4 py-2">Match du centenaire à Montevideo, le 8 juin 2030</td></tr>
                <tr><td class="px-4 py-2 text-white font-medium">Argentine</td><td class="px-4 py-2">CONMEBOL</td><td class="px-4 py-2">Match du centenaire à Buenos Aires, le 8 juin 2030</td></tr>
                <tr><td class="px-4 py-2 text-white font-medium">Paraguay</td><td class="px-4 py-2">CONMEBOL</td><td class="px-4 py-2">Match du centenaire à Asunción, le 9 juin 2030</td></tr>
            </tbody>
        </table>
    </div>
    <p class="text-gray-400 text-sm leading-relaxed mt-4">
        Aucune autre équipe n'est qualifiée au 24 novembre 2026 : les éliminatoires n'ont pas commencé. Retrouvez le détail des pays et des villes sur notre page
        <a href="/coupe-du-monde-2030-les-villes-hotes.php" class="text-green-400 hover:text-green-300 underline">villes hôtes de la Coupe du Monde 2030</a>.
    </p>
</section>

<!-- Format -->
<section class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-4">Format : 48 équipes, mais un débat reste ouvert</h2>
    <div class="bg-gray-800 rounded-xl border border-gray-700 p-6 text-sm text-gray-300 leading-relaxed space-y-3">
        <p>
            Le format retenu à ce jour est celui de la Coupe du Monde 2026 : <strong class="text-white">48 équipes</strong>, 12 groupes de 4 et 104 matchs.
            Une extension à <strong class="text-white">64 équipes</strong> a été proposée, mais elle est contestée, notamment par le président de l'UEFA, celui de l'AFC
            et les trois pays hôtes du tournoi principal, qui avaient candidaté pour un Mondial à 48.
        </p>
        <p>
            Sur la base de 48 équipes, avec 6 hôtes qualifiés d'office, il resterait <strong class="text-white">42 places</strong> à attribuer par les éliminatoires.
            Si la répartition de 2026 était reprise, l'Europe disposerait de 16 places, dont deux pour l'Espagne et le Portugal. Ces chiffres sont une base de travail,
            non une décision de la FIFA, qui n'a pas publié de répartition propre à 2030.
        </p>
    </div>
</section>

<!-- Calendrier -->
<section class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-4">Calendrier : ce que l'on sait, et ce qui reste à confirmer</h2>
    <div class="bg-gray-800 border border-gray-700 rounded-xl overflow-x-auto">
        <table class="w-full text-sm">
            <caption class="text-left text-gray-400 text-xs px-4 pt-3 pb-1">Calendrier de la Coupe du Monde 2030 : dates du tournoi confirmées et éliminatoires provisoires</caption>
            <thead>
                <tr class="text-gray-500 uppercase text-xs border-b border-gray-700">
                    <th class="text-left px-4 py-2 font-semibold">Date</th>
                    <th class="text-left px-4 py-2 font-semibold">Étape</th>
                    <th class="text-left px-4 py-2 font-semibold">Statut</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-700/60 text-gray-300">
                <tr><td class="px-4 py-2 whitespace-nowrap text-white font-medium">Vers 2027 à 2029</td><td class="px-4 py-2">Éliminatoires des confédérations</td><td class="px-4 py-2 text-yellow-400">Provisoire, non publié par la FIFA</td></tr>
                <tr><td class="px-4 py-2 whitespace-nowrap text-white font-medium">8 et 9 juin 2030</td><td class="px-4 py-2">Matchs du centenaire en Uruguay, en Argentine et au Paraguay</td><td class="px-4 py-2 text-green-400">Annoncé par la FIFA</td></tr>
                <tr><td class="px-4 py-2 whitespace-nowrap text-white font-medium">13 juin au 21 juillet 2030</td><td class="px-4 py-2">Tournoi principal en Espagne, au Portugal et au Maroc</td><td class="px-4 py-2 text-green-400">Annoncé par la FIFA</td></tr>
            </tbody>
        </table>
    </div>
    <p class="text-gray-400 text-sm leading-relaxed mt-4">
        Le tirage au sort des éliminatoires et les dates exactes ne sont pas encore connus. Pour comparer avec une compétition dont le calendrier est déjà fixé, voyez notre page
        <a href="/euro-2028-qualifications.php" class="text-green-400 hover:text-green-300 underline">qualifications de l'Euro 2028</a>.
    </p>
</section>

<!-- Équipe de France -->
<section class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-4">Et l'équipe de France ?</h2>
    <div class="bg-gray-800 rounded-xl border border-gray-700 p-6 text-sm text-gray-300 leading-relaxed">
        <p>
            Les Bleus devront passer par les éliminatoires européennes, comme toutes les nations de l'UEFA hors Espagne et Portugal.
            Nommé sélectionneur le 28 juillet 2026 avec un contrat jusqu'en 2030, Zinédine Zidane fait de ce Mondial son grand objectif, après l'Euro 2028.
            Retrouvez la <a href="/equipe-france.php" class="text-green-400 hover:text-green-300 underline">fiche de l'équipe de France</a> et notre
            <a href="/coupe-du-monde-2030.php" class="text-green-400 hover:text-green-300 underline">dossier Coupe du Monde 2030</a>.
        </p>
    </div>
</section>

<!-- FAQ -->
<section class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-4">Questions fréquentes</h2>
    <div class="space-y-3">
        <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5">
            <summary class="flex items-center justify-between cursor-pointer text-white font-semibold text-sm list-none">
                Quelles équipes sont qualifiées pour la Coupe du Monde 2030 ?
                <span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span>
            </summary>
            <p class="text-gray-400 text-sm leading-relaxed mt-3">
                Six pays sont qualifiés d'office en tant qu'hôtes : l'Espagne, le Portugal et le Maroc pour le tournoi principal, ainsi que l'Argentine, l'Uruguay et le Paraguay pour les matchs du centenaire. Aucune autre équipe n'est qualifiée au 24 novembre 2026.
            </p>
        </details>
        <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5">
            <summary class="flex items-center justify-between cursor-pointer text-white font-semibold text-sm list-none">
                Combien d'équipes participeront à la Coupe du Monde 2030 ?
                <span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span>
            </summary>
            <p class="text-gray-400 text-sm leading-relaxed mt-3">
                Le format retenu à ce jour est celui de 2026, avec 48 équipes. Une extension à 64 équipes a été proposée, mais elle est contestée. Avec 48 équipes et 6 hôtes qualifiés, il resterait 42 places à attribuer.
            </p>
        </details>
        <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5">
            <summary class="flex items-center justify-between cursor-pointer text-white font-semibold text-sm list-none">
                Quand commencent les qualifications de la Coupe du Monde 2030 ?
                <span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span>
            </summary>
            <p class="text-gray-400 text-sm leading-relaxed mt-3">
                La FIFA n'a pas encore publié le calendrier officiel. Les éliminatoires se disputeraient environ de 2027 à 2029, selon les sources, et ces dates restent provisoires.
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
    <a href="/coupe-du-monde-2030.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">🏆 Coupe du Monde 2030</a>
    <a href="/coupe-du-monde-2030-les-stades.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">🏟️ Les stades</a>
    <a href="/equipe-france.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">🇫🇷 Équipe de France</a>
</section>

<?php include __DIR__ . '/templates/footer.php'; ?>
