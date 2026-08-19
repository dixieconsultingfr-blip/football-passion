<?php
// Hub evergreen football - Accueil
// Charger les données
require_once __DIR__ . '/blog/helpers.php';
$articles = load_articles_index(__DIR__);
$categories = json_decode(file_get_contents(__DIR__ . '/data/categories.json'), true) ?? [];

$logosCompetitions = [
    'L1'     => '/images/logo/logo-ligue-1.webp',
    'L2'     => '/images/logo/logo-ligue-2.png',
    'CL'     => '/images/logo/logo-champions-league.webp',
    'Europa' => '/images/logo/logo-europa-league.webp',
];

$hubs = [
    'france'           => '/equipe-france.php',
    'euro'             => '/euro.php',
    'ligue-1'          => '/ligue-1.php',
    'ligue-2'          => '/ligue-2.php',
    'champions-league' => '/champions-league.php',
    'europa-league'    => '/europa-league.php',
];

$page_title = 'Football Passion — L1, L2, Champions League, Europa, Euro, CDM';
$meta_desc = 'Hub evergreen football. Calendriers, matchs, analyses, actualités de la Ligue 1, Champions League, Europa League, Euro, Coupe du Monde, CAN et Équipe de France.';

include __DIR__ . '/templates/header.php';
?>

<section class="relative overflow-hidden rounded-2xl mb-12 border border-gray-800">
    <!-- Fond -->
    <div class="absolute inset-0 bg-gradient-to-br from-gray-900 via-gray-950 to-gray-900"></div>

    <!-- Texture terrain (cercle central + ligne médiane, tres discret) -->
    <svg class="absolute inset-0 w-full h-full" viewBox="0 0 800 320" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg">
        <line x1="400" y1="0" x2="400" y2="320" stroke="#4ade80" stroke-width="1" opacity="0.08"/>
        <circle cx="400" cy="160" r="70" fill="none" stroke="#4ade80" stroke-width="1" opacity="0.08"/>
        <circle cx="400" cy="160" r="3" fill="#4ade80" opacity="0.15"/>
        <path d="M0,0 L0,90 A90,90 0 0,0 90,0 Z" fill="none" stroke="#4ade80" stroke-width="1" opacity="0.06"/>
        <path d="M800,320 L800,230 A90,90 0 0,0 710,320 Z" fill="none" stroke="#4ade80" stroke-width="1" opacity="0.06"/>
    </svg>

    <!-- Halo -->
    <div class="absolute -top-24 -right-16 w-72 h-72 bg-green-500/10 blur-3xl rounded-full pointer-events-none"></div>
    <div class="absolute -bottom-24 -left-16 w-72 h-72 bg-green-500/10 blur-3xl rounded-full pointer-events-none"></div>

    <div class="relative py-16 px-6 text-center">
        <div class="inline-flex items-center gap-4 mb-6">
            <img src="/images/logo-fp-icon-512.png" alt="" class="w-16 h-16 rounded-2xl shadow-lg shadow-green-950/50" />
            <h1 class="text-4xl sm:text-5xl font-bold text-white">Football <span class="text-green-400">Passion</span></h1>
        </div>
        <p class="text-xl text-gray-300 mb-6">Calendriers • Matchs • Analyses • Actualités</p>
        <div class="flex flex-wrap justify-center gap-2">
            <?php foreach ($categories as $cat): ?>
            <?php $catHref = $hubs[$cat['slug']] ?? '/blog?cat=' . urlencode($cat['code']); ?>
            <a href="<?= htmlspecialchars($catHref) ?>" class="px-3 py-1 text-xs font-semibold text-gray-400 border border-gray-700 rounded-full hover:border-green-600 hover:text-green-400 transition-colors"><?= htmlspecialchars($cat['name']) ?></a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Catégories -->
<section class="mb-12">
    <h2 class="text-3xl font-bold mb-6">Catégories</h2>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <?php foreach ($categories as $cat): ?>
        <?php $catHref = $hubs[$cat['slug']] ?? '/blog?cat=' . urlencode($cat['code']); ?>
        <a href="<?php echo $catHref; ?>" class="bg-gray-800 p-4 rounded-lg hover:bg-green-900 transition">
            <div class="flex items-center gap-2 mb-1">
                <?php if (!empty($logosCompetitions[$cat['code']])): ?>
                <span class="inline-flex items-center justify-center w-6 h-6 bg-white rounded-full p-1 shrink-0">
                    <img src="<?php echo htmlspecialchars($logosCompetitions[$cat['code']]); ?>" alt="" class="w-full h-full object-contain" loading="lazy" />
                </span>
                <?php endif; ?>
                <h3 class="font-bold text-green-400"><?php echo htmlspecialchars($cat['name']); ?></h3>
            </div>
            <p class="text-xs text-gray-400 mt-1"><?php echo htmlspecialchars($cat['description']); ?></p>
        </a>
        <?php endforeach; ?>
    </div>
</section>

<!-- Derniers articles -->
<section class="mb-12">
    <h2 class="text-3xl font-bold mb-6">Derniers articles</h2>
    <?php if (empty($articles)): ?>
        <p class="text-gray-400">Aucun article pour le moment.</p>
    <?php else: ?>
        <div class="grid gap-6">
            <?php foreach (array_slice($articles, 0, 5) as $article): ?>
            <article class="bg-gray-800 p-6 rounded-lg hover:bg-gray-700 transition">
                <h3 class="text-xl font-bold text-green-400 mb-2"><?php echo htmlspecialchars($article['titre']); ?></h3>
                <p class="text-sm text-gray-400 mb-3">
                    <span class="bg-gray-700 px-2 py-1 rounded text-xs"><?php echo htmlspecialchars($article['categorie']); ?></span>
                    • <?php echo htmlspecialchars($article['date']); ?>
                </p>
                <p class="text-gray-300 mb-4"><?php echo htmlspecialchars($article['extrait']); ?></p>
                <a href="/blog?slug=<?php echo urlencode($article['slug']); ?>" class="text-green-400 hover:text-green-300">Lire la suite →</a>
            </article>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>

<?php include __DIR__ . '/templates/footer.php'; ?>
