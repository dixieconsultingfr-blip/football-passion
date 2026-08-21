<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="<?php echo htmlspecialchars($meta_desc ?? 'Hub evergreen football — L1, L2, CL, Europa, Euro, CDM, CAN'); ?>" />
    <title><?php echo htmlspecialchars($page_title ?? 'Football Passion'); ?></title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="/images/charte-graphique/favicon.svg" />
    <link rel="icon" type="image/x-icon" href="/images/charte-graphique/favicon.ico" />
    <link rel="apple-touch-icon" href="/images/charte-graphique/apple-touch-icon.png" />
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
