<?php
header('Content-Type: application/xml; charset=utf-8');
require_once __DIR__ . '/blog/helpers.php';

$articles = load_articles_index(__DIR__);

$staticPages = [
    ['loc' => '/',                              'changefreq' => 'daily',   'priority' => '1.0'],
    ['loc' => '/blog',                          'changefreq' => 'daily',   'priority' => '0.9'],
    ['loc' => '/calendrier.php',                'changefreq' => 'hourly',  'priority' => '0.9'],
    ['loc' => '/archives.php',                  'changefreq' => 'monthly', 'priority' => '0.4'],
    ['loc' => '/equipe-france.php',             'changefreq' => 'weekly',  'priority' => '0.8'],
    ['loc' => '/euro.php',                      'changefreq' => 'weekly',  'priority' => '0.7'],
    ['loc' => '/a-propos.php',                  'changefreq' => 'monthly', 'priority' => '0.3'],
    ['loc' => '/contact.php',                   'changefreq' => 'monthly', 'priority' => '0.3'],
    ['loc' => '/mentions-legales.php',          'changefreq' => 'yearly',  'priority' => '0.1'],
    ['loc' => '/politique-confidentialite.php', 'changefreq' => 'yearly',  'priority' => '0.1'],
];

$archivePages = [];
$archiveDir = __DIR__ . '/data/archives';
if (is_dir($archiveDir)) {
    foreach (glob($archiveDir . '/*.json') as $file) {
        $base = basename($file, '.json');
        if (preg_match('/^([A-Za-z0-9]+)-(\d{4}-\d{4})$/', $base, $mtc)) {
            $archivePages["$mtc[1]-$mtc[2]"] = "/archives.php?comp=" . urlencode($mtc[1]) . "&saison=" . urlencode($mtc[2]);
        }
    }
}
// Saisons en cours (pas encore archivées) : présentes dans matchs.json avec au moins un résultat
$matchsAll = json_decode(@file_get_contents(__DIR__ . '/data/matchs.json'), true) ?? [];
foreach ($matchsAll as $m) {
    if (($m['status'] ?? '') !== 'FINISHED' || empty($m['competition'])) { continue; }
    $s = $m['saison'] ?? saison_fr($m['date']);
    $archivePages["$m[competition]-$s"] = "/archives.php?comp=" . urlencode($m['competition']) . "&saison=" . urlencode($s);
}
$archivePages = array_values($archivePages);

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
<?php foreach ($archivePages as $loc): ?>
  <url>
    <loc>https://football-passion.fr<?= htmlspecialchars($loc) ?></loc>
    <changefreq>yearly</changefreq>
    <priority>0.3</priority>
  </url>
<?php endforeach; ?>
</urlset>
