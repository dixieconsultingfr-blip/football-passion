<?php
header('Content-Type: application/xml; charset=utf-8');
require_once __DIR__ . '/blog/helpers.php';

$articles = load_articles_index(__DIR__);

$staticPages = [
    ['loc' => '/',                              'changefreq' => 'daily',   'priority' => '1.0'],
    ['loc' => '/blog',                          'changefreq' => 'daily',   'priority' => '0.9'],
    ['loc' => '/calendrier.php',                'changefreq' => 'hourly',  'priority' => '0.9'],
    ['loc' => '/equipe-france.php',             'changefreq' => 'weekly',  'priority' => '0.8'],
    ['loc' => '/euro.php',                      'changefreq' => 'weekly',  'priority' => '0.7'],
    ['loc' => '/a-propos.php',                  'changefreq' => 'monthly', 'priority' => '0.3'],
    ['loc' => '/contact.php',                   'changefreq' => 'monthly', 'priority' => '0.3'],
    ['loc' => '/mentions-legales.php',          'changefreq' => 'yearly',  'priority' => '0.1'],
    ['loc' => '/politique-confidentialite.php', 'changefreq' => 'yearly',  'priority' => '0.1'],
];

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?php foreach ($staticPages as $p): ?>
  <url>
    <loc>https://football-passion.fr<?= htmlspecialchars($p['loc']) ?></loc>
    <changefreq><?= $p['changefreq'] ?></changefreq>
    <priority><?= $p['priority'] ?></priority>
  </url>
<?php endforeach; ?>
<?php foreach ($articles as $a): ?>
  <url>
    <loc>https://football-passion.fr/blog?slug=<?= urlencode($a['slug']) ?></loc>
    <lastmod><?= htmlspecialchars($a['date']) ?></lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.6</priority>
  </url>
<?php endforeach; ?>
</urlset>
