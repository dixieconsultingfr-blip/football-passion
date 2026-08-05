<?php
// Hub evergreen football - Accueil
// Charger les données
require_once __DIR__ . '/blog/helpers.php';
$articles = load_articles_index(__DIR__);
$categories = json_decode(file_get_contents(__DIR__ . '/data/categories.json'), true) ?? [];

$page_title = 'Football Passion — L1, L2, Champions League, Europa, Euro, CDM';
$meta_desc = 'Hub evergreen football. Calendriers, matchs, analyses, actualités de la Ligue 1, Champions League, Europa League, Euro, Coupe du Monde, CAN et Équipe de France.';

include __DIR__ . '/templates/header.php';
?>

<section class="py-16 bg-gradient-to-r from-green-900 to-gray-900 rounded-lg mb-12">
    <div class="text-center">
        <h1 class="text-5xl font-bold mb-4">⚽ Football Passion</h1>
        <p class="text-xl text-gray-300">Calendriers • Matchs • Analyses • Actualités</p>
        <p class="text-sm text-gray-400 mt-2">L1 • L2 • Champions League • Europa • Euro • Coupe du Monde • CAN • France</p>
    </div>
</section>

<!-- Catégories -->
<section class="mb-12">
    <h2 class="text-3xl font-bold mb-6">Catégories</h2>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <?php foreach ($categories as $cat): ?>
        <?php
        $hubs = ['france' => '/equipe-france.php', 'euro' => '/euro.php'];
        $catHref = $hubs[$cat['slug']] ?? '/blog?cat=' . urlencode($cat['name']);
        ?>
        <a href="<?php echo $catHref; ?>" class="bg-gray-800 p-4 rounded-lg hover:bg-green-900 transition">
            <h3 class="font-bold text-green-400"><?php echo htmlspecialchars($cat['name']); ?></h3>
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
