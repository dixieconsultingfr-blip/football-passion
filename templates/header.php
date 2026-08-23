<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="<?php echo htmlspecialchars($meta_desc ?? 'Hub evergreen football — L1, L2, CL, Europa, Euro, CDM, CAN'); ?>" />
    <title><?php echo htmlspecialchars($page_title ?? 'Football Passion'); ?></title>

    <?php
    $og_url_final   = $canonical_url ?? ('https://football-passion.fr' . strtok($_SERVER['REQUEST_URI'] ?? '/', '?'));
    $og_title_final = $page_title ?? 'Football Passion';
    $og_desc_final  = $meta_desc  ?? 'Hub evergreen football — L1, L2, CL, Europa, Euro, CDM, CAN';
    $og_image_final = $og_image   ?? 'https://football-passion.fr/images/charte-graphique/logo-fp-icon-512.png';
    if ($og_image_final !== '' && $og_image_final[0] === '/') {
        $og_image_final = 'https://football-passion.fr' . $og_image_final;
    }
    $og_type_final = $og_type ?? 'website';
    ?>
    <link rel="canonical" href="<?php echo htmlspecialchars($og_url_final); ?>" />

    <!-- Open Graph -->
    <meta property="og:type" content="<?php echo htmlspecialchars($og_type_final); ?>" />
    <meta property="og:site_name" content="Football Passion" />
    <meta property="og:locale" content="fr_FR" />
    <meta property="og:url" content="<?php echo htmlspecialchars($og_url_final); ?>" />
    <meta property="og:title" content="<?php echo htmlspecialchars($og_title_final); ?>" />
    <meta property="og:description" content="<?php echo htmlspecialchars($og_desc_final); ?>" />
    <meta property="og:image" content="<?php echo htmlspecialchars($og_image_final); ?>" />

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="<?php echo htmlspecialchars($og_title_final); ?>" />
    <meta name="twitter:description" content="<?php echo htmlspecialchars($og_desc_final); ?>" />
    <meta name="twitter:image" content="<?php echo htmlspecialchars($og_image_final); ?>" />

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="/images/charte-graphique/favicon.svg" />
    <link rel="icon" type="image/x-icon" href="/images/charte-graphique/favicon.ico" />
    <link rel="apple-touch-icon" href="/images/charte-graphique/apple-touch-icon.png" />

    <!-- Google AdSense -->
    <meta name="google-adsense-account" content="ca-pub-1397315006076063">
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-1397315006076063"
     crossorigin="anonymous"></script>
</head>
<body class="bg-gray-950 text-gray-100">
    <header class="bg-gray-900 border-b border-green-500">
        <nav class="max-w-6xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="/" class="flex items-center">
                <img src="/images/charte-graphique/logo-football-passion.svg" alt="Football Passion" class="h-8 w-auto" />
            </a>
            <ul class="flex gap-6">
                <li><a href="/" class="hover:text-green-400">Accueil</a></li>
                <li><a href="/calendrier.php" class="hover:text-green-400">Calendrier</a></li>
                <li><a href="/archives.php" class="hover:text-green-400">Archives</a></li>
                <li><a href="/blog" class="hover:text-green-400">Blog</a></li>
                <li><a href="/droits-tv-football.php" class="hover:text-green-400">Droits TV</a></li>
            </ul>
        </nav>
    </header>
    <main class="max-w-6xl mx-auto px-4 py-8">
