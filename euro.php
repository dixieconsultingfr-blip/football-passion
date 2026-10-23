<?php
// Page hub "Euro" — pointe vers les pages dediees par edition (ex. euro-2028.php).
// Ajouter une entree dans $editions quand une nouvelle edition est connue (ex. Euro 2032).
$editions = [
    [
        'annee'  => '2028',
        'url'    => '/euro-2028.php',
        'dates'  => '9 juin — 9 juillet 2028',
        'pays'   => 'Royaume-Uni & République d\'Irlande',
        'statut' => 'Prochaine édition',
    ],
];

$page_title = 'Euro — Championnat d\'Europe de football | Football Passion';
$meta_desc  = "Toutes les éditions du Championnat d'Europe de football (Euro). Retrouvez l'Euro 2028 au Royaume-Uni et en Irlande : dates, stades, qualifications.";
include __DIR__ . '/templates/header.php';
?>

<!-- Breadcrumb -->
<nav class="text-xs text-gray-400 mb-8 flex items-center gap-2">
    <a href="/" class="hover:text-green-400 transition-colors">Accueil</a>
    <span>›</span>
    <span class="text-gray-400">Euro</span>
</nav>

<header class="mb-10">
    <p class="text-green-400 text-xs font-semibold uppercase tracking-widest mb-1">Compétition internationale</p>
    <h1 class="text-4xl font-bold text-white mb-4">Euro — Championnat d'Europe de football</h1>
    <p class="text-gray-300 leading-relaxed max-w-2xl">
        Organisé tous les quatre ans par l'UEFA, le Championnat d'Europe de football (Euro), parfois
        aussi appelé Coupe d'Europe, réunit les meilleures sélections du continent. Retrouvez ci-dessous
        la page dédiée à chaque édition.
    </p>
</header>

<section class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-5">Éditions</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <?php foreach ($editions as $e): ?>
        <a href="<?= htmlspecialchars($e['url']) ?>" class="bg-gray-800 border border-gray-700 hover:border-green-600 rounded-xl p-6 transition-colors block">
            <p class="text-green-400 text-xs font-semibold uppercase tracking-wider mb-2"><?= htmlspecialchars($e['statut']) ?></p>
            <h3 class="text-white font-bold text-2xl mb-2">Euro <?= htmlspecialchars($e['annee']) ?></h3>
            <p class="text-gray-400 text-sm mb-1"><?= htmlspecialchars($e['dates']) ?></p>
            <p class="text-gray-500 text-xs mb-4"><?= htmlspecialchars($e['pays']) ?></p>
            <span class="text-green-400 text-xs font-semibold">Voir la page complète →</span>
        </a>
        <?php endforeach; ?>
    </div>
</section>

<section class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-5">En attendant l'Euro 2028</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <a href="/ligue-des-nations-groupe-a1.php" class="bg-gray-800 border border-gray-700 hover:border-green-600 rounded-xl p-6 transition-colors block">
            <p class="text-green-400 text-xs font-semibold uppercase tracking-wider mb-2">Équipe de France · Bleus de Zidane</p>
            <h3 class="text-white font-bold text-xl mb-2">Ligue des Nations — Groupe A1</h3>
            <p class="text-gray-400 text-sm mb-1">France, Italie, Belgique, Turquie</p>
            <p class="text-gray-500 text-xs mb-4">6 matchs du 25 septembre au 15 novembre 2026, diffusés sur TF1</p>
            <span class="text-green-400 text-xs font-semibold">Calendrier, classement et diffusion →</span>
        </a>
        <a href="/blog/premiere-liste-zidane-23-bleus-ce-quil-faut-retenir" class="bg-gray-800 border border-gray-700 hover:border-green-600 rounded-xl p-6 transition-colors block">
            <p class="text-green-400 text-xs font-semibold uppercase tracking-wider mb-2">À lire</p>
            <h3 class="text-white font-bold text-xl mb-2">La première liste de Zidane</h3>
            <p class="text-gray-400 text-sm mb-1">23 Bleus, cinq nouveaux visages, sans Tchouaméni</p>
            <p class="text-gray-500 text-xs mb-4">Le premier groupe de la route vers l'Euro 2028</p>
            <span class="text-green-400 text-xs font-semibold">Lire l'article →</span>
        </a>
    </div>
</section>

<!-- Liens internes -->
<section class="flex flex-wrap gap-4 justify-center pb-4">
    <a href="/equipe-france.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">🇫🇷 Équipe de France</a>
    <a href="/coupe-du-monde.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">🏆 Coupe du Monde</a>
    <a href="/calendrier.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">📅 Calendrier</a>
</section>

<?php include __DIR__ . '/templates/footer.php'; ?>
