<?php
// Page hub "Coupe du Monde" — pointe vers les pages dediees par edition (ex. coupe-du-monde-2030.php).
// Ajouter une entree dans $editions quand une nouvelle edition est connue (ex. CDM 2034).
$editions = [
    [
        'annee'  => '2030',
        'url'    => '/coupe-du-monde-2030.php',
        'dates'  => '8 juin — 21 juillet 2030',
        'pays'   => 'Espagne, Portugal, Maroc + matchs du centenaire en Amérique du Sud',
        'statut' => 'Prochaine édition',
    ],
];

$page_title = 'Coupe du Monde — Championnat du monde de football | Football Passion';
$meta_desc  = "Toutes les éditions de la Coupe du Monde de la FIFA. Retrouvez la Coupe du Monde 2030 en Espagne, au Portugal, au Maroc et en Amérique du Sud : dates, stades, format.";
include __DIR__ . '/templates/header.php';
?>

<!-- Breadcrumb -->
<nav class="text-xs text-gray-500 mb-8 flex items-center gap-2">
    <a href="/" class="hover:text-green-400 transition-colors">Accueil</a>
    <span>›</span>
    <span class="text-gray-400">Coupe du Monde</span>
</nav>

<header class="mb-10">
    <p class="text-green-400 text-xs font-semibold uppercase tracking-widest mb-1">Compétition internationale</p>
    <h1 class="text-4xl font-bold text-white mb-4">Coupe du Monde — Championnat du monde de football</h1>
    <p class="text-gray-300 leading-relaxed max-w-2xl">
        Organisée tous les quatre ans par la FIFA, la Coupe du Monde réunit les meilleures sélections de la planète pour désigner le champion du monde. Retrouvez ci-dessous la page dédiée à chaque édition.
    </p>
</header>

<section class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-5">Éditions</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <?php foreach ($editions as $e): ?>
        <a href="<?= htmlspecialchars($e['url']) ?>" class="bg-gray-800 border border-gray-700 hover:border-green-600 rounded-xl p-6 transition-colors block">
            <p class="text-green-400 text-xs font-semibold uppercase tracking-wider mb-2"><?= htmlspecialchars($e['statut']) ?></p>
            <h3 class="text-white font-bold text-2xl mb-2">Coupe du Monde <?= htmlspecialchars($e['annee']) ?></h3>
            <p class="text-gray-400 text-sm mb-1"><?= htmlspecialchars($e['dates']) ?></p>
            <p class="text-gray-500 text-xs mb-4"><?= htmlspecialchars($e['pays']) ?></p>
            <span class="text-green-400 text-xs font-semibold">Voir la page complète →</span>
        </a>
        <?php endforeach; ?>
    </div>
</section>

<!-- Liens internes -->
<section class="flex flex-wrap gap-4 justify-center pb-4">
    <a href="/equipe-france.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">🇫🇷 Équipe de France</a>
    <a href="/euro.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">🏆 Euro</a>
    <a href="/calendrier.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">📅 Calendrier</a>
</section>

<?php include __DIR__ . '/templates/footer.php'; ?>
