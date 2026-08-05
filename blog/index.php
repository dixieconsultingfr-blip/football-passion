<?php
header('Content-Type: text/html; charset=utf-8');
define('BASE_PATH', __DIR__ . '/..');
require_once __DIR__ . '/helpers.php';

$slug = trim($_GET['slug'] ?? '');

// ── Vue article individuel ───────────────────────────────────────────────────
if ($slug !== '') {
    $article = preg_match('/^[a-z0-9-]+$/', $slug) ? load_article(BASE_PATH, $slug) : null;

    if (!$article) {
        http_response_code(404);
        $page_title = 'Article introuvable – Football Passion';
        $meta_desc  = 'Cet article n\'existe pas.';
        include BASE_PATH . '/templates/header.php';
        echo '<div class="min-h-64 flex flex-col items-center justify-center py-24 text-center">
            <div class="text-6xl mb-6">⚽</div>
            <h1 class="text-3xl font-bold text-white mb-4">Article introuvable</h1>
            <a href="/blog" class="text-green-400 hover:text-green-300 border border-green-600 px-6 py-3 rounded transition-colors">← Retour au blog</a>
        </div>';
        include BASE_PATH . '/templates/footer.php';
        exit;
    }

    $page_title = htmlspecialchars($article['meta_title'] ?? $article['titre']) . ' — Football Passion';
    $meta_desc  = $article['meta_desc'] ?? $article['extrait'];
    include BASE_PATH . '/templates/header.php';
?>
<!-- Breadcrumb -->
<nav class="text-xs text-gray-500 mb-8 flex items-center gap-2">
    <a href="/" class="hover:text-green-400 transition-colors">Accueil</a>
    <span>›</span>
    <a href="/blog" class="hover:text-green-400 transition-colors">Blog</a>
    <span>›</span>
    <span class="text-gray-400 truncate max-w-xs"><?= htmlspecialchars($article['titre']) ?></span>
</nav>

<article class="max-w-3xl mx-auto">
    <header class="mb-8">
        <div class="flex items-center gap-3 mb-4">
            <span class="bg-green-900 border border-green-700 text-green-400 text-xs px-3 py-1 rounded font-semibold uppercase tracking-wider">
                <?= htmlspecialchars($article['categorie']) ?>
            </span>
            <time class="text-gray-500 text-sm"><?= date_fr_long($article['date']) ?></time>
            <span class="text-gray-600 text-sm">· <?= htmlspecialchars($article['auteur']) ?></span>
        </div>

        <h1 class="text-3xl sm:text-4xl font-bold text-white leading-tight mb-5">
            <?= htmlspecialchars($article['titre']) ?>
        </h1>

        <p class="text-gray-300 text-lg leading-relaxed border-l-4 border-green-500 pl-4">
            <?= htmlspecialchars($article['extrait']) ?>
        </p>
    </header>

    <?php if (!empty($article['image'])): ?>
    <figure class="mb-8 rounded-xl overflow-hidden border border-gray-700">
        <img src="<?= htmlspecialchars($article['image']) ?>"
             alt="<?= htmlspecialchars($article['image_alt'] ?? $article['titre']) ?>"
             class="w-full" loading="eager" />
    </figure>
    <?php endif; ?>

    <div class="prose-fp text-gray-200 leading-relaxed space-y-4">
        <?= $article['contenu'] ?>
    </div>

    <footer class="mt-12 pt-6 border-t border-gray-700">
        <?php if (!empty($article['etiquettes'])): ?>
        <div class="flex flex-wrap gap-2 mb-6">
            <?php foreach ($article['etiquettes'] as $tag): ?>
            <a href="/blog?cat=<?= urlencode($tag) ?>"
               class="text-gray-500 hover:text-green-400 text-xs border border-gray-700 hover:border-green-700 px-2 py-1 rounded transition-colors">
                #<?= htmlspecialchars($tag) ?>
            </a>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
        <a href="/blog" class="text-green-400 hover:text-green-300 text-sm font-semibold transition-colors">← Retour au blog</a>
    </footer>
</article>

<style>
.prose-fp h2 { color: #4ade80; font-size: 1.4rem; font-weight: 700; margin: 2rem 0 0.75rem; }
.prose-fp h3 { color: #86efac; font-size: 1.15rem; font-weight: 600; margin: 1.5rem 0 0.5rem; }
.prose-fp p  { margin-bottom: 1rem; }
.prose-fp a  { color: #4ade80; text-decoration: underline; }
.prose-fp a:hover { color: #86efac; }
.prose-fp ul, .prose-fp ol { padding-left: 1.5rem; margin-bottom: 1rem; }
.prose-fp li { margin-bottom: 0.25rem; }
.prose-fp blockquote { border-left: 4px solid #16a34a; padding-left: 1rem; color: #9ca3af; font-style: italic; margin: 1.5rem 0; }
</style>

<?php
    include BASE_PATH . '/templates/footer.php';
    exit;
}

// ── Vue liste ────────────────────────────────────────────────────────────────
$articles = load_articles_index(BASE_PATH);

$cat_filtre = trim($_GET['cat'] ?? '');
$articles_affiches = $cat_filtre
    ? array_values(array_filter($articles, fn($a) =>
        $a['categorie'] === $cat_filtre ||
        in_array($cat_filtre, $a['etiquettes'] ?? [])))
    : $articles;

$par_page      = 12;
$page          = max(1, (int)($_GET['page'] ?? 1));
$total         = count($articles_affiches);
$total_pages   = max(1, (int)ceil($total / $par_page));
$page          = min($page, $total_pages);
$articles_page = array_slice($articles_affiches, ($page - 1) * $par_page, $par_page);

$categories    = array_unique(array_column($articles, 'categorie'));
sort($categories);

$page_title = 'Blog – Football Passion | L1, L2, CL, Europa, CDM, Euro, CAN';
$meta_desc  = 'Analyses, actualités et décryptages football : Ligue 1, Champions League, Équipe de France, Coupe du Monde, Euro et CAN.';
include BASE_PATH . '/templates/header.php';
?>

<div class="mb-8">
    <h1 class="text-4xl font-bold text-white mb-2">Blog Football Passion</h1>
    <p class="text-gray-400">Analyses, actus et décryptages football.</p>
</div>

<!-- Filtres catégories -->
<div class="flex flex-wrap gap-2 mb-8">
    <a href="/blog"
       class="text-xs font-semibold px-3 py-1.5 rounded-full border transition-colors
              <?= $cat_filtre === '' ? 'bg-green-700 text-white border-green-700' : 'border-gray-600 text-gray-400 hover:border-green-600 hover:text-green-400' ?>">
        Tous
    </a>
    <?php foreach ($categories as $cat): ?>
    <a href="/blog?cat=<?= urlencode($cat) ?>"
       class="text-xs font-semibold px-3 py-1.5 rounded-full border transition-colors
              <?= $cat_filtre === $cat ? 'bg-green-700 text-white border-green-700' : 'border-gray-600 text-gray-400 hover:border-green-600 hover:text-green-400' ?>">
        <?= htmlspecialchars($cat) ?>
    </a>
    <?php endforeach; ?>
</div>

<!-- Grille articles -->
<?php if (empty($articles_page)): ?>
<p class="text-gray-400 py-12 text-center">Aucun article pour le moment.</p>
<?php else: ?>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
    <?php foreach ($articles_page as $a): ?>
    <article class="bg-gray-800 rounded-xl border border-gray-700 hover:border-green-600 transition-colors overflow-hidden flex flex-col">
        <?php if (!empty($a['vignette'])): ?>
        <a href="/blog?slug=<?= urlencode($a['slug']) ?>" class="block h-40 overflow-hidden">
            <img src="<?= htmlspecialchars($a['vignette']) ?>"
                 alt="<?= htmlspecialchars($a['titre']) ?>"
                 class="w-full h-full object-cover transition-transform duration-300 hover:scale-105" loading="lazy" />
        </a>
        <?php else: ?>
        <div class="h-20 bg-gradient-to-br from-green-900 to-gray-800 flex items-center justify-center">
            <span class="text-green-600 font-bold text-xs uppercase tracking-wider px-3"><?= htmlspecialchars($a['categorie']) ?></span>
        </div>
        <?php endif; ?>

        <div class="p-5 flex flex-col flex-1">
            <div class="flex items-center gap-2 mb-3">
                <span class="bg-green-900 text-green-400 text-xs px-2 py-0.5 rounded font-semibold">
                    <?= htmlspecialchars($a['categorie']) ?>
                </span>
                <time class="text-gray-500 text-xs"><?= date_fr_short($a['date']) ?></time>
            </div>

            <h2 class="text-base font-bold text-white leading-snug mb-3 flex-1">
                <a href="/blog?slug=<?= urlencode($a['slug']) ?>" class="hover:text-green-400 transition-colors">
                    <?= htmlspecialchars($a['titre']) ?>
                </a>
            </h2>

            <p class="text-gray-400 text-sm leading-relaxed mb-4 line-clamp-3">
                <?= htmlspecialchars(mb_substr($a['extrait'], 0, 130)) ?>…
            </p>

            <a href="/blog?slug=<?= urlencode($a['slug']) ?>"
               class="text-green-400 hover:text-green-300 text-sm font-semibold transition-colors self-start">
                Lire →
            </a>
        </div>
    </article>
    <?php endforeach; ?>
</div>

<!-- Pagination -->
<?php if ($total_pages > 1): ?>
<div class="flex justify-center items-center gap-2 mt-8">
    <?php if ($page > 1): ?>
    <a href="/blog?page=<?= $page - 1 ?><?= $cat_filtre ? '&cat=' . urlencode($cat_filtre) : '' ?>"
       class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-4 py-2 text-sm font-semibold rounded transition-colors">
        ← Précédent
    </a>
    <?php endif; ?>

    <span class="text-gray-500 text-sm">Page <?= $page ?> / <?= $total_pages ?></span>

    <?php if ($page < $total_pages): ?>
    <a href="/blog?page=<?= $page + 1 ?><?= $cat_filtre ? '&cat=' . urlencode($cat_filtre) : '' ?>"
       class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-4 py-2 text-sm font-semibold rounded transition-colors">
        Suivant →
    </a>
    <?php endif; ?>
</div>
<?php endif; ?>

<?php endif; ?>

<?php include BASE_PATH . '/templates/footer.php'; ?>
